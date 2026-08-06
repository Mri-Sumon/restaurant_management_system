@extends('master')
@section('title', 'Terms and Conditions')
@section('breadcrumb_title', 'Terms and Conditions')
@section('content')

<div id="terms">
    <form @submit.prevent="saveTerm">
        <div class="row">
            <div class="col-md-12">
                <fieldset class="scheduler-border bg-of-skyblue">
                    <legend class="scheduler-border">Terms and Conditions Form</legend>

                    <div class="control-group">
                        <div class="col-md-12" style="padding: 0; margin-top: 30px;">
                            <div class="form-group clearfix">
                                <label class="control-label col-md-3">Title:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="title" autocomplete="off" v-model="term.title">
                                </div>
                            </div>

                            <div class="form-group clearfix" style="margin-bottom: 15px;">
                                <label class="control-label col-md-3">Description:</label>
                                <div class="col-md-9 text-left">
                                    <textarea id="editor" class="form-control" name="description"></textarea>
                                </div>
                            </div>

                            <div class="form-group clearfix">
                                <label class="col-md-3"></label>
                                <div class="col-md-9 text-right">
                                    @if(userAction('e'))
                                    <button type="button" class="btn btn-danger btn-reset" @click="clearForm">Reset</button>
                                    <button :disabled="onProgress" type="submit" class="btn btn-primary btn-padding" v-html="btnText"></button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-sm-12 form-inline">
            <div class="form-group">
                <input type="text" class="form-control" v-model="filter" placeholder="Filter">
            </div>
        </div>

        <div class="col-md-12">
            <div class="table-responsive">
                <datatable :columns="columns" :data="terms" :filter-by="filter">
                    <template slot-scope="{ row }">
                        <tr>
                            <td>@{{ row.sl }}</td>
                            <td>@{{ row.title }}</td>
                            <td v-html="row.description"></td>
                            <td>
                                @if(userAction('u'))
                                <i @click="editData(row)" class="fa fa-pencil text-primary" style="cursor:pointer;"></i>
                                @endif
                                @if(userAction('d'))
                                <i @click="deleteData(row.id)" class="fa fa-trash text-danger" style="cursor:pointer;"></i>
                                @endif
                            </td>
                        </tr>
                    </template>
                </datatable>
                <datatable-pager v-model="page" type="abbreviated" :per-page="per_page"></datatable-pager>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    let editor;
    $(document).ready(function() {
        ClassicEditor.create(document.querySelector('#editor'))
            .then(newEditor => {
                editor = newEditor;
            }).catch(error => {
                console.error(error);
            });
    });

    new Vue({
        el: '#terms',
        data() {
            return {
                columns: [
                    { label: 'Sl', field: 'sl', align: 'center', filterable: false },
                    { label: 'Title', field: 'title', align: 'center' },
                    { label: 'Description', field: 'description', align: 'center' },
                    { label: 'Action', align: 'center', filterable: false }
                ],
                page: 1,
                per_page: 20,
                filter: '',
                term: { id: "", title: "", description: "" },
                terms: [],
                onProgress: false,
                btnText: "Save",
            }
        },

        created() {
            this.getTerms();
        },

        methods: {

            getTerms() {
                axios.get("/get_terms_and_conditions")
                    .then(res => {
                        this.terms = res.data.map((item, index) => ({
                            ...item,
                            sl: index + 1
                        }));
                    }).catch(err => {
                        toastr.error("Failed to fetch terms.");
                    });
            },

            saveTerm(event) {
                this.term.description = editor.getData();

                let data = {
                    title: this.term.title,
                    description: this.term.description
                };

                let url = '/terms_and_conditions';
                let method = 'post';

                if (this.term.id) {
                    url = '/terms_and_conditions/' + this.term.id;
                    method = 'put';
                }

                this.onProgress = true;

                axios({
                    method: method,
                    url: url,
                    data: data,
                })
                .then(res => {
                    toastr.success(res.data);
                    this.clearForm();
                    this.getTerms();
                    this.btnText = "Save";
                })
                .catch(err => {
                    toastr.error(err.response?.data?.message || "Error occurred.");
                })
                .finally(() => {
                    this.onProgress = false;
                });
            },

            editData(row) {
                this.btnText = "Update";
                this.term = { ...row };
                editor.setData(row.description || "");
            },

            deleteData(rowId) {
                if (confirm("Are you sure?")) {
                    axios.delete("/terms_and_conditions/" + rowId) 
                        .then(res => {
                            toastr.success(res.data);
                            this.getTerms();
                        })
                        .catch(err => {
                            toastr.error(err.response?.data?.message || "Error occurred.");
                        });
                }
            },

            clearForm() {
                this.term = { id: "", title: "", description: "" };
                editor.setData("");
                this.btnText = "Save";
            }
        }
    });
</script>
@endpush

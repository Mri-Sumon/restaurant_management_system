@extends('master')
@section('title', 'Privacy Policy')
@section('breadcrumb_title', 'Privacy Policy')
@section('content')

<div id="privacy">
    <form @submit.prevent="savePrivacy">
        <div class="row">
            <div class="col-md-12">
                <fieldset class="scheduler-border bg-of-skyblue">
                    <legend class="scheduler-border">Privacy Policy Form</legend>

                    <div class="control-group">
                        <div class="col-md-12" style="padding: 0; margin-top: 30px;">
                            <div class="form-group clearfix">
                                <label class="control-label col-md-3">Title:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="title" autocomplete="off" v-model="privacy.title">
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
                <datatable :columns="columns" :data="privacies" :filter-by="filter">
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
        el: '#privacy',
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
                privacy: { id: "", title: "", description: "" },
                privacies: [],
                onProgress: false,
                btnText: "Save",
            }
        },

        created() {
            this.getPrivacies();
        },

        methods: {
            getPrivacies() {
                axios.get("/get_privacy_policy")
                    .then(res => {
                        this.privacies = res.data.map((item, index) => ({
                            ...item,
                            sl: index + 1
                        }));
                    }).catch(err => {
                        console.error(err);
                        toastr.error("Failed to fetch privacy policies.");
                    });
            },

            savePrivacy(event) {
                this.privacy.description = editor.getData();

                let data = {
                    title: this.privacy.title,
                    description: this.privacy.description
                };

                let url = '/privacy_policy';
                let method = 'post';

                if (this.privacy.id) {
                    url = '/privacy_policy/' + this.privacy.id;
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
                    this.getPrivacies();
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
                this.privacy = { ...row };
                editor.setData(row.description || "");
            },

            deleteData(rowId) {
                if (confirm("Are you sure?")) {
                    axios.delete("/privacy_policy/" + rowId) 
                        .then(res => {
                            toastr.success(res.data);
                            this.getPrivacies();
                        })
                        .catch(err => {
                            toastr.error(err.response?.data?.message || "Error occurred.");
                        });
                }
            },

            clearForm() {
                this.privacy = { id: "", title: "", description: "" };
                editor.setData("");
                this.btnText = "Save";
            }
        }
    });
</script>
@endpush

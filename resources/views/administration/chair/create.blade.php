@extends('master')
@section('title', 'Chair Entry')
@section('breadcrumb_title', 'Chair Entry')
@push('style')
<style>
    .v-select .selected-tag {
        margin: 8px 2px !important;
    }

    .fa-barcode {
        border: 1px solid gray;
        border-radius: 3px;
        padding: 0px 3px;
        font-weight: 600;
    }
</style>
@endpush
@section('content')
<div id="chairForm">
    <form @submit.prevent="saveChair">
        <div class="row" style="margin:0;">
            <div class="col-md-12 col-xs-12" style="padding: 0;">
                <fieldset class="scheduler-border bg-of-skyblue">
                    <legend class="scheduler-border">Chair Entry Form</legend>
                    <div class="control-group">
                        <div class="col-xs-12 col-md-6 col-md-offset-3" style="padding: 0;">
                            <div class="form-group clearfix">
                                <label class="control-label col-xs-4 col-md-4">Chair Code:</label>
                                <div class=" col-xs-8 col-md-7">
                                    <input type="text" class="form-control" name="code" v-model="chair.code">
                                </div>
                            </div>

                            <div class="form-group clearfix">
                                <label class="control-label col-xs-4 col-md-4">Table:<sup class="text-danger">*</sup> </label>
                                <div class="col-xs-7 col-md-7" style="display: flex;align-items:center;margin-bottom:5px;">
                                    <div style="width: 88%;">
                                        <v-select :options="tables" style="margin: 0;" v-model="selectedTable" label="name" placeholder="Select Table"></v-select>
                                    </div>
                                    <div style="width: 11%;">
                                        <a href="/table" title="Add New Table" class="btn btn-xs btn-danger" style="width: 100%;height: 23px;border: 0px;border-radius: 3px;" target="_blank"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group clearfix">
                                <label class="control-label col-xs-4 col-md-4">Chair Name:<sup class="text-danger">*</sup></label>
                                <div class="col-xs-8 col-md-7">
                                    <input type="text" class="form-control" name="name" v-model="chair.name" autocomplete="off" />
                                </div>
                            </div>

                            <div class="form-group clearfix" style="margin-bottom:5px;">
                                <div class="col-md-4 text-right no-padding-right">
                                </div>
                                <div class="col-md-3" style="display: flex;align-items: center;gap: 5px;">
                                    <input type="checkbox" id="status" name="status" v-model="chair.status" true-value="a" false-value="p" style="width: 15px; height: 15px;margin: 3px 0px;">
                                    <label for="status" style="margin: 0;cursor:pointer;" class="control-label">Is Active</label>
                                </div>
                            </div>

                            <div class="form-group clearfix">
                                <label class="col-md-4"></label>
                                <div class="col-md-7 text-right">
                                    @if(userAction('e'))
                                    <input type="button" class="btn btn-danger btn-reset" value="Reset" @click="clearForm">
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
                <label for="filter" class="sr-only">Filter</label>
                <input type="text" class="form-control" v-model="filter" placeholder="Filter">
            </div>
        </div>
        <div class="col-md-12">
            <div class="table-responsive">
                <datatable :columns="columns" :data="chairs" :filter-by="filter" style="margin-bottom: 5px;">
                    <template scope="{ row }">
                        <tr :style="{background: row.status == 'p' ? '#ffdb9a' : ''}" :title="row.status == 'p' ? 'Inactive' : ''">
                            <td>@{{ row.sl }}</td>
                            <td>@{{ row.code }}</td>
                            <td>@{{ row.name }}</td>
                            <td>@{{ row.table_name }}</td>
                            <td>
                                @if(userAction('u'))
                                <i @click="editData(row)" class="fa fa-pencil"></i>
                                @endif
                                @if(userAction('d'))
                                <i @click="deleteData(row.id)" class="fa fa-trash"></i>
                                @endif
                            </td>
                        </tr>
                    </template>
                </datatable>
                <datatable-pager v-model="page" type="abbreviated" :per-page="per_page" style="margin-bottom: 50px;"></datatable-pager>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    new Vue({
        el: '#chairForm',
        data() {
            return {
                columns: [{
                        label: 'Sl',
                        field: 'sl',
                        align: 'center',
                        filterable: false
                    },
                    {
                        label: 'Chair Code',
                        field: 'code',
                        align: 'center'
                    },
                    {
                        label: 'Chair Name',
                        field: 'name',
                        align: 'center'
                    },
                    {
                        label: 'Table Name',
                        field: 'table_name',
                        align: 'center'
                    },
                    {
                        label: 'Action',
                        align: 'center',
                        filterable: false
                    }
                ],
                page: 1,
                per_page: 20,
                filter: '',

                chair: {
                    id: "",
                    code: "{{generateCode('Chair', 'C')}}",
                    name: "",
                    bench_id: "",
                    status: "a"
                },
                chairs: [],

                tables: [],
                selectedTable: null,

                onProgress: false,
                btnText: "Save",

                modalHead: "",
                modalData: {
                    id: null,
                    name: ''
                },
                url: '',
            }
        },

        created() {
            this.getChairs();
            this.getTables();
        },

        methods: {
            getTables() {
                axios.get("/get-table").then(res => {
                    this.tables = res.data;
                })
            },
            getChairs() {
                axios.get("/get-chair").then(res => {
                    let r = res.data;
                    this.chairs = r.map((item, index) => {
                        item.sl = index + 1
                        return item;
                    });
                })
            },
            saveChair(event) {
                let formdata = new FormData(event.target)
                formdata.append('id', this.chair.id);
                formdata.append('status', this.chair.status);
                formdata.append('bench_id', this.selectedTable != null ? this.selectedTable.id : '');
                var url;
                if (this.chair.id == '') {
                    url = '/chair';
                } else {
                    url = '/update-chair';
                }
                this.onProgress = true
                axios.post(url, formdata).then(res => {
                    toastr.success(res.data.message);
                    this.getChairs();
                    this.clearForm();
                    this.chair.code = res.data.code;
                    this.btnText = "Save";
                    this.onProgress = false
                }).catch(err => {
                    this.onProgress = false
                    var r = JSON.parse(err.request.response);
                    if (err.request.status == '422' && r.errors != undefined && typeof r.errors == 'object') {
                        $.each(r.errors, (index, value) => {
                            $.each(value, (ind, val) => {
                                toastr.error(val)
                            })
                        })
                    } else {
                        if (r.errors != undefined) {
                            console.log(r.errors);
                        }
                        toastr.error(r.message);
                    }
                })
            },
            editData(row) {
                this.btnText = "Update";
                let keys = Object.keys(this.chair);
                keys.forEach(key => {
                    this.chair[key] = row[key];
                });
                if (row.bench_id != null) {
                    this.selectedTable = {
                        id: row.bench_id,
                        name: row.table_name
                    }
                }
            },
            deleteData(rowId) {
                let formdata = {
                    id: rowId
                }
                if (confirm("Are you sure !!")) {
                    axios.post("/delete-chair", formdata).then(res => {
                        toastr.success(res.data)
                        this.getChairs();
                    }).catch(err => {
                        var r = JSON.parse(err.request.response);
                        if (r.errors != undefined) {
                            console.log(r.errors);
                        }
                        toastr.error(r.message);
                    })
                }
            },
            clearForm() {
                this.chair = {
                    id: "",
                    code: "{{generateCode('Chair', 'C')}}",
                    name: "",
                    bench_id: "",
                    status: "a",
                };
                this.selectedTable = null;
            }
        }
    })
</script>
@endpush
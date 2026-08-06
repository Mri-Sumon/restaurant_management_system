@extends('master')
@section('title', 'Messages')
@section('breadcrumb_title', 'Messages')
@push('style')
<style>
    .read-style {
        background: #eee;
    }
</style>
@endpush

@section('content')
    <div id="message">
        <div class="row">
            <div class="col-sm-12 form-inline">
                <div class="form-group">
                    <label for="filter" class="sr-only">Filter</label>
                    <input type="text" class="form-control" v-model="filter" placeholder="Filter">
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <datatable :columns="columns" :data="messages" :filter-by="filter"
                        style="margin-bottom: 5px;">
                        <template scope="{ row }">
                            <tr :class="{ 'read-style': row.is_read == 'd' }">
                                <td>@{{ row.sl }}</td>
                                <td>@{{ row.name }}</td>
                                <td>@{{ row.email }}</td>
                                <td>@{{ row.phone }}</td>
                                <td>@{{ row.subject }}</td>
                                <td>
                                    @if (userAction('u'))
                                        <i @click="viewMessage(row.id)" class="fa fa-eye"></i>
                                    @endif
                                    @if (userAction('d'))
                                        <i @click="deleteData(row.id)" class="fa fa-trash"></i>
                                    @endif
                                </td>
                            </tr>
                        </template>
                    </datatable>
                    <datatable-pager v-model="page" type="abbreviated" :per-page="per_page"
                        style="margin-bottom: 50px;"></datatable-pager>
                </div>
            </div>
        </div>
        <div id="viewMessage" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <!-- Modal content-->
                <div class="modal-content">
                    <form @submit.prevent="addData">
                        <div class="modal-header" style="padding: 10px 15px">
                            <button type="button" @click="resetModal" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">@{{ modalHead }}</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <p>@{{ modalData.message }}</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info btn-reset" data-dismiss="modal">Close</button>
                            <a href="#" class="btn btn-reset btn-danger">Delete</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        new Vue({
            el: '#message',
            data() {
                return {
                    columns: [{
                            label: 'Sl',
                            field: 'sl',
                            align: 'center',
                            filterable: false
                        },
                        {
                            label: 'Name',
                            field: 'name',
                            align: 'center'
                        },
                        {
                            label: 'Email',
                            field: 'email',
                            align: 'center'
                        },
                        {
                            label: 'Phone',
                            field: 'phone',
                            align: 'center'
                        },
                        {
                            label: 'Subject',
                            field: 'subject',
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

                    messages: [],

                    modalHead: "",
                    modalData: {
                        id: null,
                        message: ''
                    },
                }
            },

            created() {
                this.getMessages();
            },

            methods: {
                getMessages() {
                    axios.get("/get-messages")
                        .then(res => {
                            let r = res.data;
                            this.messages = r.map((item, index) => {
                                item.sl = index + 1
                                return item;
                            });
                        })
                },

                deleteData(rowId) {
                    let formdata = {
                        id: rowId
                    }
                    if (confirm("Are you sure !!")) {
                        axios.post("/delete-message", formdata)
                            .then(res => {
                                toastr.success(res.data)
                                this.getMessages();
                            })
                            .catch(err => {
                                var r = JSON.parse(err.request.response);
                                if (r.errors != undefined) {
                                    console.log(r.errors);
                                }
                                toastr.error(r.message);
                            })
                    }
                },

                viewMessage(rowId) {
                    let formdata = {
                        id: rowId
                    }
                    var url;
                    url = '/update-read-status';
                    axios.post(url, formdata)
                        .then(res => {
                            if (res.data.status) {
                                this.modalHead = 'View Message';
                                this.modalData.message = res.data.message;
                                $('#viewMessage').modal('show');
                                this.getMessages();
                            }
                        })
                        .catch(err => {
                            this.onProgress = false
                            var r = JSON.parse(err.request.response);
                            if (err.request.status == '422' && r.errors != undefined && typeof r.errors ==
                                'object') {
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
                resetModal() {
                    this.modalHead = '';
                    this.modalData = {
                        id: null,
                        message: ''
                    }
                },
            },
        })
    </script>
@endpush

@extends('master')
@section('title', 'Cocktail Entry')
@section('breadcrumb_title', 'Cocktail Entry')
@push('style')
<style>
    .charCount {
        font-size: 12px;
        color: #555;
        float: right;
    }

    .v-select .selected-tag {
        margin: 8px 2px !important;
    }

    .slider {
        padding-left: 0;
    }

    .sliderImage {
        padding-right: 0;
    }

    @media (min-width: 320px) and (max-width: 620px) {
        .slider {
            padding: 0;
        }

        .sliderImage {
            padding: 0;
        }
    }

    .ImageBackground .imageShow {
        display: block;
        height: 75px;
        width: 85px;
        border: 1px solid #cccccc;
        box-sizing: border-box;
        margin-bottom: 5px;
    }

    .ImageBackground .bannerImageShow {
        display: block;
        height: 75px;
        width: 100%;
        border: 1px solid #cccccc;
        box-sizing: border-box;
        margin-bottom: 5px;
    }
</style>
@endpush
@section('content')
<div id="cocktail">

    <div class="row" style="margin:0;">
        <div class="col-md-2" style="margin: 0 auto"></div>
        <div class="col-md-8" style="margin: 0 auto">
            <form @submit.prevent="saveCocktail">
                <fieldset class="scheduler-border bg-of-skyblue">
                    <legend class="scheduler-border">Cocktails Entry</legend>
                    <div class="control-group">
                        <div class="col-md-12" style="padding: 0;margin-top: 20px;">
                            <div class="form-group clearfix">
                                <label class="control-label col-md-3">Category:</label>
                                <div class="col-md-9" style="display: flex;align-items:center;margin-bottom:5px;">
                                    <div style="width: 88%;">
                                        <v-select :options="categories" style="margin: 0;" v-model="selectedCategory"
                                            label="name"></v-select>
                                    </div>
                                    <div style="width: 11%;">
                                        <button type="button" @click="openModal" class="btn btn-xs btn-danger"
                                            style="width: 100%;height: 24px;border: 0px;margin-left: 1px;border-radius: 3px;"><i
                                                class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label class="control-label col-md-3">Sub-Title</label>
                                <div class="col-md-9">
                                    <input name="subtitle" class="form-control" id="title"
                                        v-model="cocktail.subtitle">
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label class="control-label col-md-3">Title</label>
                                <div class="col-md-9">
                                    <input name="title" class="form-control" id="title" v-model="cocktail.title">
                                </div>
                            </div>


                            <div class="form-group clearfix">
                                <label class="control-label col-md-3">Centiliter</label>
                                <div class="col-md-9">
                                    <input name="cl" class="form-control" id="price" v-model="cocktail.cl">
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label class="control-label col-md-3">Price</label>
                                <div class="col-md-9">
                                    <input name="price" class="form-control" id="price" v-model="cocktail.price">
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label class="control-label col-md-3">Description</label>
                                <div class="col-md-9">
                                    <textarea name="description" class="form-control" cols="2" rows="2" v-model="cocktail.description"></textarea>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label class="col-md-4"></label>
                                <div class="col-md-8 text-right">
                                    @if (userAction('e'))
                                    <input type="button" class="btn btn-danger btn-reset" value="Reset"
                                        @click="clearForm">
                                    <button :disabled="onProgress" type="submit"
                                        class="btn btn-primary btn-padding" v-html="btnText"></button>
                                    @endif
                                </div>
                            </div>
                        </div>
                </fieldset>
            </form>
        </div>
        <div class="col-md-2" style="margin: 0 auto"></div>
    </div>


    <div class="row">
        <div class="col-sm-12 form-inline">
            <div class="form-group">
                <label for="filter" class="sr-only">Filter</label>
                <input type="text" class="form-control" v-model="filter" placeholder="Filter">
            </div>
        </div>
        <div class="col-md-12">
            <div class="table-responsive">
                <datatable :columns="columns" :data="cocktails" :filter-by="filter"
                    style="margin-bottom: 5px;">
                    <template scope="{ row }">
                        <tr>
                            <td>@{{ row.sl }}</td>
                            <td>@{{ row.category.name }}</td>
                            <td>@{{ row.subtitle }}</td>
                            <td>@{{ row.title }}</td>
                            <td>@{{ row.cl }}</td>
                            <td>@{{ row.price }}</td>
                            <td>@{{ row.description }}</td>
                            <td>
                                @if (userAction('u'))
                                <i @click="editData(row)" class="fa fa-pencil"></i>
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
    @include('administration.settings.modal.common')
</div>
@endsection

@push('script')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<script>
    let editor;
    $(document).ready(function() {
        ClassicEditor.create(document.querySelector('#editor'))
            .then(newEditor => {
                editor = newEditor;
            });
    });
    new Vue({
        el: '#cocktail',
        data() {
            return {
                columns: [{
                        label: 'Sl',
                        field: 'sl',
                        align: 'center',
                        filterable: false
                    },
                    {
                        label: 'Category',
                        field: 'category',
                        align: 'center'
                    },
                    {
                        label: 'Sub-Title',
                        field: 'sub-title',
                        align: 'center'
                    },
                    {
                        label: 'Title',
                        field: 'title',
                        align: 'center'
                    },
                    {
                        label: 'Centiliter ',
                        field: 'centiliter',
                        align: 'center'
                    },
                    {
                        label: 'Price',
                        field: 'price',
                        align: 'center'
                    },
                    {
                        label: 'Description',
                        field: 'description',
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

                cocktail: {
                    id: "",
                    cocktail_category_id: "",
                    subtitle: "",
                    title: "",
                    cl: "",
                    price: "",
                    description: "",
                    // cocktail_image: "",
                },
                cocktailDescription: '',
                // cocktail_image: "",
                cocktails: [],
                // imageSrc_I: "/noImage.gif",
                onProgress: false,
                btnText: "Save",

                categories: [],
                selectedCategory: null,
                modalHead: "",
                modalData: {
                    id: null,
                    name: ''
                }
            }
        },

        created() {
            this.getCocktail();
            this.getCocktailCategory();
        },

        methods: {
            getCocktail() {
                axios.get("/get-cocktails")
                    .then(res => {

                        let r = res.data.cocktail;
                        this.cocktails = r.map((item, index) => {
                            item.sl = index + 1
                            return item;
                        });

                        this.imageSrc_I = res.data.cocktail_image ? '/' + r.cocktail_image : '/noImage.gif';
                        editor.setData(res.data.cocktailDesp.description);
                    })
            },

            getCocktailCategory() {
                axios.get("/get-categoryCocktails")
                    .then(res => {
                        let r = res.data;
                        this.categories = r.map((item, index) => {
                            item.sl = index + 1
                            return item;
                        });
                    })
            },

            saveCocktail(event) {
                let formdata = new FormData(event.target)
                if (this.selectedCategory == null) {
                    alert('Select Category');
                    return;
                } else {
                    this.cocktail.cocktail_category_id = this.selectedCategory.id;
                }
                formdata.append('cocktail_category_id', this.cocktail.cocktail_category_id);
                formdata.append('id', this.cocktail.id);
                var url;
                if (this.cocktail.id == '') {
                    url = '/store-cocktails';
                } else {
                    url = '/update-cocktails';
                }
                this.onProgress = true
                axios.post(url, formdata)
                    .then(res => {
                        toastr.success(res.data);
                        this.clearForm();
                        this.getCocktail();
                        this.btnText = "Save";
                        this.onProgress = false
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

            editData(row) {
                this.btnText = "Update";
                let keys = Object.keys(this.cocktail);
                keys.forEach(key => {
                    this.cocktail[key] = row[key];
                });

                this.selectedCategory = {
                    id: row.cocktail_category_id,
                    name: row.category != null ? row.category.name : ''
                }
            },

            deleteData(rowId) {
                let formdata = {
                    id: rowId
                }
                if (confirm("Are you sure !!")) {
                    axios.post("/delete-cocktails", formdata)
                        .then(res => {
                            toastr.success(res.data)
                            this.getCocktail();
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

            clearForm() {
                this.cocktail = {
                    id: "",
                    subtitle: "",
                    title: "",
                    cl: "",
                    price: "",
                    description: "",
                }
                this.selectedCategory = null;
            },

            openModal() {
                this.modalHead = 'Category Entry';
                $('#commonModal').modal('show');
            },
            resetModal() {
                this.modalHead = '';
                this.modalData = {
                    id: null,
                    name: ''
                }
            },
            addData() {
                url = '/store-categoryCocktails';
                axios.post(url, this.modalData)
                    .then(res => {
                        toastr.success(res.data);
                        this.getCocktailCategory();
                        this.getCocktail();
                        this.resetModal();
                        $('#commonModal').modal('hide');
                    })
                    .catch(err => {
                        var r = JSON.parse(err.request.response);
                        if (r.errors) {
                            $.each(r.errors, (index, value) => {
                                $.each(value, (ind, val) => {
                                    toastr.error(val)
                                })
                            })
                        } else {
                            toastr.error(r.message);
                        }
                    })
            },

        },
    })
</script>
@endpush
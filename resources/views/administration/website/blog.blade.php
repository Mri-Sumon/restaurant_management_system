@extends('master')
@section('title', 'Blog Entry')
@section('breadcrumb_title', 'Blog Entry')
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
    <div id="blog">

        <div class="row" style="margin:0;">
            <form @submit.prevent="saveBlog">
                <div class="col-md-12 slider">
                    <fieldset class="scheduler-border bg-of-skyblue">
                        <legend class="scheduler-border">Blog Entry Form</legend>
                        <div class="control-group">
                            <div class="col-md-2 sliderImage">
                                <div class="form-group ImageBackground clearfix">
                                    <span class="text-danger">(730 × 460) PX</span>
                                    <img :src="imageSrc" class="imageShow" />
                                    <label for="image">Upload Image</label>
                                    <input type="file" id="image" class="form-control shadow-none"
                                        @change="imageUrl" />
                                </div>
                            </div>
                            <div class="col-md-4" style="padding: 0;margin-top: 20px;">
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
                                    <label class="control-label col-md-3">Title</label>
                                    <div class="col-md-9">
                                        <input name="title" class="form-control" id="title" v-model="blog.title">
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="control-label col-md-3">Date</label>
                                    <div class="col-md-9">
                                        <input name="date" type="date" class="form-control" id="date"
                                            v-model="blog.date">
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6" style="padding: 0;margin-top: 20px;">
                                <div class="form-group clearfix" style="margin-bottom: 10px">
                                    <label class="control-label col-md-3">Description</label>
                                    <div class="col-md-9">
                                        <textarea id="editor"></textarea>
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
                </div>
            </form>
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
                    <datatable :columns="columns" :data="blogs" :filter-by="filter"
                        style="margin-bottom: 5px;">
                        <template scope="{ row }">
                            <tr>
                                <td>@{{ row.sl }}</td>
                                <td>
                                    <img :src="`/${row.image ? row.image : 'noImage.gif'}`"
                                        style="width: 40px; border: 1px solid gray; border-radius: 4px; padding: 1px;">
                                </td>
                                <td>@{{ row.date }}</td>
                                <td>@{{ row.title }}</td>
                                <td>@{{ row.category.name }}</td>
                                {{-- <td v-html="row.description"></td> --}}
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
    </script>
    <script>
        new Vue({
            el: '#blog',
            data() {
                return {
                    columns: [{
                            label: 'Sl',
                            field: 'sl',
                            align: 'center',
                            filterable: false
                        },
                        {
                            label: 'Image',
                            field: 'image',
                            align: 'center'
                        },
                        {
                            label: 'Date',
                            field: 'date',
                            align: 'center'
                        },
                        {
                            label: 'Title',
                            field: 'title',
                            align: 'center'
                        },
                        {
                            label: 'Category',
                            field: 'category',
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

                    blog: {
                        id: "",
                        title: "",
                        date: "",
                        description: "",
                        image: "",
                    },
                    blogs: [],

                    imageSrc: "/noImage.gif",
                    bannerImageSrc: "/noImage.gif",
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
                this.getBlogs();
                this.getBlogCategory();
            },

            methods: {
                getBlogs() {
                    axios.get("/get-blog")
                        .then(res => {
                            let r = res.data;
                            this.blogs = r.map((item, index) => {
                                item.sl = index + 1
                                return item;
                            });
                        })
                },
                getBlogCategory() {
                    axios.get("/get-blog-categories")
                        .then(res => {
                            let r = res.data;
                            this.categories = r.map((item, index) => {
                                item.sl = index + 1
                                return item;
                            });
                        })
                },

                saveBlog(event) {
                    let formdata = new FormData(event.target)
                    formdata.append('id', this.blog.id);
                    formdata.append('image', this.blog.image);
                    if (this.selectedCategory == null) {
                        alert('Select Category');
                        return;
                    } else {
                        this.blog.blog_category_id = this.selectedCategory.id;
                        formdata.append('blog_category_id', this.blog.blog_category_id);
                    }
                    formdata.append('description', editor.getData());
                    var url;
                    if (this.blog.id == '') {
                        url = '/store-blog';
                    } else {
                        url = '/update-blog';
                    }
                    this.onProgress = true
                    axios.post(url, formdata)
                        .then(res => {
                            toastr.success(res.data);
                            this.clearForm();
                            this.getBlogs();
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
                    Object.keys(this.blog).forEach(key => {
                        this.blog[key] = row[key] || '';
                    });
                    this.imageSrc = row.image ? "/" + row.image : "/noImage.gif";
                    this.selectedCategory = this.categories.find(cat => cat.id === row.blog_category_id) ||
                        null;
                    if (typeof editor !== 'undefined') {
                        editor.setData(row.description || ''); // CKEditor specific method
                    }
                },


                deleteData(rowId) {
                    let formdata = {
                        id: rowId
                    }
                    if (confirm("Are you sure !!")) {
                        axios.post("/delete-blog", formdata)
                            .then(res => {
                                toastr.success(res.data)
                                this.getBlogs();
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
                    this.blog = {
                        id: "",
                        title: "",
                        date: "",
                        description: "",
                        image: "",
                    };
                    this.imageSrc = "/noImage.gif";
                    this.selectedCategory = null;
                    this.modalData = {
                        id: null,
                        name: ""
                    };
                    this.btnText = "Save";
                    editor.setData('');
                },

                imageUrl(event) {
                    const WIDTH = 730;
                    const HEIGHT = 460;
                    const allowedMimes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'];

                    if (event.target.files[0]) {
                        const file = event.target.files[0];

                        if (!allowedMimes.includes(file.type)) {
                            toastr.error(
                                'Invalid file type. Please select an image with one of the following types: jpeg, png, jpg, gif, svg.'
                            );
                            event.target.value = '';
                            return;
                        }

                        let reader = new FileReader();
                        reader.readAsDataURL(file);
                        reader.onload = (ev) => {
                            let img = new Image();
                            img.src = ev.target.result;
                            img.onload = async e => {
                                let canvas = document.createElement('canvas');
                                canvas.width = WIDTH;
                                canvas.height = HEIGHT;
                                const context = canvas.getContext("2d");
                                context.drawImage(img, 0, 0, canvas.width, canvas.height);
                                let new_img_url = context.canvas.toDataURL(file.type);
                                this.imageSrc = new_img_url;
                                const resizedImage = await new Promise(rs => canvas.toBlob(rs,
                                    'image/jpeg', 1));
                                this.blog.image = new File([resizedImage], file.name, {
                                    type: resizedImage.type
                                });
                            }
                        }
                    } else {
                        event.target.value = '';
                    }
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
                    url = '/storeBlogCategory';
                    axios.post(url, this.modalData)
                        .then(res => {
                            toastr.success(res.data);
                            this.getBlogs();
                            this.getBlogCategory();
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

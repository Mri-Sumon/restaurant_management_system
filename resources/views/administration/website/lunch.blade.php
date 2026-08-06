@extends('master')
@section('title', 'LunchPage Entry')
@section('breadcrumb_title', 'LunchPage Entry')
@push('style')
    <style>
        .v-select .selected-tag {
            margin: 8px 2px !important;
        }

        .lunchpage {
            padding-left: 0;
        }

        .lunchpageImage {
            padding-right: 0;
        }

        @media (min-width: 320px) and (max-width: 620px) {
            .lunchpage {
                padding: 0;
            }

            .lunchpageImage {
                padding: 0;
            }
        }
    </style>
@endpush
@section('content')
    <div id="lunchpage">
        <form @submit.prevent="updateLucnh">
            <div class="row" style="margin:0;">
                <div class="col-md-2 lunchpageImage">
                    <fieldset class="scheduler-border bg-of-skyblue">
                        <legend class="scheduler-border">Option A Image</legend>
                        <div class="control-group">
                            <div class="form-group ImageBackground clearfix">
                                <span class="text-danger">(540 X 250)PX</span>
                                <img :src="imageSrc" class="imageShow" />
                                <label for="image">Upload Image</label>
                                <input type="file" id="image" class="form-control shadow-none" @change="imageUrl" />
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="scheduler-border bg-of-skyblue">
                        <legend class="scheduler-border">Option B Image</legend>
                        <div class="control-group">
                            <div class="form-group ImageBackground clearfix">
                                <span class="text-danger">(540 X 810)PX</span>
                                <img :src="imageSrc_I" class="imageShow" />
                                <label for="image_I">Upload Image</label>
                                <input type="file" id="image_I" class="form-control shadow-none" @change="imageUrl_I" />
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-2 lunchpageImage">
                    <fieldset class="scheduler-border bg-of-skyblue">
                        <legend class="scheduler-border">Option C Image</legend>
                        <div class="control-group">
                            <div class="form-group ImageBackground clearfix">
                                <span class="text-danger">(540 X 810)PX</span>
                                <img :src="imageSrc_C" class="imageShow" />
                                <label for="image_C">Upload Image</label>
                                <input type="file" id="image_C" class="form-control shadow-none" @change="imageUrl_C" />
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="scheduler-border bg-of-skyblue">
                        <legend class="scheduler-border">Option D Image</legend>
                        <div class="control-group">
                            <div class="form-group ImageBackground clearfix">
                                <span class="text-danger">(540 X 810)PX</span>
                                <img :src="imageSrc_D" class="imageShow" />
                                <label for="image_D">Upload Image</label>
                                <input type="file" id="image_D" class="form-control shadow-none" @change="imageUrl_D" />
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-8">
                    <fieldset class="scheduler-border bg-of-skyblue">
                        <legend class="scheduler-border">Lunch Update Form</legend>
                        <div class="control-group">
                            <div class="col-md-2"></div>
                            <div class="col-md-8" style="padding: 0;">
                                <div class="form-group clearfix">
                                    <label class="control-label">Lunch Time Start - End:</label>
                                    <input type="text" class="form-control" name="lunch_time" autocomplete="off"
                                        v-model="lunch.lunch_time">
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <div class="form-group clearfix">
                                    <label class="control-label">Option A Menu Price:</label>
                                    <input type="text" class="form-control" name="optionA_price" autocomplete="off"
                                        v-model="lunch.optionA_price">
                                </div>
                                <div class="form-group clearfix">
                                    <label class="control-label">Option A Menu Description:</label>
                                    <textarea id="editor"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group clearfix">
                                    <label class="control-label">Option B Menu Price:</label>
                                    <input type="text" class="form-control" name="optionB_price" autocomplete="off"
                                        v-model="lunch.optionB_price">
                                </div>
                                <div class="form-group clearfix">
                                    <label class="control-label">Option B Menu Description:</label>
                                    <textarea id="editor_I"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group clearfix text-right" style="margin-top: 5px;">
                                    @if (userAction('e'))
                                        <button :disabled="onProgress" type="submit" class="btn btn-primary btn-padding"
                                            v-html="btnText"></button>
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                    </fieldset>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
    <script>
        let editor;
        let editor_I;
        $(document).ready(function() {
            ClassicEditor.create(document.querySelector('#editor'))
                .then(newEditor => {
                    editor = newEditor;
                });
        });
        $(document).ready(function() {
            ClassicEditor.create(document.querySelector('#editor_I'))
                .then(newEditor_I => {
                    editor_I = newEditor_I;
                });
        });
        new Vue({
            el: '#lunchpage',
            data() {
                return {
                    lunch: {
                        lunch_time: "",
                        optionA_menu: "",
                        optionA_price: "",
                        optionA_image: "",
                        optionB_menu: "",
                        optionB_price: "",
                        optionB_image: "",
                        optionC_image: "",
                        optionD_image: "",
                    },

                    imageSrc: "/noImage.gif",
                    imageSrc_I: "/noImage.gif",
                    imageSrc_C: "/noImage.gif",
                    imageSrc_D: "/noImage.gif",
                    onProgress: false,
                    btnText: "Update",
                }
            },

            created() {
                this.getLunch();
            },

            methods: {
                getLunch() {
                    axios.get("/get-lunch")
                        .then(res => {
                            let r = res.data;
                            this.imageSrc = r.optionA_image ? '/' + r.optionA_image : '/noImage.gif';
                            this.imageSrc_I = r.optionB_image ? '/' + r.optionB_image : '/noImage.gif';
                            this.imageSrc_C = r.optionC_image ? '/' + r.optionC_image : '/noImage.gif';
                            this.imageSrc_D = r.optionD_image ? '/' + r.optionD_image : '/noImage.gif';
                            editor.setData(r.optionA_menu);
                            editor_I.setData(r.optionB_menu);
                            this.lunch = r;
                        })
                },

                updateLucnh(event) {
                    let formdata = new FormData(event.target);
                    formdata.append('optionA_image', this.lunch.optionA_image);
                    formdata.append('optionB_image', this.lunch.optionB_image);
                    formdata.append('optionC_image', this.lunch.optionC_image);
                    formdata.append('optionD_image', this.lunch.optionD_image);
                    formdata.append('optionA_menu', editor.getData());
                    formdata.append('optionB_menu', editor_I.getData());
                    var url = '/update-lunch';
                    this.onProgress = true
                    axios.post(url, formdata)
                        .then(res => {
                            toastr.success(res.data);
                            this.getLunch();
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

                imageUrl(event) {
                    const WIDTH = 540;
                    const HEIGHT = 250;
                    if (event.target.files[0]) {
                        let reader = new FileReader();
                        reader.readAsDataURL(event.target.files[0]);
                        reader.onload = (ev) => {
                            let img = new Image();
                            img.src = ev.target.result;
                            img.onload = async e => {
                                let canvas = document.createElement('canvas');
                                canvas.width = WIDTH;
                                canvas.height = HEIGHT;
                                const context = canvas.getContext("2d");
                                context.drawImage(img, 0, 0, canvas.width, canvas.height);
                                let new_img_url = context.canvas.toDataURL(event.target.files[0].type);
                                this.imageSrc = new_img_url;
                                const resizedImage = await new Promise(rs => canvas.toBlob(rs,
                                    'image/jpeg', 1))
                                this.lunch.optionA_image = new File([resizedImage], event.target.files[0]
                                    .name, {
                                        type: resizedImage.type
                                    });
                            }
                        }
                    } else {
                        event.target.value = '';
                    }
                },
                imageUrl_I(event) {
                    const WIDTH = 540;
                    const HEIGHT = 810;
                    if (event.target.files[0]) {
                        let reader = new FileReader();
                        reader.readAsDataURL(event.target.files[0]);
                        reader.onload = (ev) => {
                            let img = new Image();
                            img.src = ev.target.result;
                            img.onload = async e => {
                                let canvas = document.createElement('canvas');
                                canvas.width = WIDTH;
                                canvas.height = HEIGHT;
                                const context = canvas.getContext("2d");
                                context.drawImage(img, 0, 0, canvas.width, canvas.height);
                                let new_img_url = context.canvas.toDataURL(event.target.files[0].type);
                                this.imageSrc_I = new_img_url;
                                const resizedImage = await new Promise(rs => canvas.toBlob(rs,
                                    'image/jpeg', 1))
                                this.lunch.optionB_image = new File([resizedImage], event.target.files[0]
                                    .name, {
                                        type: resizedImage.type
                                    });
                            }
                        }
                    } else {
                        event.target.value = '';
                    }
                },
                imageUrl_C(event) {
                    const WIDTH = 540;
                    const HEIGHT = 810;
                    if (event.target.files[0]) {
                        let reader = new FileReader();
                        reader.readAsDataURL(event.target.files[0]);
                        reader.onload = (ev) => {
                            let img = new Image();
                            img.src = ev.target.result;
                            img.onload = async e => {
                                let canvas = document.createElement('canvas');
                                canvas.width = WIDTH;
                                canvas.height = HEIGHT;
                                const context = canvas.getContext("2d");
                                context.drawImage(img, 0, 0, canvas.width, canvas.height);
                                let new_img_url = context.canvas.toDataURL(event.target.files[0].type);
                                this.imageSrc_C = new_img_url;
                                const resizedImage = await new Promise(rs => canvas.toBlob(rs,
                                    'image/jpeg', 1))
                                this.lunch.optionC_image = new File([resizedImage], event.target.files[0]
                                    .name, {
                                        type: resizedImage.type
                                    });
                            }
                        }
                    } else {
                        event.target.value = '';
                    }
                },
                imageUrl_D(event) {
                    const WIDTH = 540;
                    const HEIGHT = 810;
                    if (event.target.files[0]) {
                        let reader = new FileReader();
                        reader.readAsDataURL(event.target.files[0]);
                        reader.onload = (ev) => {
                            let img = new Image();
                            img.src = ev.target.result;
                            img.onload = async e => {
                                let canvas = document.createElement('canvas');
                                canvas.width = WIDTH;
                                canvas.height = HEIGHT;
                                const context = canvas.getContext("2d");
                                context.drawImage(img, 0, 0, canvas.width, canvas.height);
                                let new_img_url = context.canvas.toDataURL(event.target.files[0].type);
                                this.imageSrc_D = new_img_url;
                                const resizedImage = await new Promise(rs => canvas.toBlob(rs,
                                    'image/jpeg', 1))
                                this.lunch.optionD_image = new File([resizedImage], event.target.files[0]
                                    .name, {
                                        type: resizedImage.type
                                    });
                            }
                        }
                    } else {
                        event.target.value = '';
                    }
                }
            },
        })
    </script>
@endpush

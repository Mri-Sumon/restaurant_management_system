@extends('master')
@section('title', 'Cocktail Description')
@section('breadcrumb_title', 'Cocktail Description')
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
        height: 105px;
        width: 115px;
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
        <div class="col-md-12" style="margin: 0 auto">
            <form @submit.prevent="saveCocktailDescription">
                <div class="col-md-8" style="margin: 0 auto">
                    <fieldset class="scheduler-border bg-of-skyblue">
                        <legend class="scheduler-border">Cocktails Description</legend>
                        <div class="control-group">
                            <div class="form-group clearfix">
                                <div class="col-md-12">
                                    <textarea id="editor"></textarea>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label class="col-md-4"></label>
                                <div class="col-md-8 text-right">
                                    @if (userAction('e'))
                                    <button type="submit" class="btn btn-primary btn-padding">Update</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-2" style="margin: 0 auto">
                    <fieldset class="scheduler-border bg-of-skyblue">
                        <legend class="scheduler-border">Image</legend>
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
                <div class="col-md-2" style="margin: 0 auto">
                    <fieldset class="scheduler-border bg-of-skyblue">
                        <legend class="scheduler-border">Video</legend>
                        <div class="control-group">
                            <div class="form-group ImageBackground clearfix">
                                <span class="text-danger">(MP4 Only)</span>
                                <video v-if="videoSrc_I" controls class="videoShow" style="width: 100%; height: auto; margin-bottom: 5px;">
                                    <source :src="videoSrc_I" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <label for="video_I">Upload Video</label>
                                <input type="file" id="video_I" class="form-control shadow-none" @change="videoUrl_I" />
                            </div>
                        </div>
                    </fieldset>
                </div>
            </form>
        </div>

    </div>
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
                cocktail: {
                    description: "",
                    cocktail_image: "",
                    cocktail_video: "",
                },
                imageSrc_I: "/noImage.gif",
                videoSrc_I: "",
            };
        },

        methods: {
            getCocktail() {
                axios.get("/get-cocktails")
                    .then(res => {
                        let r = res.data.cocktailDesp;

                      
                        if (r.cocktail_image != '' || r.cocktail_image != undefined) {
                            this.imageSrc_I = r.cocktail_image;
                        } else {
                            this.imageSrc_I = "/noImage.gif";
                        }
                        if (res.data.cocktailDesp) {
                            editor.setData(res.data.cocktailDesp.description || '');
                        }
                    })
                    .catch(err => {
                        console.error("Error fetching cocktails:", err);
                        toastr.error("Unable to load cocktails.");
                    });
            },


            imageUrl_I(event) {
                if (event.target.files[0]) {
                    const file = event.target.files[0];
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.imageSrc_I = e.target.result;
                    };
                    reader.readAsDataURL(file);
                    this.cocktail.cocktail_image = file;
                } else {
                    this.imageSrc_I = "/noImage.gif";
                }
            },

            videoUrl_I(event) {
                if (event.target.files[0]) {
                    const file = event.target.files[0];
                    if (file.type === "video/mp4") {
                        this.videoSrc_I = URL.createObjectURL(file);
                        this.cocktail.cocktail_video = file;
                    } else {
                        toastr.error("Please upload a valid MP4 video.");
                        this.videoSrc_I = "";
                    }
                } else {
                    this.videoSrc_I = "";
                }
            },

            saveCocktailDescription(event) {
                const formdata = new FormData();
                formdata.append('description', editor.getData());
                formdata.append('cocktail_image', this.cocktail.cocktail_image || '');
                formdata.append('cocktail_video', this.cocktail.cocktail_video || '');

                axios.post('/update-description-cocktails', formdata)
                    .then(res => {
                        toastr.success("Cocktail description updated successfully.");
                        this.getCocktail();
                    })
                    .catch(err => {
                        toastr.error("An error occurred while saving the data.");
                        console.error(err);
                    });
            },
        },

        created() {
            this.getCocktail();
        },
    });
</script>
@endpush
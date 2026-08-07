@extends('master')

@section('title')
    {{ Auth::user()->name }} - Profile
@endsection

@section('breadcrumb_title')
    {{ Auth::user()->name }} - Profile
@endsection

@push('style')
    <style scoped>
        .profile-card {
            background: #ffffff;
            border: 1px solid #e3e8ee;
            border-radius: 4px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
            padding: 24px;
            margin-bottom: 20px;
        }

        .profile-avatar-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-bottom: 15px;
        }

        .profile-avatar {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #438eb9;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            margin-bottom: 12px;
            transition: transform 0.2s ease;
        }

        .profile-avatar:hover {
            transform: scale(1.02);
        }

        .upload-btn-label {
            cursor: pointer;
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            color: #555;
            padding: 4px 12px;
            font-size: 12px;
            border-radius: 3px;
            transition: all 0.2s ease;
        }

        .upload-btn-label:hover {
            background-color: #e6e6e6;
            color: #333;
        }

        .profile-user-info-striped {
            display: table;
            width: 100%;
            border: 1px solid #e0e0e0;
        }

        .profile-user-info-striped .profile-info-row {
            display: table-row;
        }

        .profile-user-info-striped .profile-info-row:nth-child(even) {
            background-color: #f9f9f9;
        }

        .profile-user-info-striped .profile-info-name {
            display: table-cell;
            width: 150px;
            text-align: right;
            padding: 10px 15px;
            font-weight: 600;
            color: #478fca;
            border-bottom: 1px dashed #e0e0e0;
            vertical-align: middle;
        }

        .profile-user-info-striped .profile-info-value {
            display: table-cell;
            padding: 10px 15px;
            border-bottom: 1px dashed #e0e0e0;
            vertical-align: middle;
        }

        .section-header {
            border-bottom: 2px solid #438eb9;
            color: #438eb9;
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 15px;
            padding-bottom: 5px;
        }

        .custom-form-control {
            max-width: 320px;
            border-radius: 3px !important;
        }

        .v-select .dropdown-toggle {
            padding: 0px;
            height: 26px !important;
        }

        .v-select .dropdown-menu {
            width: 350px !important;
            overflow-y: auto !important;
        }
    </style>
@endpush

@section('content')
    <div class="row" id="userProfile">
        <div class="col-xs-12">
            <div class="profile-card">
                <form @submit.prevent="profileUpdate($event)">
                    <div class="row">
                        <!-- Sidebar: Profile Details -->
                        <div class="col-xs-12 col-sm-4 col-md-3 text-center">
                            <div class="profile-avatar-wrapper">
                                <img :src="imageSrc" class="profile-avatar" alt="User Avatar" />
                                <label for="image" class="upload-btn-label">
                                    <i class="ace-icon fa fa-camera bigger-110"></i> Change Photo
                                </label>
                                <input type="file" id="image" class="hidden" @change="imageUrl" accept="image/*" />
                            </div>

                            <div class="space-6"></div>

                            <div class="well well-sm background-blue white align-center"
                                style="border-radius: 4px; padding: 10px; background-color: #438eb9 !important;">
                                <h4 class="white font-bold align-center" style="margin: 0; text-transform: capitalize;">
                                    {{ Auth::user()->name }}
                                </h4>
                                <small class="white" style="opacity: 0.85;">{{ Auth::user()->role }}</small>
                            </div>

                            <div class="space-4"></div>

                            <div class="align-left"
                                style="background: #fcfcfc; padding: 12px; border: 1px solid #e8e8e8; border-radius: 4px;">
                                <p class="text-muted" style="margin-bottom: 6px;">
                                    <i class="ace-icon fa fa-envelope blue"></i> <strong>Email:</strong><br>
                                    <span class="text-primary">{{ Auth::user()->email }}</span>
                                </p>
                                <p class="text-muted" style="margin-bottom: 0;">
                                    <i class="ace-icon fa fa-phone green"></i> <strong>Phone:</strong><br>
                                    <span>{{ Auth::user()->phone ?? 'N/A' }}</span>
                                </p>
                            </div>
                        </div>

                        <!-- Main Content: Account Information & Security -->
                        <div class="col-xs-12 col-sm-8 col-md-9">

                            <!-- Profile Overview Section -->
                            <div class="section-header">
                                <i class="ace-icon fa fa-id-card"></i> Account Overview
                            </div>

                            <div class="profile-user-info-striped">
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Full Name </div>
                                    <div class="profile-info-value">
                                        <span class="text-capitalize">{{ Auth::user()->name }}</span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Username </div>
                                    <div class="profile-info-value">
                                        <code>{{ Auth::user()->username }}</code>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Contact Phone </div>
                                    <div class="profile-info-value">
                                        <span>{{ Auth::user()->phone ?? 'Not Provided' }}</span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Access Role </div>
                                    <div class="profile-info-value">
                                        <span
                                            class="label label-info label-white arrowed-in">{{ Auth::user()->role }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="space-12"></div>

                            <!-- Update Security Section -->
                            <div class="section-header">
                                <i class="ace-icon fa fa-key"></i> Security & Settings
                            </div>

                            <div class="profile-user-info-striped">
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Email Address </div>
                                    <div class="profile-info-value">
                                        <input type="email" name="email"
                                            class="form-control custom-form-control input-sm"
                                            value="{{ Auth::user()->email }}" placeholder="Email Address" required>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Current Password </div>
                                    <div class="profile-info-value">
                                        <input type="password" name="current_password"
                                            class="form-control custom-form-control input-sm"
                                            placeholder="Leave empty to keep unchanged">
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> New Password </div>
                                    <div class="profile-info-value">
                                        <input type="password" name="password"
                                            class="form-control custom-form-control input-sm" placeholder="New Password">
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Confirm Password </div>
                                    <div class="profile-info-value">
                                        <input type="password" name="confirm_password"
                                            class="form-control custom-form-control input-sm"
                                            placeholder="Confirm New Password">
                                    </div>
                                </div>
                            </div>

                            <div class="space-12"></div>

                            <!-- Submit Button Container -->
                            <div class="clearfix">
                                <div class="pull-right">
                                    <button type="submit" :disabled="onProgress" class="btn btn-sm btn-primary btn-round">
                                        <i class="ace-icon fa" :class="onProgress ? 'fa-spinner fa-spin' : 'fa-check'"></i>
                                        @{{ onProgress ? 'Saving Changes...' : 'Save Changes' }}
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        new Vue({
            el: "#userProfile",

            data() {
                return {
                    filterdata: {},
                    user: {
                        id: "{{ Auth::user()->id }}",
                        password: "",
                        image: ''
                    },
                    imageSrc: "{{ Auth::user()->image != null ? Auth::user()->image : '/no-userimage.png' }}",
                    onProgress: false,
                }
            },

            methods: {
                profileUpdate(event) {
                    let formdata = new FormData(event.target);
                    formdata.append('id', this.user.id);
                    if (this.user.image) {
                        formdata.append('image', this.user.image);
                    }

                    let url = '/user-profile-update';

                    this.onProgress = true;
                    axios.post(url, formdata)
                        .then(res => {
                            toastr.success(res.data);
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        })
                        .catch(err => {
                            this.onProgress = false;
                            var r = JSON.parse(err.request.response);
                            if (err.request.status == '422' && r.errors != undefined && typeof r.errors ==
                                'object') {
                                $.each(r.errors, (index, value) => {
                                    $.each(value, (ind, val) => {
                                        toastr.error(val);
                                    });
                                });
                            } else {
                                if (r.errors != undefined) {
                                    console.log(r.errors);
                                }
                                toastr.error(r.message || 'An error occurred while updating profile.');
                            }
                        });
                },

                imageUrl(event) {
                    const WIDTH = 150;
                    const HEIGHT = 150;
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
                                    'image/jpeg', 1));
                                this.user.image = new File([resizedImage], event.target.files[0].name, {
                                    type: resizedImage.type
                                });
                            }
                        }
                    } else {
                        event.target.value = '';
                    }
                }
            }
        });
    </script>
@endpush

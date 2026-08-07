@extends('master')
@section('title', 'Company Profile')
@section('breadcrumb_title', 'Company Profile')

@push('style')
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --bg-light: #f8fafc;
            --border-color: #e2e8f0;
            --text-dark: #1e293b;
            --text-muted: #64748b;
        }

        .profile-container {
            padding-bottom: 80px;
        }

        .custom-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            margin-bottom: 1.5rem;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .custom-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid var(--border-color);
            padding: 1.25rem 1.5rem;
        }

        .custom-card .header-title {
            color: var(--text-dark);
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .custom-card .card-body {
            padding: 1.5rem;
        }

        .upload-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .upload-box {
            border: 2px dashed var(--border-color);
            border-radius: 8px;
            padding: 1.5rem;
            text-align: center;
            background: var(--bg-light);
            transition: border-color 0.2s ease, background-color 0.2s ease;
            position: relative;
        }

        .upload-box:hover {
            border-color: var(--primary);
            background: #f1f5f9;
        }

        .image-preview-wrapper {
            width: 80px;
            height: 80px;
            margin: 0 auto 1rem;
            border-radius: 8px;
            overflow: hidden;
            background: #fff;
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .image-preview-wrapper img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .upload-label {
            display: inline-block;
            padding: 6px 16px;
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.875rem;
            color: var(--text-dark);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .upload-label:hover {
            background: var(--primary);
            color: #ffffff;
            border-color: var(--primary);
        }

        .upload-box input[type="file"] {
            display: none;
        }

        .dim-badge {
            font-size: 0.75rem;
            font-weight: 600;
            color: #ef4444;
            background: #fee2e2;
            padding: 2px 8px;
            border-radius: 12px;
            display: inline-block;
            margin-bottom: 0.75rem;
        }

        .form-label-custom {
            font-weight: 500;
            color: var(--text-dark);
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }

        .form-control-custom {
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 0.55rem 0.75rem;
            font-size: 0.875rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-control-custom:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
            outline: none;
        }

        .sticky-action-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #ffffff;
            border-top: 1px solid var(--border-color);
            padding: 1rem 2rem;
            z-index: 100;
            box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: flex-end;
        }

        .btn-save {
            background-color: var(--primary);
            color: #ffffff;
            border: none;
            padding: 0.6rem 2rem;
            font-weight: 600;
            border-radius: 6px;
            transition: background-color 0.2s ease;
        }

        .btn-save:hover {
            background-color: var(--primary-hover);
            color: #ffffff;
        }
    </style>
@endpush

@section('content')
    <div id="companyProfile" class="profile-container">
        <form @submit.prevent="updateProfile($event)">

            <!-- Top Section: Media Uploads -->
            <div class="row">
                <div class="col-12">
                    <div class="custom-card">

                        <div class="widget-header">
                            <h4 class="widget-title">
                                <i class="ace-icon fa fa-camera"></i>
                                Media Branding
                            </h4>
                        </div>

                        <div class="card-body">
                            <div class="upload-grid">
                                <!-- Logo Upload -->
                                <div class="upload-box">
                                    <span class="dim-badge">64 x 64 PX</span>
                                    <div class="image-preview-wrapper">
                                        <img :src="logoSrc" alt="Logo Preview" />
                                    </div>
                                    <label for="logo" class="upload-label">
                                        <i class="fas fa-cloud-upload-alt mr-1"></i> Upload Logo
                                    </label>
                                    <input type="file" name="logo" id="logo" accept="image/*"
                                        @change="logoUrl" />
                                </div>

                                <!-- Favicon Upload -->
                                <div class="upload-box">
                                    <span class="dim-badge">64 x 64 PX</span>
                                    <div class="image-preview-wrapper">
                                        <img :src="faviconSrc" alt="Favicon Preview" />
                                    </div>
                                    <label for="favicon" class="upload-label">
                                        <i class="fas fa-cloud-upload-alt mr-1"></i> Upload Favicon
                                    </label>
                                    <input type="file" name="favicon" id="favicon" accept="image/*"
                                        @change="faviconUrl" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Section -->
            <div class="row">
                <!-- Company General Info -->
                <div class="col-lg-7 col-md-12">
                    <div class="custom-card">
                        <div class="card-header">
                            <h3 class="header-title">
                                <i class="fas fa-building text-primary"></i> Company Details
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-3">
                                <label class="col-md-3 form-label-custom col-form-label">Company Name</label>
                                <div class="col-md-9">
                                    <input type="text" name="name" v-model="company.name"
                                        class="form-control form-control-custom" placeholder="e.g. Acme Corporation" />
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 form-label-custom col-form-label">Slogan / Title</label>
                                <div class="col-md-9">
                                    <input type="text" name="title" v-model="company.title"
                                        class="form-control form-control-custom"
                                        placeholder="e.g. Innovation at its best" />
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 form-label-custom col-form-label">Phone Number</label>
                                <div class="col-md-9">
                                    <input type="text" name="phone" v-model="company.phone"
                                        class="form-control form-control-custom" placeholder="+1 (555) 000-0000" />
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 form-label-custom col-form-label">Email Address</label>
                                <div class="col-md-9">
                                    <input type="email" name="email" v-model="company.email"
                                        class="form-control form-control-custom" placeholder="contact@company.com" />
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 form-label-custom col-form-label">Physical Address</label>
                                <div class="col-md-9">
                                    <textarea class="form-control form-control-custom" name="address" v-model="company.address" rows="3"
                                        placeholder="Enter street, city, state, zip"></textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 form-label-custom col-form-label">Google Maps Link</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control form-control-custom" name="map_link"
                                        v-model="company.map_link" placeholder="https://maps.google.com/..." />
                                </div>
                            </div>

                            <hr class="my-4" style="border-top: 1px solid var(--border-color);">

                            <h6 class="mb-3 font-weight-bold text-dark"><i class="fas fa-share-alt text-primary mr-1"></i>
                                Social Profiles</h6>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 form-label-custom col-form-label">Facebook</label>
                                <div class="col-md-9">
                                    <input type="url" class="form-control form-control-custom" name="facebook"
                                        id="facebook" v-model="company.facebook"
                                        placeholder="https://facebook.com/yourpage" />
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 form-label-custom col-form-label">Instagram</label>
                                <div class="col-md-9">
                                    <input type="url" class="form-control form-control-custom" name="instagram"
                                        id="instagram" v-model="company.instagram"
                                        placeholder="https://instagram.com/yourhandle" />
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 form-label-custom col-form-label">Twitter / X</label>
                                <div class="col-md-9">
                                    <input type="url" class="form-control form-control-custom" name="twitter"
                                        id="twitter" v-model="company.twitter"
                                        placeholder="https://x.com/yourhandle" />
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 form-label-custom col-form-label">YouTube</label>
                                <div class="col-md-9">
                                    <input type="url" class="form-control form-control-custom" name="youtube"
                                        id="youtube" v-model="company.youtube"
                                        placeholder="https://youtube.com/c/yourchannel" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Opening Hours -->
                <div class="col-lg-5 col-md-12">
                    <div class="custom-card">
                        <div class="card-header">
                            <h3 class="header-title">
                                <i class="fas fa-clock text-primary"></i> Operating Hours
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-3"
                                v-for="day in ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday']"
                                :key="day">
                                <label
                                    class="col-md-4 form-label-custom col-form-label text-capitalize">@{{ day }}:</label>
                                <div class="col-md-8">
                                    <input type="text" :name="day" v-model="company[day]"
                                        class="form-control form-control-custom"
                                        placeholder="e.g. 09:00 AM - 06:00 PM or Closed" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sticky Save Bar -->
            <div class="sticky-action-bar">
                <button type="submit" class="btn btn-save shadow-sm">
                    <i class="fas fa-save mr-1"></i> Save Profile Changes
                </button>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script>
        new Vue({
            el: '#companyProfile',
            data() {
                return {
                    company: {},
                    logoSrc: '/noImage.gif',
                    faviconSrc: '/noImage.gif'
                }
            },

            created() {
                this.getCompany();
            },

            methods: {
                getCompany() {
                    axios.get('/get-company')
                        .then(res => {
                            this.company = res.data;
                            this.logoSrc = this.company.logo ? '/' + this.company.logo : '/noImage.gif'
                            this.faviconSrc = this.company.favicon ? '/' + this.company.favicon : '/noImage.gif'
                        })
                },

                updateProfile(event) {
                    let formdata = new FormData(event.target);
                    axios.post("/update-company", formdata)
                        .then(res => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                            }
                        })
                },

                logoUrl(event) {
                    const WIDTH = 64;
                    const HEIGHT = 64;
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
                                this.logoSrc = new_img_url;
                                const resizedImage = await new Promise(rs => canvas.toBlob(rs,
                                    'image/jpeg', 1))
                                this.company.logo = new File([resizedImage], event.target.files[0]
                                    .name, {
                                        type: resizedImage.type
                                    });
                            }
                        }
                    } else {
                        event.target.value = '';
                    }
                },

                faviconUrl(event) {
                    const WIDTH = 64;
                    const HEIGHT = 64;
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
                                this.faviconSrc = new_img_url;
                                const resizedImage = await new Promise(rs => canvas.toBlob(rs,
                                    'image/jpeg', 1))
                                this.company.favicon = new File([resizedImage], event.target.files[0]
                                    .name, {
                                        type: resizedImage.type
                                    });
                            }
                        }
                    } else {
                        event.target.value = '';
                    }
                },
            },
        });
    </script>
@endpush

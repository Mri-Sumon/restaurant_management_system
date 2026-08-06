@extends('web_master')
@section('title', 'Uk Restaurant')
@section('main_content')

    <div class="container-fluid top-menu-section"
        style="background-image: linear-gradient(to bottom,rgba(255, 255, 255, 0.2), rgba(41, 46, 49, 1)), url('{{ asset('frontend/img/common-bg.jpg') }}');">
    </div>
    <section class="static page-blend">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div id="contact" class="themecard p-4">
                        <h4 class="text-center">Contact</h4>
                        <hr>
                        <form @submit.prevent="save">
                            <div class="col-md-12 mt-2">
                                <input v-model="contact.name" type="text" class="form-control" name="name" placeholder="Your name" required>
                            </div>
                            <div class="col-md-12 mt-2">
                                <input v-model="contact.email" type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                            <div class="col-md-12 mt-2">
                                <input v-model="contact.subject" type="text" class="form-control" name="subject" placeholder="Subject" required>
                            </div>
                            <div class="col-md-12 mt-2">
                                <textarea v-model="contact.message" class="form-control mt-2" name="message" placeholder="Your message" rows="3" required></textarea>
                            </div>
                            {{-- <div class="form-group row mt-2">
                                <div class="col-md-12 pl-5">
                                    <div class="g-recaptcha" 
                                         data-sitekey="6LfSYakqAAAAAMi8nH3JuBHSXZwWbY6vgLpWbxIN" 
                                         data-callback="onRecaptchaVerified" 
                                         id="recaptcha-element"></div>
                                </div>
                            </div> --}}
                            <button type="submit" class="btn btn-md poibtn w-100 mt-2" :disabled="onProgress">
                                <span v-if="onProgress">Submitting...</span>
                                <span v-else>Submit</span>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('script')
    {{-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> --}}
    <script src="{{asset('backend/js/vue/axios.min.js')}}"></script>
    <script>
        new Vue({
            el: '#contact',
            data() {
                return {
                    contact: {
                        name: "",
                        email: "",
                        subject: "",
                        message: "",
                    },
                    onProgress: false,
                    recaptchaToken: null,
                };
            },
            methods: {
                save(event) {
                    event.preventDefault();
                    
                    // if (!this.recaptchaToken) {
                    //     toastr.error("Please complete the reCAPTCHA.");
                    //     return;
                    // }
    
                    let formdata = new FormData();
                    formdata.append('name', this.contact.name);
                    formdata.append('email', this.contact.email);
                    formdata.append('subject', this.contact.subject);
                    formdata.append('message', this.contact.message);
                    // formdata.append('g-recaptcha-response', this.recaptchaToken);
    
                    const url = '/storeMessage';
                    this.onProgress = true;
    
                    axios.post(url, formdata)
                        .then(res => {
                            toastr.success(res.data.message || "Message sent successfully!");
                            this.resetForm();
                            this.onProgress = false;
                        })
                        .catch(err => {
                            this.onProgress = false;
    
                            if (err.response && err.response.status === 422 && err.response.data.errors) {
                                const errors = err.response.data.errors;
                                Object.keys(errors).forEach(key => {
                                    errors[key].forEach(message => toastr.error(message));
                                });
                            } else {
                                toastr.error(err.response?.data?.message || "An error occurred.");
                            }
                        });
                },
                resetForm() {
                    this.contact = {
                        name: "",
                        email: "",
                        subject: "",
                        message: "",
                    };
                    // this.recaptchaToken = null;
                    // grecaptcha.reset();
                },
                onRecaptchaVerified(token) {
                    this.recaptchaToken = token;
                },
            },
        });
    </script>
    
@endpush

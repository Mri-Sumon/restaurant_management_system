@extends('web_master')
@section('title', 'Uk Restaurant')
@section('main_content')
    <div class="container-fluid top-menu-section"
        style="background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.2), rgba(41, 46, 49, 1)), url('{{ asset('frontend/img/common-bg.jpg') }}');">
    </div>

    <div id="login" class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="foodcard p-4" style=" margin-bottom:10%;">
                    <h4 class="text-center">Register</h4>
                    <hr>
                    <div class="card-body">
                        <form action="{{ route('registration.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div style="display:none;">
                                        <label class="form-label">Code</label>
                                        <input type="text" class="form-control " name="code" placeholder="Code"
                                            value="{{ generateCode('Customer', 'C') }}">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="text" placeholder="First name"
                                                class="form-control  @error('first_name') is-invalid @enderror " name="first_name"
                                                value="{{ old('first_name') }}" placeholder="First Name" value="" required
                                                autocomplete="off" autofocus>
                                            @error('first_name')
                                                <span class="invalid-feedback" style="color:red;float:left">
                                                    <strong>{{ $message }}</strong>
                                                </span><br>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" placeholder="Last name"
                                                class="form-control  @error('last_name') is-invalid @enderror " name="last_name"
                                                value="{{ old('last_name') }}" placeholder="Last Name" value="" required
                                                autocomplete="off" autofocus>
                                            @error('last_name')
                                                <span class="invalid-feedback" style="color:red;float:left">
                                                    <strong>{{ $message }}</strong>
                                                </span><br>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <!-- <div class="col-md-6">
                                    <input id="Lname" type="text" placeholder="Last name"
                                        class="form-control " name="Lname"
                                        value="" required autocomplete="Fname" autofocus>

                                </div> -->
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" placeholder="Email">
                                    @error('email')
                                        <span class="invalid-feedback" style="color:red;float:left">
                                            <strong>{{ $message }}</strong>
                                        </span><br>
                                    @enderror

                                </div>
                            </div>
                            {{-- <div class="mb-2">
                                <label class="form-label">NID NO.</label>
                                <input type="number" value="{{ old('nid') }}" autocomplete="off" class="form-control"
                        name="nid" value="{{ old('nid') }}" placeholder="NID No" aria-describedby="nid">
                </div> --}}
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                        name="phone" value="{{ old('phone') }}" autocomplete="off" placeholder="Phone"
                                        aria-describedby="emailHelp">
                                    @error('phone')
                                        <span class="invalid-feedback" style="color:red;float:left">
                                            <strong>{{ $message }}</strong>
                                        </span><br>
                                    @enderror

                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input id="signup-password-field" type="password"
                                        class="form-control @error('password') is-valid @enderror"
                                        name="password" placeholder="Password">
                                    @error('password')
                                        <span class="invalid-feedback" style="color:red;float:left">
                                            <strong>{{ $message }}</strong>
                                        </span><br>
                                    @enderror

                                </div>
                            </div>
                            <div style="margin-top: 10px;" class="form-group">
                                <!-- <label class="form-label">Question Answer --</label> -->
                                <label style="display: flex;align-items: center;width:100%;">
                                    <span style="width: 20%;margin-right:5px;"><i style="font-size:22px"
                                            v-html="first_code"></i> <i style="font-size:22px">+</i> <i
                                            style="font-size:22px" v-html="second_code"></i>
                                        = </span> <input type="number" style="width: 80px;margin:0;box-shadow: none;"
                                        value="{{ old('summation') }}" autocomplete="off" class="form-control"
                                        name="summation" aria-describedby="summation">
                                    <button type="button" @click="getCaptcha"
                                        style="padding: 4px 10px; margin-left: 3px; outline: none; border: none;"><i
                                            class="fas fa-sync-alt"></i></button>
                                </label>
                            </div>
                            <!-- <div class="form-group row">
                                <div class="col-md-12">
                                    <input id="password-confirm" placeholder="Confirm password" type="password"
                                        class="form-control" name="password_confirmation" required
                                        autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="g-recaptcha" data-sitekey="6LccuDsqAAAAABmG1b7Y4VoIeKs7TDVXMFiVdG8p" data-size="normal" data-theme="light" id="recaptcha-element"></div>
                                </div>
                            </div> -->

                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-md poibtn w-100">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#ftco-navbar').addClass('customfixnav');
        });
    </script>

    <script src="{{ asset('backend') }}/js/vue/vue.js"></script>
    <script src="{{ asset('backend') }}/js/vue/axios.min.js"></script>
    <script src="{{ asset('backend') }}/js/vue/moment.js"></script>
    <script>
        @if (Session::has('code_error'))
            toastr.error("{{ Session::get('code_error') }}");
        @endif
    </script>

    <script>
        new Vue({
            el: '#login',
            data() {
                return {
                    first_code: 0,
                    second_code: 0,
                }
            },

            created() {
                this.getCaptcha();
            },

            methods: {
                getCaptcha() {
                    axios.post("/get-captcha", {})
                        .then(res => {
                            this.first_code = res.data.first_code;
                            this.second_code = res.data.second_code;
                        })
                },
            },
        });
    </script>
@endpush

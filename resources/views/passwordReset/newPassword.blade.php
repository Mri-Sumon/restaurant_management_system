@extends('web_master')
@section('main_content')
    <style>
        .btn-primary {
            width: 100%;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .mb-3 a {
            font-size: 15px;
        }

        .field-icon {
            float: right;
            margin-left: -25px;
            margin-right: 5px;
            margin-top: -35px;
            position: relative;
            z-index: 2;
        }
    </style>
    <!-- breadcumb-area start -->
    <div class="container-fluid top-menu-section"
    style="background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.2), rgba(41, 46, 49, 1)), url('{{ asset('frontend/img/common-bg.jpg')}}');">
    </div>
    <!-- breadcumb-area end -->

    <!-- .booking start -->
    <div class="shop-area shop-list-area" style="padding-bottom:200px;">
        <div class="container">
            <div class="row">
            <div class="col-md-2"></div>
                <div class="col-xs-12 col-md-8 col-xs-12">
                    <div class="section-title text-center">
                        <h3>Reset Your Password</h3>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-xs-12 col-md-8 col-xs-12">
                    <div class="shop-wrap "
                        style="box-shadow:0px 1px 15px rgba(0, 0, 0, .1);border-radius: 10px">
                        <div class="shop-img">
                            <img src="{{ asset('web_assets/images/reset-password.png') }}" alt="" style="height: 350px">
                        </div>
                        <div class="shop-content">
                            {{-- <img src="{{asset('web_assets/images/logo/tsc_logo.png')}}"  alt=""> --}}
                            <form action="{{ route('ForgotPassword') }}" method="post">
                                @csrf
                                <input type="hidden" name="token"  value="{{ $token }}">
                                <div class="mb-3" style="margin-top:10px">
                                    <label for="email" >Email</label>
                                    <input type="email" name="email" id="email"
                                        class="form-control shadow-none @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" placeholder="email" />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3" style="margin-top:10px">
                                    <label for="email"  >New Password</label>
                                    <input type="password" name="password" id="password"
                                        class="form-control shadow-none @error('password') is-invalid @enderror"
                                        value="{{ old('password') }}" placeholder="Password" />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3" style="margin-top:10px">
                                    <label for="email">Confirmed Password</label>
                                            <input type="password" name="password_confirmation" id="password_confirmation"
                                                class="form-control shadow-none @error('password_confirmation') is-invalid @enderror"
                                                value="{{ old('password_confirmation') }}" placeholder="Confirmed Password" />
                                            @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Reset-Password</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
    <!-- .booking end -->
@endsection

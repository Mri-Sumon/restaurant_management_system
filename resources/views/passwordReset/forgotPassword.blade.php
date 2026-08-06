@extends('web_master')
@section('main_content')


<div class="container-fluid top-menu-section"
    style="background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.2), rgba(41, 46, 49, 1)), url('{{ asset('frontend/img/common-bg.jpg')}}');">
</div>
    <!-- .booking start -->
    <div class="shop-area shop-list-area" style="padding-bottom:200px;">
        <div class="container">
            <div class="row">
            <div class="col-md-2"></div>
                <div class="col-xs-12 col-md-8 col-xs-12">
                    <div class="section-title text-center">
                        <h3 style="text-align: center;">Recovery Your Account</h3>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-xs-12 col-md-8 col-xs-12">
                    <div class="shop-wrap"
                        style="box-shadow:0px 1px 15px rgba(0, 0, 0, .1);border-radius: 10px">
                        <!-- <div class="shop-img">
                            <img src="{{ asset('web_assets/images/forgot-password.webp') }}" alt="">
                        </div> -->
                        <div class="shop-content">
                            <!-- {{-- <img src="{{asset('web_assets/images/logo/tsc_logo.png')}}"  alt=""> --}} -->
                            <form action="{{ route('ForgotPassword') }}" method="post">
                                @csrf
                                <div class="mb-3" style="margin-top:10px">
                                    <label class="form-label">Enter Valid Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" placeholder="Enter A Valid Email">
                                    @error('email')
                                        <span class="invalid-feedback" style="color:red;float:left">
                                            <strong>{{ $message }}</strong>
                                        </span><br>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Send</button>
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

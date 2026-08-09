@extends('web_master')
@section('title', 'Restaurant Management System')
@section('main_content')

    <div class="container-fluid top-menu-section"
        style="background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.2), rgba(41, 46, 49, 1)), url('{{ asset('frontend/img/common-bg.jpg') }}')">
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6" style="margin-bottom:10%;">
                <div class="foodcard p-4">
                    <h4 class="text-center">Login</h4>
                    <hr>
                    <div class="card-body">
                        <form action="{{ route('authCheck') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                        name="phone" value="{{ old('phone') }}" autocomplete="off"
                                        placeholder="Phone No">
                                    @error('phone')
                                        <span class="invalid-feedback" style="color:red;float:left">
                                            <strong>{{ $message }}</strong>
                                        </span><br>
                                    @enderror

                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input id="signin-password-field" type="password"
                                        class="form-control @error('password') is-valid @enderror" name="password"
                                        placeholder="Password">
                                    @error('password')
                                        <span class="invalid-feedback" style="color:red;float:left">
                                            <strong>{{ $message }}</strong>
                                        </span><br>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <a class="poi-link" href="{{ route('password') }}">
                                        Forgot Your Password?
                                    </a>
                                </div>
                            </div>
                            <!--
                            <div class="form-group row">
                                <div class="col-md-12 ml-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">

                                        <label class="form-check-label" for="remember">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div> -->

                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-md poibtn w-100">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

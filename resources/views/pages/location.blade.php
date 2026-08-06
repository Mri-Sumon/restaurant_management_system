@extends('web_master')
@section('title', 'Uk Restaurant')
@push('css')
<style>
    .iframe{
        height:500px !important;
    }
</style>
@endpush
@section('main_content')

<div class="container-fluid top-menu-section"
    style="background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.2), rgba(41, 46, 49, 1)), url('{{ asset('frontend/img/common-bg.jpg')}}');">
</div>

<div class="page-blend">
    <section class="static" style="margin-bottom: 3% !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">

                    <h3>Contact Information</h3>
                    <hr>
                    <h2>{{ $info->name}}</h2>
                    <p>{{ $info->address}}</p>
                    <a href="tel{{ $info->phone}}" target="_blank">
                        <p>Phone: <span style="font-size: 11pt; font-family: Calibri, sans-serif;">{{$info->phone}}</span></p>
                    </a>
                    <a href="mailto:{{ $info->email}}" target="_blank">
                        <p>Email: <span style="font-size: 11pt; font-family: Calibri, sans-serif;">{{$info->email}}</span></p>
                    </a>
                    <h4 class="mt-2">Opening Hour&nbsp;</h4>
                    <div class="d-flex justify-content-start align-items-start">
                        <div class=" mt-1">
                            <ul class="list-unstyled">
                                <li><a href="#" class=" d-block" style="color: white !important;">Monday: <span>{{ $info->monday}}</span></a></li>
                                <li><a href="#" class=" d-block" style="color: white !important;">Tuesday: <span>{{ $info->tuesday}}</span></a></li>
                                <li><a href="#" class=" d-block" style="color: white !important;">Wednesday: <span>{{ $info->wednesday}}</span></a></li>
                                <li><a href="#" class=" d-block" style="color: white !important;">Thursday: <span>{{ $info->thursday}}</span></a></li>
                                <li><a href="#" class=" d-block" style="color: white !important;">Friday: <span>{{ $info->friday}}</span></a></li>
                                <li><a href="#" class=" d-block" style="color: white !important;">Saturday: <span>{{ $info->saturday}}</span></a></li>
                                <li><a href="#" class=" d-block" style="color: white !important;">Sunday: <span>{{ $info->sunday}}</span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="social-link mt-2">
                    <a href="{{ $info->facebook}}" target="_blank" style="color:white;padding-right:1rem;font-size:25px"><i class="ti-facebook ti" ></i></a>
                    <a href="{{ $info->twitter}}" target="_blank" style="color:white;padding-right:1rem;font-size:25px"><i class="ti-twitter-alt"></i></a>
                    <a href="{{ $info->instagram}}" target="_blank" style="color:white;padding-right:1rem;font-size:25px"><i class="ti-instagram"></i></a>
                    <a href="{{ $info->youtube}}" target="_blank" style="color:white;padding-right:1rem;font-size:25px"><i class="ti-youtube"></i></a>
                    </div>
                    <p>&nbsp;</p>
                </div>
                <div class="col-md-6">

                    <h3>Locations on Map</h3>
                    <hr>
                    <div class="d-flex justify-content-start align-items-start mt-3">
                    <iframe src="{{ $info->map_link}}" style="border:0;height:420px" width="600" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <p>&nbsp;</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
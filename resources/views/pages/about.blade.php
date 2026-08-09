@extends('web_master')
@section('title', 'Restaurant Management System')
@push('css')
    <style>
        @media (min-width: 1200px) {
            .img-fluid {
                height: 600px !important;
            }
        }

        @media (max-width: 1199px) {
            .img-fluid {
                height: auto !important;
            }
        }
    </style>
@endpush
@section('main_content')

    <section class="static">
        <div class="container">
            <div class="row pt-5">
                <div class="col-md-6 pl-md-5 pl-xl-0 offset-xl-1 col-xl-5">
                    <!-- <div class="section-intro mb-lg-4">
                        <h4 class="intro-title" data-aos="fade-up">{{ $info->name }}</h4>
                    </div> -->
                    <div data-aos="fade-up" data-aos-delay="100">
                        <h1>{{ $about->title }}&nbsp;</h1>
                        <h4>{{ $about->short_description }}</h4>
                        <div style="text-align:justify">{!! $about->description !!}</div>
                    </div>
                </div>
                <div class="img-styleBox col-md-6 col-xl-6 mb-5 mb-md-0  pb-md-0">
                    <div lass="about-carousel-item">
                        <img class="img-fluid" src="{{ asset($about->image) }}">
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

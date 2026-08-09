@extends('web_master')
@section('title', 'Restaurant Management System')

@push('css')
    <style>
        body {
            background-image: none !important;
            background-color: var(--main-bg-color) !important;
        }

        @media (min-width: 1200px) {
            .img-fluid {
                height: 370px !important;
                width: 370px !important;
            }
        }

        @media (max-width: 1199px) {
            .img-fluid {
                height: 370px !important;
                width: 370px !important;
            }
        }
    </style>
@endpush

@section('main_content')

    <div class="container-fluid top-menu-section"
        style="background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.2), rgba(41, 46, 49, 1)), url('{{ asset('frontend/img/common-bg.jpg') }}');">
    </div>
    <div class="page-blend">
        <div class="container">
            <section>
                <div class="row" style="margin-top:10%; margin-bottom:10%;">
                    <div class="col-md-12">
                        <div class="mdb-lightbox no-margin">
                            @foreach ($photos as $item)
                                <figure class="col-md-4">
                                    <a href="{{ asset($item->image) }}">
                                        <img alt="picture" src="{{ asset($item->image) }}" class="img-fluid">
                                    </a>
                                </figure>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection

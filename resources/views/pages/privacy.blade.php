@extends('web_master')
@section('title', 'Restaurant Management System')
@section('main_content')
    <div class="container-fluid top-menu-section"
        style="background-image: linear-gradient(to bottom,rgba(255, 255, 255, 0.2), rgba(41, 46, 49, 1)), url('{{ asset('frontend/img/common-bg.jpg') }}');">
    </div>
    <div class="page-blend">
        <div class="container-fluid top-section">
            <h2 class="text-center">Privacy Policy</h2>
        </div>
        <section class="static">
            <div class="container">
                <h3>Privacy Policy</h3>
                <hr>

                <div class="accordion" id="accordionExample">
                    @foreach ($privacyPolicy as $index => $term)
                        <div class="card">
                            <div class="card-header" id="heading{{ $index }}">
                                <h2 class="mb-0">
                                    <button class="card-btn collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapse{{ $index }}" aria-expanded="false"
                                        aria-controls="collapse{{ $index }}">
                                        {{ $term->title }}
                                    </button>
                                </h2>
                            </div>
                            <div id="collapse{{ $index }}" class="collapse"
                                aria-labelledby="heading{{ $index }}" data-parent="#accordionExample">
                                <div class="card-body">
                                    {!! $term->description !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>
    </div>
@endsection

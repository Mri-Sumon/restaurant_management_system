@extends('web_master')
@section('title', 'Restaurant Management System')
@section('main_content')
    <section class="single-blog">
        <img class="blog-img-single rounded-0" src="{{ asset($blog->image) }}" alt="">
        <div class="container">
            <div class="row" style="margin-top:-10%; margin-bottom:10%">
                <div class="col-lg-12">
                    <div class="themecard">
                        <article class="blog_item">
                            <div class="p-md-5 p-3 details">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3 class="mb-0">{{ $blog->title }}</h3>
                                        <a class="poi-link">{{ $blog->category->name }}</a>
                                    </div>
                                    <p class="mb-0">Wed, {{ $blog->date }}</p>
                                </div>
                                <hr>
                                {!! $blog->description !!}
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

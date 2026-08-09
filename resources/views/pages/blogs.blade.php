@extends('web_master')
@section('title', 'Restaurant Management System')
@section('main_content')
    <div class="container-fluid top-menu-section"
        style="background-image: linear-gradient(to bottom,rgba(255, 255, 255, 0.2), rgba(41, 46, 49, 1)), url('{{ asset('frontend/img/common-bg.jpg') }}');">
    </div>

    <!--================Blog Area =================-->
    <div class="page-blend">
        <section class="blogs-area">

            <div class="container">
                <h1 class="mb-4">Latest Blogs</h1>
                <div class="row">
                    <div class="mb-5 col-lg-8 mb-lg-0">
                        @foreach ($blog as $b)
                            <div class="blog_left_sidebar themecard mb-4 ">
                                <article class="blog_item">
                                    <div class="blog_item_img">
                                        <img class="card-img" src="{{ asset($b->image) }}" alt="">
                                        <a href="#" class="blog_item_date">
                                            <h3>{{ Carbon\Carbon::parse($b->date)->format('d') }}</h3>
                                            <p class="black-text">
                                                {{ Carbon\Carbon::parse($b->date)->format('M') }},{{ Carbon\Carbon::parse($b->date)->format('y') }}
                                            </p>
                                        </a>
                                    </div>
                                    <div class="p-4 mt-4 details d-flex align-items-start justify-content-between">
                                        <div>
                                            <h4 class="mb-0">{{ $b->title }}</h4>
                                            <a href="{{ route('blog_details', $b->slug) }}" class="poi-link">
                                                {{ $b->category->name }}</a>
                                        </div>
                                        <a href="{{ route('blog_details', $b->slug) }}" type="button"
                                            class="btn btn-md poibtn flex-none">Read more</a>
                                    </div>
                                </article>
                            </div>
                        @endforeach

                    </div>
                    <div class="col-lg-4">
                        <div class="p-4 mt-2 mb-4 themecard">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <input class="w-80 form-control" type="text" name="query" id="search_input"
                                        placeholder="Search blog" value="" aria-label="Search">
                                </div>
                                <div>
                                    <button id="search_btn" type="button" class="btn btn-md poibtn">
                                        <i class="text-white fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 mt-2 mb-2 themecard">
                            <h4>Category</h4>
                            <hr>
                            @foreach ($category as $cate)
                                <a onclick="filter({{ $cate->id }})" href="javascript:void(0);" class="poi-link"
                                    style="font-size: 15px;">
                                    {{ $cate->name }}
                                </a>
                                <hr class="mt-0">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--================Blog Area =================-->

@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#search_btn').click(function() {
                filter(); // Trigger filtering when the search button is clicked
            });
        });

        function filter(categoryId = null) {
            let searchInput = $('#search_input').val(); // Get search input
            let url = "{{ route('blogs') }}?q=" + encodeURIComponent(searchInput);

            // Add category filter if a category is selected
            if (categoryId) {
                url += "&c=" + categoryId;
            }

            // Redirect to the URL with query parameters
            window.location.href = url;
        }
    </script>
@endpush

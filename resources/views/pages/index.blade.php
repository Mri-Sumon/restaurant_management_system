@extends('web_master')
@section('title', 'Uk Restaurant')
@section('main_content')

<!--================Hero Banner Section start =================-->
<section class="hero-banner">
    <div class="hero-wrapper parallaxView">
        <div class="scaleParallax">
            <div class="owl-carousel main-carousel">
                <!-- Loop through each slider item for image, title, and subtitle -->
                @foreach ($sliders as $item)
                <div class="hero-carousel-item">
                    <div class="view sliderView">
                        <!-- Dynamic image for each slide -->
                        <img class="sliderImage" src="{{ asset($item->image) }}" alt="{{ $item->title }}">
                    </div>
                    <div class="text-center slideOverlay">
                        <!-- Title and Subtitle for each slide -->
                        <h2 class="hero-title" data-aos="fade-up" data-aos-delay="100">{{ $item->title }}</h2>
                        <h5 class="hero-info" data-aos="fade-up" data-aos-delay="150">{{ $item->sub_title }}</h5>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<div class="gradient-effect"></div>

<!--================ reservation content =================-->
<section class="pt-5 pb-5 reservation" id="reservation">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="takeaway-section">
                    <h1 class="text-white">Takeaway</h1>
                    <p>
                        Can't pick your order up in person? No problem!
                    </p>
                    <p>
                        Order online with us!
                    </p>
                    <a class="btn btn-lg takeaway-btn" style="font-size:18px;" href="{{route('menu')}}"> Order
                        Now</a>
                    <div>
                        <img src="{{ asset('frontend/img/menu-qr.png') }}" alt=""
                            style="width: 220px; height: 260px;">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div id="booking" class="booking-wrapper p-5">
                    <h2 class="mb-4 text-center">Reservation</h2>

                    <form @submit.prevent="saveBooking" class="booking-form">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Name" v-model="booking.name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <input type="email" class="form-control" placeholder="Email Address" v-model="booking.email" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Phone Number" v-model="booking.phone" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <input type="date" class="form-control" placeholder="Select Date" v-model="booking.booking_date" :min="minDate" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <input type="time" class="form-control" placeholder="Select Time" v-model="booking.booking_time" min="12:00" max="22:00" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" min="1" class="form-control" placeholder="Select People" v-model="booking.persons" required>
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <div class="col-md-12">
                                <div class="g-recaptcha" data-sitekey="6LccuDsqAAAAABmG1b7Y4VoIeKs7TDVXMFiVdG8p" data-size="normal" data-theme="light" id="recaptcha-element"></div>
                            </div>
                        </div>

                        <div>
                            <button class="btn btn-lg poibtn" type="submit">Make Reservation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!--================ reservation content =================-->

<div class="container">

    <div class="food-carousel owl-carousel">
        @foreach ($gallery as $item)
        <img src="{{ asset($item->image) }}" class="gallery-carousel-img" />
        @endforeach
    </div>

    <p class="text-center" style="color:#9F784A">{{ $info->name}} are committed to delivering amazing
        customer service <br /> and unforgettable food in a warm and welcoming environment. </p>
</div>

<!--================About Section start =================-->
@isset($lunch)
<section class="about section-margin" id="lunch">
    <div class="container">
        <div class="row">

            <div class="col-lg-6">
                <div class="my-4 my-md-0" data-aos="fade-up" data-aos-delay="150">
                    <img class="img-fluid" style="width:100%"
                        src="{{ asset($lunch->optionA_image) }}">
                </div>

                <div class="section-intro mt-lg-4">

                    <h4 class="intro-title pl-2" data-aos="fade-up">{{ $info->name}}</h4>

                </div>
                <div data-aos="fade-up" data-aos-delay="100">

                    <div class="pl-2 ck-wrapper">
                        <h1 style="text-align:justify">COME &amp; ENJOY</h1>

                        <h1 style="text-align:justify">LUNCH EVERYDAY</h1>

                        <h2>{{$lunch->lunch_time}}</h2>

                        <h2>OPTION A - &pound;{{$lunch->optionA_price}}</h2>

                        {!! $lunch->optionA_menu !!}

                        <h2>OPTION B - &pound;{{$lunch->optionB_price}}</h2>

                        {!! $lunch->optionB_menu !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div id="autoSwipeCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset($lunch->optionB_image) }}" class="d-block w-100 img-fluid"
                                style="object-fit: cover;" alt="Slide 1">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset($lunch->optionA_image) }}" class="d-block w-100 img-fluid"
                                style=" object-fit: cover;" alt="Slide 2">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset($lunch->optionC_image) }}" class="d-block w-100 img-fluid"
                                style=" object-fit: cover;" alt="Slide 3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endisset
<!--================About Section End =================-->

@isset($CocktailDesp)
<div class="container-fluid p-0" id="cocktails">
    <div class="row">
        <div class="col-lg-8">
            <img class="img-fluid" src="{{ asset($CocktailDesp->cocktail_image) }}" data-aos="fade-right"
                data-aos-delay="200" />
        </div>
        <div class="col-lg-4 p-4">
            <h1 data-aos="fade-up" data-aos-delay="300">Cocktails</h1>
            <p style="font-size: 20px;" data-aos="fade-up" data-aos-delay="350">{!!$CocktailDesp->description!!}</p>
        </div>
    </div>
</div>
@endisset

<div class="container-fluid p-0" id="night">
    <div class="row">

        <div class="col-lg-8 p-0 d-md-none d-block" style="overflow: hidden">

            <video class="booking-vid" autoplay muted loop>
                <source src="{{ asset('frontend/reserve-vid.mp4') }}" type="video/mp4">
            </video>
        </div>

        <div class="col-lg-4 style-bg p-0" data-aos="fade-right" data-aos-delay="200">
            <div class="pl-5 mt-4">

                <h1 class="text-white">Having a celebration?</h1>
                <p style="font-size: 35px;">EVENTS NIGHTS</p>
                <p style="font-size: 28px;">Live Performances</p>
                <p class="my-3" style="font-size: 18px;"> Our function room <br />
                    is available for hire for up to 80 people</p>
            </div>
        </div>

        <div class="col-lg-8 p-0 d-none d-md-block" style="overflow: hidden">
            <video class="booking-vid" controls autoplay muted loop controlsList="nodownload">
                <source src="{{ asset(isset($CocktailDesp) ? $CocktailDesp->cocktail_video : '') }}" type="video/mp4">
            </video>
        </div>
    </div>
</div>


<div>
    <style>
        .food-parallax {
            background-image: url("{{ $image->home_bg_image }}");
        }
    </style>
    <div class="food-parallax" id="catering"></div>
    <div class="pt-4 text-center">
        <h1>{{$CateringDesp->title}}</h1>
        {!!$CateringDesp->description!!}
    </div>
    <div class="text-center d-md-none">
        <img src="{{ asset('frontend/img/outside-catering.jpg') }}" alt="Catering" class="img-fluid">
    </div>
</div>


<!--================ blog content =================-->
<section class="blog">
    <div class="container">
        <h1 class="text-center" data-aos="fade-up" data-aos-delay="100">Recent Blogs</h1>
        <div class="mt-5 blogs">
            <div class="row">
                @forelse ($Blog as $blog)
                <div class="col-md-4">
                    <div class="blogCard" data-aos="fade-up" data-aos-delay="100">
                        <img class="img-fluid blog-img"
                            src="{{ asset($blog->image) }}" alt="">
                        <div class="p-3 cardinfo">
                            <small>Wed, {{$blog->date}}</small>
                            <h5 class="blogcard-title">{{$blog->title}}</h5>
                            <a href="{{route('blog_details',$blog->slug)}}" type="button" class="poi-link">Read
                                more</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-lg-12">
                    NO Blog Found
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
<!--================ blog content =================-->

<!--================ review section =================-->
{{-- <section class="">
        <h1 class="text-center mb-4">Happy Clients</h1>
        <div class="container-fluid review">
            <div class="owl-carousel rev-carousel owl-theme">
            </div>
        </div>
    </section> --}}
<!--================ review section=================-->

<!--================ review form =================-->
{{-- <section class="revform">
        <div class="container">

            <h1 class="text-center" data-aos="fade-up" data-aos-delay="100">Submit a Review
            </h1>

            <div class="p-5 ReviewFormThemecard" data-aos="fade-up" data-aos-delay="100">
                <div id="reviewrate" style="font-size: 20px;"></div>
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="_token" value="7PzbPjf8dLQfHPCwLlipaRjkc5TB60ssteJjKayE">
                    <div class="form-row">
                        <input type="hidden" readonly id="halfstarsInput" name="rate" class="form-control">
                        <div class="px-0 col-md-6">
                            <input type="text" name="name" placeholder="Name" class="mt-2 form-control" required>
                        </div>
                        <div class="col-md-6 px-0">
                            <input type="email" name="email" placeholder="Email" class="mt-2 form-control" required>
                        </div>

                    </div>
                    <div class="mt-2 form-row">
                        <textarea name="msg" id="msg" rows="5" class="form-control" maxlength="120" placeholder="Message"
                            required></textarea>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="g-recaptcha" data-sitekey="6LccuDsqAAAAABmG1b7Y4VoIeKs7TDVXMFiVdG8p"
                                data-size="normal" data-theme="light" id="recaptcha-element"></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-lg poibtn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section> --}}
<!--================ review form =================-->

<div class="news-wrapper">
    <div class="mb-4 d-md-flex align-items-center justify-content-center single-footer-widget">
        <div class="col-md-6">
            <h4 class="text-white p-4 text-right">Subscribe to our Newsletter <br /> for exciting offers and promos
            </h4>

        </div>
        <div class="col-md-6">
            <div class="form-wrap" id="mc_embed_signup">
                <form action="#" method="post">
                    @csrf
                    <div class="news-input-wrapper">
                        <div class="input-group">
                            <input type="email" class="form-control" name="email"
                                placeholder="Your Email Address" required>
                            <div class="input-group-append">
                                <button class="click-btn" type="button">
                                    <i class="ti-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                        <div style="position: absolute; left: -5000px;">
                            <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value=""
                                type="text">
                        </div>

                        <div class="info"></div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openSlideMenu() {
        if (window.innerWidth > 400) {
            document.getElementById('side-menu').style.width = '350px';
        } else {
            document.getElementById('side-menu').style.width = '100%';
        }
        document.getElementById('side-menu').style.marginLeft = '80%';
        document.getElementById('side-menu').style.opacity = '1';
        // document.getElementById('main').style.marginLeft = '80%';
    }

    function closeSlideMenu() {
        document.getElementById('side-menu').style.width = '0';
        document.getElementById('side-menu').style.opacity = '0';
        //   document.getElementById('main').style.marginLeft = '0';
    }


    function goto(id) {
        let target = document.getElementById(id).offsetTop - document.getElementById("offset-nav").offsetHeight;
        closeSlideMenu();
        window.scrollTo({
            top: target,
            behavior: 'smooth',
        })

    }
</script>

<script>
    document.querySelector(".sushi-nav").style.backgroundColor = "transparent";
    document.querySelector(".logo").style.width = "80px";
    window.onscroll = function() {
        scrollFunction()
        scrollFunction2(); //slider
    };

    function scrollFunction() {
        // var width = (window.innerWidth > 0) ? window.innerWidth : document.documentElement.clientWidth;
        if (document.body.scrollTop > 150 || document.documentElement.scrollTop > 150) {

            document.querySelector(".sushi-nav").style.backgroundColor = "#2e3235";
            document.querySelector(".logo").style.width = "50px";
            document.querySelector('.logo-text').style.fontSize = '24px';
            // document.querySelector('.sub').style.fontSize = '0';
        } else {
            document.querySelector(".sushi-nav").style.backgroundColor = "transparent";
            document.querySelector(".logo").style.width = "80px";
            document.querySelector('.logo-text').style.fontSize = '34px';
            // document.querySelector('.sub').style.fontSize = '24px';

        }
    }

    function openSlideMenu() {
        if (window.innerWidth > 400) {
            document.getElementById('side-menu').style.width = '350px';
        } else {
            document.getElementById('side-menu').style.width = '100%';
        }
        document.getElementById('side-menu').style.marginLeft = '80%';
        document.getElementById('side-menu').style.opacity = '1';
        // document.getElementById('main').style.marginLeft = '80%';
    }

    function goto(id) {
        let target = document.getElementById(id).offsetTop - document.getElementById("offset-nav").offsetHeight;
        closeSlideMenu();
        window.scrollTo({
            top: target,
            behavior: 'smooth',
        })
    }
</script>

<script>
    document.querySelector(".scaleParallax").style.scale = "1";

    //function called in navbar

    function scrollFunction2() {
        // var width = (window.innerWidth > 0) ? window.innerWidth : document.documentElement.clientWidth;

        var scale = 1 + (document.documentElement.scrollTop / 2000);

        if (scale <= 1.3) {
            document.querySelector(".scaleParallax").style.scale = scale;
        }

    }
</script>

<script>
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();

            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>
@endsection

@push('script')
<script src="{{asset('backend/js/vue/moment.js')}}"></script>
<script src="{{asset('backend/js/vue/axios.min.js')}}"></script>

<script>
    new Vue({
        el: '#booking',
        data() {
            const currentDate = new Date();
            const tomorrow = new Date(currentDate);
            tomorrow.setDate(currentDate.getDate() + 1);

            // Format tomorrow's date as "YYYY-MM-DD"
            const formattedTomorrow = tomorrow.toISOString().split('T')[0];
            // Format current time as "HH:MM"
            const currentTime = currentDate.toTimeString().slice(0, 5);

            return {
                booking: {
                    name: '',
                    phone: '',
                    email: '',
                    date: moment().format('YYYY-MM-DD'),
                    booking_date: formattedTomorrow,
                    booking_time: currentTime,
                    persons: '',
                },
                minDate: formattedTomorrow // set the minimum date for booking
            }
        },
        methods: {
            saveBooking() {
                if (this.booking.name == '' || this.booking.phone == '' || this.booking.date == '' || this.booking.booking_date == '' || this.booking.booking_time == '' || this.booking.persons == '') {
                    Toast.fire({
                        icon: 'error',
                        title: 'All field required',
                    });
                    return;
                }
                // let authCheck = "{{Auth::guard('customer')->check()}}";
                // if (authCheck == '') {
                //     Toast.fire({
                //         icon: 'error',
                //         title: 'Please login first',
                //     });
                //     return
                // }

                axios.post("/saveBooking", this.booking).then(res => {
                    if (res.data.status) {
                        Toast.fire({
                            icon: 'success',
                            title: res.data.message,
                        });
                        this.booking = {
                            name: '',
                            phone: '',
                            email: '',
                            persons: '',
                        }
                        setTimeout(() => {
                            location.href = '/confirmBooking';
                        }, 1500);
                    } else {
                        alert('Something went wrong');
                    }
                }).catch(error => {
                    alert('Error saving booking');
                    console.error(error);
                });
            }
        }
    });
</script>
@endpush
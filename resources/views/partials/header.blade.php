<nav class="navbar fixed-top navbar-expand-lg {{ Route::is('home') ? 'navbar-dark' : 'no-navbar-dark' }}  sushi-nav"
    id="offset-nav">
    <div class="container-fluid">
        <a href="{{ route('home') }}" class="justify-content-center d-flex align-items-center">
            <img src="{{ asset('uploads/logo/_6732eae4b31f7.png') }}" class="logo d-none d-md-block">
            <img src="{{ asset('uploads/logo/_6732eae4b31f7.png') }}" class="d-md-none" style="width:50px">
            <div>
                <h3 class="logo-text">{{ $info->name}}</h3>
                <!-- <h4 class="logo-text sub d-none d-md-block">Restaurant</h4> -->
            </div>

        </a>

        <ul class="ml-auto navbar-nav">
            <li class="nav-item">
                <a class="nav-link cart-count" href="{{ route('checkout') }}"><i class="fas fa-shopping-cart"></i>
                </a>
            </li>
            <li class="nav-item">
                <span class="open-slide">
                    <a href="javascript:void(0);" class="nav-link" onclick="openSlideMenu()">
                        <i class="fas fa-bars"></i>
                    </a>
                </span>
            </li>
        </ul>
    </div>

    <div id="side-menu" class="sushi-side-nav">
        <a href="javascript:void(0);" class="float-left p-0 m-0 btn-close" onclick="closeSlideMenu()">&times;</a>
        <a class="nav-link" href="{{ route('home') }}">Home</a>
        <a class="nav-link" href="{{ route('locations') }}">Locations</a>
        <a class="nav-link" @if (Route::is('home')) onclick="goto('reservation'); return false;" @else href="{{ route('home') }}#reservation" @endif>Book Now</a>
        <a class="nav-link" @if (Route::is('home')) onclick="goto('cocktails'); return false;" @else href="{{ route('home') }}#cocktails" @endif>Cocktails</a>
        <a class="nav-link" @if (Route::is('home')) onclick="goto('night'); return false;" @else href="{{ route('home') }}#night" @endif>Events Night</a>
        <a class="nav-link" @if (Route::is('home')) onclick="goto('lunch'); return false;" @else href="{{ route('home') }}#lunch" @endif>Lunch</a>
        <a class="nav-link" href="{{ route('menu') }}">Menu</a>
        <a class="nav-link" href="{{ route('cocktailMenu') }}">Cocktail Menu</a>
        <a class="nav-link" @if (Route::is('home')) onclick="goto('catering'); return false;" @else href="{{ route('home') }}#catering" @endif>Outside Catering</a>
        



        <a class="nav-link" href="{{ route('photos') }}">Gallery</a>
        <a class="nav-link" href="{{ route('blogs') }}">Blog</a>
        <a class="nav-link" href="{{ route('aboutUs') }}">About</a>
        <a class="nav-link" href="{{ route('privacy') }}">Privacy Policy</a>
        <a class="nav-link" href="{{ route('terms') }}">Terms & Conditions</a>
        <a class="nav-link" href="{{ route('contact') }}">Contact</a>

        <hr>

        <div class="mt-3 d-flex login-section">
            @if (!Auth::guard('customer')->check())
                <a class="nav-link" href="{{ route('customerLogin') }}">Login</a>
                <a class="nav-link" href="{{ route('register') }}">Register</a>
            @else
                <a class="nav-link" href="{{ route('profile') }}"> <i class="fas fa-user"></i> Profile</a>
            @endif
            {{-- <a class="nav-link" href="login.html">Login</a>
            <a class="nav-link" href="register.html">Register</a> --}}
        </div>
    </div>
</nav>

<style>
    a:hover {
        color: #0056b3;
        text-decoration: none !important;
    }
</style>

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
        // scrollFunction2(); //slider
    };

    function scrollFunction() {
        // var width = (window.innerWidth > 0) ? window.innerWidth : document.documentElement.clientWidth;
        if (document.body.scrollTop > 150 || document.documentElement.scrollTop > 150) {
            document.querySelectorAll(".navbar-nav .nav-item .nav-link").forEach((link) => {
                link.style.color = "#b68854";
            });
            document.querySelector(".sushi-nav").style.backgroundColor = "#2e3235";
            document.querySelector(".logo").style.width = "50px";
            document.querySelector('.logo-text').style.fontSize = '24px';
            // document.querySelector('.sub').style.fontSize = '0';
        } else {
            document.querySelectorAll(".navbar-nav .nav-item .nav-link").forEach((link) => {
                link.style.color = "#fff";
            });
            document.querySelector(".sushi-nav").style.backgroundColor = "transparent";
            document.querySelector(".logo").style.width = "80px";
            document.querySelector('.logo-text').style.fontSize = '34px';
            // document.querySelector('.sub').style.fontSize = '24px';
        }

    }
</script>

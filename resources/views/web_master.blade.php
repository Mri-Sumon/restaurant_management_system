<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!--Favicon--->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset($info->favicon) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset($info->favicon) }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset($info->favicon) }}">
    <link rel="manifest" href="{{ asset('frontend/favicon/site.html') }}">
    <script src="{{ asset('backend') }}/js/vue/vue.js"></script>
    <!--Favicon--->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="../use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"
        integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,600;1,800&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@1,700&amp;display=swap"
        rel="stylesheet">
    <!-- LUNCH CAROSOUL SLIDER  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="{{ asset('frontend/css/mdb.min.css') }}" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="{{ asset('frontend/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/pride_app.css') }}">
    <link href="../unpkg.com/aos%402.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/addons/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="../cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">

    <link rel="stylesheet" href="{{ asset('frontend/owl-carousel/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/owl-carousel/owl.carousel.min.css') }}">
    <!-- toaster  -->
    <link href="{{ asset('backend') }}/css/toastr.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('frontend/owl-carousel/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/owl-carousel/owl.carousel.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/owl-carousel/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/owl-carousel/owl.carousel.min.css') }}">

    <!-- JQuery -->
    <script type="text/javascript" src="{{ asset('frontend/js/jquery-3.4.1.min.js') }}"></script>
    <!-- CAROUSUL SLIDER  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('css')
</head>

<body>
    @include('partials.header')

    @yield('main_content')

    <!-- Footer section -->
    @include('partials.footer')
    <div>
        <div class="cookie-consent-popup fixed-bottom w-100 p-3 shadow-lg" id="cookieConsentPopup"
            style="display: none; z-index: 9999;">
            <div class="container d-flex justify-content-between align-items-center flex-wrap flex-md-nowrap">
                <div>
                    <h5 class="mb-2">We use cookies</h5>
                    <p class="mb-0">We use cookies to enhance your browsing experience, serve personalized content and
                        ads, to provide social media features and to analyze our traffic. By clicking "Accept", you
                        consent to our use of cookies.
                    </p>
                </div>
                <div class="d-flex">
                    <button id="acceptCookies" class="btn poibtn me-2">Accept</button>
                    <button id="rejectCookies" class="btn poibtn-outline">Reject</button>
                </div>
            </div>
        </div>
    </div>
    <!--Main js file start-->
    @stack('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const consentPopup = document.getElementById('cookieConsentPopup');
            const consentStatus = localStorage.getItem('cookieConsentStatus');

            // Show cookie popup if not already accepted/rejected
            if (!consentStatus) {
                consentPopup.style.display = 'block';
            }

            // Handle Accept button click
            document.getElementById('acceptCookies').addEventListener('click', function() {
                localStorage.setItem('cookieConsentStatus', true);
                consentPopup.style.display = 'none';
                // Optional: Call an API or perform further actions here
            });

            // Handle Reject button click
            document.getElementById('rejectCookies').addEventListener('click', function() {
                localStorage.setItem('cookieConsentStatus', false);
                consentPopup.style.display = 'none';
                // Optional: Call an API or perform further actions here
            });
        });
    </script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{ asset('frontend/js/mdb.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('frontend/js/addons/datatables.min.js') }}"></script>

    <script src="{{ asset('frontend/owl-carousel/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{ asset('frontend/rating/rating.js') }}"></script>

    <script src="{{ asset('frontend/aos/aos.js') }}"></script>
    <script>
        AOS.init({
            easing: 'ease-in-out-sine',
            once: true
        });
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Sweet Alert Script -->
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: window.innerWidth <= 768 ? 'top-end' : 'bottom-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            },
            customClass: {
                popup: 'small-swal',
            },
        })
    </script>
    <!-- Sweet Alert Script -->

    @if (session('success'))
    <script>
        Toast.fire({
            icon: 'success',
            title: '{{ session('
            success ') }}',
        })
    </script>
    @endif

    @if (session('error'))
    <script>
        Toast.fire({
            icon: 'error',
            title: '{{ session('
            error ') }}',
        })
    </script>
    @endif


    <script>
        $(document).ready(function() {
            $('.rev-carousel').owlCarousel({
                loop: true,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplayHoverPause: false,
                margin: 30,
                dots: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },

                    1100: {
                        items: 3
                    }
                }
            });

            $('.main-carousel').owlCarousel({
                loop: true,
                autoplay: true,
                autoplayTimeout: 6000,
                autoplayHoverPause: false,
                margin: 0,
                animateIn: 'fadeIn',
                animateOut: 'fadeOut',
                dots: true,
                items: 1,

            })


            $('.food-carousel').owlCarousel({
                loop: true,
                center: true,
                autoplay: true,
                slideTransition: 'linear',
                autoplayTimeout: 3000,
                autoplaySpeed: 3000,
                margin: 20,
                dots: false,
                items: 5,
                stagePadding: 50,
                responsive: {
                    0: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },

                    1100: {
                        items: 5
                    }
                }

            })
        });
    </script>

    <script>
        $(function() {
            $("#reviewrate").rating({
                "half": true,
                "color": "#fbbf24",
                "click": function(e) {

                    $("#halfstarsInput").val(e.stars);
                }

            });
        });
    </script>

    <script>
        $('#pointable').DataTable();
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('.mdb-select').materialSelect();

        });
    </script>

    <script>
        $(document).ready(function() {

            $('.chips-placeholder').materialChip({
                placeholder: 'Enter a tag',
                secondaryPlaceholder: '+Tag',
            });
        })
    </script>

    <script>
        $(document).ready(function() {
            $(".slide-toggle").click(function() {
                $(".mobcart").slideToggle();
            });
        });
    </script>

    <script>
        // MDB Lightbox Init
        // $(function() {
        //     $("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
        // });
    </script>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        toastr.options = {
            "closeButton": true,
            "closeClass": "toast-close-button",
            "closeDuration": 300,
            "closeEasing": "swing",
            "closeHtml": "<button><i class=\"icon-off\"><\/i><\/button>",
            "closeMethod": "fadeOut",
            "closeOnHover": true,
            "containerId": "toast-container",
            "debug": false,
            "escapeHtml": false,
            "extendedTimeOut": 10000,
            "hideDuration": 1000,
            "hideEasing": "linear",
            "hideMethod": "fadeOut",
            "iconClass": "toast-info",
            "iconClasses": {
                "error": "toast-error",
                "info": "toast-info",
                "success": "toast-success",
                "warning": "toast-warning"
            },
            "messageClass": "toast-message",
            "newestOnTop": false,
            "onHidden": null,
            "onShown": null,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "progressBar": true,
            "progressClass": "toast-progress",
            "rtl": false,
            "showDuration": 300,
            "showEasing": "swing",
            "showMethod": "fadeIn",
            "tapToDismiss": true,
            "target": "body",
            "timeOut": 5000,
            "titleClass": "toast-title",
            "toastClass": "toast"
        };
    </script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>



</html>
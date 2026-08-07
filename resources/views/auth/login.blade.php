<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $company->name }} - Login Page</title>
    <link rel="icon" type="image/x-icon" href="{{ asset($company->favicon ? $company->favicon : '/noImage.gif') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('auth/css/materialdesignicons.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('auth/css/bootstrap.min.css') }}" />
    <link href="{{ asset('backend') }}/css/toastr.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('auth/css/style.css') }}" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0f172a !important;
        }

        .login-card-container {
            position: relative;
            z-index: 1;
        }

        .login-card {
            background-color: #ffffff !important;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px !important;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2) !important;
            height: auto !important;
            padding: 10px;
        }

        .brand-wrapper img.logo {
            max-height: 48px;
            object-fit: contain;
        }

        .form-label {
            display: block;
            text-align: left;
            font-size: 0.875rem;
            font-weight: 500;
            color: #334155 !important;
            margin-bottom: 0.35rem;
        }

        .form-control {
            border: 1px solid #cbd5e1 !important;
            border-radius: 8px !important;
            padding: 0.65rem 0.9rem !important;
            font-size: 0.95rem;
            color: #0f172a !important;
            background-color: #ffffff !important;
            transition: all 0.2s ease;
        }

        .form-control::placeholder {
            color: #94a3b8 !important;
            opacity: 1;
        }

        .form-control:focus {
            border-color: #2563eb !important;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15) !important;
            color: #0f172a !important;
        }

        .login-btn {
            background-color: #2563eb !important;
            border-color: #2563eb !important;
            color: #ffffff !important;
            font-weight: 600 !important;
            border-radius: 8px !important;
            padding: 0.65rem !important;
            font-size: 0.95rem;
            transition: background-color 0.2s ease, transform 0.1s ease;
        }

        .login-btn:hover {
            background-color: #1d4ed8 !important;
            border-color: #1d4ed8 !important;
            color: #ffffff !important;
        }

        .login-btn:disabled {
            background-color: #94a3b8 !important;
            border-color: #94a3b8 !important;
            color: #ffffff !important;
        }

        .password i {
            color: #64748b !important;
            transition: color 0.2s ease;
        }

        .password i:hover {
            color: #0f172a !important;
        }

        .error-username,
        .error-password {
            font-size: 0.825rem;
            margin-top: 4px !important;
            color: #dc2626 !important;
            text-align: left;
        }

        .text-danger {
            color: #dc2626 !important;
        }
    </style>
</head>

<body>
    <main class="w-100">
        <div class="container login-card-container">
            <div class="row">
                <div class="col-md-6 col-lg-4 mx-auto">
                    <div class="card login-card">
                        <div class="card-body">
                            <div class="brand-wrapper d-flex justify-content-center mb-2">
                                <img src="{{ asset($company->logo) }}" alt="logo" class="logo" />
                            </div>
                            <form onsubmit="AdminLogin(event)">
                                <div class="form-group mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" id="username"
                                        class="form-control shadow-none" autofocus placeholder="Enter your username"
                                        autocomplete="off" />
                                    <p class="error-username m-0"></p>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <div style="position: relative;" class="password">
                                        <input type="password" name="password" id="password"
                                            class="form-control shadow-none" placeholder="Enter your password"
                                            autocomplete="off" />
                                        <i class="fa fa-eye"
                                            style="position: absolute;top: 13px;right: 12px;cursor:pointer;"
                                            onclick="passwordShow(event)"></i>
                                    </div>
                                    <p class="error-password m-0"></p>
                                </div>
                                <button type="submit" name="login" id="login"
                                    class="btn btn-block login-btn shadow-none w-100">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('backend') }}/js/jquery.js"></script>
    <script src="{{ asset('backend') }}/js/toastr.min.js"></script>
    <script src="{{ asset('backend') }}/js/typed.js"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif

        @if (Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif

        $(function() {
            if ($('#typed').length) {
                var typed = new Typed('#typed', {
                    strings: ["{{ $company->title }}"],
                    typeSpeed: 100,
                    backSpeed: 100,
                    loop: true
                });
            }
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function AdminLogin(event) {
            event.preventDefault();
            $("#login").prop("disabled", true);
            var formdata = new FormData(event.target);
            $.ajax({
                url: "/login",
                method: "POST",
                data: formdata,
                contentType: false,
                processData: false,
                beforeSend: () => {
                    $(".error-username").text('').removeClass("text-danger");
                    $(".error-password").text('').removeClass("text-danger");
                },
                success: res => {
                    location.href = "/module/dashboard";
                },
                error: err => {
                    $("#login").prop("disabled", false);
                    toastr.error(err.responseJSON.message);
                    if (typeof err.responseJSON.errors == 'object') {
                        $.each(err.responseJSON.errors, (index, value) => {
                            $(".error-" + index).text(value).addClass("text-danger");
                        });
                        return;
                    }
                    console.log(err.responseJSON.errors);
                }
            });
        }

        function passwordShow(event) {
            let passwordInput = $(".password").find('input');
            let icon = $(".password").find('i');

            if (passwordInput.attr('type') === 'password') {
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
                passwordInput.attr('type', 'text');
            } else {
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
                passwordInput.attr('type', 'password');
            }
        }
    </script>
</body>

</html>

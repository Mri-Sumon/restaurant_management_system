@extends('web_master')
@section('title', 'Restaurant Management System')
@section('main_content')
    <div class="container-fluid top-menu-section"
        style="background-image: linear-gradient(to bottom,rgba(255, 255, 255, 0.2), rgba(41, 46, 49, 1)), url('{{ asset('frontend/img/common-bg.jpg') }}');">
    </div>

    <link rel="stylesheet" href="{{ asset('back_asset/css/style.css') }}" />
    <style>
        /* Custom Styles */
        .navbar.scrolled,
        .navbar {
            position: fixed !important;
            right: 0;
            left: 0;
            top: 0;
            background: #404044 !important;
            -webkit-box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);
            box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);
        }

        .profile-sidebar-portlet {
            background-color: transparent;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1)
        }

        .profile-userpic {
            margin-bottom: 15px;
        }

        .profile-image {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .profile-usertitle-name {
            font-size: 18px;
            font-weight: bold;
            color: #9F784A;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        .profile-usermenu {
            text-align: left;
        }

        .profile-usermenu .nav {
            padding: 0 10px;
            display: block;
            text-align: center
        }

        .profile-usermenu .nav li {
            margin-bottom: 8px;
            border: none
        }

        .profile-usermenu .nav li a {
            background: transparent;
            color: #9F784A;
            border-radius: 25px;
            padding: 5px 15px;
            font-size: 15px;
            text-decoration: none;
            border: 1px solid #9F784A
        }

        .profile-usermenu .nav li a:hover {
            color: #fff;
            background: #9F784A;
            border: 1px solid transparent
        }

        .profile-usermenu .nav li.active a {
            color: #fff;
            background: #9F784A;
            border: 1px solid transparent
        }

        .login-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #9F784A;
            background: linear-gradient(90deg, #9F784A, #9F784A);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1.2s ease-in-out;
            transition: transform 0.3s ease-in-out;
            display: inline-block;
            margin-bottom: 20px
        }

        .login-title:hover {
            transform: scale(1.05);
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.3);
        }

        input::file-selector-button {
            background-color: #9F784A;
            border: none;
            color: #fff;
            border-radius: 5px;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <div class="container">
        <div class="blog-details-area" style="padding: 35px 0;margin-top: 100px;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center head" style="text-align: center">
                            <h3 class="login-title">Customer Panel</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3" style="padding: 0;">
                        <div class="portlet light profile-sidebar-portlet bordered">
                            <div class="profile-userpic">
                                @if (Auth::guard('customer')->check())
                                    <img src="{{ asset(Auth::guard('customer')->user()->image ?? 'profile.png') }}"
                                        class="img-responsive profile-image" alt="Profile Image">
                                @else
                                    <img src="{{ asset('profile.png') }}" class="img-responsive profile-image"
                                        alt="Default Profile Image">
                                @endif
                            </div>
                            <div class="profile-usertitle">
                                @if (Auth::guard('customer')->check())
                                    <div class="profile-usertitle-name">{{ Auth::guard('customer')->user()->name }}</div>
                                @else
                                    <div class="profile-usertitle-name">Guest</div>
                                @endif
                            </div>
                            <div class="profile-usermenu">
                                <ul class="nav" role="tablist">
                                    <li role="presentation" class="active"><a href="#home" aria-controls="home"
                                            role="tab" data-toggle="tab"><i class="mdi mdi-home"></i> Home</a></li>
                                    <li role="presentation"><a href="#password" aria-controls="password" role="tab"
                                            data-toggle="tab"><i class="mdi mdi-lock"></i> Change Password</a></li>
                                    <li role="presentation"><a href="#address" aria-controls="address" role="tab"
                                            data-toggle="tab"><i class="mdi mdi-home-circle"></i> Address</a></li>
                                    <li role="presentation"><a href="#bookingList" aria-controls="bookingList"
                                            role="tab" data-toggle="tab"><i class="mdi mdi-bookmark"></i> Booking
                                            List</a></li>
                                    <li role="presentation"><a href="#checkinList" aria-controls="checkinList"
                                            role="tab" data-toggle="tab"><i class="mdi mdi-silverware-fork-knife"></i>
                                            Menu Order's</a></li>
                                    @if (Auth::guard('customer')->check())
                                        <li><a href="" onclick="logout(event)"><i class="mdi mdi-logout"></i>
                                                Logout</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Main content -->
                    <div class="col-md-9" style="padding-right: 0;">
                        <div class="portlet light bordered">
                            <div class="portlet-body">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="home">
                                        <form method="POST" action="{{ route('profile.update') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label for="name">First Name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="first_name"
                                                        value="{{ Auth::guard('customer')->user()->first_name ?? '' }}"
                                                        class="form-control shadow-none @error('first_name') is-invalid @enderror"
                                                        id="first_name" placeholder="Enter First Name">
                                                    @error('first_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                    <label for="name">Last Name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="last_name"
                                                        value="{{ Auth::guard('customer')->user()->last_name ?? '' }}"
                                                        class="form-control shadow-none @error('last_name') is-invalid @enderror"
                                                        id="last_name" placeholder="Enter Last Name">
                                                    @error('last_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                    <label for="phone">Phone<span class="text-danger">*</span></label>
                                                    <input type="text" name="phone"
                                                        value="{{ Auth::guard('customer')->user()->phone ?? '' }}"
                                                        class="form-control shadow-none @error('phone') is-invalid @enderror"
                                                        id="phone" placeholder="Enter Phone">
                                                    @error('phone')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="email">E-Mail<span class="text-danger">*</span></label>
                                                    <input type="email" name="email"
                                                        value="{{ Auth::guard('customer')->user()->email ?? '' }}"
                                                        class="form-control shadow-none @error('email') is-invalid @enderror"
                                                        id="email" placeholder="Enter Email">
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                    <label for="image">User Image</label>
                                                    <input class="form-control" id="image" type="file"
                                                        name="image"
                                                        oninput="I.src=window.URL.createObjectURL(this.files[0])">
                                                    <div class="form-group mt-2">
                                                        <img src="{{ asset('profile.png') }}"
                                                            class="img-responsive profile-image" id="I">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="my-2">
                                            <div class="clearfix">
                                                <div class="text-right m-auto">
                                                    <button type="submit"
                                                        class="m-0 mb-3 btn btn-lg poibtn waves-effect waves-light">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="password">
                                        <form action="{{ route('password.change') }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <label for="">Old Password</label>
                                                <input type="password" name="old_password"
                                                    class="form-control mb-1 shadow-none" placeholder="Enter Old Password"
                                                    required>
                                                <label for="">New Password</label>
                                                <input type="password" class="form-control shadow-none" name="password"
                                                    placeholder="Enter New password" required>
                                            </div>
                                            <div class="modal-footer text-right">
                                                <button type="submit"
                                                    class="m-0 mb-3 btn btn-lg poibtn waves-effect waves-light">Save
                                                    changes</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="address">
                                        <form method="POST" action="{{ route('profile.address.update') }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group row">
                                                <div class="col-lg-6">
                                                    <label for="name">Address I</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ Auth::guard('customer')->user()->address }}"
                                                        name="address" placeholder="Address Line 1">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="name">Address II</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ Auth::guard('customer')->user()->address_line_II }}"
                                                        name="address_line_II" placeholder="Address Line 2">
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="name">City</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ Auth::guard('customer')->user()->city }}"
                                                        name="city" placeholder="City">
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="name">State/Province/Region</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ Auth::guard('customer')->user()->state }}"
                                                        name="state" placeholder="State/Province/Region">
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="name">ZIP/Postal Code</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ Auth::guard('customer')->user()->zip }}" name="zip"
                                                        placeholder="ZIP/Postal Code">
                                                </div>
                                            </div>
                                            <hr class="my-2">
                                            <div class="clearfix">
                                                <div class="text-right m-auto">
                                                    <button type="submit"
                                                        class="m-0 mb-3 btn btn-lg poibtn waves-effect waves-light">Update
                                                        Address</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="bookingList">
                                        <table class="table table-bordered text-center table-sm" id="datatablesSimple"
                                            width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center;color:white">SL</th>
                                                    <th style="text-align: center;color:white">Booking Date</th>
                                                    <th style="text-align: center;color:white">Booking Time</th>
                                                    <th style="text-align: center;color:white">Person</th>
                                                    <th style="text-align: center;color:white">Status</th>
                                                    <th style="text-align: center;color:white">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($bookings as $key => $content)
                                                    <tr>
                                                        <td style="color:white">{{ $key + 1 }}</td>
                                                        <td style="color:white">{{ $content->booking_date }}</td>
                                                        <td style="color:white">{{ $content->booking_time }}</td>
                                                        <td style="color:white">{{ $content->persons }}</td>
                                                        <td style="color:white">
                                                            @if ($content->status == 'p')
                                                                <span class="badge badge-warning">Pending</span>
                                                            @elseif ($content->status == 'a')
                                                                <span class="badge badge-info">Approve</span>
                                                            @elseif ($content->status == 'c')
                                                                <span class="badge badge-danger">Cancel</span>
                                                            @else
                                                                <span class="badge badge-success">Complete</span>
                                                            @endif

                                                        </td>
                                                        <td style="color:white">
                                                            @if ($content->status == 'p')
                                                                <a href="{{ route('booking.cancel', $content->id) }}"
                                                                    class="text-danger"><span
                                                                        class="mdi mdi-cancel"></span></a>
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6" style="color:white">No Data Found</td>
                                                    </tr>
                                                @endforelse

                                            </tbody>
                                        </table>
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="checkinList">
                                        <table class="table table-bordered text-center table-sm" id="datatablesSimple"
                                            width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center;color:white">SL</th>
                                                    <th style="text-align: center;color:white">Date</th>
                                                    <th style="text-align: center;color:white">Invoice</th>
                                                    <th style="text-align: center;color:white">Subtotal</th>
                                                    <th style="text-align: center;color:white">Charge</th>
                                                    <th style="text-align: center;color:white">Total</th>
                                                    <th style="text-align: center;color:white">Status</th>
                                                    <th style="text-align: center;color:white">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($orders as $chabi => $content)
                                                    <tr>
                                                        <td style="color:white">{{ $chabi + 1 }} </td>
                                                        <td style="color:white">{{ $content->date }} </td>
                                                        <td style="color:white">{{ $content->invoice }}</td>
                                                        <td style="color:white">{{ $content->sub_total }}</td>
                                                        <td style="color:white">{{ $content->charge }}</td>
                                                        <td style="color:white">{{ $content->total }}</td>
                                                        <td style="color:white">
                                                            @if ($content->status == 'p')
                                                                <span class="badge badge-warning">Pending</span>
                                                            @elseif ($content->status == 'a')
                                                                <span class="badge badge-info">Approved</span>
                                                            @elseif ($content->status == 'c')
                                                                <span class="badge badge-danger">Cancel</span>
                                                            @else
                                                                <span class="badge badge-success">Delivered</span>
                                                            @endif

                                                        </td>
                                                        <td style="color:white">
                                                            @if ($content->status == 'p')
                                                                <a href="{{ route('order.cancel', $content->id) }}"
                                                                    class="text-danger"><span
                                                                        class="mdi mdi-cancel"></span></a>
                                                            @endif
                                                            <a href="{{ route('order.customer.invoice', $content->id) }}"
                                                                class="text-info">
                                                                <span class="mdi mdi-printer-outline ml-2"></span>
                                                                Invoice</a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" style="color:white">No Data Found</td>
                                                    </tr>
                                                @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        $(document).ready(function() {
            $('#ftco-navbar').addClass('customfixnav');
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tabLinks = document.querySelectorAll('.profile-usermenu .nav li a');
            const tabContent = document.querySelectorAll('.tab-content .tab-pane');

            tabLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Remove 'active' class from all tabs and content
                    tabLinks.forEach(link => link.parentElement.classList.remove('active'));
                    tabContent.forEach(content => content.classList.remove('active'));

                    // Add 'active' class to the clicked tab and the corresponding content
                    link.parentElement.classList.add('active');
                    const targetId = link.getAttribute('aria-controls');
                    document.getElementById(targetId).classList.add('active');
                });
            });
        });
    </script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#previewImage')
                        .attr('src', e.target.result)
                        .width(100)
                        .height(80);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        document.getElementById("previewImage").src =
            "{{ asset(Auth::guard('customer')->user()->image ?? 'back_asset/images/profile.png') }}";



        function showInvoice(id) {
            event.preventDefault();
            window.open(`/confirm-booking-invoice/${id}`, '_blank');
        }

        function logout(event) {
            event.preventDefault();
            if (confirm("Are you sure ?")) {
                location.href = "{{ route('customerLogout') }}";
            }
        }
    </script>
@endpush

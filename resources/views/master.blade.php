<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>@yield('title')</title>

    <meta name="description" content="Static &amp; Dynamic Tables" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{ asset('backend') }}/js/vue/vue.js"></script>
    <link rel="stylesheet" href="{{ asset('backend') }}/css/selectize.default.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/font-awesome/4.5.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/css/fonts.googleapis.com.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/css/ace.min.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/css/responsive.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/css/style.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/css/ace-skins.min.css" />
    <script src="{{ asset('backend') }}/js/jquery-2.1.4.min.js"></script>
    <link href="{{ asset('backend') }}/css/toastr.min.css" rel="stylesheet" />

    @include('layouts.dashboard_style')
    <link rel="icon" type="image/x-icon"
        href="{{ asset($company->favicon ? $company->favicon : '/noImage.gif') }}">
    @stack('style')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .notify {
            background: red;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            line-height: 18px;
            text-align: center;
        }
    </style>
</head>

<body class="skin-2">

    @include('layouts.navbar')

    <div class="main-container ace-save-state" id="main-container">
        <div id="sidebar" class="sidebar responsive ace-save-state sidebar-fixed sidebar-scroll">

            @include('layouts.sidebar')

            <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state"
                    data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
            </div>
        </div>

        <div class="main-content">
            <div class="main-content-inner">

                <div class="breadcrumbs ace-save-state" id="breadcrumbs"
                    style="display:flex;justify-content:space-between;align-items:center;">

                    <ul class="breadcrumb" style="margin:0;">
                        <li>
                            <a style="color:#fff;" href="{{ route('dashboard') }}">
                                <i class="ace-icon fa fa-home home-icon"></i>
                                Home
                            </a>
                        </li>
                        <li>
                            <a style="color:#fff;" href="#">
                                @yield('breadcrumb_title')
                            </a>
                        </li>
                    </ul>

                    <a href="/clear-cache" class="btn btn-xs btn-primary">
                        <i class="fa fa-refresh"></i>
                        Clear Cache
                    </a>

                </div>

                <div class="customScroll">
                    <div class="main-content-navbar menuItem"></div>
                </div>

                <div class="page-content">
                    <div id="loader" hidden
                        style="position: fixed; z-index: 1000; margin: auto; height: 100%; width: 100%; background: rgba(255, 255, 255, 0.72);">
                        <img src="" style="top: 30%; left: 50%; opacity: 1; position: fixed;">
                    </div>

                    @yield('content')
                </div>

                <div class="row" style="display: none;">
                    <table id="dynamic-table" class="table table-striped table-bordered table-hover"></table>
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="footer-inner">
                <div class="footer-content"
                    style="padding: 6px 0; text-align: center; font-size: 12px; line-height: 1.4;">
                    &copy; {{ date('Y') }} Soft Museum. All Rights Reserved.
                </div>
            </div>
        </div>

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
        </a>
    </div>

    @include('layouts.shortcutModal')
    @include('layouts.script')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#organizationChange").selectize({
            onChange: id => {
                if (id) {
                    location.href = "/organization/" + id;
                }
            }
        });

        var menuArr = [];

        function showMenu() {
            menuArr = JSON.parse(localStorage.getItem('menus')) || [];
            let menuUrl = "";
            $.each(menuArr, (index, val) => {
                menuUrl += "<a href='/" + val.url + "'>" + val.value + "</a>";
            });

            let menuHtml = `
                <a href="/module/dashboard">Dashboard</a>
                ${menuUrl}
                <a onclick="shortcutMenuModal()"><i class="bi bi-plus-circle"></i></a>
            `;

            $(".menuItem").html(menuHtml);
        }
        showMenu();

        function shortcutMenuModal() {
            menuArr = JSON.parse(localStorage.getItem('menus')) || [];
            $("#shortcutMenuModal").modal("show");
            if (menuArr) {
                $.each(menuArr, (index, val) => {
                    $("#shortcutMenuModal").find('#' + val.url).prop("checked", true);
                });
            }
        }

        function singleCheck(event) {
            let menu = event.target.value.split(',');
            let menuItem = {
                url: menu[0],
                value: menu[1].trim()
            };

            if (event.target.checked) {
                menuArr.push(menuItem);
            } else {
                let findInd = menuArr.findIndex(item => item.url == menuItem.url);
                if (findInd !== -1) {
                    menuArr.splice(findInd, 1);
                }
            }

            localStorage.setItem('menus', JSON.stringify(menuArr));
            showMenu();
        }
    </script>
</body>

</html>

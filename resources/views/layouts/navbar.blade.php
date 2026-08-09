<style>
    #navbar.navbar {
        background-color: #111827 !important;
        border-bottom: 1px solid #374151 !important;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.2);
    }

    #navbar .navbar-brand {
        color: #ffffff !important;
        font-weight: 600;
        display: flex;
        align-items: center;
        padding-top: 5px;
        padding-bottom: 5px;
    }

    #navbar .navbar-brand img {
        border-radius: 4px;
        border: 1px solid #374151 !important;
        background: #ffffff;
        padding: 2px;
    }

    #navbar .ace-nav>li>a {
        background-color: transparent !important;
        color: #d1d5db !important;
        transition: all 0.2s ease-in-out;
    }

    #navbar .ace-nav>li>a:hover,
    #navbar .ace-nav>li>a:focus {
        background-color: #374151 !important;
        color: #ffffff !important;
    }

    #navbar .ace-nav>li.open>a {
        background-color: #374151 !important;
        color: #ffffff !important;
    }

    #navbar .ace-nav>li.clock_li>a {
        color: #9ca3af !important;
    }

    #navbar .user-info {
        color: #d1d5db !important;
    }

    #navbar .user-info small {
        color: #9ca3af !important;
    }

    #navbar .navbar-toggle {
        background-color: transparent !important;
        border-color: #374151 !important;
    }

    #navbar .navbar-toggle:hover {
        background-color: #374151 !important;
    }

    #navbar .navbar-toggle .icon-bar {
        background-color: #ffffff !important;
    }
</style>

<div id="navbar" class="navbar navbar-default ace-save-state navbar-fixed-top">
    <div class="navbar-container ace-save-state" id="navbar-container">

        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">
            <a href="/module/dashboard" class="navbar-brand">
                <small style="display: flex; align-items: center; gap: 10px;">
                    <img style="width: 35px; height: 35px; object-fit: contain;"
                        src="{{ asset($company->logo ? $company->logo : '/noImage.gif') }}" alt="Logo">
                    <span style="color:#ffffff; font-weight:600; letter-spacing:0.5px; font-size:15px;">
                        {{ $company->title }}
                    </span>
                </small>
            </a>
        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">

                <!-- Clock Widget -->
                <li class="clock_li">
                    <a class="clock">
                        <span
                            style="font-size: 11px; color: #d1d5db; display: flex; flex-direction: column; align-items: flex-end; text-align: right; gap: 2px;">
                            <span style="font-size: 11px; line-height: 1.2;">
                                <?php date_default_timezone_set('Asia/Dhaka');
                                echo date('l, d F Y'); ?>
                            </span>
                            <span id="timer" style="font-size: 11px; line-height: 1.2;"></span>
                        </span>
                    </a>
                </li>

                <!-- User Dropdown Menu -->
                <li class="light-blue dropdown-modal">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <img class="nav-user-photo"
                            src="{{ asset(auth()->user()->image != null ? auth()->user()->image : '/no-userimage.png') }}"
                            alt="{{ auth()->user()->name }}" />
                        <span class="user-info">
                            {{ auth()->user()->name }}
                        </span>
                        <i class="ace-icon fa fa-caret-down" style="color: #9ca3af;"></i>
                    </a>

                    <ul
                        class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="/user-profile">
                                <i class="ace-icon fa fa-user"></i>
                                Profile
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="{{ route('user.logout') }}">
                                <i class="ace-icon fa fa-power-off"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>

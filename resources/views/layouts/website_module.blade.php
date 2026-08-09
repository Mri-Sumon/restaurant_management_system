<style>
    /* Dark Theme Base Styles */
    #sidebar {
        background: #111827 !important;
        border-right: 1px solid #374151;
    }

    #sidebar .nav-list {
        background: #111827 !important;
    }

    /* Primary Links & Headers */
    #sidebar .nav-list>li>a {
        background: #111827 !important;
        color: #d1d5db !important;
        border: 0 !important;
    }

    #sidebar .nav-list>li>a .menu-icon,
    #sidebar .nav-list>li>a .arrow {
        color: #9ca3af !important;
    }

    /* Hover States */
    #sidebar .nav-list>li:hover>a,
    #sidebar .nav-list>li>a:hover {
        background: #374151 !important;
        color: #ffffff !important;
    }

    #sidebar .nav-list>li:hover>a .menu-icon,
    #sidebar .nav-list>li>a:hover .menu-icon,
    #sidebar .nav-list>li:hover>a .arrow,
    #sidebar .nav-list>li>a:hover .arrow {
        color: #ffffff !important;
    }

    /* Active Item Highlight */
    #sidebar .nav-list>li.active>a,
    #sidebar .nav-list>li.open>a {
        background: #2563eb !important;
        color: #ffffff !important;
        font-weight: 600;
    }

    #sidebar .nav-list>li.active>a .menu-icon,
    #sidebar .nav-list>li.open>a .menu-icon,
    #sidebar .nav-list>li.active>a .arrow,
    #sidebar .nav-list>li.open>a .arrow {
        color: #ffffff !important;
    }

    #sidebar .nav-list>li {
        border-color: #374151 !important;
    }

    /* Section Header (Website Module Title) */
    #sidebar .nav-list>li>a.module_title {
        background: #1f2937 !important;
        color: #9ca3af !important;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 700;
        pointer-events: none;
    }

    /* Submenu Dark Theme Styling */
    #sidebar .nav-list>li .submenu {
        background: #0f172a !important;
        border-top: 1px solid #1f2937;
        margin: 0;
        padding: 0;
    }

    #sidebar .nav-list>li .submenu>li>a {
        background: #0f172a !important;
        color: #9ca3af !important;
        padding-left: 35px;
    }

    #sidebar .nav-list>li .submenu>li:hover>a,
    #sidebar .nav-list>li .submenu>li>a:hover {
        background: #1e293b !important;
        color: #ffffff !important;
    }

    #sidebar .nav-list>li .submenu>li.active>a {
        background: #1d4ed8 !important;
        color: #ffffff !important;
        font-weight: 600;
    }

    #sidebar .nav-list>li .submenu>li.active>a .menu-icon,
    #sidebar .nav-list>li .submenu>li:hover>a .menu-icon {
        color: #60a5fa !important;
    }
</style>

@if (checkAccess('management') ||
        checkAccess('gallery') ||
        checkAccess('about') ||
        checkAccess('lunch') ||
        checkAccess('catering') ||
        checkAccess('slider') ||
        checkAccess('blog') ||
        checkAccess('cocktail') ||
        checkAccess('cocktaileDesc') ||
        checkAccess('privacy_policy') ||
        checkAccess('terms_and_conditions') ||
        checkAccess('website_messages'))
    <ul class="nav nav-list" style="background:#111827;">
        <li class="active">
            <a href="/module/dashboard">
                <i class="menu-icon bi bi-grid-1x2-fill"></i>
                <span class="menu-text"> Dashboard </span>
            </a>
            <b class="arrow"></b>
        </li>

        <li>
            <a href="/module/WebsiteModule" class="module_title">
                <span>Web Module</span>
            </a>
        </li>

        @if (checkAccess('about'))
            <li class="{{ Request::is('about') ? 'active' : '' }}">
                <a href="/about">
                    <i class="menu-icon bi bi-file-person"></i>
                    <span class="menu-text"> About Page </span>
                </a>
                <b class="arrow"></b>
            </li>
        @endif

        @if (checkAccess('lunch'))
            <li class="{{ Request::is('lunch') ? 'active' : '' }}">
                <a href="/lunch">
                    <i class="menu-icon fa fa-cutlery"></i>
                    <span class="menu-text"> Lunch Items </span>
                </a>
                <b class="arrow"></b>
            </li>
        @endif

        @if (checkAccess('catering'))
            <li class="{{ Request::is('catering') ? 'active' : '' }}">
                <a href="/catering">
                    <i class="menu-icon mdi mdi-food-turkey"></i>
                    <span class="menu-text"> Catering Details </span>
                </a>
                <b class="arrow"></b>
            </li>
        @endif

        @if (checkAccess('slider'))
            <li class="{{ Request::is('slider') ? 'active' : '' }}">
                <a href="/slider">
                    <i class="menu-icon fa fa-image"></i>
                    <span class="menu-text"> Slider Entry </span>
                </a>
                <b class="arrow"></b>
            </li>
        @endif

        @if (checkAccess('blog'))
            <li class="{{ Request::is('blog/create') ? 'active' : '' }}">
                <a href="{{ route('blog.create') }}">
                    <i class="menu-icon fa fa-pencil-square-o" aria-hidden="true"></i>
                    <span class="menu-text"> Blog Entry </span>
                </a>
                <b class="arrow"></b>
            </li>
        @endif

        @if (checkAccess('cocktail') || checkAccess('cocktaileDesc'))
            <li class="{{ Request::is('concktailsEntry') || Request::is('cocktails-description') ? 'open' : '' }}">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-glass"></i>
                    <span class="menu-text"> Cocktail Info </span>
                    <b class="arrow bi bi-chevron-down"></b>
                </a>
                <b class="arrow"></b>

                <ul class="submenu">
                    @if (checkAccess('cocktail'))
                        <li class="{{ Request::is('concktailsEntry') ? 'active' : '' }}">
                            <a href="{{ route('cocktails.create') }}">
                                <i class="menu-icon bi bi-dash-lg"></i>
                                Cocktail Entry
                            </a>
                            <b class="arrow"></b>
                        </li>
                    @endif
                    @if (checkAccess('cocktaileDesc'))
                        <li class="{{ Request::is('cocktails-description') ? 'active' : '' }}">
                            <a href="{{ route('cocktaileDesc') }}">
                                <i class="menu-icon bi bi-dash-lg"></i>
                                Cocktail Description
                            </a>
                            <b class="arrow"></b>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (checkAccess('gallery'))
            <li class="{{ Request::is('gallery') ? 'active' : '' }}">
                <a href="/gallery">
                    <i class="menu-icon bi bi-images"></i>
                    <span class="menu-text"> Gallery Entry </span>
                </a>
                <b class="arrow"></b>
            </li>
        @endif

        @if (checkAccess('privacy_policy'))
            <li class="{{ Request::is('privacy_policy') ? 'active' : '' }}">
                <a href="{{ url('privacy_policy') }}">
                    <i class="menu-icon mdi mdi-file-document-alert-outline"></i>
                    <span class="menu-text"> Privacy Policy </span>
                </a>
                <b class="arrow"></b>
            </li>
        @endif

        @if (checkAccess('terms_and_conditions'))
            <li class="{{ Request::is('terms_and_conditions') ? 'active' : '' }}">
                <a href="{{ url('terms_and_conditions') }}">
                    <i class="menu-icon mdi mdi-file-document-alert-outline"></i>
                    <span class="menu-text"> Terms & Condition</span>
                </a>
                <b class="arrow"></b>
            </li>
        @endif

        @if (checkAccess('website_messages'))
            <li class="{{ Request::is('messages') ? 'active' : '' }}">
                <a href="/messages">
                    <i class="menu-icon mdi mdi-message-processing-outline"></i>
                    <span class="menu-text"> Messages
                        @php
                            $cnt = App\Models\WebsiteMessage::where('is_read', 'd')->count();
                        @endphp
                        @if ($cnt > 0)
                            <span class="badge notify">{{ $cnt }}</span>
                        @endif
                    </span>
                </a>
                <b class="arrow"></b>
            </li>
        @endif
    </ul>
@endif

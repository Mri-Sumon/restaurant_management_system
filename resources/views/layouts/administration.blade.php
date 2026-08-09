<style>
    #sidebar {
        background: #111827 !important;
        border-right: 1px solid #374151;
    }

    #sidebar .nav-list {
        background: #111827 !important;
    }

    #sidebar .nav-list>li>a {
        background: #111827 !important;
        color: #d1d5db !important;
        border: 0 !important;
    }

    #sidebar .nav-list>li>a .menu-icon,
    #sidebar .nav-list>li>a .arrow {
        color: #9ca3af !important;
    }

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

    #sidebar .nav-list>li>a.module_title {
        background: #1f2937 !important;
        color: #9ca3af !important;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 700;
        pointer-events: none;
    }

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

@if (checkAccess('user') ||
        checkAccess('customer') ||
        checkAccess('supplier') ||
        checkAccess('size') ||
        checkAccess('color') ||
        checkAccess('district') ||
        checkAccess('brand') ||
        checkAccess('category') ||
        checkAccess('product') ||
        checkAccess('sms') ||
        checkAccess('productList') ||
        checkAccess('productLedger') ||
        checkAccess('damageEntry') ||
        checkAccess('damageList'))
    <ul class="nav nav-list" style="background:#111827;">
        <li class="active">
            <a href="/module/dashboard">
                <i class="menu-icon bi bi-grid-1x2-fill"></i>
                <span class="menu-text"> Dashboard </span>
            </a>
            <b class="arrow"></b>
        </li>

        <li>
            <a href="/module/Administration" class="module_title">
                <span>Administration</span>
            </a>
        </li>

        @if (checkAccess('sms'))
            <li class="{{ Request::is('send-sms') ? 'active' : '' }}">
                <a href="/send-sms">
                    <i class="menu-icon bi bi-chat-left-text-fill"></i>
                    <span class="menu-text"> Send SMS </span>
                </a>
                <b class="arrow"></b>
            </li>
        @endif

        @if (checkAccess('table') || checkAccess('tableList') || checkAccess('chair'))
            <li class="{{ Request::is('table') || Request::is('tablelist') || Request::is('chair') ? 'open' : '' }}">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon bi bi-border-inner"></i>
                    <span class="menu-text"> Table Info </span>
                    <b class="arrow bi bi-chevron-down"></b>
                </a>
                <b class="arrow"></b>

                <ul class="submenu">
                    @if (checkAccess('table'))
                        <li class="{{ Request::is('table') ? 'active' : '' }}">
                            <a href="/table">
                                <i class="menu-icon bi bi-dash-lg"></i>
                                Table Entry
                            </a>
                            <b class="arrow"></b>
                        </li>
                    @endif
                    @if (checkAccess('tableList'))
                        <li class="{{ Request::is('tablelist') ? 'active' : '' }}">
                            <a href="/tablelist">
                                <i class="menu-icon bi bi-dash-lg"></i>
                                Table List
                            </a>
                            <b class="arrow"></b>
                        </li>
                    @endif
                    @if (checkAccess('chair'))
                        <li class="{{ Request::is('chair') ? 'active' : '' }}">
                            <a href="/chair">
                                <i class="menu-icon bi bi-dash-lg"></i>
                                Chair Entry
                            </a>
                            <b class="arrow"></b>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (checkAccess('supplier') || checkAccess('supplierList'))
            <li class="{{ Request::is('supplier') || Request::is('supplierlist') ? 'open' : '' }}">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon bi bi-truck-flatbed"></i>
                    <span class="menu-text"> Supplier Info </span>
                    <b class="arrow bi bi-chevron-down"></b>
                </a>
                <b class="arrow"></b>

                <ul class="submenu">
                    @if (checkAccess('supplier'))
                        <li class="{{ Request::is('supplier') ? 'active' : '' }}">
                            <a href="/supplier">
                                <i class="menu-icon bi bi-dash-lg"></i>
                                Supplier Entry
                            </a>
                            <b class="arrow"></b>
                        </li>
                    @endif
                    @if (checkAccess('supplierList'))
                        <li class="{{ Request::is('supplierlist') ? 'active' : '' }}">
                            <a href="/supplierlist">
                                <i class="menu-icon bi bi-dash-lg"></i>
                                Supplier List
                            </a>
                            <b class="arrow"></b>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (checkAccess('customer') || checkAccess('customerList'))
            <li class="{{ Request::is('customer') || Request::is('customerlist') ? 'open' : '' }}">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon bi bi-people-fill"></i>
                    <span class="menu-text"> Guest Info </span>
                    <b class="arrow bi bi-chevron-down"></b>
                </a>
                <b class="arrow"></b>

                <ul class="submenu">
                    @if (checkAccess('customer'))
                        <li class="{{ Request::is('customer') ? 'active' : '' }}">
                            <a href="/customer">
                                <i class="menu-icon bi bi-dash-lg"></i>
                                Guest Entry
                            </a>
                            <b class="arrow"></b>
                        </li>
                    @endif
                    @if (checkAccess('customerList'))
                        <li class="{{ Request::is('customerlist') ? 'active' : '' }}">
                            <a href="/customerlist">
                                <i class="menu-icon bi bi-dash-lg"></i>
                                Guest List
                            </a>
                            <b class="arrow"></b>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if (checkAccess('floor'))
            <li class="{{ Request::is('floor') ? 'active' : '' }}">
                <a href="/floor">
                    <i class="menu-icon bi bi-layers-fill"></i>
                    <span class="menu-text"> Floor Entry </span>
                </a>
            </li>
        @endif

        @if (checkAccess('tabletype'))
            <li class="{{ Request::is('tabletype') ? 'active' : '' }}">
                <a href="/tabletype">
                    <i class="menu-icon bi bi-tags-fill"></i>
                    <span class="menu-text"> Table Type </span>
                </a>
            </li>
        @endif

        @if (checkAccess('district'))
            <li class="{{ Request::is('district') ? 'active' : '' }}">
                <a href="/district">
                    <i class="menu-icon bi bi-geo-alt-fill"></i>
                    <span class="menu-text"> Area Entry </span>
                </a>
            </li>
        @endif

        @if (checkAccess('user'))
            <li class="{{ Request::is('user') || Route::is('user.userAccess') ? 'active' : '' }}">
                <a href="/user">
                    <i class="menu-icon bi bi-person-plus-fill"></i>
                    <span class="menu-text"> Create User </span>
                </a>
            </li>
        @endif

        <li class="{{ Request::is('user-activity') ? 'active' : '' }}">
            <a href="/user-activity">
                <i class="menu-icon bi bi-journal-text"></i>
                <span class="menu-text"> User Activity </span>
            </a>
        </li>

        @if (checkAccess('companyProfile'))
            <li class="{{ Request::is('company-profile') ? 'active' : '' }}">
                <a href="/company-profile">
                    <i class="menu-icon bi bi-building-gear"></i>
                    <span class="menu-text"> Company Profile </span>
                </a>
                <b class="arrow"></b>
            </li>
        @endif
    </ul>
@endif

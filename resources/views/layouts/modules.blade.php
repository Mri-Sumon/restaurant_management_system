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

    #sidebar .nav-list>li>a>.menu-icon {
        color: #9ca3af !important;
    }

    #sidebar .nav-list>li:hover>a,
    #sidebar .nav-list>li>a:hover {
        background: #374151 !important;
        color: #ffffff !important;
    }

    #sidebar .nav-list>li:hover>a>.menu-icon,
    #sidebar .nav-list>li>a:hover>.menu-icon {
        color: #ffffff !important;
    }

    #sidebar .nav-list>li.active>a {
        background: #2563eb !important;
        color: #ffffff !important;
        font-weight: 600;
    }

    #sidebar .nav-list>li.active>a>.menu-icon {
        color: #ffffff !important;
    }

    #sidebar .nav-list>li>.arrow {
        color: #9ca3af !important;
    }

    #sidebar .nav-list>li {
        border-color: #374151 !important;
    }
</style>

<ul class="nav nav-list" style="background:#111827;">

    <li class="active">
        <a href="{{ route('dashboard') }}">
            <i class="menu-icon bi bi-grid-1x2-fill"></i>
            <span class="menu-text"> Dashboard </span>
        </a>
        <b class="arrow"></b>
    </li>

    <li>
        <a href="{{ url('module/RestaurantModule') }}">
            <i class="menu-icon fa fa-cutlery"></i>
            <span class="menu-text"> Restaurant Module </span>
        </a>
        <b class="arrow"></b>
    </li>

    <li>
        <a href="{{ url('module/KitechenModule') }}">
            <i class="menu-icon fa fa-fire"></i>
            <span class="menu-text"> Kitchen Module </span>
        </a>
        <b class="arrow"></b>
    </li>

    <li>
        <a href="{{ url('module/InventoryModule') }}">
            <i class="menu-icon fa fa-cubes"></i>
            <span class="menu-text"> Inventory Module </span>
        </a>
        <b class="arrow"></b>
    </li>

    <li>
        <a href="{{ url('module/AccountsModule') }}">
            <i class="menu-icon fa fa-calculator"></i>
            <span class="menu-text"> Accounts Module </span>
        </a>
        <b class="arrow"></b>
    </li>

    <li>
        <a href="{{ url('module/HRPayroll') }}">
            <i class="menu-icon fa fa-users"></i>
            <span class="menu-text"> HR &amp; Payroll </span>
        </a>
        <b class="arrow"></b>
    </li>

    <li>
        <a href="{{ url('module/ReportsModule') }}">
            <i class="menu-icon fa fa-file-text-o"></i>
            <span class="menu-text"> Reports Module </span>
        </a>
        <b class="arrow"></b>
    </li>

    <li>
        <a href="{{ url('module/Administration') }}">
            <i class="menu-icon fa fa-cogs"></i>
            <span class="menu-text"> Administration </span>
        </a>
        <b class="arrow"></b>
    </li>

    @if (checkAccess('graph'))
        <li class="{{ Request::is('graph') ? 'active' : '' }}">
            <a href="/graph">
                <i class="menu-icon fa fa-line-chart"></i>
                <span class="menu-text"> Business Monitor </span>
            </a>
            <b class="arrow"></b>
        </li>
    @endif

    <li>
        <a href="{{ url('module/WebsiteModule') }}">
            <i class="menu-icon fa fa-globe"></i>
            <span class="menu-text"> Website Module </span>
        </a>
        <b class="arrow"></b>
    </li>

    <li>
        <a href="{{ url('logout') }}">
            <i class="menu-icon fa fa-sign-out"></i>
            <span class="menu-text"> Log Out </span>
        </a>
        <b class="arrow"></b>
    </li>

</ul>

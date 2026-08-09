<style>
    /* Modern Side-by-Side Module Layout */
    #dashboard .module-card {
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 16px 18px;
        margin-bottom: 20px;
        transition: all 0.25s ease-in-out;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        display: flex;
        align-items: center;
        text-decoration: none !important;
        position: relative;
        overflow: hidden;
    }

    #dashboard .module-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
        border-color: #cbd5e1;
    }

    /* Fixed Icon Container */
    #dashboard .logo-icon {
        width: 44px;
        height: 44px;
        min-width: 44px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin-right: 14px;
        transition: all 0.25s ease;
    }

    #dashboard .module-title {
        font-size: 14px;
        font-weight: 600;
        color: #334155;
        margin: 0;
        line-height: 1.3;
        letter-spacing: 0.1px;
    }

    /* Soft Themed Icon Colors */
    .theme-teal .logo-icon {
        background-color: #ccfbf1;
        color: #0f766e;
    }

    .theme-indigo .logo-icon {
        background-color: #e0e7ff;
        color: #4338ca;
    }

    .theme-blue .logo-icon {
        background-color: #dbeafe;
        color: #1d4ed8;
    }

    .theme-amber .logo-icon {
        background-color: #fef3c7;
        color: #b45309;
    }

    .theme-cyan .logo-icon {
        background-color: #cffaff;
        color: #0e7490;
    }

    .theme-emerald .logo-icon {
        background-color: #dcfce7;
        color: #15803d;
    }

    .theme-purple .logo-icon {
        background-color: #f3e8ff;
        color: #6b21a8;
    }

    .theme-slate .logo-icon {
        background-color: #f1f5f9;
        color: #475569;
    }

    /* Alert Banner Style */
    .modern-alert {
        background-color: #fef2f2;
        border-left: 4px solid #ef4444;
        border-radius: 6px;
        padding: 12px 16px;
        margin-top: 10px;
    }

    .modern-alert-text {
        margin: 0;
        color: #991b1b;
        font-weight: 600;
        font-size: 15px;
    }
</style>

<div class="row" id="dashboard">
    <div class="col-md-12 col-xs-12">

        <!-- Restaurant Operations -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="/module/RestaurantModule" class="module-card theme-teal">
                <div class="logo-icon">
                    <i class="bi bi-cup-hot"></i>
                </div>
                <span class="module-title">Restaurant POS</span>
            </a>
        </div>

        <!-- Kitchen Display System -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="/module/KitechenModule" class="module-card theme-teal">
                <div class="logo-icon">
                    <i class="fa fa-cutlery"></i>
                </div>
                <span class="module-title">Kitchen Display (KDS)</span>
            </a>
        </div>

        <!-- Service Desk -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="/module/ServiceModule" class="module-card theme-blue">
                <div class="logo-icon">
                    <i class="bi bi-person-workspace"></i>
                </div>
                <span class="module-title">Guest Services</span>
            </a>
        </div>

        <!-- Inventory & Stock -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="/module/InventoryModule" class="module-card theme-amber">
                <div class="logo-icon">
                    <i class="bi bi-cart-plus"></i>
                </div>
                <span class="module-title">Inventory & Stock</span>
            </a>
        </div>

        <!-- Accounts & Finance -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="/module/AccountsModule" class="module-card theme-cyan">
                <div class="logo-icon">
                    <i class="bi bi-cash-coin"></i>
                </div>
                <span class="module-title">Financial Ledger</span>
            </a>
        </div>

        <!-- HR & Payroll -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="/module/HRPayroll" class="module-card theme-emerald">
                <div class="logo-icon">
                    <i class="bi bi-person-bounding-box"></i>
                </div>
                <span class="module-title">HR & Payroll</span>
            </a>
        </div>

        <!-- Reports & Analytics -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="/module/ReportsModule" class="module-card theme-purple">
                <div class="logo-icon">
                    <i class="bi bi-journal-bookmark"></i>
                </div>
                <span class="module-title">Analytics & Reports</span>
            </a>
        </div>

        <!-- System Administration -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="/module/Administration" class="module-card theme-slate">
                <div class="logo-icon">
                    <i class="bi bi-gear"></i>
                </div>
                <span class="module-title">System Settings</span>
            </a>
        </div>

        <!-- Business Monitor -->
        @if (checkAccess('graph'))
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="/graph" class="module-card theme-blue">
                    <div class="logo-icon">
                        <i class="fa fa-bar-chart"></i>
                    </div>
                    <span class="module-title">Business Monitor</span>
                </a>
            </div>
        @endif

        <!-- Session Message -->
        @if (Session::has('dueMsg'))
            <div class="col-md-12">
                <div class="modern-alert text-center">
                    <p class="modern-alert-text">
                        <i class="fa fa-exclamation-circle" style="margin-right: 6px;"></i>
                        {{ Session::get('dueMsg') }}
                    </p>
                </div>
            </div>
        @endif

    </div>
</div>

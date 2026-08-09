<style>
    .admin-module-card {
        position: relative;
        min-height: 105px;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        padding: 16px 12px;
        overflow: hidden;
        transition: all 0.2s ease;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    }

    .admin-module-card:hover {
        border-color: #4b3f72;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transform: translateY(-2px);
    }

    .admin-module-icon {
        width: 42px;
        height: 42px;
        line-height: 42px;
        text-align: center;
        float: left;
        margin-right: 11px;
        border-radius: 4px;
        background: #f2f0f8;
        color: #4b3f72;
        font-size: 20px;
    }

    .admin-module-content {
        padding-top: 2px;
        padding-right: 15px;
        overflow: hidden;
    }

    .admin-module-title {
        font-size: 13px;
        font-weight: 600;
        color: #344054;
        line-height: 18px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .admin-module-subtitle {
        margin-top: 5px;
        font-size: 11px;
        color: #98a2b3;
        line-height: 15px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .admin-module-arrow {
        position: absolute;
        right: 10px;
        bottom: 9px;
        color: #c4c8ce;
        font-size: 13px;
        transition: all 0.2s ease;
    }

    .admin-module-card:hover .admin-module-arrow {
        color: #4b3f72;
        right: 8px;
    }

    .admin-module-card:hover .admin-module-icon {
        background: #4b3f72;
        color: #fff;
    }

    @media (max-width: 767px) {
        .admin-module-card {
            min-height: 95px;
            padding: 13px 10px;
        }

        .admin-module-icon {
            width: 36px;
            height: 36px;
            line-height: 36px;
            font-size: 17px;
            margin-right: 8px;
        }

        .admin-module-title {
            font-size: 12px;
        }

        .admin-module-subtitle {
            font-size: 10px;
        }
    }
</style>

<div class="row">
    <div class="col-md-12 col-xs-12">

        <!-- Module Header -->
        <div
            style="
                margin-bottom: 20px;
                padding: 0 5px 12px;
                border-bottom: 1px solid #e5e7eb;
            ">
            <div style="display: inline-block;">
                <h3
                    style="
                        margin: 0;
                        font-size: 22px;
                        font-weight: 600;
                        color: #2c3e50;
                    ">
                    <i class="ace-icon fa fa-cogs" style="margin-right: 8px; color: #4b3f72;"></i>
                    Administration Module
                </h3>

                <div
                    style="
                        margin-top: 5px;
                        font-size: 12px;
                        color: #8a8f98;
                    ">
                    Manage your system configuration and administration
                </div>
            </div>
        </div>


        <!-- Table Entry -->
        @if (checkAccess('table'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/table" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">

                        <div class="admin-module-icon">
                            <i class="menu-icon bi bi-table"></i>
                        </div>

                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Table Entry
                            </div>
                            <div class="admin-module-subtitle">
                                Manage tables
                            </div>
                        </div>

                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>

                    </div>
                </a>
            </div>
        @endif


        <!-- Table List -->
        @if (checkAccess('tableList'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/tablelist" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">

                        <div class="admin-module-icon">
                            <i class="menu-icon bi bi-list-ol"></i>
                        </div>

                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Table List
                            </div>
                            <div class="admin-module-subtitle">
                                View all tables
                            </div>
                        </div>

                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>

                    </div>
                </a>
            </div>
        @endif


        <!-- Chair Entry -->
        @if (checkAccess('chair'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/chair" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">

                        <div class="admin-module-icon">
                            <i class="menu-icon bi bi-view-stacked"></i>
                        </div>

                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Chair Entry
                            </div>
                            <div class="admin-module-subtitle">
                                Manage chairs
                            </div>
                        </div>

                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>

                    </div>
                </a>
            </div>
        @endif


        <!-- Table Type -->
        @if (checkAccess('tableType'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/tabletype" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">

                        <div class="admin-module-icon">
                            <i class="menu-icon bi bi-view-stacked"></i>
                        </div>

                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Table Type
                            </div>
                            <div class="admin-module-subtitle">
                                Configure table types
                            </div>
                        </div>

                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>

                    </div>
                </a>
            </div>
        @endif


        <!-- Supplier Entry -->
        @if (checkAccess('supplier'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/supplier" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">

                        <div class="admin-module-icon">
                            <i class="menu-icon bi bi-person"></i>
                        </div>

                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Supplier Entry
                            </div>
                            <div class="admin-module-subtitle">
                                Manage suppliers
                            </div>
                        </div>

                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>

                    </div>
                </a>
            </div>
        @endif


        <!-- Supplier List -->
        @if (checkAccess('supplierList'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/supplierlist" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">

                        <div class="admin-module-icon">
                            <i class="menu-icon bi bi-list-ol"></i>
                        </div>

                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Supplier List
                            </div>
                            <div class="admin-module-subtitle">
                                View suppliers
                            </div>
                        </div>

                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>

                    </div>
                </a>
            </div>
        @endif


        <!-- Guest Entry -->
        @if (checkAccess('customer'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/customer" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">

                        <div class="admin-module-icon">
                            <i class="menu-icon bi bi-person"></i>
                        </div>

                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Guest Entry
                            </div>
                            <div class="admin-module-subtitle">
                                Manage guests
                            </div>
                        </div>

                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>

                    </div>
                </a>
            </div>
        @endif


        <!-- Guest List -->
        @if (checkAccess('customerList'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/customerlist" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">

                        <div class="admin-module-icon">
                            <i class="menu-icon bi bi-list-ol"></i>
                        </div>

                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Guest List
                            </div>
                            <div class="admin-module-subtitle">
                                View guest records
                            </div>
                        </div>

                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>

                    </div>
                </a>
            </div>
        @endif


        <!-- Area Entry -->
        @if (checkAccess('district'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/district" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">

                        <div class="admin-module-icon">
                            <i class="menu-icon bi bi-globe"></i>
                        </div>

                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Area Entry
                            </div>
                            <div class="admin-module-subtitle">
                                Manage areas
                            </div>
                        </div>

                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>

                    </div>
                </a>
            </div>
        @endif

        <!-- Create User -->
        @if (checkAccess('user'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/user" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">

                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-user-plus"></i>
                        </div>

                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Create User
                            </div>
                            <div class="admin-module-subtitle">
                                Manage system users
                            </div>
                        </div>

                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>

                    </div>
                </a>
            </div>
        @endif


        <!-- Company Profile -->
        @if (checkAccess('companyProfile'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/company-profile" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">

                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-bank"></i>
                        </div>

                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Company Profile
                            </div>
                            <div class="admin-module-subtitle">
                                Company information
                            </div>
                        </div>

                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>

                    </div>
                </a>
            </div>
        @endif

    </div>
</div>

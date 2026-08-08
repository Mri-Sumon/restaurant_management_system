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
                    <i class="ace-icon fa fa-calendar" style="margin-right: 8px; color: #4b3f72;"></i>
                    Booking Module
                </h3>

                <div
                    style="
                        margin-top: 5px;
                        font-size: 12px;
                        color: #8a8f98;
                    ">
                    Manage reservations, check-ins, and billing records
                </div>
            </div>
        </div>


        <!-- Booking Entry -->
        @if (checkAccess('booking'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/booking" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">

                        <div class="admin-module-icon">
                            <i class="menu-icon bi bi-bookmarks"></i>
                        </div>

                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Booking Entry
                            </div>
                            <div class="admin-module-subtitle">
                                New booking
                            </div>
                        </div>

                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>

                    </div>
                </a>
            </div>
        @endif


        <!-- Checkout -->
        @if (checkAccess('checkinRecord'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/checkout" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">

                        <div class="admin-module-icon">
                            <i class="menu-icon bi bi-box-arrow-right"></i>
                        </div>

                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Checkout
                            </div>
                            <div class="admin-module-subtitle">
                                Process checkout
                            </div>
                        </div>

                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>

                    </div>
                </a>
            </div>
        @endif


        <!-- Checkin Record -->
        @if (checkAccess('checkinRecord'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/checkin-record" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">

                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-list"></i>
                        </div>

                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Checkin Record
                            </div>
                            <div class="admin-module-subtitle">
                                View check-ins
                            </div>
                        </div>

                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>

                    </div>
                </a>
            </div>
        @endif


        <!-- Booking Record -->
        @if (checkAccess('bookingRecord'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/booking-record" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">

                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-list"></i>
                        </div>

                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Booking Record
                            </div>
                            <div class="admin-module-subtitle">
                                View all bookings
                            </div>
                        </div>

                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>

                    </div>
                </a>
            </div>
        @endif


        <!-- Billing Record -->
        @if (checkAccess('billingRecord'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/billing-record" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">

                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-list"></i>
                        </div>

                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Billing Record
                            </div>
                            <div class="admin-module-subtitle">
                                View billings
                            </div>
                        </div>

                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>

                    </div>
                </a>
            </div>
        @endif


        <!-- Billing Invoice -->
        @if (checkAccess('billingInvoice'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/billing-invoice" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">

                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-file-text-o"></i>
                        </div>

                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Billing Invoice
                            </div>
                            <div class="admin-module-subtitle">
                                Manage invoices
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

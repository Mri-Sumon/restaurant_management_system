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
                    <i class="ace-icon fa fa-shopping-cart" style="margin-right: 8px; color: #4b3f72;"></i>
                    Purchase Module
                </h3>

                <div
                    style="
                        margin-top: 5px;
                        font-size: 12px;
                        color: #8a8f98;
                    ">
                    Manage inventory purchases, suppliers, and billing records
                </div>
            </div>
        </div>


        <!-- Purchase Entry -->
        @if (checkAccess('purchase'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/purchase" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">

                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-shopping-cart"></i>
                        </div>

                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Purchase Entry
                            </div>
                            <div class="admin-module-subtitle">
                                New purchase
                            </div>
                        </div>

                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>

                    </div>
                </a>
            </div>
        @endif


        <!-- Purchase Return -->
        @if (checkAccess('purchaseReturn'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/purchase-return" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">

                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-rotate-right"></i>
                        </div>

                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Purchase Return
                            </div>
                            <div class="admin-module-subtitle">
                                Return items
                            </div>
                        </div>

                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>

                    </div>
                </a>
            </div>
        @endif


        <!-- Purchase Record -->
        @if (checkAccess('purchaseRecord'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/purchase-record" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">

                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-file-text-o"></i>
                        </div>

                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Purchase Record
                            </div>
                            <div class="admin-module-subtitle">
                                View purchases
                            </div>
                        </div>

                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>

                    </div>
                </a>
            </div>
        @endif


        <!-- Asset Entry -->
        @if (checkAccess('assetEntry'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/asset" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">

                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-line-chart"></i>
                        </div>

                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Asset Entry
                            </div>
                            <div class="admin-module-subtitle">
                                Manage assets
                            </div>
                        </div>

                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>

                    </div>
                </a>
            </div>
        @endif


        <!-- Invoice Print -->
        @if (checkAccess('purchaseInvoice'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/purchase-invoice" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">

                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-print"></i>
                        </div>

                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Invoice Print
                            </div>
                            <div class="admin-module-subtitle">
                                Print invoices
                            </div>
                        </div>

                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>

                    </div>
                </a>
            </div>
        @endif


        <!-- Due Report -->
        @if (checkAccess('supplierDue'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/supplier-due" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">

                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-list"></i>
                        </div>

                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Due Report
                            </div>
                            <div class="admin-module-subtitle">
                                Supplier dues
                            </div>
                        </div>

                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>

                    </div>
                </a>
            </div>
        @endif


        <!-- Payment Report -->
        @if (checkAccess('supplierPaymentReport'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/supplier-ledger" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">

                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-credit-card-alt"></i>
                        </div>

                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Payment Report
                            </div>
                            <div class="admin-module-subtitle">
                                Supplier ledger
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
                            <i class="menu-icon fa fa-th-list"></i>
                        </div>

                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Supplier List
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


        <!-- Return Record -->
        @if (checkAccess('purchaseReturnList'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/purchase-return-record" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">

                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-retweet"></i>
                        </div>

                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Return Record
                            </div>
                            <div class="admin-module-subtitle">
                                View returns
                            </div>
                        </div>

                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>

                    </div>
                </a>
            </div>
        @endif


        <!-- Re-Order List -->
        @if (checkAccess('reorderList'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/reorder-list" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">

                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-list"></i>
                        </div>

                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Re-Order List
                            </div>
                            <div class="admin-module-subtitle">
                                Low stock alert
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

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
                    <i class="ace-icon bi bi-file-earmark-text" style="margin-right: 8px; color: #4b3f72;"></i>
                    Reports Module
                </h3>

                <div
                    style="
                        margin-top: 5px;
                        font-size: 12px;
                        color: #8a8f98;
                    ">
                    View cash, ledger, bank, due, sales, and employee financial reports
                </div>
            </div>
        </div>

        <!-- Cash View -->
        @if (checkAccess('cashView'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/cash-view" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">
                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-list"></i>
                        </div>
                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Cash View
                            </div>
                            <div class="admin-module-subtitle">
                                Cash records
                            </div>
                        </div>
                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        <!-- Supplier Due Report -->
        @if (checkAccess('supplierDue'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/supplier-due" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">
                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-money"></i>
                        </div>
                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Supplier Due
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

        <!-- Supplier Ledger -->
        @if (checkAccess('supplierPaymentReport'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/supplier-ledger" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">
                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-money"></i>
                        </div>
                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Supplier Ledger
                            </div>
                            <div class="admin-module-subtitle">
                                Supplier logs
                            </div>
                        </div>
                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        <!-- Supplier Payment Report -->
        @if (checkAccess('supplierPaymentReport'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/supplier-payment-history" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">
                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-credit-card"></i>
                        </div>
                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Payment Report
                            </div>
                            <div class="admin-module-subtitle">
                                Supplier payments
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

        <!-- Sales Record -->
        @if (checkAccess('saleRecord'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/sale-record" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">
                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-th-list"></i>
                        </div>
                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Sales Record
                            </div>
                            <div class="admin-module-subtitle">
                                View sales
                            </div>
                        </div>
                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        <!-- Guest Due List -->
        @if (checkAccess('customerDue'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/customer-due" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">
                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-list-ul"></i>
                        </div>
                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Guest Due List
                            </div>
                            <div class="admin-module-subtitle">
                                Customer dues
                            </div>
                        </div>
                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        <!-- Guest Ledger -->
        @if (checkAccess('customerPaymentReport'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/customer-ledger" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">
                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-list-ul"></i>
                        </div>
                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Guest Ledger
                            </div>
                            <div class="admin-module-subtitle">
                                Customer ledger
                            </div>
                        </div>
                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        <!-- Guest Payment Report -->
        @if (checkAccess('customerPaymentReport'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/customer-payment-history" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">
                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-credit-card"></i>
                        </div>
                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Payment Report
                            </div>
                            <div class="admin-module-subtitle">
                                Guest payments
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
                            <i class="menu-icon fa fa-th-list"></i>
                        </div>
                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Guest List
                            </div>
                            <div class="admin-module-subtitle">
                                View customers
                            </div>
                        </div>
                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        <!-- Cash Transaction Report -->
        @if (checkAccess('TransactionReport'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="{{ route('cash.transaction.report') }}" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">
                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-money"></i>
                        </div>
                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Cash Transaction
                            </div>
                            <div class="admin-module-subtitle">
                                Transaction logs
                            </div>
                        </div>
                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        <!-- Bank Transaction Report -->
        @if (checkAccess('bankTransactionReport'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="{{ route('bank.transaction.record') }}" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">
                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-file-text-o"></i>
                        </div>
                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Bank Transaction
                            </div>
                            <div class="admin-module-subtitle">
                                Bank records
                            </div>
                        </div>
                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        <!-- Bank Ledger -->
        @if (checkAccess('bankLedger'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/bank-ledger" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">
                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-file-text-o"></i>
                        </div>
                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Bank Ledger
                            </div>
                            <div class="admin-module-subtitle">
                                Ledger view
                            </div>
                        </div>
                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        <!-- Cash Statement -->
        @if (checkAccess('cashStatement'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/cash-statement" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">
                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-money"></i>
                        </div>
                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Cash Statement
                            </div>
                            <div class="admin-module-subtitle">
                                Statement logs
                            </div>
                        </div>
                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        <!-- Balance Sheet -->
        @if (checkAccess('balanceSheet'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/balance-sheet" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">
                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-money"></i>
                        </div>
                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Balance Sheet
                            </div>
                            <div class="admin-module-subtitle">
                                Financial sheet
                            </div>
                        </div>
                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        <!-- Employee List -->
        @if (checkAccess('employeeList'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/employee-list" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">
                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-user-plus"></i>
                        </div>
                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Employee List
                            </div>
                            <div class="admin-module-subtitle">
                                Staff records
                            </div>
                        </div>
                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        <!-- Salary Payment Report -->
        @if (checkAccess('salaryPaymentReport'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/salaryRecord" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">
                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-money"></i>
                        </div>
                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Salary Report
                            </div>
                            <div class="admin-module-subtitle">
                                Salary history
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

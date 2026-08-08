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

        <div class="col-md-10 col-md-offset-1 col-xs-12">

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
                        <i class="ace-icon bi bi-cash-stack" style="margin-right: 8px; color: #4b3f72;"></i>
                        Accounts Module
                    </h3>

                    <div
                        style="
                        margin-top: 5px;
                        font-size: 12px;
                        color: #8a8f98;
                    ">
                        Manage cash transactions, bank accounts, and financial reports
                    </div>
                </div>
            </div>

            <!-- Cash Transaction -->
            @if (checkAccess('cashTransaction'))
                <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                    <a href="{{ route('cash.transaction') }}" style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon bi bi-cash-stack"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Cash Transaction
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

            <!-- Bank Transactions -->
            @if (checkAccess('bankTransaction'))
                <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                    <a href="/bank-transaction" style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon bi bi-bank"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Bank Transactions
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

            <!-- Guest Payment -->
            @if (checkAccess('customerPayment'))
                <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                    <a href="{{ route('customer.payment') }}" style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon fa fa-money"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Guest Payment
                                </div>
                                <div class="admin-module-subtitle">
                                    Customer payments
                                </div>
                            </div>
                            <div class="admin-module-arrow">
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <!-- Supplier Payment -->
            @if (checkAccess('supplierPayment'))
                <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                    <a href="{{ route('supplier.payment') }}" style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon fa fa-money"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Supplier Payment
                                </div>
                                <div class="admin-module-subtitle">
                                    Vendor payments
                                </div>
                            </div>
                            <div class="admin-module-arrow">
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

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
                                    View cash
                                </div>
                            </div>
                            <div class="admin-module-arrow">
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <!-- Transaction Accounts -->
            @if (checkAccess('account'))
                <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                    <a href="{{ route('account.create') }}" style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon bi bi-person-vcard"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Transaction Accounts
                                </div>
                                <div class="admin-module-subtitle">
                                    Manage accounts
                                </div>
                            </div>
                            <div class="admin-module-arrow">
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <!-- Bank Accounts -->
            @if (checkAccess('bankAccounts'))
                <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                    <a href="/bank-account" style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon fa fa-bank"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Bank Accounts
                                </div>
                                <div class="admin-module-subtitle">
                                    Manage banks
                                </div>
                            </div>
                            <div class="admin-module-arrow">
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <!-- Cheque Entry -->
            @if (checkAccess('checkEntry'))
                <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                    <a href="/check/entry" style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon fa fa-credit-card-alt"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Cheque Entry
                                </div>
                                <div class="admin-module-subtitle">
                                    New cheque
                                </div>
                            </div>
                            <div class="admin-module-arrow">
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <!-- All Cheque list -->
            @if (checkAccess('checkList'))
                <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                    <a href="/check/list" style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon fa fa-list"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    All Cheque list
                                </div>
                                <div class="admin-module-subtitle">
                                    View cheques
                                </div>
                            </div>
                            <div class="admin-module-arrow">
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <!-- Reminder Cheque list -->
            @if (checkAccess('checkreminderList'))
                <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                    <a href="/check/reminder/list" style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon fa fa-bell"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Reminder Cheque list
                                </div>
                                <div class="admin-module-subtitle">
                                    Cheque alerts
                                </div>
                            </div>
                            <div class="admin-module-arrow">
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <!-- Pending Cheque list -->
            @if (checkAccess('checkpendingList'))
                <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                    <a href="/check/pending/list" style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon fa fa-hourglass-half"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Pending Cheque list
                                </div>
                                <div class="admin-module-subtitle">
                                    Pending cheques
                                </div>
                            </div>
                            <div class="admin-module-arrow">
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <!-- Dishonoured Cheque list -->
            @if (checkAccess('checkdishoneredList'))
                <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                    <a href="/check/dis/list" style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon fa fa-times"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Dishonoured Cheque list
                                </div>
                                <div class="admin-module-subtitle">
                                    Dishonoured
                                </div>
                            </div>
                            <div class="admin-module-arrow">
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <!-- Paid Cheque list -->
            @if (checkAccess('checkpaidList'))
                <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                    <a href="/check/paid/list" style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon fa fa-check-square-o"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Paid Cheque list
                                </div>
                                <div class="admin-module-subtitle">
                                    Paid cheques
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
                    <a href="{{ route('cash.transaction.report') }}" target="_blank"
                        style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon bi bi-list-ul"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Cash Transaction Report
                                </div>
                                <div class="admin-module-subtitle">
                                    Cash report
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
                                <i class="menu-icon bi bi-list-ul"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Bank Transaction Report
                                </div>
                                <div class="admin-module-subtitle">
                                    Bank report
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
                    <a href="/bank_ledger" style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon bi bi-file-earmark-text"></i>
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
                                <i class="menu-icon fa fa-list"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Cash Statement
                                </div>
                                <div class="admin-module-subtitle">
                                    Statement view
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
                                <i class="menu-icon fa fa-credit-card-alt"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Balance Sheet
                                </div>
                                <div class="admin-module-subtitle">
                                    Financial balance
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
</div>

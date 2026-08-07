@extends('master')
@php
    $module = session('module');
@endphp

@section('title')
    {{ ucfirst($module) }}
@endsection
@section('breadcrumb_title')
    {{ ucfirst($module) }}
@endsection

@section('content')

    @if ($module == 'dashboard' or $module == '')
        @include('administration.modules')
    @elseif($module == 'Administration')
        @include('administration.administration_module')
    @elseif($module == 'WebsiteModule')
        @include('administration.web_site_module')
    @elseif($module == 'BookingModule')
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="col-md-12 header">
                        <h3>Booking Module </h3>
                    </div>
                    @if (checkAccess('booking'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/booking">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-bookmarks"></i>
                                    </div>
                                    <div class="textModule">
                                        Booking Entry
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                    @if (checkAccess('checkinRecord'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/checkout">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-box-arrow-right"></i>
                                    </div>
                                    <div class="textModule">
                                        Checkout
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                    @if (checkAccess('checkinRecord'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/checkin-record">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-list"></i>
                                    </div>
                                    <div class="textModule">
                                        Checkin Record
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                    @if (checkAccess('bookingRecord'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/booking-record">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-list"></i>
                                    </div>
                                    <div class="textModule">
                                        Booking Record
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                    @if (checkAccess('billingRecord'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/billing-record">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-list"></i>
                                    </div>
                                    <div class="textModule">
                                        Billing Record
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                    @if (checkAccess('billingInvoice'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/billing-invoice">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-file-text-o"></i>
                                    </div>
                                    <div class="textModule">
                                        Billing Invoice
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @elseif($module == 'PurchaseModule')
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="col-md-12 header">
                        <h3> Purchase Module </h3>
                    </div>
                    @if (checkAccess('purchase'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/purchase">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-shopping-cart"></i>
                                    </div>
                                    <div class="textModule">
                                        Purchase Entry
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('purchaseReturn'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/purchase-return">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-rotate-right"></i>
                                    </div>
                                    <div class="textModule">
                                        Purchase Return
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('purchaseRecord'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/purchase-record">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-file-text-o"></i>
                                    </div>
                                    <div class="textModule">
                                        Purchase Record
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('assetEntry'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/asset">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-line-chart"></i>
                                    </div>
                                    <div class="textModule">
                                        Asset Entry
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('purchaseInvoice'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/purchase-invoice">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-print"></i>
                                    </div>
                                    <div class="textModule">
                                        Invoice Print
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('supplierDue'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/supplier-due">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-list"></i>
                                    </div>
                                    <div class="textModule">
                                        Due Report
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('supplierPaymentReport'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/supplier-ledger">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-credit-card-alt"></i>
                                    </div>
                                    <div class="textModule">
                                        Payment Report
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                    @if (checkAccess('supplierList'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/supplierlist">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-th-list"></i>
                                    </div>
                                    <div class="textModule">
                                        Supplier List
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('purchaseReturnList'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/purchase-return-record">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-retweet"></i>
                                    </div>
                                    <div class="textModule">
                                        Return Record
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('reorderList'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/reorder-list">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-list"></i>
                                    </div>
                                    <div class="textModule">
                                        Re-Order List
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    @elseif($module == 'AccountsModule')
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="col-md-12 header">
                        <h3> Accounts Module </h3>
                    </div>
                    @if (checkAccess('cashTransaction'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="{{ route('cash.transaction') }}">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-cash-stack"></i>
                                    </div>
                                    <div class="textModule">
                                        Cash Transaction
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('bankTransaction'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/bank-transaction">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-bank"></i>
                                    </div>
                                    <div class="textModule">
                                        Bank Transactions
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('customerPayment'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="{{ route('customer.payment') }}">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-money"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Guest Payment
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('supplierPayment'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="{{ route('supplier.payment') }}">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-money"></i>
                                    </div>
                                    <div class="textModule">
                                        Supplier Payment
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('cashView'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/cash-view">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-list"></i>
                                    </div>
                                    <div class="textModule">
                                        Cash View
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('account'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="{{ route('account.create') }}">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-person-vcard"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px; margin-top: 0;">
                                        Transaction Accounts
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('bankAccounts'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/bank-account">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-bank"></i>
                                    </div>
                                    <div class="textModule">
                                        Bank Accounts
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('checkEntry'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/check/entry">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-credit-card-alt"></i>
                                    </div>
                                    <div class="textModule">
                                        Cheque Entry
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('checkList'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/check/list">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-list"></i>
                                    </div>
                                    <div class="textModule">
                                        All Cheque list
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('checkreminderList'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/check/reminder/list">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-bell"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px; margin-top: 0;">
                                        Reminder Cheque list
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('checkpendingList'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/check/pending/list">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-hourglass-half"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px; margin-top: 0;">
                                        Pending Cheque list
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('checkdishoneredList'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/check/dis/list">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-times"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px; margin-top: 0;">
                                        Dishonoured Cheque list
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('checkpaidList'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/check/paid/list">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-check-square-o"></i>
                                    </div>
                                    <div class="textModule">
                                        Paid Cheque list
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('TransactionReport'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="{{ route('cash.transaction.report') }}" target="_blank">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-list-ul"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px; margin-top: 0;">
                                        Cash Transaction Report
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('bankTransactionReport'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="{{ route('bank.transaction.record') }}">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-list-ul"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px; margin-top: 0;">
                                        Bank Transaction Report
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('bankLedger'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/bank_ledger">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-file-earmark-text"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Bank Ledger
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('cashStatement'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/cash-statement">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-list"></i>
                                    </div>
                                    <div class="textModule">
                                        Cash Statement
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('balanceSheet'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/balance-sheet">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-credit-card-alt"></i>
                                    </div>
                                    <div class="textModule">
                                        Balance Sheet
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @elseif($module == 'HRPayroll')
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="col-md-12 header">
                        <h3> HR & Payroll Module </h3>
                    </div>
                    @if (checkAccess('salaryPayment'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="{{ route('employee.salary') }}">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-money"></i>
                                    </div>
                                    <div class="textModule">
                                        Salary Payment
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('employee'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="{{ route('employee.create') }}">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-user-plus"></i>
                                    </div>
                                    <div class="textModule">
                                        Add Employee
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('employeeList'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="{{ route('employee.list') }}">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-users"></i>
                                    </div>
                                    <div class="textModule">
                                        Employee List
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('leaveType'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/leave-type">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-sliders"></i>
                                    </div>
                                    <div class="textModule">
                                        Leave Type
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('leaveEntry'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/leave">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-house-add-fill"></i>
                                    </div>
                                    <div class="textModule">
                                        Leave Entry
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('leaveRecord'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/leave-record">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-list-check"></i>
                                    </div>
                                    <div class="textModule">
                                        Leave Record
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('designation'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/designation">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-binoculars"></i>
                                    </div>
                                    <div class="textModule">
                                        Add Designation
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('department'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/department">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-building"></i>
                                    </div>
                                    <div class="textModule">
                                        Add Department
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('salaryRecord'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="{{ route('salary.record') }}">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-money"></i>
                                    </div>
                                    <div class="textModule">
                                        Payment Report
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @elseif($module == 'ReportsModule')
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="col-md-12 header">
                        <h3> Reports Module </h3>
                    </div>
                    @if (checkAccess('cashView'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/cash-view">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-list"></i>
                                    </div>
                                    <div class="textModule">
                                        Cash View
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('supplierDue'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/supplier-due">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-money"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px; margin-top: 0;">
                                        Supplier Due Report
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('supplierPaymentReport'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/supplier-ledger">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-money"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px; margin-top: 0;">
                                        Supplier Ledger
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('supplierPaymentReport'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/supplier-payment-history">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-credit-card"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px; margin-top: 0;">
                                        Supplier Payment Report
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('supplierList'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/supplierlist">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-th-list"></i>
                                    </div>
                                    <div class="textModule">
                                        Supplier List
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('saleRecord'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/sale-record">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-th-list"></i>
                                    </div>
                                    <div class="textModule">
                                        Sales Record
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('customerDue'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/customer-due">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-list-ul"></i>
                                    </div>
                                    <div class="textModule">
                                        Guest Due List
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('customerPaymentReport'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/customer-ledger">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-list-ul"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Guest Ledger
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('customerPaymentReport'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/customer-payment-history">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-credit-card"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px; margin-top: 0;">
                                        Guest Payment Report
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('customerList'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/customerlist">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-th-list"></i>
                                    </div>
                                    <div class="textModule">
                                        Guest List
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('TransactionReport'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="{{ route('cash.transaction.report') }}">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-money"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px; margin-top: 0;">
                                        Cash Transaction Report
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('bankTransactionReport'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="{{ route('bank.transaction.record') }}">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-file-text-o"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px; margin-top: 0;">
                                        Bank Transaction Report
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('bankLedger'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/bank-ledger">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-file-text-o"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Bank Ledger
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('cashStatement'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/cash-statement">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-money"></i>
                                    </div>
                                    <div class="textModule">
                                        Cash Statement
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('balanceSheet'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/balance-sheet">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-money"></i>
                                    </div>
                                    <div class="textModule">
                                        Balance Sheet
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('employeeList'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/employee-list">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-user-plus"></i>
                                    </div>
                                    <div class="textModule">
                                        Employee List
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('salaryPaymentReport'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/salaryRecord">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-money"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px; margin-top: 0;">
                                        Salary Payment Report
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @elseif($module == 'RestaurantModule')
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="col-md-12 header">
                        <h3> Restaurant Module </h3>
                    </div>
                    @if (checkAccess('order'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/order">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-building-add"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Order Entry
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('payFirst'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/payFirst">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-cash-stack"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Pay First
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('pendingOrder'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/pendingOrder">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-card-checklist"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Pending Order
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('orderList'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/orderList">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-card-checklist"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Order List
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('tableBooking'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/tableBooking">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-list-ul"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Table Booking List
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('menu'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/menu">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-egg-fried"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Menu Entry
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('menuList'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/menuList">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-list-ul"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Menu List
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('menuCategory'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/menu-category">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-boxes"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Menu Category
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('productionList'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/productionList">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-card-checklist"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Production List
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('materialPurchase'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/materialPurchase">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-shopping-cart"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Material Purchase
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('materialPurchaseList'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/materialPurchaseList">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-list-ul"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Material Purchase List
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('material'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/material">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-building-gear"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Material Entry
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('requisition'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/requisition">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-cart-plus"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Requisition Entry
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('requisitionList'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/requisitionList">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-list-ul"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Requisition List
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('unit'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/unit">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-unity"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Unit Entry
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @elseif($module == 'KitechenModule')
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="col-md-12 header">
                        <h3> Kitchen Module </h3>
                    </div>

                    @if (checkAccess('kitchen_pending_order'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/kitchen_pending_order">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-card-checklist"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Pending Orders
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('kitchen_delivered_order'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/kitchen_delivered_order">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-card-checklist"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Delivered Orders
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    @elseif($module == 'InventoryModule')
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="col-md-12 header">
                        <h3> Inventory Module </h3>
                    </div>
                    @if (checkAccess('issue'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/issue">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-plus-square"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Issue Entry
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('issueReturn'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/issueReturn">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-rotate-left"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Issue Return
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('issueRecord'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/issueRecord">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-card-checklist"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Issue Record
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('issueReturnList'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/issueReturnList">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-card-checklist"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Issue Return List
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('asset'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/asset">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-house-add-fill"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Asset Entry
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('assetList'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/assetList">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-list-ul"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Asset List
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('brand'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/brand">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-boxes"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Brand Entry
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('purchase'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/purchase">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-shopping-cart"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Purchase Entry
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('purchaseList'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/purchaseList">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-list-ul"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Purchase List
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('supplier'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/supplier">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-user-plus"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Supplier Entry
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('disposal'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/disposal">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-ban"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Disposal Entry
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('disposalList'))
                        <div class="col-md-2 col-xs-6">
                            <div class="col-md-12 section20">
                                <a href="/disposalList">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-list-ul"></i>
                                    </div>
                                    <div class="textModule" style="line-height: 13px;">
                                        Disposal List
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @elseif($module == 'ServiceModule')
        @if (checkAccess('serviceHead'))
            <div class="col-md-2 col-xs-6">
                <div class="col-md-12 section20">
                    <a href="/service-head">
                        <div class="logo">
                            <i class="menu-icon fa fa-server"></i>
                        </div>
                        <div class="textModule" style="line-height: 13px;">
                            Service Head
                        </div>
                    </a>
                </div>
            </div>
        @endif
        @if (checkAccess('service'))
            <div class="col-md-2 col-xs-6">
                <div class="col-md-12 section20">
                    <a href="/service">
                        <div class="logo">
                            <i class="menu-icon bi bi-building-add"></i>
                        </div>
                        <div class="textModule" style="line-height: 13px;">
                            Service Entry
                        </div>
                    </a>
                </div>
            </div>
        @endif
        @if (checkAccess('serviceList'))
            <div class="col-md-2 col-xs-6">
                <div class="col-md-12 section20">
                    <a href="/serviceList">
                        <div class="logo">
                            <i class="menu-icon bi bi-card-checklist"></i>
                        </div>
                        <div class="textModule" style="line-height: 13px;">
                            Service List
                        </div>
                    </a>
                </div>
            </div>
        @endif
    @endif
@endsection

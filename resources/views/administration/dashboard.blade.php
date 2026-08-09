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
    @elseif($module == 'PurchaseModule')
        @include('administration.purchase_module')
    @elseif($module == 'AccountsModule')
        @include('administration.accounts_module')
    @elseif($module == 'HRPayroll')
        @include('administration.hr_payroll')
    @elseif($module == 'ReportsModule')
        @include('administration.reports_module')
    @elseif($module == 'RestaurantModule')
        @include('administration.restaurant_module')
    @elseif($module == 'KitechenModule')
        @include('administration.kitechen_module')
    @elseif($module == 'InventoryModule')
        @include('administration.inventory_module')
    @endif
@endsection

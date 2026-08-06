@extends('master')
@section('title', 'Requisition Invoice')
@section('breadcrumb_title', 'Requisition Invoice')
@section('content')
<div id="requisitionInvoice">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <requisitoin-invoice v-bind:requisition_id="requisitionId" v-bind:fixed="2" v-bind:company="company"></requisitoin-invoice>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{asset('components')}}/requisitionInvoice.js"></script>
<script>
    new Vue({
        el: '#requisitionInvoice',
        components: {
            requisitionInvoice
        },
        data() {
            return {
                requisitionId: parseInt('<?php echo $id; ?>'),
                company: {
                    logo: "{{ $company->logo }}",
                    title: "{{ $company->title }}",
                    address: "{{ $company->address }}",
                }
            }
        }
    })
</script>
@endpush

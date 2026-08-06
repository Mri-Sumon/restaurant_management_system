@extends('web_master')

@section('main_content')
<style>
    #invoice{
        margin-top: 100px
    }
    .navbar.scrolled,
    .navbar {
        position: fixed !important;
        right: 0;
        left: 0;
        top: 0;
        /* margin-top: -130px; */
        background: #404044 !important;
        -webkit-box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);
        box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);
    }
    [_a584de] {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        border: 1px solid gray;
        border-radius: 10px;
        overflow: hidden;
        padding: 8px 0;
    }

    [_a584de] th,
    [_a584de] td {
        padding: 3px 8px !important;
        text-align: left;
    }

    [_a584de] thead th {
        background-color: #f2f2f2;
    }

    [_a584de]>thead>tr>td {
        font-weight: 700;
        text-align: center;
    }
</style>

<section id="invoice">
    <div class="container">
        <div class="row" style="padding-top: 30px;">
            {{-- <div class="col-md-6">
                <div class="card" style="background: #dfdfdf; margin-bottom: 25px; padding: 35px; border-radius: 5px; font-size: 25px; font-weight: 700; color: green; text-align: center;">
                    <div class="card-body">Order Invoice</div>
                </div>
            </div> --}}
            <div class="col-md-12" style="display: flex;justify-content:end;">
                <a href="" onclick="contentPrint(event)" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
            </div>
        </div>
        <div class="row" id="invoiceContent" style="padding-top: 10px;padding-bottom:30px;">
            <div class="col-md-12">
                <table _a584de style="width: 100%;">
                    <tr>
                        <td style="border-bottom: 1px solid gray;font-weight:700;text-align:center;" colspan="2">Order Information</td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Customer ID: </strong> {{$order->customer->code}}<br />
                            <strong>Name: </strong> {{$order->customer_name}}<br />
                            <strong>Phone: </strong> {{$order->customer_phone}}<br />
                            <strong>Address: </strong> {{$order->customer_address}}
                        </td>
                        <td style="text-align: right;">
                            <strong>Invoice: </strong> {{$order->invoice}}<br />
                            <strong>Date: </strong> {{date('d-m-Y', strtotime($order->date))}}<br />
                            <strong>Subtotal: </strong> {{$order->sub_total}}<br />
                            <strong>Charge: </strong> {{$order->charge}}<br />
                            <strong>Total: </strong> {{$order->total}}<br />
                        </td>
                    </tr>
                </table>

                <table _a584de style="width: 100%;margin-top:5px;">
                    <tr>
                        <th colspan="9" style="text-align: center;border-bottom:1px solid gray;">Order Details</th>
                    </tr>
                    <tr>
                        <th style="border-bottom: 1px solid gray;text-align:center;">Sl</th>
                        <th style="border-bottom: 1px solid gray;text-align:center;">Item</th>
                        <th style="border-bottom: 1px solid gray;text-align:center;">Menu</th>
                        <th style="border-bottom: 1px solid gray;text-align:center;">Unit Price</th>
                        <th style="border-bottom: 1px solid gray;text-align:center;">Quantity</th>
                        <th style="border-bottom: 1px solid gray;text-align:center;">Total</th>
                    </tr>
                    @foreach($details as $key => $item)
                    <tr>
                        <td style="text-align: center;">{{$key + 1}}</td>
                        <td style="text-align: center;">{{$item->menu->name}}</td>
                        <td style="text-align: center;">{{$item->menu->category->name}}</td>
                        <td style="text-align: center;">{{$item->price}}</td>
                        <td style="text-align: center;">{{$item->quantity}}</td>
                        <td style="text-align: right;">{{$item->total}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-md-12">
                <div class="form-group" style="margin-top: 10px;">
                    <label for="note">Note: </label>
                    {{$order->note}}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#ftco-navbar').addClass('customfixnav');
    });
</script>
<script>
    async function contentPrint(event) {
        event.preventDefault();
        let logo = "{{$info->logo}}";
        let logoSrc = logo;
        let title = "{{$info->title}}";
        let address = "{{$info->address}}";
        let phone = "{{$info->phone}}";
        let invoiceContent =
            document.querySelector("#invoiceContent").innerHTML;
        let printWindow = window.open(
            "",
            "PRINT",
            `width=${screen.width}, height=${screen.height}, left=0, top=0`
        );

        printWindow.document.write(`
                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <meta http-equiv="X-UA-Compatible" content="ie=edge">
                        <title>Billing Invoice</title>
                        <link rel="stylesheet" href="{{asset('backend')}}/css/bootstrap.min.css">
                        <style>
                            body, table{
                                font-size: 13px;
                            }

                            [_a584de] {
                                border-collapse: separate;
                                border-spacing: 0;
                                width: 100%;
                                border: 1px solid gray;
                                border-radius: 10px;
                                overflow: hidden;
                                padding: 8px 0;
                            }

                            [_a584de] th,
                            [_a584de] td {
                                padding: 3px 8px !important;
                                text-align: left;
                            }

                            [_a584de] thead th {
                                background-color: #f2f2f2;
                            }

                            [_a584de]>thead>tr>td {
                                font-weight: 700;
                                text-align: center;
                            }

                            @media print{
                                .totalColor{
                                    background-color: gainsboro !important;
                                }
                                .col-xs-12{
                                    padding: 0;
                                }
                            }
                        </style>
                    </head>
                    <body>
                        <table style="width:100%;">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-xs-2"><img src="${ logo ? logoSrc : '/back_asset/images/no.png' }" alt="Logo" style="height:80px;border: 1px solid gray; border-radius: 5px;" /></div>
                                                <div class="col-xs-10" style="padding-top:5px;">
                                                    <strong style="font-size:18px;">${ title }</strong><br>
                                                    <p style="white-space: pre-line;">${ address}</p>
                                                    <p style="white-space: pre-line;">${ phone }</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div style="border-bottom: 4px double #454545;margin-top:7px;margin-bottom:7px;"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12">${invoiceContent}</div>
                                            </div>
                                        </div> 
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot style="height:90px;">
                                <tr>
                                    <td>
                                        <div class="container" style="position:fixed;left:0;bottom:0;width:100%;">
                                            <div class="row" style="margin-bottom:5px;padding-bottom:6px;">
                                                <div class="col-xs-6">
                                                    <span style="text-decoration:overline;">Received by</span>
                                                </div>
                                                <div class="col-xs-6 text-right">
                                                    <span style="text-decoration:overline;">Authorized Signature</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </body>
                    </html>
				`);

        printWindow.focus();
        await new Promise((resolve) => setTimeout(resolve, 1000));
        printWindow.print();
        printWindow.close();
    }
</script>
@endsection
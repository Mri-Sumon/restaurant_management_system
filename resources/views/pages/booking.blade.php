@extends('web_master')
@section('title', 'Restaurant Management System')

@section('main_content')
    <style>
        .booking_info {
            margin-top: -150px;
        }

        .booking_info textarea.form-control {
            border-color: #fff;
            border-radius: 5px;
        }

        [_a584de] {
            background: #9F784A;
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            border: 1px solid transparent;
            border-radius: 10px;
            overflow: hidden;
            padding: 8px 0;
        }

        [_a584de] th,
        [_a584de] td {
            padding: 3px 8px !important;
            text-align: left;
            color: #fff;
        }

        [_a584de] thead th {
            background-color: #fff;
        }

        [_a584de]>thead>tr>td {
            font-weight: 700;
            text-align: center;
        }
    </style>
    <div class="container-fluid top-menu-section"
        style="background-image: linear-gradient(to bottom,rgba(255, 255, 255, 0.2), rgba(41, 46, 49, 1)), url('{{ asset('frontend/img/common-bg.jpg') }}');">
    </div>
    <section class="booking_info">
        <div class="container">
            <form action="{{ route('makeBooking') }}" method="POST">
                @csrf
                <div class="row" style="padding: 30px 0;">
                    <div class="col-md-12 col-md-offset-1">
                        <table _a584de style="width: 100%;">
                            <tr>
                                <td style="border-bottom: 1px solid black;font-weight:700;text-align:center;"
                                    colspan="2">Booking Information</td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Name: </strong> {{ $booking_info['name'] }}<br />
                                    <strong>Phone: </strong> {{ $booking_info['phone'] }}
                                </td>
                                <td style="text-align: right;">
                                    <strong>Booking No: </strong> {{ invoiceGenerate('table_booking', '') }} <br />
                                    <strong>Date: </strong> {{ date('d-m-Y') }}<br />
                                </td>
                            </tr>
                        </table>

                        <table _a584de style="width: 100%;margin-top:5px;">
                            <tr>
                                <th colspan="9" style="text-align: center;border-bottom:1px solid black;">Booking Details
                                </th>
                            </tr>
                            <tr>
                                <th style="border-bottom: 1px solid black;text-align:center;">Sl</th>
                                <th style="border-bottom: 1px solid black;text-align:center;">Date</th>
                                <th style="border-bottom: 1px solid black;text-align:center;">Time</th>
                                <th style="border-bottom: 1px solid black;text-align:center;">Persons</th>
                            </tr>
                            <tr>
                                <td style="text-align: center;">1</td>
                                <td style="text-align: center;">{{ $booking_info['booking_date'] }}</td>
                                <td style="text-align: center;">{{ $booking_info['booking_time'] }}</td>
                                <td style="text-align: center;">{{ $booking_info['persons'] }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <table _a584de style="width: 100%;margin-top:5px;">
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label for="note">Note: </label>
                                        <textarea name="note" id="note" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group"
                                        style="display: flex; align-items: center; justify-content: end; margin-bottom: 0;">
                                        <button type="submit" style="background: #b68854" class="btn-sm btn">Confirm
                                            Booking</button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </form>
        </div>
    </section>


@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#ftco-navbar').addClass('customfixnav');
        });
    </script>
@endpush

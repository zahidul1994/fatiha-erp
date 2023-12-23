@php
$setup=Helper::adminSetup();
use NumberToWords\NumberToWords;
@endphp

<!DOCTYPE html>
<html lang="en">
 <!-- CSRF Token -->
 <meta name="csrf-token" content="{{ csrf_token() }}">
<head>
    <meta charset="UTF-8">
    <title>POS Sales Return-invoice</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            outline: none;
        }

        body {
            font-family: sans-serif;
            font-size: 14px;
        }

        .main-invoice {
            width: 302.36px;
            padding: 40px 10px;
            margin: auto;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 100px;
        }

        .address {
            text-align: center;
        }

        .address span {
            display: block;
        }

        .border {
            border-bottom: 1px solid #000;
            padding-top: 5px;
            margin-bottom: 5px;
        }

        .w-50 {
            width: 50%;
        }
        .w-60 {
            width: 60%;
        }
        .w-40 {
            width: 40%;
        }

        .d-flex {
            display: flex;
        }

        .text-center {
            text-align: center
        }

        .text-right {
            text-align: right
        }

        .text-left {
            text-align: left
        }

    </style>
</head>

<body onload="window.print()">
    <div class="main-invoice">
        <div class="logo">

            <img src="{{url($setup->printing_logo)}}" style="width:40px">
            <h1><i>{{$sale->shop->shop_name}}</i></h1>

        </div>
        <p class="address">
           <span>Address: {{$sale->shop->shop_address}}</span>
            <span>Phone: {{$sale->shop->shop_phone}}</span>
        </p>
        <h6 style="text-align:center;margin-top:5px">SR Invoice No :{{@$sale->invoice_no}}  </h6>
        <div class="border"></div>

        <div class="d-flex" style="margin-top: 10px;">
            <p style="width: 5%">
                <b>SL </b>
            </p>
            <p style="width: 45%">
                <b>&nbsp; &nbsp; &nbsp;Description</b>
            </p>
            <p style="width: 20%">
                <b>MRP</b>
            </p>
            <p style="width: 10%">
                <b>Qty</b>
            </p>
            <p style="width: 20%" class="text-right">
                <b>Amount</b>
            </p>
        </div>
        <div class="border"></div>


        @foreach ($sale->salereturndetails as $saledetail)
        <div class="d-flex" style="margin-top: 10px;">
            <p style="width: 5%">
			{{$loop->index+1}}
            </p>
            <p style="width: 45%; font-size:10px">
                {{(@$saledetail->product_name)}}
            </p>
            <p style="width: 20%">
                 {{(@$saledetail->sale_price)}}
            </p>
            <p style="width: 10%" class="text-center">
                {{@$saledetail->qty}}
            </p>
            <p style="width: 20%" class="text-right">

                {{(@$saledetail->sale_price*$saledetail->qty)}}
            </p>
        </div>
		@endforeach
        <div style="margin-left: auto; width: 60%; margin-top: 10px;">

            <div class="d-flex">
                <div class="w-50">
                    <p style="padding-bottom: 5px;">
                        <b>
                            Sub Total
                        </b>
                    </p>
                    <p style="padding-bottom: 10px;">
                        <b>
                            (+) VAT
                        </b>
                    </p>
                    <p style="padding-bottom: 10px;">
                        <b>
                            (-) Discount
                        </b>
                    </p>
                </div>

                <div class="w-50" style="text-align: right">
                 <div class="border"></div>
                    <p style="padding-bottom: 5px;">
                        {{($sale->sub_total)}}
                    </p>

                    <p style="padding-bottom: 5px;">
                       {{($sale->total_vat)}}
                    </p>
                    <p style="padding-bottom: 5px;">
                        {{($sale->total_discount)}}
                    </p>
                </div>
            </div>
            <div class="border"></div>
            <div class="d-flex">
                <div class="w-50">
                    <p style="padding-bottom: 5px;">
                        <b>
                            Net Return
                        </b>
                    </p>

                </div>
                <div class="w-50" style="text-align: right">
                    <p style="padding-bottom: 5px;">
                       {{ @$sale->grand_total}}
                    </p>

                </div>
            </div>

        </div>
        <div class="border"></div>
        <div class="d-flex">
            <div class="w-60">
                <p>
                 Customer :  {{@$sale->customer->customer_name}}
                </p>
            </div>
            <div class="w-40 text-right">
                <p>
                    Tel: {{@$sale->customer->customer_phone}}
                </p>
            </div>
        </div>

        <div class="border"></div>
        <div class="d-flex">
            <div class="w-50">
                <p style="margin-bottom: 5px;">
                    <b>
                        Return By :
                    </b>
                    {{@$sale->payment_method}}
                </p>
                <p>
                    <b>
                        Cashier :
                    </b>
                    {{$sale->user->name}}
                </p>
            </div>
            <div class="w-50 text-right">
                <p style="margin-bottom: 5px;">
                    <b>
                        Date :
                    </b>
                    {{@Carbon\Carbon::today()->toDateString()}}
                </p>
                <p>
                    <b>
                        Time :
                    </b>
                   {{@Carbon\Carbon::now()->format('h:i A')}}
                </p>
            </div>
        </div>
        <div class="barcode" style="margin: 10px 0; text-align: center;">
           <img width="170mm" height="30mm" src="data:image/png;base64,{!!DNS1D::getBarcodePNG(@$sale->id,'C39')!!}" />
         </div>
         <div class="border"></div>

        <p style="padding-top: 5px;">
            # {{@$setup->print_first_note}}
			<br>
            # {{@$setup->print_second_note}}

        </p>
 <div class="border"></div>
   <p style="text-align:center;font-size: 10px">
        Software By: SohiSoft &copy; (2016-{{date('Y')}})
       <br/>Tel- (+88) 019 1274 8597 <br/>
   </p>

    </div>


<script src="{{ asset('backend/assets/js/jquery-3.6.3.min.js') }}"></script>
    <script type="text/javascript">

        var url = "{{ URL::to('/') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        var start = new Date;
        setInterval(function() {

        }, 10000);

        setTimeout(function() {
            document.location.href = "{{ url(Request::segment(1) . '/sale-returns') }}";

        }, 10000);
    </script>
    </body>
</html>

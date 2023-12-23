@php
  use NumberToWords\NumberToWords;
  $setup=Helper::adminSetup();

@endphp
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice</title>
    <style media="all">

        * {
            margin: 0;
            padding: 0;
            line-height: 1.3;
            color: #333542;
        }


        body {
            font-size: .875rem;
            font-family: "Camber";
            color: #000000 !important;
            margin: 16px 50px !important;
            /* width: 718.11023622px; */
        }

        table {
            width: 100%;
        }

        table th {
            font-weight: normal;
        }

        table.padding th {
            padding: .5rem .7rem;
        }

        /* CUSTOM DESIGN */

        table,
        th,
        td {
            border-collapse: collapse;
        }
        .product_details td,
        .product_details th {
            padding: 8px;
            border: 1px solid black;
        }
        .product_details th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #0A77BA;
            color: white;
        }
        .number-to-word {
            font-size: .625rem;
            padding: 30 1.5rem;
        }



    </style>
</head>

<body>
    <div class="invoice" style="text-align: center;">
        <div style="padding-top: -45px">
            <img src="{{$setup->printing_logo}}" style="height: 100px; width:100px;">
            <div>
                <strong style="font-size: 1.3em;text-transform:uppercase; font-weight:900;"><b> {{$saleReturn->shop->shop_name}} </b>
            </div>
            </div>
            <div style="margin: 10px 0px; font-size:1.5em;" >
                <div  style="border: 2px solid #0A77BA;border-radius: 10px;padding: 7px 15px; width:30%; margin:auto;">
                    <div style="background-color: #0A77BA;color: #eceff4; padding: 3px 25px; width:70%; margin:auto;">invoice <span style="font-family: dejavusans"></span> </div>
                 </div>
            </div>
            @if ($setup->vat_number)
            <div>
                <strong style="font-size: .9rem;">VAT NO:{{ $setup->vat_number }}</strong>
            </div>
            @endif
        </div>
    </div>
    <div style="margin: 20px 0px;">
        <div style="width:100%;">
            <div style="width:40%; float:left;">
                <strong style="font-weight:100;">Invoice No: <b> {{ @$expenses->invoice_no }}</b> </strong><br>
                <strong style="font-weight:100;">Date & Time: {{@$expenses->created_at->format('m-d-Y h:m a')}}</strong><br>
                <strong style="font-weight:100;">
                   Address: {{$saleReturn->shop->shop_address}}
                </strong><br>
                <strong style="font-weight:100;">Salesman: {{$expenses->user->name}}</strong><br>
                <strong style="font-weight:100;">Phone: {{$expenses->shop->shop_phone}}</strong><br>
                <strong style="font-weight:100;">Email: {{$expenses->shop->shop_email}}</strong>
            </div>
              <div style="width:20%;float:left; margin 0 auto;">
                <img  class="img-fluid" src="data:image/png;base64,{!! DNS2D::getBarcodePNG($saleReturn->invoice_no, 'QRCODE') !!}"
                alt="barcode" style="height:80px; height:80px;" />
            </div>

            <div style="width:40%;float:right;">
                <strong style="font-weight:100;">Cus. Name : {{ @$expenses->customer->customer_name }}</strong>
                <br>
                <strong style="font-weight:100;">Cus. Phone : {{ @$expenses->customer->customer_phone }}</strong>
                <br>
                <strong style="font-weight:100;">Cus. Email : {{ @$expenses->customer->customer_email }}</strong>

                <br>
                <strong style="font-weight:100;"> Total Due: <b> {{ @$expenses->customer->customerdue->sum('due')}} </b></strong>
                <br>
                <strong style="font-weight:100;"> Return Discount: {{ @$expenses->total_discount }}</strong>
                <br>
                <strong style="font-weight:100;"> Print Date: {{ now()->format('m-d-Y h:m a') }}</strong>
            </div>
        </div>
    </div>

    <div class="product_details">
        <table>
            <thead>
                <tr>
                <th width="8%">SL </th>
                <th width="30%">Product Name </th>
                   <th width="15%">Return Qty </th>
                    <th width="15%"> UN Price  </th>
                    <th width="10%"> Vat (%)</th>
                    <th width="15%"> Vat Amount </th>
                    <th width="10%"> Discount (%)</th>
                    <th width="15%"> Discount Amount </th>
                    <th width="20%" class="text-right"> Amount  </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($saleReturn->salereturndetails as $salereturn)
                    <tr class="">
                        <td> {{ $loop->index + 1 }}
                        </td>
                        <td>{{ Str::limit(@$salereturn->product_name, 50, '..') }}</td>
                        <td>{{ @$salereturn->return_qty }}</td>
                        <td>{{ (@$salereturn->purchase_price) }}</td>
                        <td>{{(@$salereturn->vat_percent) }}</td>
                        <td>{{ (@$salereturn->vat_amount) }}</td>
                        <td>{{(@$salereturn->discount_percent) }}</td>
                        <td>{{ (@$salereturn->discount_amount) }}</td>
                        <td>{{ (@$salereturn->total_price) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2">
                       Total
                    </td>
                    <td>
                        {{$saleReturn->salereturndetails->sum('return_qty') }}
                    </td>

                    <td> {{($saleReturn->salereturndetails->sum('sale_price')) }}</td>
                    <td></td>
                    <td> {{($saleReturn->salereturndetails->sum('vat_amount')) }}</td>
                    <td></td>
                    <td> {{($saleReturn->salereturndetails->sum('discount_amount')) }}</td>
                    <td>
                        {{($saleReturn->salereturndetails->sum('total_price')) }}
                    </td>
                </tr>

            </tbody>
            <tfoot>

                <tr>
                    <td colspan="6" style="text-align: center">Payment Method: {{@$saleReturn->payment_method}}</td>
                    <td colspan="2" style="text-align: right">Grand Total</td>
                    <td> {{ (@$saleReturn->grand_total) }}</td>
                   </tr>
                <tr>
                    <td colspan="7" style="text-align: center"> @if (@$saleReturn->payment_method=='Bkash' ||@$saleReturn->payment_method=='Nagad'|| @$saleReturn->payment_method=='Rocket' )
                      Mobile Number:   {{$customerPayment->phone_number}}
                      @elseif(@$saleReturn->payment_method=='Bank')
                     Bank Name:   {{$customerPayment->bank_name}}
                     @elseif(@$saleReturn->payment_method=='Other')
                     Payment Note:   {{$customerPayment->note}}
                    @endif </td>
                    <td colspan="1" style="text-align: right">Paid</td>
                    <td> {{(@$saleReturn->paid) }}</td>
                   </tr>

            </tfoot>
        </table>
    </div>

    <div style="text-align:center;text-transform:uppercase; margin-bottom:11px">
         In Word: {{ NumberToWords::transformNumber('en', ($saleReturn->grand_total)) }} {{ @$setup->currency_name }}. <br>
         Note: {{$saleReturn->description}}
    </div>

    <div class="footer_details" style="padding: 1.5rem 0px; text-align: center;
    border: 2px solid #0A77BA; page-break-inside: avoid;">
        <div>
            <strong style="font-weight:100;">Terms & Conditions</strong>
            <br>
            <strong style="font-weight:100;">
               {{ @$setup->print_first_note }}</strong>  <br>
            <strong style="font-weight:100;">
                {{ @$setup->print_second_note }}</strong>
        </div>
    </div>
</body>

</html>


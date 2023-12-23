@php
use NumberToWords\NumberToWords;
$setup=Helper::adminSetup();

@endphp
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Purchase Return Invoice</title>
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
                <strong style="font-size: 1.3em;text-transform:uppercase; font-weight:900;"><b>
                        {{$purchasereturns->shop->shop_name}} </b>
            </div>
        </div>
        <div style="margin: 10px 0px; font-size:1.5em;">
            <div style="border: 2px solid #0A77BA;border-radius: 10px;padding: 5px 10px; width:40%; margin:auto;">
                <div style="background-color: #0A77BA;color: #eceff4; padding: 3px 20px; margin:auto;">Purchase Return
                    Invoice <span style="font-family: dejavusans"></span> </div>
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
                <strong style="font-weight:100;">Invoice No: <b> {{ @$purchasereturns->invoice_no }}</b> </strong><br>
                <strong style="font-weight:100;">Date & Time: {{@$purchasereturns->created_at->format('m-d-Y h:m
                    a')}}</strong><br>
                <strong style="font-weight:100;">
                    Address: {{$purchasereturns->shop->shop_address}}
                </strong><br>
                <strong style="font-weight:100;">Salesman: {{$purchasereturns->user->name}}</strong><br>
                <strong style="font-weight:100;">Phone: {{$purchasereturns->shop->shop_phone}}</strong><br>
                <strong style="font-weight:100;">Email: {{$purchasereturns->shop->shop_email}}</strong>
            </div>
            <div style="width:20%;float:left; margin 0 auto;">
                <img class="img-fluid"
                    src="data:image/png;base64,{!! DNS2D::getBarcodePNG($purchasereturns->invoice_no, 'QRCODE') !!}"
                    alt="barcode" style="height:80px; height:80px;" />
            </div>

            <div style="width:40%;float:right;">
                <strong style="font-weight:100;">Sup. Name : {{ @$purchasereturns->supplier->supplier_name }}</strong>
                <br>
                <strong style="font-weight:100;">Sup. Phone : {{ @$purchasereturns->supplier->supplier_phone }}</strong>
                <br>
                <strong style="font-weight:100;">Sup. Email : {{ @$purchasereturns->supplier->supplier_email }}</strong>

                <br>
                <strong style="font-weight:100;"> Total Due: <b> {{ @$purchasereturns->supplier->total_balance}}
                    </b></strong>
                <br>
                <strong style="font-weight:100;"> Return Discount: {{ @$purchasereturns->total_discount }}</strong>
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
                    <th width="15%"> UN Price </th>
                    <th width="10%"> Vat (%)</th>
                    <th width="15%"> Vat Amount </th>
                    <th width="20%" class="text-right"> Amount </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchasereturns->purchasereturndetails as $purchasedetail)
                <tr class="">
                    <td> {{ $loop->index + 1 }}
                    </td>
                    <td>{{ Str::limit(@$purchasedetail->product_name, 50, '..') }}</td>
                    <td>{{ @$purchasedetail->return_qty }}</td>
                    <td>{{(@$purchasedetail->purchase_price) }}</td>
                    <td>{{(@$purchasedetail->vat_percent) }}</td>
                    <td>{{(@$purchasedetail->vat_amount) }}</td>
                    <td>{{(@$purchasedetail->total_price) }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="2">
                        Total
                    </td>
                    <td>
                        {{$purchasereturns->purchasereturndetails->sum('return_qty') }}
                    </td>

                    <td> {{($purchasereturns->purchasereturndetails->sum('purchase_price')) }}</td>
                    <td></td>
                    <td> {{($purchasereturns->purchasereturndetails->sum('vat_amount')) }}</td>

                    <td>
                        {{($purchasereturns->purchasereturndetails->sum('total_price')) }}
                    </td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td>Discount</td>
                    <td>
                        {{($purchasereturns->total_discount) }}
                    </td>
                </tr>
            </tbody>
            <tfoot>

                <tr>
                    <td colspan="4" style="text-align: center">Payment Method: {{@$purchasereturns->payment_method}}
                    </td>
                    <td colspan="2" style="text-align: right">Grand Total</td>
                    <td> {{(@$purchasereturns->grand_total) }}</td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: center"> @if (@$purchasereturns->payment_method=='Bkash'
                        ||@$purchasereturns->payment_method=='Nagad'|| @$purchasereturns->payment_method=='Rocket' )
                        Mobile Number: {{$supplierPayment->phone_number}}
                        @elseif(@$purchasereturns->payment_method=='Bank')
                        Bank Name: {{$supplierPayment->bank_name}}
                        @elseif(@$purchasereturns->payment_method=='Other')
                        Payment Note: {{$supplierPayment->note}}
                        @endif </td>
                    <td colspan="1" style="text-align: right">Paid</td>
                    <td> {{(@$purchasereturns->paid) }}</td>
                </tr>

            </tfoot>
        </table>
    </div>

    <div style="text-align:center;text-transform:uppercase; margin-bottom:11px">
        In Word: {{ NumberToWords::transformNumber('en', ($purchasereturns->grand_total)) }} {{ @$setup->currency_name
        }}. <br>
        Note: {{$purchasereturns->description}}
    </div>

    <div class="footer_details" style="padding: 1.5rem 0px; text-align: center;
    border: 2px solid #0A77BA; page-break-inside: avoid;">
        <div>
            <strong style="font-weight:100;">Terms & Conditions</strong>
            <br>
            <strong style="font-weight:100;">
                {{ @$setup->print_first_note }}</strong> <br>
            <strong style="font-weight:100;">
                {{ @$setup->print_second_note }}</strong>
        </div>
    </div>
</body>

</html>

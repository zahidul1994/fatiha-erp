@php
  use NumberToWords\NumberToWords;
  $setup=Helper::adminSetup();

@endphp
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Purchase Return PDF</title>
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
        <div style="padding-top: -35px">
            <img src="{{$setup->printing_logo}}" style="height: 100px; width:100px;">
            <div>
                <strong style="font-size: 1.3em;text-transform:uppercase; font-weight:900;"><b> {{$purchase->shop->shop_name}} </b>
            </div>
            </div>
            <div style="margin: 10px 0px; font-size:1.5em;" >
                <div  style="border: 2px solid #0A77BA;border-radius:10px;margin:auto; width:40%">
                    <div style="background-color: #0A77BA;color: #eceff4; border-radius:10px; margin:auto;">Purchase Return Invoice <span style="font-family: dejavusans"></span> </div>
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
                <strong style="font-weight:100;">Invoice No: <b> {{ @$purchase->invoice_no }}</b> </strong><br>
                <strong style="font-weight:100;">Date & Time: {{@$purchase->created_at->format('m-d-Y h:m a')}}</strong><br>
                <strong style="font-weight:100;">
                   Address: {{$purchase->shop->shop_address}}
                </strong><br>
                <strong style="font-weight:100;">Salesman: {{$purchase->user->name}}</strong><br>
                <strong style="font-weight:100;">Phone: {{$purchase->shop->shop_phone}}</strong><br>
                <strong style="font-weight:100;">Email: {{$purchase->shop->shop_email}}</strong>
            </div>
              <div style="width:20%;float:left; margin 0 auto;">
                <img  class="img-fluid" src="data:image/png;base64,{!! DNS2D::getBarcodePNG($purchase->invoice_no, 'QRCODE') !!}"
                alt="barcode" style="height:80px; height:80px;" />
            </div>

            <div style="width:40%;float:right;">
                <strong style="font-weight:100;">Sup. Name : {{ @$purchase->supplier->supplier_name }}</strong>
                <br>
                <strong style="font-weight:100;">Sup. Phone : {{ @$purchase->supplier->supplier_phone }}</strong>
                <br>
                <strong style="font-weight:100;">Sup. Email : {{ @$purchase->supplier->supplier_phone }}</strong>

                <br>
                <strong style="font-weight:100;"> Total Due: <b> {{ @$purchase->supplier->supplierdue->sum('due')}} </b></strong>
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
                   <th width="15%"> Qty </th>
                    <th width="15%">  Price  </th>
                    <th width="10%"> Vat (%)</th>
                    <th width="15%"> Vat Amount </th>
                    <th width="20%" class="text-right"> Amount  </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchase->purchasereturndetails as $purchasedetail)
                    <tr class="">
                        <td> {{ $loop->index + 1 }}
                        </td>
                        <td>{{ Str::limit(@$purchasedetail->product_name, 50, '..') }}</td>
                        <td>{{ @$purchasedetail->return_qty }}</td>
                        <td>{{ @$purchasedetail->purchase_price }}</td>
                        <td>{{(@$purchasedetail->vat_percent) }}</td>
                        <td>{{ (@$purchasedetail->vat_amount) }}</td>
                        <td>{{ (@$purchasedetail->total_price+$purchasedetail->vat_amount) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2">
                       Total
                    </td>
                    <td >
                        {{$purchase->purchasereturndetails->sum('return_qty') }}
                    </td>
                    <td> {{($purchase->purchasereturndetails->sum('purchase_price')) }}</td>
                    <td></td>
                    <td> {{($purchase->purchasereturndetails->sum('vat_amount')) }}</td>
                    <td>
                        {{($purchase->purchasereturndetails->sum('total_price')+$purchase->purchasereturndetails->sum('vat_amount')) }}
                    </td>

                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td>Discount</td>
                    <td>
                        {{($purchase->total_discount) }}
                    </td>
                </tr>
            </tbody>
            <tfoot>

                <tr>
                    <td colspan="4" style="text-align: center">Payment Method: {{@$purchase->payment_method}}</td>
                    <td colspan="2" style="text-align: right">Grand Total</td>
                    <td> {{(@$purchase->grand_total) }}</td>
                   </tr>
                <tr>
                    <td colspan="4" style="text-align: center"> @if (@$purchase->payment_method=='Bkash' ||@$purchase->payment_method=='Nagad'|| @$purchase->payment_method=='Rocket' )
                      Mobile Number:   {{$purchase->customerdue->phone_number}}
                      @elseif(@$purchase->payment_method=='Bank')
                     Bank Name:   {{$purchase->customerdue->bank_name}}
                     @elseif(@$purchase->payment_method=='Other')
                     Payment Note:   {{$purchase->customerdue->note}}
                    @endif </td>
                    <td colspan="2" style="text-align: right">Paid</td>
                    <td> {{(@$purchase->paid) }}</td>
                   </tr>
                <tr>
                    <td colspan="4" style="text-align: center"> @if (@$purchase->payment_method=='Bkash' ||@$purchase->payment_method=='Nagad'|| @$purchase->payment_method=='Rocket' )
                        Transaction Number:   {{$purchase->customerdue->transaction_number}}
                        @elseif(@$purchase->payment_method=='Bank')
                       Bank Acount:   {{$purchase->customerdue->bank_account_number}}

                      @endif </td>
                    <td colspan="2" style="text-align: right">Due</td>
                    <td> {{(@$purchase->due) }}</td>
                   </tr>
            </tfoot>
        </table>
    </div>

    <div style="text-align:center;text-transform:uppercase; margin-bottom:11px">
         In Word: {{ NumberToWords::transformNumber('en', ($purchase->grand_total)) }} {{ @$setup->currency_name }}. <br>
         Note: {{$purchase->description}}
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


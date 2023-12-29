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
        <div style="padding-top: -30px">
            <img src="{{url($setup->printing_logo)}}" style="height: 100px;">
            <div>
                <strong style="font-size: 1.3em;text-transform:uppercase; font-weight:900;"><b> {{$setup->address}} </b>
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
                <strong style="font-weight:100;">Invoice No: <b> {{ @$workorder->invoice_no }}</b> </strong><br>
                <strong style="font-weight:100;">Date & Time: {{@$workorder->created_at->format('m-d-Y h:m a')}}</strong><br>
                <strong style="font-weight:100;">
                   Address: {{$setup->address}}
                </strong><br>
                <strong style="font-weight:100;">Staff: {{$workorder->user->name}}</strong><br>
                <strong style="font-weight:100;">Phone: {{$workorder->user->phone}}</strong><br>
                <strong style="font-weight:100;">Email: {{$workorder->user->email}}</strong>
            </div>
              <div style="width:20%;float:left; margin 0 auto;">
                <img  class="img-fluid" src="data:image/png;base64,{!! DNS2D::getBarcodePNG($workorder->invoice_no, 'QRCODE') !!}"
                alt="barcode" style="height:80px; height:80px;" />
            </div>

            <div style="width:40%;float:right;">
                <strong style="font-weight:100;">Cust. Name : {{ @$workorder->customer->customer_name }}</strong>
                <br>
                <strong style="font-weight:100;">Cust. Phone : {{ @$workorder->customer->customer_phone }}</strong>
                <br>
                <strong style="font-weight:100;">Cust. Email : {{ @$workorder->customer->customer_phone }}</strong>
                <br>
                <strong style="font-weight:100;">Cust. Brith Date: {{ @$workorder->customer->brith_date }}</strong>
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
                    <th width="5%"> Qty </th>
                    <th width="15%"> UN Price </th>
                    <th width="10%"> Vat (%)</th>
                    <th width="15%"> Vat Amount </th>
                   <th width="20%" class="text-right"> Amount </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($workorder->workorderdetails as $work)
                <tr class="text-right">
                    <td> {{ $loop->index + 1 }}
                    </td>
                    <td>{{ Str::limit(@$work->product_name, 50, '..') }}</td>
                    <td>{{ @$work->qty }}</td>
                    <td>{{ (@$work->product_price) }}</td>
                    <td>{{(@$work->product_vat) }}</td>
                    <td>{{ (@$work->product_vat_amount) }}</td>
                   <td>{{ (@$work->product_total_price) }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="2">
                        Total
                    </td>
                    <td colspan="1">
                        
                        {{$workorder->total_quantity }}
                    </td>
                   <td></td>
                   <td></td>
                    <td> {{($workorder->total_vat) }}
                    </td>
                   
                    <td> {{($workorder->grand_total) }}</td>
                  
                </tr>
            </tbody>
        </table>
    </div>

    <div style="text-align:center;text-transform:uppercase; margin-bottom:11px">
         In Word: {{ NumberToWords::transformNumber('en', ($workorder->grand_total)) }} {{ @$setup->currency_name }}. <br>
         Note: {{$workorder->description}}
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


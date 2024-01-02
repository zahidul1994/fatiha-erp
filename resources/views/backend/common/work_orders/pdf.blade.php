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
            padding: 2px;
            border: 1px solid black;
        }
        .product_details th {
            padding-top: 2px;
            padding-bottom: 2px;
            text-align: left;
            background-color: #747474;
            color: white;
        }
        .number-to-word {
            font-size: .625rem;
            padding: 30 1.5rem;
        }



    </style>
</head>

<body>
        <div>
       <small> <strong style="font-weight:100;">{{@$workorder->created_at->format('l jS \o\f F Y h:i:s A')}}</strong></small>
        </div>
        <div style="text-align: right; margin-top: -35px;">
    <img src="{{url($setup->printing_logo)}}" width="110px">
        
    </div>
  
    
    <div style="margin: 20px 0px;">
        <div style="width:100%;">
            <div style="width:40%; float:left;">
                <strong style="font-weight:100;">Quotation No: <b> {{ @$workorder->invoice_no }}</b> </strong><br>
                <strong style="font-weight:100;">Name Of Purchaser : {{ @$workorder->customer->customer_name }}</strong><br>
                <strong style="font-weight:100;">BIN Number : {{ @$workorder->customer->bin_number }}</strong><br><strong style="font-weight:100;">Email : {{ @$workorder->customer->customer_email }}</strong>
                <br>

                <strong style="font-weight:100;">Phone No: {{ @$workorder->customer->customer_phone }}</strong>
                <br>
                <strong style="font-weight:100;">Address: {{ @$workorder->customer->address }}</strong>
                <br>
                <br>
              
                
            </div>
           
       
        </div>
        
    </div>
    <h6>It's Pleasure to offer you the following price of your nominate.</h6>
    <div class="product_details">
        <table>
            <thead>
                <tr>
                    <th width="8%">SL </th>
                    <th width="30%">Description of Goods/Services <small>(Including Brand & HS Code applicable)</small> </th>
                    <th width="5%"> Qty </th>
                    <th width="10%"> Unit Price </th>
                    <th width="10%">Total Value</th>
                    <th width="5%">Rate Of <small>({{ (@$workorder->currency_name) }})</small></th>
                    <th width="5%">Port/Shipment</th>
                    <th width="5%"> Vat (%)</th>
                    <th width="15%"> Vat Amount </th>
                   <th width="20%" class="text-right"> Total Value <small>(including SP and VAT)</small> </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($workorder->workorderdetails as $work)
                <tr class="text-right">
                    @php 
                    $totalValue = ($work->qty*$work->product_price);
                    @endphp
                    <td> {{ $loop->index + 1 }}
                    </td>
                    <td>{{ Str::limit(@$work->product_name, 50, '..') }}</td>
                    <td>{{ @$work->qty }}</td>
                    <td>{{ (@$work->product_price) }}</td>
                    <td>{{$totalValue}}</td>
                    <td>{{ (@$workorder->convert_rate) }}</td>
                    <td>{{ (@$workorder->port_name) }}</td>
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
                   <td colspan="5"></td>
                   
                    <td> {{($workorder->total_vat) }}
                    </td>
                   
                    <td> {{($workorder->grand_total) }}</td>
                  
                </tr>
            </tbody>
        </table>
    </div>

    <div style="text-align:center;text-transform:uppercase; margin-bottom:11px">
         In Word: {{ NumberToWords::transformNumber('en', ($workorder->grand_total)) }} {{ @$setup->currency_name }}. <br>
         @if($workorder->description)
         Note: {{$workorder->description}}
         @endif
    </div>

  
        <div>
            <strong style="font-weight:100;">Terms & Conditions</strong>
            <br>
            <strong style="font-weight:80;">
               {!!@$setup->print_first_note !!}</strong>  <br>
            <h4>
                {{ @$setup->print_second_note }}</h4>
        </div>
        <br><br>

        <strong style="font-weight:100;">{{ @$setup->company_name }}</strong>  <br>
        <strong>{{ @$setup->owner_name }}</strong><br><small>Proprieter</small>
        
        <div class="border"></div>
        <hr>
        <h1>{{ @$setup->company_name }}</h1>
        <h6>Phone No : {{ @$setup->office_phone }} , Email Address : {{ @$setup->office_email }}</h6>
   <h6>{{ @$setup->company_address }}</h6>

    </div>
</body>

</html>


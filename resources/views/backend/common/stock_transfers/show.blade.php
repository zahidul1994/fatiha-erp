@php
  use NumberToWords\NumberToWords;
  $setup=Helper::adminSetup();

@endphp
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stock Transfer</title>
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
                <strong style="font-size: 1.3em;text-transform:uppercase; font-weight:900;"><b> {{$setup->company_address}} </b>
            </div>
            </div>
            <div style="margin: 10px 0px; font-size:1.5em;" >
                <div  style="border: 2px solid #0A77BA;border-radius: 10px;padding: 7px 15px; width:40%; margin:auto;">
                    <div style="background-color: #0A77BA;color: #eceff4; padding: 3px 25px; width:50%; margin:auto;">Stock Transfer <span style="font-family: dejavusans"></span> </div>
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
                <strong style="font-weight:100;">Date & Time: {{@$stockTransfer->created_at->format('m-d-Y h:m a')}}</strong><br>
                <strong style="font-weight:100;">
                 From Shop :-
                </strong><br>
                <strong style="font-weight:100;">Shop Name: {{$stockTransfer->fromshop->shop_name}}</strong><br>
                <strong style="font-weight:100;">Phone: {{$stockTransfer->fromshop->shop_phone}}</strong><br>
                <strong style="font-weight:100;">Email: {{$stockTransfer->fromshop->shop_email}}</strong>

            </div>
              <div style="width:20%;float:left; margin 0 auto;">
                <img  class="img-fluid" src="data:image/png;base64,{!! DNS2D::getBarcodePNG($stockTransfer->date, 'QRCODE') !!}"
                alt="barcode" style="height:80px; height:80px;" />
            </div>

            <div style="width:40%;float:right;">
                <strong style="font-weight:100;">
                    To Shop  :-
                 </strong><br>
                 <strong style="font-weight:100;">Shop Name: {{$stockTransfer->toshop->shop_name}}</strong><br>
                 <strong style="font-weight:100;">Phone: {{$stockTransfer->toshop->shop_phone}}</strong><br>
                 <strong style="font-weight:100;">Email: {{$stockTransfer->toshop->shop_email}}</strong>
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
                <th width="10%">Before Stock  </th>
                <th width="10%"> Transfer Stock</th>
                <th width="20%"> New Stock </th>

                </tr>
            </thead>
            <tbody>


                @foreach ($stockTransfer->stocktransferdetails as $item)
                    <tr class="">
                        <td> {{ $loop->index + 1 }}
                        </td>
                        <td>{{ Str::limit(@$item->product_name, 50, '..') }}</td>
                        <td>{{$item->current_qty}} </td>
                        <td>{{$item->transfer_qty}} </td>
                        <td>{{$item->current_qty-$item->transfer_qty}} </td>
                    </tr>
                @endforeach


            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                       Total
                    </td>

                    <td>
                        {{$stockTransfer->stocktransferdetails->sum('current_qty') }}
                    </td>
                    <td>
                        {{$stockTransfer->total_stock}}
                    </td>
                    <td>
                        {{$stockTransfer->stocktransferdetails->sum('current_qty')-$stockTransfer->total_stock}}
                    </td>

                </tr>
            </tfoot>
        </table>
    </div>
    <p style="text-align:center">Creator: {{$stockTransfer->user->name}}, | Phone: {{$stockTransfer->user->phone}} | Email: {{$stockTransfer->user->email}} </p>
    <div style="text-align:center;text-transform:uppercase; margin-top:5px">

        <br>     Note: {{$stockTransfer->note}}
    </div>


</body>

</html>


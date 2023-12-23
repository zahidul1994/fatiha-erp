@php
  use NumberToWords\NumberToWords;
  $setup=Helper::adminSetup();

@endphp
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stock Adjustment</title>
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
            <img src="{{$setup->printing_logo}}" style="height: 80px; width:100px;">
            <div>
                <strong style="font-size: 1.3em;text-transform:uppercase; font-weight:900;"><b> {{$setup->company_name}} </b>
            </div>
            </div>
            <div style="margin: 10px 0px; font-size:1.5em;" >
                <div  style="border: 2px solid #0A77BA;border-radius: 10px;padding: 7px 15px; width:30%; margin:auto;">
                    <div style="background-color: #0A77BA;color: #eceff4; padding: 3px 25px; width:70%; margin:auto;">Adjustoment <span style="font-family: dejavusans"></span> </div>
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
                <strong style="font-weight:100;">Date & Time: {{@$stockAdjustment->created_at->format('m-d-Y h:m a')}}</strong><br>
                <strong style="font-weight:100;">
                   Shop Information :-
                </strong><br>
                <strong style="font-weight:100;">Shop Name: {{$stockAdjustment->shop->shop_name}}</strong><br>
                <strong style="font-weight:100;">Phone: {{$stockAdjustment->shop->shop_phone}}</strong><br>
                <strong style="font-weight:100;">Email: {{$stockAdjustment->shop->shop_email}}</strong>

            </div>
              <div style="width:20%;float:left; margin 0 auto;">
                <img  class="img-fluid" src="data:image/png;base64,{!! DNS2D::getBarcodePNG($stockAdjustment->date, 'QRCODE') !!}"
                alt="barcode" style="height:80px; height:80px;" />
            </div>

            <div style="width:40%;float:right;">
                <strong style="font-weight:100;">
                    Employee Information :-
                 </strong><br>
                <strong style="font-weight:100;"> Name : {{ @$stockAdjustment->user->name }}</strong>
                <br>
                <strong style="font-weight:100;"> Phone : {{ @$stockAdjustment->user->phone }}</strong>
                <br>
                <strong style="font-weight:100;"> Email : {{ @$stockAdjustment->user->email  }}</strong>
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
                <th width="10%"> Increment  </th>
                <th width="10%"> Decrement</th>
                <th width="20%"> Previous Stock </th>
                <th width="20%">Update Stock</th>
                </tr>
            </thead>
            <tbody>
                @php
                 $totalIncrement=0;
                $totalDecrement=0;
                @endphp

                @foreach ($stockAdjustment->stockadjustmentdetails as $item)
                    <tr class="">
                        <td> {{ $loop->index + 1 }}
                        </td>
                        <td>{{ Str::limit(@$item->product_name, 50, '..') }}</td>
                        <td> @if ($item->previous_qty<$item->current_qty)
                            {{$item->current_qty-$item->previous_qty}}
                            @php
                                 $totalIncrement +=$item->current_qty-$item->previous_qty
                            @endphp
                            @else
                            0
                            @endif  </td>
                            <td> @if ($item->previous_qty>$item->current_qty)
                                {{$item->previous_qty-$item->current_qty}}
                                @php
                                     $totalDecrement+=$item->previous_qty-$item->current_qty
                                @endphp
                                @else
                                0
                                @endif  </td>

                        <td>{{$item->previous_qty}} </td>
                        <td>{{$item->current_qty}} </td>
                    </tr>
                @endforeach


            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                       Total
                    </td>
                    <td>{{$totalIncrement}}</td>
                    <td>{{$totalDecrement}}</td>
                    <td>
                        {{$stockAdjustment->total_previous_stock }}
                    </td>
                    <td>
                        {{$stockAdjustment->total_current_stock}}
                    </td>

                </tr>
            </tfoot>
        </table>
    </div>

    <div style="text-align:center;text-transform:uppercase; margin-top:5px">
             Note: {{$stockAdjustment->description}}
    </div>


</body>

</html>


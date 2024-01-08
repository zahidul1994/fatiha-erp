@php

  $setup=Helper::adminSetup();

@endphp
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chalan</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            margin: 2% 5% !important;
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
            color: rgb(21, 1, 1);
        }


    </style>
</head>

<body onload="window.print()">
    <div class="container">
    <div class="invoice" style="text-align: center;">
        <strong style="font-size: 1.3em;text-transform:uppercase; font-weight:900;"><b>{{$purchase->warehouse->warehose_name}} </b></strong> <br>
                 Address:  {{$purchase->warehouse->warehouse_address}}
                 <br>
                      Chalan Copy         
       
    </div>
    <div style="margin: 20px 0px;">
        <div style="width:100%;">
            <div style="width:40%; float:left;">
                <strong style="font-weight:100;"> No: <b> {{ @$purchase->invoice_no }}</b> </strong><br>
                <strong style="font-weight:100;">Date: {{@$purchase->created_at->format('m-d-Y ')}}</strong><br>
                <strong style="font-weight:100;">
                   Phone: {{$purchase->warehouse->warehouse_phone}}
                </strong><br>
               
            </div>
              <div style="width:20%;float:left; margin 0 auto;">
                <img  class="img-fluid" src="data:image/png;base64,{!! DNS2D::getBarcodePNG($purchase->invoice_no, 'QRCODE') !!}"
                alt="barcode" style="height:80px; height:45px;" />
            </div>

            <div style="width:40%;float:right;">
                <strong style="font-weight:100;">Sup. Name : {{ @$purchase->supplier->supplier_name }}</strong>
                <br>
                <strong style="font-weight:100;">Sup. Phone : {{ @$purchase->supplier->supplier_phone }}</strong> <br>
                <strong style="font-weight:100;">Sup. address : {{ @$purchase->supplier->address }}</strong>
                
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
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($purchase->purchasedetails as $purchasedetail)
                    <tr class="">
                        <td> {{ $loop->index + 1 }}
                        </td>
                        <td>{{(@$purchasedetail->product_name) }}</td>
                        <td>{{ @$purchasedetail->qty }}</td>
                        
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2">
                       Total
                    </td>
                    <td>
                        {{$purchase->purchasedetails->sum('qty') }}
                    </td>
                   
            </tr>
            </tbody>
           
        </table>
    
    <div style="width:100%; margin-top:30px;">

        <div style="width:50%; float:left;">
        <strong> &nbsp;&nbsp;&nbsp;Staff Signature</strong>
          <hr style="width: 50%; border-top: 2px solid #000000; ">
        </div>
        <div style="width:50%;float:right">
             <strong>&nbsp; Supplier Signature</strong>
              <hr style="width: 50%; border-top: 2px solid #000000; ">
        </div>
    </div>
 </div>
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

        }, 1000);

        setTimeout(function() {
            document.location.href = "{{ url(Request::segment(1) . '/purchases') }}";

        }, 1000);
    </script>
</body>

</html>

@php

  $setup=Helper::adminSetup();

@endphp
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Requisition Copy</title>
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
      
                      Requisition Copy         
       
    </div>
    <div style="margin: 20px 0px;">
        <div style="width:100%;">
            <div style="width:40%; float:left;">
                <strong style="font-weight:100;"> No: <b> {{ @$requisition->invoice_no }}</b> </strong><br>
                <strong style="font-weight:100;">Date: {{@$requisition->created_at->format('l jS \o\f F Y')}}</strong><br>
               
               
            </div>
         

            <div style="width:40%;float:right;">
                <strong style="font-weight:100;">Sup. Name : {{ @$requisition->supplier->supplier_name }}</strong>
                <br>
                <strong style="font-weight:100;">Sup. Phone : {{ @$requisition->supplier->supplier_phone }}</strong> <br>
                <strong style="font-weight:100;">Sup. address : {{ @$requisition->supplier->address }}</strong>
                
            </div>
        </div>
    </div>

    <div class="product_details">
        <table class="table table-bordered">
            <thead>
                <tr>
                <th width="8%">SL </th>
                <th width="30%">Product Name </th>
                   <th width="15%"> Qty </th>                 
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($requisition->requisitiondetails as $requisitiondetail)
                    <tr class="text-right">
                        <td> {{ $loop->index + 1 }}
                        </td>
                        <td>{{(@$requisitiondetail->product_name) }}</td>
                        <td>{{ @$requisitiondetail->qty }}</td>
                        
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2">
                       Total
                    </td>
                    <td>
                        {{$requisition->requisitiondetails->sum('qty') }}
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
            document.location.href = "{{ url(Request::segment(1) . '/requisitions') }}";

        }, 1000);
    </script>
</body>

</html>

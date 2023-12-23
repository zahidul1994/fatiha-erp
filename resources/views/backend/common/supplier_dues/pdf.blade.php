@php
use NumberToWords\NumberToWords;
$setup= Helper::companySetup();
@endphp
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Supplier  Slip</title>
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
            border-left: 1px solid black;
            border-right: 1px solid black;
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
        <div class="heading" style="padding-top:-10px">
            <img src="{{ @$setup->printing_logo }}" style="height: 100px; width:100px;">
            <div>
                <strong style="font-size: 1.17em;">{{  @$setup->company_name }}</strong>
            </div>
            <div style="margin: 10px 0px; font-size:1.5em;" >
                <div  style="border: 2px solid #0A77BA;border-radius: 10px;padding: 7px 15px; width:30%; margin:auto;">
                    <div style="background-color: #0A77BA;color: #eceff4; padding: 3px 25px; width:70%; margin:auto;">Supplier Slip</div>
                 </div>
            </div>
            <div>
                <strong style="font-size: .9rem;">Invoice NO: {{@$supplierDue->invoice_no }}</strong>
            </div>
        </div>
    </div>

    <div style="margin: 20px 0px;">
        <div style="width:100%;">
            <div style="width:40%; float:left;">
                <strong style="font-weight:100;">Date & Time: {{@$supplierDue->created_at}}</strong><br>
                <strong style="font-weight:100;">Company Name: {{  @$setup->company_name }} </strong><br>
                <strong style="font-weight:100;">Address: {{  @$setup->company_address }}  </strong><br>
                <strong style="font-weight:100;">Phone: {{  @$setup->office_phone }}  </strong><br>
                <strong style="font-weight:100;">Email: {{  @$setup->office_email }}  </strong><br>

            </div>
            <div style="width:20%;float:left; margin 0 auto;">
                <img  class="img-fluid" src="data:image/png;base64,{!! DNS2D::getBarcodePNG($supplierDue->invoice_no, 'QRCODE') !!}"
                alt="barcode" style="height:80px; height:80px;" />
            </div>
            <div style="width:40%;float:right;">
                <strong style="font-weight:100;">Supplier Name : {{ @$supplierDue->supplier->supplier_name }}</strong>
                <br>
                <strong style="font-weight:100;">Total Due: {{@$supplierDue->supplier->total_balance }}</strong>
                <br>
                <strong style="font-weight:100;">Phone : {{ @$supplierDue->supplier->supplier_phone }}</strong>
                <br>
                <strong style="font-weight:100;">Email : {{ @$supplierDue->supplier->supplier_email }}</strong>
                <br>
                <strong style="font-weight:100;">Address : {{ @$supplierDue->supplier->address }}</strong>
                <br>
            </div>
        </div>
    </div>

    <div class="product_details">
        <table>
            <thead>
                <tr>
                <th width="15%">Date </th>
                <th width="25%">Note </th>
                <th width="15%"> Payment Method </th>
               <th width="20%"> Due </th>
               <th width="20%"> Paid </th>
               <th width="20%"> Total </th>
                </tr>
            </thead>
            <tbody>

                <tr style="border:1px solid #000;">
                    <td>
                        {{$supplierDue->created_at}}
                    </td>
                    <td>
                        {{$supplierDue->note}}
                    </td>
                    <td>
                        {{@$supplierDue->payment_method}}
                    </td>
                    <td>
                        {{$supplierDue->due}}
                    </td>
                    <td>
                        {{$supplierDue->paid}}
                    </td>
                    <td>
                        {{$supplierDue->paid-$supplierDue->due}}
                    </td>
                </tr>
                 <tr style="border:1px solid #000;">
                    <td></td>
                    <td colspan="5">  Paid In Word :

                        {{ NumberToWords::transformNumber('en', @($supplierDue->paid)) }}  {{ @Helper::setting()->currency_name }}
                    </td>

                </tr>
            </tbody>
        </table>
    </div>

    <div class="footer_details" style="padding: 1.5rem 0px; text-align: center;
   margin-top: 10px;">
        <div>
            <strong style="font-weight:100;">Thank You For Receive</strong>

        </div>
    </div>
    <div style="width:100%; margin-top:50px;">

        <div style="width:50%; float:left;">
          &nbsp;  &nbsp;  &nbsp;   &nbsp; &nbsp;  &nbsp;   &nbsp; &nbsp;  &nbsp;   &nbsp; &nbsp;  &nbsp;   &nbsp; <strong > Company Signature:</strong>
          <hr style="width: 50%; border-top: 2px solid #000000; ">
        </div>
        <div style="width:50%;float:right">
              &nbsp;  &nbsp;  &nbsp;   &nbsp; &nbsp;  &nbsp;   &nbsp; &nbsp;  &nbsp;   &nbsp; &nbsp;  &nbsp;   &nbsp; <strong> Supplier Signature:</strong>
              <hr style="width: 50%; border-top: 2px solid #000000; ">
        </div>
    </div>
</body>

</html>

@php
use NumberToWords\NumberToWords;
@endphp
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer  Slip</title>
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
             height: 2480px !important;
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
            <img src="{{ @$customerDue->admin->profile->company_logo }}" style="height: 100px; width:100px;">
            <div>
                <strong style="font-size: 1.17em;">{{ @$customerDue->admin->profile->company_name }}</strong>
            </div>
            <div style="margin: 10px 0px; font-size:1.5em;" >
                <div  style="border: 2px solid #0A77BA;border-radius: 10px;padding: 7px 15px; width:30%; margin:auto;">
                    <div style="background-color: #0A77BA;color: #eceff4; padding: 3px 25px; width:70%; margin:auto;">Customer Slip</div>
                 </div>
            </div>
            <div>
                <strong style="font-size: .9rem;">Invoice NO: {{@$customerDue->invoice_no }}</strong>
            </div>
        </div>
    </div>

    <div style="margin: 20px 0px;">
        <div style="width:100%;">
            <div style="width:40%; float:left;">
                <strong style="font-weight:100;">Date & Time: {{@$customerDue->created_at}}</strong><br>
                <strong style="font-weight:100;">Company Name: {{ @$customerDue->admin->profile->company_name }} </strong><br>
                <strong style="font-weight:100;">Address: {{ @$customerDue->admin->profile->company_address }}  </strong><br>
                <strong style="font-weight:100;">Phone: {{ @$customerDue->admin->phone }}  </strong><br>
                <strong style="font-weight:100;">Email: {{ @$customerDue->admin->email }}  </strong><br>

            </div>
            <div style="width:20%;float:left; margin 0 auto;">
                <img  class="img-fluid" src="data:image/png;base64,{!! DNS2D::getBarcodePNG($customerDue->invoice_no, 'QRCODE') !!}"
                alt="barcode" style="height:80px; height:80px;" />
            </div>
            <div style="width:40%;float:right;">
                <strong style="font-weight:100;">Customer Name : {{ @$customerDue->customer->customer_name }}</strong>
                <br>
                <strong style="font-weight:100;">Total Due: {{@$customerDue->customer->total_balance }}</strong>
                <br>
                <strong style="font-weight:100;">Phone : {{ @$customerDue->customer->customer_phone }}</strong>
                <br>
                <strong style="font-weight:100;">Email : {{ @$customerDue->customer->customer_email }}</strong>
                <br>
                <strong style="font-weight:100;">Address : {{ @$customerDue->customer->address }}</strong>
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
                        {{$customerDue->created_at}}
                    </td>
                    <td>
                        {{$customerDue->note}}
                    </td>
                    <td>
                        {{@$customerDue->payment_method}}
                    </td>
                    <td>
                        {{$customerDue->due}}
                    </td>
                    <td>
                        {{$customerDue->paid}}
                    </td>
                    <td>
                        {{$customerDue->paid-$customerDue->due}}
                    </td>
                </tr>
                 <tr style="border:1px solid #000;">
                    <td></td>
                    <td colspan="5">  Paid In Word :

                        {{ NumberToWords::transformNumber('en', @($customerDue->paid)) }}  {{ @Helper::setting()->currency_name }}
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
              &nbsp;  &nbsp;  &nbsp;   &nbsp; &nbsp;  &nbsp;   &nbsp; &nbsp;  &nbsp;   &nbsp; &nbsp;  &nbsp;   &nbsp; <strong> Customer Signature:</strong>
              <hr style="width: 50%; border-top: 2px solid #000000; ">
        </div>
    </div>
</body>

</html>

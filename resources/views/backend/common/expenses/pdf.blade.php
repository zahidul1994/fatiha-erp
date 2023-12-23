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
           
            <div style="width:40%;float:right;">
                <strong style="font-weight:100;">Shop Name : {{ @$expenses->shop->shop_name }}</strong>
                <br>
                <strong style="font-weight:100;">Phone : {{@$expenses->shop->shop_phone }}</strong>
                <br>
                <strong style="font-weight:100;">Email : {{@$expenses->shop->shop_email }}</strong>
                <br>
                <strong style="font-weight:100;">Address : {{@$expenses->shop->shop_address }}</strong>
                <br>
                
            </div>
        </div>
    </div>

    <div class="product_details">
        <table>
            <thead>
                <tr>
                <th width="25%">expense_head_id </th>
                @if($expenses->notes!=NULL)
                <th width="25%">Note </th>
                @endif
                <th width="15%"> Payment Method </th>
               <th width="20%"> Expense Amount </th>
               @if($expenses->bank_name !=NULL)
               <th width="20%"> bank_name </th>
               <th width="20%"> bank_account_number </th>
               @endif
               @if($expenses->phone_number !=NULL)
               <th width="20%"> phone_number </th>
               <th width="20%"> transaction_number </th>
               @endif
               @if($expenses->path !=NULL)
               <th width="20%"> path </th>
               @endif


                </tr>
            </thead>
            <tbody>

                <tr style="border:1px solid #000;">
                    <td>
                        {{$expenses->expensehead->expense_name}}
                    </td>
                    @if($expenses->notes!=NULL)
                    <td>
                        {{$expenses->notes}}
                    </td>
                    @endif
                    <td>
                        {{@$expenses->payment_method}}
                    </td>
                    <td>
                        {{$expenses->expense_amount}}
                    </td>
                    @if($expenses->bank_name !=NULL)
                    <td>
                        {{$expenses->bank_name}}
                    </td>
                    <td>
                        {{$expenses->bank_account_number}}
                    </td>
                    @endif
                    @if($expenses->phone_number !=NULL)
                    <td>
                        {{$expenses->phone_number}}
                    </td>
                    <td>
                        {{$expenses->transaction_number}}
                    </td>
                    @endif
                    @if($expenses->path!=NULL)
                    <td>
                       
                    <img title="Photo"
              src="{{url(@$expenses->path.@$expenses->attachment) }}"
             alt="preview image" >
                    </td>
                    @endif
                  
                </tr>
                 <tr style="border:1px solid #000;">
                    <td></td>
                    <td colspan="4">  Paid In Word :

                        {{ NumberToWords::transformNumber('en', @($expenses->expense_amount)) }}  {{ @Helper::setting()->currency_name }}
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

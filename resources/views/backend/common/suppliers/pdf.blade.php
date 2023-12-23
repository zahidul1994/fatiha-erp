@php
use NumberToWords\NumberToWords;
$setup= Helper::companySetup();
@endphp
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Supplier </title>
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
                <strong style="font-size: 1.17em;">{{ @$setup->company_name }}</strong>
            </div>
            <div style="margin: 10px 0px; font-size:1.5em;">
                <div style="border: 2px solid #0A77BA;border-radius: 10px;padding: 7px 15px; width:30%; margin:auto;">
                    <div style="background-color: #0A77BA;color: #eceff4; padding: 3px 25px; width:70%; margin:auto;">
                        Supplier Info</div>
                </div>
            </div>

        </div>
    </div>
        <div style="width:100%;">
            <div style="width:50%;float:left;">
               <strong style="font-weight:100;">Supplier Name : {{ @$supplier->supplier_name }}</strong>
                <br>
                <strong style="font-weight:100;">Phone : {{ @$supplier->supplier_phone }}</strong> <br>
                <strong style="font-weight:100;">Email : {{ @$supplier->supplier_email }}</strong>
            </div>
            <div style="width:50%;float:right;">
                <strong style="font-weight:100;">Date Time:  {{ now() }}</strong>
                <br>
                <strong style="font-weight:100;">Total Due: {{@$supplier->total_balance }}</strong>
                <br>
                <strong style="font-weight:100;">Address : {{ @$supplier->address }}</strong>
            </div>

        </div>


    <div class="product_details">
        <table>
            <thead>
                <tr>
                    <th width="8%">SL </th>
                    <th width="25%">Date </th>
                    <th width="25%">Note </th>
                    <th width="15%"> Payment Method </th>
                    <th width="20%"> Due </th>
                    <th width="20%"> Paid </th>
                    <th width="20%"> Total </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($supplier->supplierdue as $due)
                <tr>
                    <td>
                        {{ $loop->index+1 }}
                    </td>
                    <td>
                        {{ $due->created_at }}
                    </td>
                    <td>
                        {{ $due->note }}
                    </td>
                    <td>
                        {{ @$due->payment_method }}
                    </td>
                    <td>
                        {{ $due->due }}
                    </td>
                    <td>
                        {{ $due->paid }}
                    </td>
                    <td>
                        {{ $due->paid - $due->due }}
                    </td>
                </tr>
                @endforeach

            </tbody>
            <tfoot>
                <tr style="border:1px solid #000;">
                    <td colspan="4">Total</td>
                    <td>{{ @$supplier->total_due}}</td>
                    <td>{{ @$supplier->total_paid}}</td>
                    <td>{{ @$supplier->total_balance}}</td>
                </tr>
            </tfoot>
        </table>
    </div>


</body>

</html>

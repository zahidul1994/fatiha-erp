<html>

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Purchase Product Report </title>
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
    </style>
</head>

<body>
    <div class="invoice" style="text-align: center;">
        <div class="heading">
            <img src="{{ Helper::companySetup()->company_logo }}" style="height: 100px; width:100px;">
            <div>
                <strong style="font-size: 1.17em;">{{ Helper::companySetup()->company_name }}
                </strong>
            </div>
            <div style="margin: 10px 0px; font-size:1.5em;">
                <div style="border: 2px solid #0A77BA;border-radius: 10px;padding: 7px 15px; width:53%; margin:auto;">
                    <div style="background-color: #0A77BA;color: #eceff4; padding: 3px 25px; width:90%; margin:auto;">
                        Purchase Product Report
                    </div>
                </div>
                <div>
                    <strong style="font-size: .9rem;">Phone: {{Helper::companySetup()->office_phone}}</strong>
                    <br>
                    <strong style="font-size: .9rem;">Address: {{Helper::companySetup()->company_address}}</strong>
                </div>
            </div>

        </div>


        <div class="product_details">
            <table>
                <thead>
                    <tr class="strong" style="background: #eceff4;">

                            <th width="8%">SL </th>
                            <th width="20%">Date </th>
                            <th width="30%">Product Information </th>
                            <th width="15%"> Qty </th>
                            <th width="15%">R Qty </th>
                            <th width="15%"> P Price </th>
                            <th width="10%"> Vat (%)</th>
                            <th width="15%"> Vat Amount </th>
                            <th width="20%" class="text-right"> Total </th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchaseProducts as $purchasedetail)
                                <tr class="">
                                    <td> {{ $loop->index + 1 }}</td>
                                    <td> {{ $purchasedetail->created_at->format('m-d-Y h:m') }}</td>
                                    <td>{{ Str::limit(@$purchasedetail->product_name, 50, '..') }}</td>
                                    <td>{{ @$purchasedetail->qty }}</td>
                                    <td>{{ @$purchasedetail->already_return_qty }}</td>
                                    <td>{{ (@$purchasedetail->purchase_price) }}</td>
                                    <td>{{(@$purchasedetail->vat_percent) }}</td>
                                    <td>{{(@$purchasedetail->vat_amount) }}</td>
                                    <td>{{ (@$purchasedetail->total_price+$purchasedetail->vat_amount) }}</td>
                                </tr>
                                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"><b> Print Date-Time: {{now()}}</b></td>
                        <td><b>Total</b></td>
                        <td><b>{{$purchaseProducts->sum('qty')}}</b></td>
                        <td><b>{{$purchaseProducts->sum('already_return_qty')}}</b></td>
                        <td><b>{{$purchaseProducts->sum('purchase_price')}}</b></td>
                        <td></td>
                        <td><b>{{$purchaseProducts->sum('vat_amount')}}</b></td>
                        <td><b>{{$purchaseProducts->sum('vat_amount')+$purchaseProducts->sum('total_price')}}</b>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
</body>

</html>

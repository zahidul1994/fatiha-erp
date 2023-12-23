<html>

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Loss Profit Report </title>
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
                        Product Loss Profit Report
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
                        <th width="30%">Product Name </th>
                        <th width="5%"> AVG Price </th>
                        <th width="5%"> Sale Price </th>
                        <th width="5%"> Qty </th>
                        <th width="20%" class="text-right">Sale Amount </th>
                        <th width="20%" class="text-right"> Loss Profit </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($saleProducts as $saledetail)
                                <tr class="align-bold">
                                    <td> {{ $loop->index + 1 }}
                                    </td>
                                    <td>{{ Str::limit(@$saledetail->product_name, 50, '..') }}</td>
                                  <td>{{ (@$saledetail->average_purchase_price) }}</td>
                                    <td>{{ (@$saledetail->sale_price) }}</td>
                                    <td>{{ @$saledetail->qty }}</td>
                                    <td>{{ (@$saledetail->total_price) }}</td>

                                    <td>{{ (@$saledetail->loss_profit_amount) }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2">
                                        Total
                                    </td>
                                    <td>
                                        {{($saleProducts->sum('average_purchase_price')) }}
                                    </td>
                                    <td>
                                        {{($saleProducts->sum('sale_price')) }}
                                    </td>

                                    <td>
                                        {{$saleProducts->sum('qty') }}
                                    </td>

                                    <td>
                                        {{($saleProducts->sum('total_price')) }}
                                    </td>
                                    <td>
                                        {{($saleProducts->sum('loss_profit_amount')) }}
                                    </td>
                                </tr>

                </tbody>
            </table>
        </div>
</body>

</html>

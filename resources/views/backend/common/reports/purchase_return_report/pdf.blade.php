<html>

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Purchase Return Report </title>
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
                <div style="border: 2px solid #0A77BA;border-radius: 10px;padding: 7px 15px; width:33%; margin:auto;">
                    <div style="background-color: #0A77BA;color: #eceff4; padding: 3px 25px; width:70%; margin:auto;">
                        Purchase Report
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
                        <th>Sl</th>
                        <th>Date</th>
                        <th>Invoice</th>
                        <th>Biller</th>
                        <th>Shop</th>
                        <th>Supplier</th>
                        <th>Vat</th>
                        <th>Discount</th>
                        <th>SubTotal</th>
                        <th>Purchase</th>
                        <th>Paid</th>
                        <th>Due</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchases as $purchase)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{@$purchase->date}}</td>
                        <td>{{@$purchase->invoice_no}}</td>
                        <td>{{@$purchase->user->name}}</td>
                        <td>{{@$purchase->shop->shop_name}}</td>
                        <td>{{@$purchase->supplier->supplier_name}}</td>
                        <td>{{@$purchase->total_vat}}</td>
                        <td>{{@$purchase->total_discount}}</td>
                        <td>{{@$purchase->sub_total}}</td>
                        <td>{{@$purchase->grand_total}}</td>
                        <td>{{@$purchase->paid}}</td>
                        <td>{{@$purchase->grand_total-@$purchase->paid}}</td>
                    </tr>

                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5"> Print Date-Time: {{now()}} </td>
                        <td><b>Total</b></td>
                        <td><b>{{$purchases->sum('total_vat')}}</b></td>
                        <td><b>{{$purchases->sum('total_discount')}}</b></td>
                        <td><b>{{$purchases->sum('sub_total')}}</b></td>
                        <td><b>{{$purchases->sum('grand_total')}}</b></td>
                        <td><b>{{$purchases->sum('paid')}}</b></td>
                        <td><b>{{$purchases->sum('grand_total')-$purchases->sum('paid')}}</b></td>
                    </tr>
                </tfoot>
            </table>
        </div>
</body>

</html>

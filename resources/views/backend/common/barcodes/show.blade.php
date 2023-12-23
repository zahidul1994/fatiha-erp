<!DOCTYPE html>
<html lang="en">
<head>
    <title>Barcode Print</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt "Tahoma";
        }


        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 50mm;
            min-height: 25mm;
            /*padding: 1mm 1mm;*/
            /*margin: 1mm auto;*/
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .subpage {
            padding: 1px;
            /*border: 1px red solid;*/
            height: 24mm;
            /*outline: 2cm #FFEAEA solid;*/
        }

        @page {
            size: 50mm 25mm;
            /*size: 50mm;*/
            margin: 0;
        }

        @media print {

            html,
            body {
                width: 50mm;
                height: 25mm;
            }

            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                /*page-break-after: always;*/
            }

        }
    </style>
</head>

<body onload="window.print()">
      @for ($i = 0; $i < count($productsku); $i++)
            @for ($l = 0; $l < $barcodequantity[$i]; $l++)
                <div class="page">
                    <div class="subpage">
                        <div style="text-align: center;page-break-after:always;">
                            <span style="font-size: 11px;font-weight: bold;">{{ $productsku[$i] }}</span> <br>
                            <img width="125mm" height="30mm" src="data:image/png;base64,{!! DNS1D::getBarcodePNG($barcodes[$i], 'C39') !!}" />
                            <div style="font-size: 10px;margin-top:-5px">{{ $barcodes[$i] }}</div>
                            @isset($printeprice)
                            <span style="font-size: 10px;">Price: <b>{{ $saleprice[$i] }}</b></span>
                            @endisset
                            @isset($printDate)
                            <span style="font-size: 10px;">&nbsp;Ex: <b>{{ $productExpireDate[$i] }}</b></span>
                            @endisset

                        </div>
                    </div>
                </div>
            @endfor

        @endfor


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

        }, 10000);

        setTimeout(function() {
            document.location.href = "{{ url(Request::segment(1) . '/barcodes') }}";

        }, 10000);
    </script>
    </body>
</html>

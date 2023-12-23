@extends('backend.layouts.master')
@section('title', 'Sale Product Report')
@push('css')
<link rel="stylesheet" href="{{asset('backend/assets/js/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet"
    href="{{asset('backend/assets/js/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet"
    href="{{ asset('backend/assets/js/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<link href="{{ asset('backend/assets/select2/css/select2.min.css') }}" rel="stylesheet" />

<style>
    .select2-selection__choice {
        background-color: var(--bs-gray-200);
        border: none !important;
        font-size: 12px;
        font-size: 0.85rem !important;
    }
</style>
@endpush
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="border border-info">
                    <!--estimated annual area-->
                    <h3 class="text-center bg-info">Sale Product Report</h3>
                    {!! Form::open(['route' => Request::segment(1) . '.saleProductReportShow', 'method' =>
                    'POST','class'=>'form']) !!}
                    <div class="row mx-auto">
                        <div class="form-group col-md-3">
                            <label for="product_id" class="form-control-label"> Type Product Name Or Barcode </label>
                            {!! Form::select('product_id',[@$product_id=>@Helper::getProductName(@$product_id)], null,
                            ['id' => 'product_id', 'class' => 'form-control select2','tabindex' => 1]) !!}

                        </div>

                        <!-- form start -->
                        <div class="form-group col-md-2">
                            <label for="start_date" class="form-control-label"> Start Date * </label>
                            {!! Form::date('start_date', $from?:null, ['class' => 'form-control','id' =>
                            'start_date','required']) !!}

                        </div>

                        <div class="form-group col-md-2">
                            <label for="end_date" class="form-control-label"> End Date * </label>
                            {!! Form::date('end_date', $to?:null, ['class' => 'form-control','id' =>
                            'end_date','required']) !!}
                        </div>

                        <div class="form-group col-md-2">
                            <label for="status" class="form-control-label"> View As * </label>
                            <br>
                            <label for="htmlview" class="form-control-label">
                                <input type="radio" {{ $previewtype=='htmlview' ? 'checked' : '' }} name="previewtype"
                                    value="htmlview" checked id="htmlview">
                                Html</label>
                            <label for="pdfview" class="form-control-label">
                                <input type="radio" {{ $previewtype=='pdfview' ? 'checked' : '' }} name="previewtype"
                                    value="pdfview" id="pdfview"> Pdf
                            </label>

                        </div>
                        <div class="form-group col-md-2">
                            <label for="search" class="form-control-label">&nbsp;</label>
                            <button type="submit" class="form-control btn btn-primary"> <i class='fas fa-search'></i>
                                Search</button>
                            <a href="{{ url(Request::segment(1) . '/sale-product-report') }}"
                                class="form-control btn btn-warning" type="button"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                    <path
                                        d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z">
                                    </path>
                                    <path fill-rule="evenodd"
                                        d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z">
                                    </path>
                                </svg> Reset</a>

                        </div>


                    </div>
                    </form>
                </div>


                <!-- Card header -->
                <div class="container mt-1">
                    <div class="table-responsive">
                        @if ($saleProducts->isNotEmpty())
                        <table id="datatable" class="table table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th width="8%">SL </th>
                                    <th width="30%">Product Name </th>
                                    <th width="5%"> Qty </th>
                                    <th width="5%">R Qty </th>
                                    <th width="15%"> UN Price </th>
                                    <th width="10%"> Vat (%)</th>
                                    <th width="15%"> Vat Amount </th>
                                    <th width="10%"> Dis (%)</th>
                                    <th width="15%"> Dis Amount</th>
                                    <th width="20%" class="text-right"> Amount </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($saleProducts as $saledetail)
                                <tr class="align-bold">
                                    <td> {{ $loop->index + 1 }}
                                    </td>
                                    <td>{{ Str::limit(@$saledetail->product_name, 50, '..') }}</td>
                                    <td>{{ @$saledetail->qty }}</td>
                                    <td>{{ @$saledetail->already_return_qty }}</td>
                                    <td>{{ (@$saledetail->sale_price) }}</td>
                                    <td>{{(@$saledetail->vat_percent) }}</td>
                                    <td>{{ (@$saledetail->vat_amount) }}</td>
                                    <td>{{ (@$saledetail->discount_percent) }}</td>
                                    <td>{{ (@$saledetail->discount_amount) }}</td>
                                    <td>{{ (@$saledetail->total_price) }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2">
                                        Total
                                    </td>
                                    <td colspan="1">
                                        {{$saleProducts->sum('qty') }}
                                    </td>
                                    <td>
                                        {{$saleProducts->sum('already_return_qty') }}
                                    </td>
                                    <td> {{($saleProducts->sum('sale_price')) }}
                                    </td>
                                    <td></td>
                                    <td> {{($saleProducts->sum('vat_amount')) }}
                                    </td>
                                    <td></td>
                                    <td> {{($saleProducts->sum('discount_amount'))
                                        }}</td>
                                    <td>
                                        {{($saleProducts->sum('total_price')) }}
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        @else
                        <div>
                            <h2 class="text-center">No Data found</h2>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="{{ asset('backend/assets/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $(document).ready(function() {
            $('#product_id').select2({
       placeholder: 'Type Product Name Or Barcode',
       minimumInputLength: 1,
       ajax: {
         type: "GET",
         url: "{{ URL(Request::segment(1).'/finding-reporting-product') }}",
          dataType: "JSON",
             delay: 250,
            processResults: function (data) {
           return {
             results:  $.map(data, function (item) {
                   return {
                       text: item.product_full_name,
                       id: item.id

                   }

               })

           };

         },

         cache: true

       }

     });
            $('#datatable').DataTable({
                dom: 'Bflrtip',
                paginate: false,

                buttons: [
                    {
                        extend: 'csv',
                        text: 'Excel',
                        title: 'Sale Product Report',
                        exportOptions: {
                            stripHtml: true,
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        text: 'PDF',
                        title: 'Sale Product Report',
                        exportOptions: {
                            pdfHtml5: true,
                            columns: ':visible'

                        },

                    },
                    {
                        extend: 'print',
                        text: 'Print',
                        exportOptions: {
                            stripHtml: true,
                            columns: ':visible'
                        },
                        title: function(){
                        return "<div style='display:flex'><div><img src='{{url(Helper::companySetup()->printing_logo)}}'style='display: block;margin: 0 auto;width:100px;' /></div><div style='font-size: 22px;margin-top:2%'>&nbsp Company Name:"+"&nbsp; " +'{{Helper::companySetup()->company_name}}'+"<br/> &nbsp; Address: " + '{{Helper::companySetup()->company_address}}</div></div><div><div style="margin:0 auto;text-align:center;font-size: 23px;padding-bottom:1%">Report Name:Sale Product List</div></div>';

                          }
                    },
                    'colvis'

                ],

            });
        });
    });
</script>
@endpush

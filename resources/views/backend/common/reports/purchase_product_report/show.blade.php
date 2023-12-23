@extends('backend.layouts.master')
@section('title', 'Purchase Product Report')
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
                    <h3 class="text-center bg-info">Purchase Product Report</h3>
                    {!! Form::open(['route' => Request::segment(1) . '.purchaseProductReportShow', 'method' =>
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
                            <a href="{{ url(Request::segment(1) . '/purchase-product-report') }}"
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
                        @if ($purchaseProducts->isNotEmpty())
                        <table id="datatable" class="table table-flush">
                            <thead class="thead-light">
                                 <tr class="text-center">
                                    <th width="8%">SL </th>
                                    <th width="10%">Date </th>
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
                        title: 'Purchase Product Report',
                        exportOptions: {
                            stripHtml: true,
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        text: 'PDF',
                        title: 'Purchase Product Report',
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
                        return "<div style='display:flex'><div><img src='{{url(Helper::companySetup()->printing_logo)}}'style='display: block;margin: 0 auto;width:100px;' /></div><div style='font-size: 22px;margin-top:2%'>&nbsp Company Name:"+"&nbsp; " +'{{Helper::companySetup()->company_name}}'+"<br/> &nbsp; Address: " + '{{Helper::companySetup()->company_address}}</div></div><div><div style="margin:0 auto;text-align:center;font-size: 23px;padding-bottom:1%">Report Name:Purchase Product List</div></div>';

                          }
                    },
                    'colvis'

                ],

            });
        });
    });
</script>
@endpush

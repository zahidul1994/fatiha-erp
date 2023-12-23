@extends('backend.layouts.master')
@section('title', 'Sale Return')
@push('css')
<link href="{{ asset('backend/assets/select2/css/select2.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('backend/assets/js/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet"
    href="{{asset('backend/assets/js/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
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
        <div class="col-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header pb-4">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">All Sale Return</h5>
                            <p class="text-sm mb-0">
                                Sale return data.
                            </p>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <a href="{{ route(Request::segment(1) . '.sales.create') }}"
                                    class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; New Sale</a>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mx-auto col-sm-1">
                        <label for="sales">Sale Return * </label>
                        {!! Form::select('sale_id',[], null, ['id' => 'sales', 'class' => 'form-control select2',
                        'tabindex' => 4]) !!}
                    </div>
                    <div class="card-body px-0 pb-0">
                        <div class="table table-responsive">
                            <table class="table table-bordered align-items-center mb-0" id="datatable-basic">
                                <thead class="thead-light">
                                    <tr class="text-center">
                                        <th>Sl</th>
                                        <th>Date</th>
                                        <th>Return</th>
                                        <th>Creator</th>
                                        <th>Customer</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr class="text-center">
                                        <th>Sl</th>
                                        <th>Date</th>
                                        <th>Return</th>
                                        <th>Creator</th>
                                        <th>Customer</th>
                                       <th style="text-align: left"></th>
                                        <th style="text-align: left"></th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="{{ asset('backend/assets/select2/js/select2.min.js') }}"></script>
<script src="{{asset('backend/assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/assets/js/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('backend/assets/js/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/assets/js/plugins/datatables/sum.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>

<script>
    $(document).ready(function() {


                $('#datatable-basic').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    dom: 'Bflrtip',
                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "All"]
                    ],
                    language: {
                        'paginate': {
                            'previous': '<strong><<strong>',
                            'next': '<strong>><strong>'
                        }
                    },

                    ajax: "{{ route(Request::segment(1) . '.sale-returns.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'date',
                            name: 'date'
                        },
                        {
                            data: 'invoice_no',
                            name: 'invoice_no'
                        },
                        {
                            data: 'user.name',
                            name: 'user.name'
                        },
                        {
                            data: 'customer.customer_name',
                            name: 'customer.customer_name'
                        },

                        {
                            data: 'return_quantity',
                            name: 'return_quantity'
                        },
                        {
                            data: 'grand_total',
                            name: 'grand_total'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: true
                        },
                    ], "footerCallback": function(row, data) {
                    var api = this.api(),
                        data;
                    $(api.column(5, {
                        page: ''
                    }).footer()).html('' + api.column(5, {
                        page: ''
                    }).data().sum());
                    $(api.column(6, {
                        page: ''
                    }).footer()).html('' + api.column(6, {
                        page: ''
                    }).data().sum());

                },
                });


    $('#sales').select2({
       placeholder: 'Type A Sale Invoice/Date/Amount',
       minimumInputLength: 1,
       ajax: {
         type: "POST",
         url: "{{ URL(Request::segment(1).'/find-sale') }}",
          dataType: "JSON",
             delay: 250,
            processResults: function (data) {
           return {
             results:  $.map(data, function (item) {
                   return {
                       text: item.invoice_no + '( '+ item.grand_total + ' )',
                       id: item.id
                   }

               })

           };

         },

         cache: true

       }

     });

            $('#sales').change(function(e) {
                window.location.href ="{{url(Request::segment(1)) }}"+'/sale-return-create/'+$(this).val();

        });







    });


</script>
@endpush

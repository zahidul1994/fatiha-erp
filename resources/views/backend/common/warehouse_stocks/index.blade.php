@extends('backend.layouts.master')
@section('title', 'Warehouse  Stock')
@push('css')
<link rel="stylesheet" href="{{asset('backend/assets/js/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/assets/js/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header pb-4">
                        <div class="d-lg-flex">
                            <div>
                                <h5 class="mb-0">All Warehouse Stock</h5>
                                <p class="text-sm mb-0">
                                    Warehouse Stock data.
                                </p>
                            </div>
                            <div class="ms-auto my-auto mt-lg-0 mt-4">
                                <div class="ms-auto my-auto">
                                    <a href="{{ route(Request::segment(1) . '.purchases.create') }}"
                                        class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; New Purchase</a>


                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-0">

                        <div class="table table-responsive">
                            <table class="table table-bordered align-items-center mb-0" id="datatable-basic">
                                <thead class="thead-light">
                                     <tr class="text-center">
                                        <th>Sl</th>
                                        <th>Warehouse</th>
                                        <th>Expire</th>
                                        <th>Product </th>
                                        <th>HScode </th>
                                        <th>LPP</th>
                                        <th>LSP</th>
                                        <th style="front-weight:blod">Stock</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tfoot>
                                     <tr class="text-center">
                                        <th>Sl</th>
                                        <th>Warehouse</th>
                                        <th>Expire</th>
                                        <th>Product </th>
                                       <th>HScode </th>
                                        <th style="text-align: left"></th>
                                        <th style="text-align: left"></th>
                                       <th></th>
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
    <script src="{{asset('backend/assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/plugins/datatables/sum.js')}}"></script>

  <script>
            $(document).ready(function() {
                $('#datatable-basic').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
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

                    ajax: "{{ route(Request::segment(1) . '.warehouse-stocks.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },

                        {
                            data: 'warehouse.warehouse_name',
                            name: 'warehouse.warehouse_name'
                        },
                        {
                            data: 'expire_date',
                            name: 'expire_date'
                        },
                        {
                            data: 'product_name',
                            name: 'product_name'
                        },
                       
                        {
                            data: 'hs_code',
                            name: 'hs_code'
                        },

                        {
                            data: 'last_purchase_price',
                            name: 'last_purchase_price',
                        },
                        {
                            data: 'last_sale_price',
                            name: 'last_sale_price',
                        },
                        {
                            data: 'stock_qty',
                            name: 'stock_qty',
                        },
                        {
                            data: 'action',
                            name: 'action',
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
            });


        </script>
    @endpush

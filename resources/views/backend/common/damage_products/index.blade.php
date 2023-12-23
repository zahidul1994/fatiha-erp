@extends('backend.layouts.master')
@section('title', 'Damage Products')
@push('css')
<link rel="stylesheet" href="{{asset('backend/assets/js/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/assets/js/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

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
                                <h5 class="mb-0">All Damage Products</h5>
                                <p class="text-sm mb-0">
                                    Damage Products data.
                                </p>
                            </div>
                            <div class="ms-auto my-auto mt-lg-0 mt-4">
                                <div class="ms-auto my-auto">
                                    <a href="{{ route(Request::segment(1) . '.damage-products.create') }}"
                                        class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; Damage Products</a>


                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-0">
                        <div class="table table-responsive">
                            <table class="table table-bordered align-items-center mb-0" id="datatable-basic">
                                <thead class="thead-light">
                                     <tr class="text-center">
                                        <th>Sl</th>
                                        <th>Date</th>
                                        <th>Creator</th>
                                        <th>Shop</th>
                                        <th>Stock</th>
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
                                        <th>Creator</th>
                                        <th>Shop</th>
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
    <script src="{{asset('backend/assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/plugins/datatables/sum.js')}}"></script>

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

                    ajax: "{{ route(Request::segment(1) . '.damage-products.index') }}",
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
                            data: 'user.name',
                            name: 'user.name'
                        },
                        {
                            data: 'shop.shop_name',
                            name: 'shop.shop_name'
                        },

                        {
                            data: 'total_damage_stock',
                            name: 'total_damage_stock'
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
                    $(api.column(4, {
                        page: ''
                    }).footer()).html('' + api.column(4, {
                        page: ''
                    }).data().sum());
                    $(api.column(5, {
                        page: ''
                    }).footer()).html('' + api.column(5, {
                        page: ''
                    }).data().sum());

                },
                });
            });


        </script>
    @endpush

@extends('backend.layouts.master')
@section('title', 'Products')
@push('css')
<link rel="stylesheet" href="{{asset('backend/assets/js/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/assets/js/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

    <link href="{{ asset('lightbox/css/lightbox.css') }}" rel="stylesheet" />
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
                                <h5 class="mb-0">All Products</h5>
                                <p class="text-sm mb-0">
                                    Products data.
                                </p>
                            </div>
                            <div class="ms-auto my-auto mt-lg-0 mt-4">
                                <div class="ms-auto my-auto">
                                    <a href="{{ route(Request::segment(1) . '.products.create') }}"
                                        class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; New Products</a>


                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-0">
                        <div class="table table-responsive">
                            <table class="table table-bordered align-items-center mb-0" id="datatable-basic">
                              <thead class="thead-light">
                                     <tr class="text-center">
                                        <th>Sl</th>
                                        <th>Brand</th>
                                        <th>Name</th>
                                        <th>Barcode</th>
                                        <th>Photo</th>
                                        <th>Unit</th>
                                        <th>Purchase P</th>
                                       <th>Sale Price</th>
                                        <th>Stock</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                     <tr class="text-center">
                                        <th>Sl</th>
                                        <th>Brand</th>
                                        <th>Name</th>
                                        <th>Barcode</th>
                                        <th>Photo</th>
                                        <th>Unit</th>
                                        <th style="text-align: left">Purchase P</th>
                                       <th style="text-align: left">Sale Price</th>
                                        <th style="text-align: left">Stock</th>
                                        <th>Status</th>
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
    <script src="{{ asset('lightbox/js/lightbox.js') }}"></script>
    <script src="{{asset('backend/assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

  <script>
            $(document).ready(function() {
                lightbox.option({
                    'resizeDuration': 200,
                    'wrapAround': true
                });

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

                    ajax: "{{ route(Request::segment(1) . '.products.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'brand.brand_name',
                            name: 'brand.brand_name'
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
                            data: 'image',
                            name: 'image'
                        },
                        {
                            data: 'unit',
                            name: 'unit'
                        },
                        {
                            data: 'purchase_price',
                            name: 'purchase_price'
                        },


                        {
                            data: 'sale_price',
                            name: 'sale_price'
                        },
                         {
                            data:'stock',
                            name:'stock'
                        },

                        {
                            data: 'status'
                        },

                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: true
                        },
                    ]
                });
            });

            function updateStatus(el) {
                if (el.checked) {
                    var status = 1;
                } else {
                    var status = 0;
                }
                $.post("{{ route(Request::segment(1) . '.productStatus') }}", {
                        _token: '{{ csrf_token() }}',
                        id: el.value,
                        status: status
                    },
                    function(data) {
                        if (data == 1) {
                            toastr.success('success', 'Product Status updated successfully');
                        } else {
                            toastr.danger('danger', 'Something went wrong');
                        }
                    });
            }
        </script>
    @endpush

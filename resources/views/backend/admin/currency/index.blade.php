@extends('backend.layouts.master')
@section('title', 'Currency')
@push('css')
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
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
                                <h5 class="mb-0">All Currency</h5>
                                <p class="text-sm mb-0">
                                    Currency  data.
                                </p>
                            </div>
                            <div class="ms-auto my-auto mt-lg-0 mt-4">
                                <div class="ms-auto my-auto">
                                 <a href="{{ route(Request::segment(1) . '.currency.create') }}"
                                 class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; New Currency</a>
                                        


                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-0">
                            <div class="table table-responsive">
                                <table class="table table-bordered align-items-center mb-0" id="datatable-basic">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Sl</th>
                                            <th>Name</th>
                                            <th>Rate</th>
                                            <th>Symble</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Name</th>
                                            <th>Rate</th>
                                            <th>Symble</th>
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
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
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

                ajax: "{{ route(Request::segment(1) . '.currency.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                   
                    {
                        data: 'currency_name',
                        name: 'currency_name'
                    },
                    {
                        data: 'currency_rate',
                        name: 'currency_rate'
                    },
                    {
                        data: 'currency_symbol',
                        name: 'currency_symbol'
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

       
    </script>
@endpush

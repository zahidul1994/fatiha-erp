@extends('backend.layouts.master')
@section('title', 'Broker')
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
                                <h5 class="mb-0">All Broker</h5>
                                <p class="text-sm mb-0">
                                    Broker  data.
                                </p>
                            </div>
                            <div class="ms-auto my-auto mt-lg-0 mt-4">
                                <div class="ms-auto my-auto">
                                    <a href="{{ route(Request::segment(1) . '.brokers.create') }}"
                                        class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; New Broker</a>

                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-0">
                            <div class="table table-responsive">
                                <table class="table table-bordered align-items-center mb-0" id="datatable-basic">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Sl</th>
                                            <th>Staff</th>
                                            <th>Broker</th>
                                            <th>Phone</th>
                                            <th>Due</th>
                                            <th>Paid</th>
                                             <th>Balance</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Staff</th>
                                            <th>Broker</th>
                                            <th>Phone</th>
                                            <th style="text-align: left"></th>
                                             <th style="text-align: left"></th>
                                             <th style="text-align: left"></th>
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

                ajax: "{{ route(Request::segment(1) . '.brokers.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'broker_name',
                        name: 'broker_name'
                    },
                    {
                        data: 'broker_phone',
                        name: 'broker_phone'
                    },
                    {
                        data: 'total_due',
                        name: 'total_due'
                    },
                    {
                        data: 'total_paid',
                        name: 'total_paid'
                    },
                    {
                        data: 'total_balance',
                        name: 'total_balance'
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
                    $(api.column(6, {
                        page: ''
                    }).footer()).html('' + api.column(6, {
                        page: ''
                    }).data().sum());

                },
                
            });
        });

        function updateStatus(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post("{{ route(Request::segment(1) . '.customerStatus') }}", {
                    _token: '{{ csrf_token() }}',
                    id: el.value,
                    status: status
                },
                function(data) {
                    if (data == 1) {
                        toastr.success('success', 'Customer Status updated successfully');
                    } else {
                        toastr.danger('danger', 'Something went wrong');
                    }
                });
        }
    </script>
@endpush

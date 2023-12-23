@extends('backend.layouts.master')
@section('title', 'Expense List')
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
                                <h5 class="mb-0">All Expenses</h5>
                                <p class="text-sm mb-0">
                                    A Home page layout data.
                                </p>
                            </div>
                            <div class="ms-auto my-auto mt-lg-0 mt-4">
                                <div class="ms-auto my-auto">
                                    <a href="{{ route(Request::segment(1) . '.expenses.create') }}"
                                        class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; New Expense</a>

                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-0">
                            <div class="table table-responsive">
                                <table class="table table-bordered align-items-center mb-0" id="datatable-basic">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Sl</th>
                                            <th>Date</th>
                                            <th>Creator</th>
                                            <th>Head</th>
                                            <th>Amount</th>
                                            <th>Payment </th>
                                            <th>Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                        <th>Sl</th>
                                            <th>Date</th>
                                            <th>Creator</th>
                                            <th>Head</th>
                                            <th></th>
                                            <th>Payment</th>
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

                ajax: "{{ route(Request::segment(1) . '.expenses.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'expensehead.expense_name',
                        name: 'expensehead.expense_name'
                    },
                    {
                        data: 'expense_amount',
                        name: 'expense_amount'
                    },
                    {
                        data: 'payment_method',
                        name: 'payment_method'
                    }, {
                        data: 'action',
                        name: 'action'
                    },

                ],
                "footerCallback": function(row, data) {
                    var api = this.api(),
                        data;

                    $(api.column(4, {
                        page: ''
                    }).footer()).html('' + api.column(4, {
                        page: ''
                    }).data().sum());



                },
            });
        });

    </script>
@endpush

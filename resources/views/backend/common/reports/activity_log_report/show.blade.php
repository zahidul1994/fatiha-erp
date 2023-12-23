@extends('backend.layouts.master')
@section('title', 'Activity Log Report')
@push('css')
<link href="{{ asset('backend/assets/select2/css/select2.min.css') }}" rel="stylesheet" />

<style>

    .select2-selection__choice {
        background-color: var(--bs-gray-200);
        border: none !important;
        font-size: 12px;
        font-size: 0.85rem !important;
    }


</style>
<link rel="stylesheet" href="{{asset('backend/assets/js/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet"
    href="{{asset('backend/assets/js/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet"
    href="{{ asset('backend/assets/js/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="border border-info">
                    <!--estimated annual area-->
                    <h3 class="text-center bg-info">Activity Log Report</h3>
                    {!! Form::open(['route' => Request::segment(1) . '.activityLogReportShow', 'method' =>
                    'POST','class'=>'form']) !!}
                    <div class="row mx-auto">
                        <div class="form-group col-md-3">
                            <label for="user_id" class="form-control-label"> Select User * </label>
                             <select name="user_id" id="select2" class="form-control" required>
                                @if (@Auth::user()->user_type=="Admin")
                                <option value="{{Auth::id()}}" {{ Auth::id() ==$adminId ? "selected" : " " }} >{{@Auth::user()->name}}</option>
                                @endif
                                @foreach (Helper::getEmployes(Auth::id()) as $info)
                                  <option value="{{$info->id}}" {{ $info->id==$adminId  ? "selected" : " " }}>{{$info->name}}</option>
                                @endforeach

                            </select>

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
                            <label for="search" class="form-control-label">&nbsp;</label>
                            <button type="submit" class="form-control btn btn-primary"> <i class='fas fa-search'></i>
                                Search</button>

                        </div>

                        <div class="form-group col-md-2">
                            <label for="search" class="form-control-label">&nbsp;</label>
                            <a href="{{ url(Request::segment(1) . '/activity-log-report') }}"
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
                        @if ($activityLogs->isNotEmpty())
                        <table id="datatable" class="table table-flush">
                            <thead class="thead-light">
                                 <tr class="text-center">
                                    <th>Sl</th>
                                    <th>Date</th>
                                    <th>Causer Name</th>
                                    <th>Description</th>
                                    <th>Event</th>
                                    <th>Changes</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                  $Causer= Helper::getAdmin($adminId);
                                @endphp
                                @foreach ($activityLogs as $log)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{ \Carbon\Carbon::parse($log->created_at)->diffForHumans()}}</td>

                                    <td>{{$Causer->name}}</td>
                                    <td>{{$log->description}}</td>
                                    <td>{{$log->event}}</td>
                                    <td><code>{{$log->properties,true}}</code></td>

                                </tr>

                                @endforeach
                            </tbody>
                            <tfoot>

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
            $('#select2').select2();
            $('#datatable').DataTable({
                dom: 'Bflrtip',
                paginate: false,

                buttons: [
                    {
                        extend: 'csv',
                        text: 'Excel',
                        title: 'Activity Log Report',
                        exportOptions: {
                            stripHtml: true,
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        text: 'PDF',
                        title: 'Activity Log Report',
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
                        return "<div style='display:flex'><div><img src='{{url(Helper::companySetup()->printing_logo)}}'style='display: block;margin: 0 auto;width:100px;' /></div><div style='font-size: 22px;margin-top:2%'>Company Name:"+"&nbsp; " +'{{Helper::companySetup()->company_name}}'+"<br/> &nbsp; Address: " + '{{Helper::companySetup()->company_address}}</div></div><div><div style="margin:0 auto;text-align:center;font-size: 23px;padding-bottom:1%">Report Name:Activity Log  List</div></div>';

                          }
                    },
                    'colvis'

                ],

            });
        });
    });
</script>
@endpush

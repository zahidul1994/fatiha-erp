@extends('backend.layouts.superadminmaster')
@section('title', 'Admins')
@push('css')
<link rel="stylesheet" href="{{asset('backend/assets/js/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet"
    href="{{asset('backend/assets/js/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
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
                            <h5 class="mb-0">All Admin</h5>
                            <p class="text-sm mb-0">
                                Admin data.
                            </p>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">

                                <a href="{{ route(Request::segment(1) . '.admins.create') }}"
                                    class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; New Admin</a>

                                <button title="SendSms" type="button" class="btn btn-success  btn-sm  mt-3 ms-auto"
                                    data-bs-toggle="modal" data-bs-target="#SendSms">
                                    Send Sms <i class="fas fa-envelope"></i>
                                </button>


                            </div>
                        </div>
                    </div>


                    <div class="modal fade" id="SendSms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true" style="overflow:hidden;">
                        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable"
                            role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Send SMS Box </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" class="text-danger">X</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="messagetext">Sent Message </label><br>

                                                {!!Form::textarea('messagetext',null,
                                                array('id'=>'messagetext','class'=>'form-label form-control',
                                                'data-length'=>'160','rows' => 4, 'cols' => 54,'required'))!!}
                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <button type="button" class="btn btn-success"
                                                id="Sendsmssubmit">Send</button>
                                        </div>
                                    <!--bp area end-->
                                </div>
                                <!--bp area end-->

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
                                        <th>Package</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Photo</th>
                                        <th>Expire</th>
                                        <th>Status</th>
                                        <th>Slug</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Name</th>
                                        <th>Package</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Photo</th>
                                        <th>Expire</th>
                                        <th>Status</th>
                                        <th>Slug</th>
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
<script src="{{ asset('backend/assets/js/plugins/sweetalert.min.js') }}"></script>
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

                ajax: "{{ route(Request::segment(1) . '.admins.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'package.package_name',
                        name: 'package.package_name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'image'
                    },
                    {
                        data: 'account_expire_date',
                        name: 'account_expire_date'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'invoice_slug'
                    },
                  {data: 'action', name: 'action', orderable: false, searchable: true},
                ]
            });

      //sent sms
      $(document).on('click', '#Sendsmssubmit', function() {
  var table = $('#datatable-basic').DataTable().data();
if (!confirm('Are You Confirm To sent '+ table.length +' SMS ?')) return;

 // console.log(table);
  for (let i = 0; i <table.length; i++) {

$info_url = `{{url(Request::segment(1) . '/admin-custom-sms')}}`;
$.ajax({
    url: $info_url,
    method: "post",
    type: "POST",
    data: {
        name:table[i]['name'],
        phonenumber:table[i]['phone'],
        smsmessage:$('#messagetext').val()
    },

});
}

Swal.fire({
   icon: 'success',
   title: "SMS Sending Process Success",
    timer: 2000,
 showConfirmButton: false,
    });
  $('#SendSms').modal('toggle');

});

        });

        function updateStatus(el) {

            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post("{{ route(Request::segment(1) . '.adminStatus') }}", {
                    _token: '{{ csrf_token() }}',
                    id: el.value,
                    status: status
                },
                function(data) {
                    if (data == 1) {
                        toastr.success('success', 'Admin Status updated successfully');
                    } else {
                        toastr.danger('danger', 'Something went wrong');
                    }
                });
        }
</script>
@endpush

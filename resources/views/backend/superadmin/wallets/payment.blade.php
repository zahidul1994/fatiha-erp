@extends('backend.layouts.master')
@section('title', 'Create Payment Reveive')
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
@endpush
@section('content')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header pb-4">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Payment Receive</p>
                            <a href="{{ route(Request::segment(1) . '.wallets.index') }}"
                                class="btn btn-primary btn-sm ms-auto"><i class="fa fa-backward"> </i>  Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @include('partial.formerror')
                            {!! Form::open(['route' => Request::segment(1) . '.paymentStore', 'method' => 'POST', 'files' => true]) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="admin_id" class="form-control-label">Select Admin * </label>
                                        {!! Form::select('admin_id',Helper::adminPluckValue(), null, ['id' => 'admin_id', 'class' =>
                                        'form-control select2', 'required','placeholder'=>'Select One']) !!}
                                        @if ($errors->has('admin_id'))
                                        <span class="text-danger alert">{{ $errors->first('admin_id') }}</span>
                                        @endif
                                    </div>
                                    </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="amount" class="form-control-label">Balance * </label>
                                        {!! Form::number('amount', null, ['id' => 'amount', 'class' =>'form-control', 'readonly','step'=>'any','min'=>1]) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="expire_date" class="form-control-label">Expire Date  * </label>
                                        {!! Form::date('expire_date', null, ['id' => 'expire_date', 'class' =>
                                        'form-control', 'readonly']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="packagePrice" class="form-control-label">Per Day Price (<span id="package"></span> ) </label>
                                        {!! Form::number('package_price', null, ['id' => 'packagePrice', 'class' =>
                                        'form-control', 'readonly']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="new_expire_date" class="form-control-label">New Expire Date  (<span id="days"></span> ) * </label>
                                        {!! Form::date('new_expire_date', null, ['id' => 'newExpireDate', 'class' =>
                                        'form-control', 'readonly']) !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="note" class="form-control-label">Note </label>
                                        {!! Form::textarea('note',null, ['id' => 'note','class'
                                        => 'form-control','rows'=>2
                                        ]) !!}
                                        @if ($errors->has('note')) <span class="text-danger alert">{{ $errors->first('note')
                                            }}</span> @endif
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Submit</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<!-- CKEditor init -->
<script src="{{ asset('backend/assets/select2/js/select2.min.js') }}"></script>

<script>
 $(".select2").select2();
$(document).ready(function () {

$('#admin_id').change(function(){

  $('#balance').val('');
 var admin = $(this).val();
$.ajax({
        type: "GET",
        url: url + '/get-admin-information/'+admin,
        dataType: "JSON",
        success:function(data) {
         if(data){
          $('#amount').val(data.balance);
          $('#expire_date').val(data.expireDate);
          $('#packagePrice').val(data.packagePrice);
          $('#newExpireDate').val(data.newExpireDate);
          $('#package').html(data.package);
          $('#days').html(data.days);

          }
            },
    });
  });

});
  </script>

@endpush




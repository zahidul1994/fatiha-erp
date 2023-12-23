@extends('backend.layouts.master')
@section('title', 'Create Expense')
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
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <div class="card-header pb-4">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Expense Create (Cash)</p>
                            <a href="{{ route(Request::segment(1) . '.expenses.index') }}"
                                class="btn btn-primary btn-sm ms-auto"><i class="fa fa-backward"> </i>  Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @include('partial.formerror')
                            {!! Form::open(['route' => Request::segment(1) . '.expenses.store', 'method' => 'POST', 'files' => true]) !!}
                            @include('backend.common.expenses.form')
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
 $(".select2").select2({
  tags: true
});
$(document).ready(function () {
    $('#payment_method').change(function(){
    if($(this).val()=='Bkash'|| $(this).val()=='Nagad' || $(this).val()=='Rocket'){
$('#MobileBankPayment').removeClass('d-none');
$('#BankPayment').addClass('d-none');
$('#paid').prop('disabled', false);
}
else if($(this).val()=='Bank'){
 $('#BankPayment').removeClass('d-none');
 $('#MobileBankPayment').addClass('d-none');
 $('#paid').prop('disabled', false);
}

else{
  $('#paid').prop('disabled', false);
 $('#MobileBankPayment').addClass('d-none');
 $('#BankPayment').addClass('d-none');

}
 });
    $('#image').change(function(event){
    let file=event.target.files[0];
            let reader = new FileReader();
            if (file.size > 800 * 800) {
                event.target.value = "";
      alert('Please Upload Image Size Less Than 500kb');
        return false;
      }
            reader.onload = (e) => {

              $('#preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

    });
    $('#preview').click(function(event){
    $('#image').click();
    });
});
  </script>

@endpush




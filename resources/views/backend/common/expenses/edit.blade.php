@extends('backend.layouts.master')
@section('title', 'Update Expense')
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
                            <p class="mb-0">Expense Update (Cash)</p>
                            <a href="{{ route(Request::segment(1) . '.expenses.index') }}"
                                class="btn btn-primary btn-sm ms-auto"><i class="fa fa-backward"> </i>  Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @include('partial.formerror')
                            {!! Form::model($expense, [
                                'route' => [Request::segment(1) . '.expenses.update', $expense->id],
                                'method' => 'PATCH',
                                'files' => true,
                            ]) !!}

                           <div class="row">
                           <div class="col-md-4 col-sm-1">
            <label for="date">Date *</label>
            {!! Form::date('date', date('Y-m-d'), ['id' => 'date', 'class' => 'form-control', 'required', 'tabindex' => 1,'autofocus']) !!}

          </div>


    <div class="col-sm-8">
            <label for="expense_head_id" class="mt-2">Select Expense Head * </label>
             {!! Form::select('expense_head_id',Helper::expenseHeadPluckValue(), null, ['id' => 'expense_head_id', 'class' =>
             'form-control select2', 'required','placeholder'=>'Select One']) !!}
             @if ($errors->has('expense_head_id'))
             <span class="text-danger alert">{{ $errors->first('expense_head_id') }}</span>
             @endif
            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="credit" class="form-control-label">Amount (Expense) * </label>
                                    {!! Form::text('expense_amount', null, ['id' => 'expense_amount', 'class' =>'form-control', 'required']) !!}
                                </div>
                            </div>
                            <div class="col-sm-6">
            <label for="expense_head_id" class="mt-2">Select Payment Method * </label>
             {!! Form::select('payment_method',Helper::paymentMethodPluckValue(), null, ['id' => 'payment_method', 'class' =>
             'form-control select2', 'required','placeholder'=>'Select One']) !!}
             @if ($errors->has('payment_method'))
             <span class="text-danger alert">{{ $errors->first('payment_method') }}</span>
             @endif
            </div>
            <div class=" row d-none" id="MobileBankPayment">
  <div class="col-md-6">
    <div class="form-group">
      <label for="phone_number" class="form-control-label">Sending Mobile Number * </label>
      {!! Form::tel('phone_number',null, ['id' => 'phone_number', 'class' =>'form-control']) !!}
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label for="transaction_number" class="form-control-label">Transaction Number/ID * </label>
      {!! Form::text('transaction_number',null, ['id' => 'paid', 'class' =>'form-control'
      ]) !!}
    </div>
  </div>
</div>
<div class=" row d-none" id="BankPayment">
  <div class="col-md-6">
    <div class="form-group">
      <label for="bank_name" class="form-control-label">Bank Name * </label>
      {!! Form::text('bank_name',null, ['id' => 'bank_name', 'class' =>'form-control']) !!}
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label for="bank_account_number" class="form-control-label">Bank Acouunt NO * </label>
      {!! Form::number('bank_account_number',null, ['id' => 'bank_account_number', 'class' =>'form-control'
      ]) !!}
    </div>
  </div>
</div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="notes" class="form-control-label">Note </label>
                                    {!! Form::textarea('notes',null, ['id' => 'notes','class'
                                    => 'form-control','rows'=>2
                                    ]) !!}
                                    @if ($errors->has('notes')) <span class="text-danger alert">{{ $errors->first('notes')
                                        }}</span> @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">

   <div class="col-6 mt-5">

           <div class="d-flex" title="Please Click The Choose File For Upload Photo">
             {!!Form::file('attachment', array('accept'=>".jpg,.jpeg,.png","id"=>"image",'class'=>'form-control'))!!}
           </div>

         </div>
         <div class="col-6">
           @if (Request::segment(3)=='create')
             <img id="preview" title="Please Click The Choose File For Upload Photo"
             class="w-100 border-radius-lg shadow-lg mt-3" src="{{url('/backend/assets/img/uploadphoto.png')}}"
             alt="preview image" style="max-height: 250px;">
             @else
             <img id="preview" title="Please Click The Choose File For Upload Photo"
             class="w-100 border-radius-lg shadow-lg mt-3" src="{{url(@$expense->path.'/'.@$expense->attachment) }}"
             alt="preview image" style="max-height: 250px;">
             @endif
         </div>
   </div>

                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Update</button>
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
    $('.select2').select2();
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



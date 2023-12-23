<div class="row">
<div class="col-md-3 col-sm-1">
            <label for="date">Date *</label>
            {!! Form::date('date', date('Y-m-d'), ['id' => 'date', 'class' => 'form-control', 'required', 'tabindex' => 1,'autofocus']) !!}

          </div>
<div class="col-md-3 col-sm-1 mt-1">
            <label for="shop_id">Shop *</label>
            {!! Form::select('shop_id',Helper::shopPluckValue(), null, ['id' => 'shop_id', 'class' => 'form-control select2', 'tabindex' => 3]) !!}

          </div>

    <div class="col-sm-6">
            <label for="expense_head_id" class="mt-2">Select Expense Head * </label>
             {!! Form::select('expense_head_id',Helper::expenseHeadPluckValue(), null, ['id' => 'expense_head_id', 'class' =>
             'form-control select2', 'required','placeholder'=>'Select One']) !!}
             @if ($errors->has('expense_head_id'))
             <span class="text-danger alert">{{ $errors->first('expense_head_id') }}</span>
             @endif
            </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="expense_amount" class="form-control-label">Amount * </label>
            {!! Form::text('expense_amount', null, ['id' => 'price', 'class' =>'form-control', 'required','placeholder'=>'Expense Amount']) !!}
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
            <label for="note" class="form-control-label">Note </label>
            {!! Form::textarea('note',null, ['id' => 'note','class'
            => 'form-control','rows'=>2, 'placeholder'=>"Expence Note"
            ]) !!}
            @if ($errors->has('note')) <span class="text-danger alert">{{ $errors->first('note')
                }}</span> @endif
        </div>
    </div>
    <div class="row">

    <div class="col-6 mt-5">

            <div class="d-flex" title="Please Click The Choose File For Upload Photo">
              {!!Form::file('attachfile', array('accept'=>".jpg,.jpeg,.png","id"=>"image",'class'=>'form-control'))!!}
            </div>

          </div>
          <div class="col-6">
            @if (Request::segment(3)=='create')
              <img id="preview" title="Please Click The Choose File For Upload Photo"
              class="w-100 border-radius-lg shadow-lg mt-3" src="{{url('/backend/assets/img/uploadphoto.png')}}"
              alt="preview image" style="max-height: 250px;">
              @else
              <img id="preview" title="Please Click The Choose File For Upload Photo"
              class="w-100 border-radius-lg shadow-lg mt-3" src="{{url(@$product->path.'/'.@$product->photo) }}"
              alt="preview image" style="max-height: 250px;">
              @endif
          </div>
    </div>


</div>

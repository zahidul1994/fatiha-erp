<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="customer_name" class="form-control-label">Customer Name  *  </label>
            {!! Form::text('customer_name', null, ['id' => 'customer_name', 'class' => 'form-control', 'required']) !!}
            @if ($errors->has('customer_name'))
            <span class="text-danger alert">{{ $errors->first('customer_name') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="customer_phone" class="form-control-label">Customer Phone * </label>
            {!! Form::tel('customer_phone', null, ['id' => 'customer_phone', 'class' => 'form-control', 'required']) !!}
            @if ($errors->has('customer_phone'))
            <span class="text-danger alert">{{ $errors->first('customer_phone') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="customer_email" class="form-control-label">Customer Email *</label>
            {!! Form::email('customer_email', null, ['id' => 'customer_email', 'class' => 'form-control','required']) !!}
            @if ($errors->has('customer_email'))
            <span class="text-danger alert">{{ $errors->first('customer_email') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="address" class="form-control-label">Customer Address *</label>
            {!! Form::textarea('address', null, ['id' => 'address', 'class' => 'form-control','required','rows'=>1]) !!}
            @if ($errors->has('address'))
            <span class="text-danger alert">{{ $errors->first('address') }}</span>
            @endif
        </div>
    </div>
   
    <div class="col-md-6">
        <div class="form-group">
            <label for="birth_date" class="form-control-label">Birth  Date</label>
            {!! Form::date('birth_date', null, ['id' => 'birth_date', 'class' => 'form-control']) !!}
            @if ($errors->has('birth_date'))
            <span class="text-danger alert">{{ $errors->first('birth_date') }}</span>
            @endif
        </div>
    </div>   
   
    <div class="col-md-6">
        <div class="form-group">
            <label for="status" class="form-control-label">Status * </label>
            {!! Form::select('status',[1=>'Active',0=>'In-Active'],null, ['id' => 'status','class' => 'form-control
            select2','required'
            ]) !!}
            @if ($errors->has('status')) <span class="text-danger alert">{{ $errors->first('status') }}</span> @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="supplier_name" class="form-control-label">Supplier Name  *  </label>
            {!! Form::text('supplier_name', null, ['id' => 'supplier_name', 'class' => 'form-control', 'required']) !!}
            @if ($errors->has('supplier_name'))
            <span class="text-danger alert">{{ $errors->first('supplier_name') }}</span>
            @endif
        </div>
    </div>
    

    <div class="col-md-6">
        <div class="form-group">
            <label for="supplier_phone" class="form-control-label">Supplier Phone * </label>
            {!! Form::tel('supplier_phone', null, ['id' => 'supplier_phone', 'class' => 'form-control', 'required']) !!}
            @if ($errors->has('supplier_phone'))
            <span class="text-danger alert">{{ $errors->first('supplier_phone') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="supplier_email" class="form-control-label">Supplier Email * </label>
            {!! Form::email('supplier_email', null, ['id' => 'supplier_email', 'class' => 'form-control','required']) !!}
            @if ($errors->has('supplier_email'))
            <span class="text-danger alert">{{ $errors->first('supplier_email') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="supplier_country" class="form-control-label">Supplier Country * </label>
            {!! Form::select('supplier_country', Helper::countryPluckValue(), null, ['id' => 'supplier_country', 'class' =>
            'form-control select2', 'required']) !!}
             @if ($errors->has('supplier_country'))
             <span class="text-danger alert">{{ $errors->first('supplier_country') }}</span>
             @endif
        </div>
    </div>
    
    <div class="col-md-12">
        <div class="form-group">
            <label for="supplier_address" class="form-control-label"> Supplier Address</label>
            {!! Form::textarea('supplier_address', null, ['id' => 'supplier_address', 'class' => 'form-control','rows'=>1]) !!}
            @if ($errors->has('supplier_address'))
            <span class="text-danger alert">{{ $errors->first('supplier_address') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="bank_account_name" class="form-control-label">Bank Account Name  *  </label>
            {!! Form::text('bank_account_name', null, ['id' => 'bank_account_name', 'class' => 'form-control', 'required']) !!}
            @if ($errors->has('bank_account_name'))
            <span class="text-danger alert">{{ $errors->first('bank_account_name') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="bank_account_number" class="form-control-label">Bank Account Number  *  </label>
            {!! Form::text('bank_account_number', null, ['id' => 'bank_account_number', 'class' => 'form-control', 'required']) !!}
            @if ($errors->has('bank_account_number'))
            <span class="text-danger alert">{{ $errors->first('bank_account_number') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="swift_code" class="form-control-label">SWIFT Code  *  </label>
            {!! Form::text('swift_code', null, ['id' => 'swift_code', 'class' => 'form-control', 'required']) !!}
            @if ($errors->has('swift_code'))
            <span class="text-danger alert">{{ $errors->first('swift_code') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="bank_currency" class="form-control-label">Bank Currency  *  </label>
            {!! Form::select('bank_currency',Helper::currencyPluckValue(), null, ['id' => 'bank_currency', 'class' => 'form-control select2','class' => 'form-control select2', 'placeholder'=>'Select One ', 'required']) !!}
            @if ($errors->has('bank_currency'))
            <span class="text-danger alert">{{ $errors->first('bank_currency') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="bank_name" class="form-control-label">Bank Name  *  </label>
            {!! Form::text('bank_name', null, ['id' => 'bank_name', 'class' => 'form-control', 'required']) !!}
            @if ($errors->has('bank_name'))
            <span class="text-danger alert">{{ $errors->first('bank_name') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="bank_address" class="form-control-label"> Bank Address</label>
            {!! Form::textarea('bank_address', null, ['id' => 'bank_address', 'class' => 'form-control','rows'=>1]) !!}
            @if ($errors->has('bank_address'))
            <span class="text-danger alert">{{ $errors->first('bank_address') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="status" class="form-control-label">Status * </label>
            {!! Form::select('status',[1=>'Active',0=>'In-Active'],null, ['id' => 'status','class' => 'form-control
            select2','required'
            ]) !!}
            @if ($errors->has('status')) <span class="text-danger alert">{{ $errors->first('status') }}</span> @endif
        </div>
    </div>
</div>
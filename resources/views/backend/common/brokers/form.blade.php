<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="broker_name" class="form-control-label">Broker Name  *  </label>
            {!! Form::text('broker_name', null, ['id' => 'broker_name', 'class' => 'form-control', 'required']) !!}
            @if ($errors->has('broker_name'))
            <span class="text-danger alert">{{ $errors->first('broker_name') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="broker_phone" class="form-control-label">Broker Phone * </label>
            {!! Form::tel('broker_phone', null, ['id' => 'broker_phone', 'class' => 'form-control', 'required']) !!}
            @if ($errors->has('broker_phone'))
            <span class="text-danger alert">{{ $errors->first('broker_phone') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="broker_email" class="form-control-label">Broker Email </label>
            {!! Form::email('broker_email', null, ['id' => 'broker_email', 'class' => 'form-control']) !!}
            @if ($errors->has('broker_email'))
            <span class="text-danger alert">{{ $errors->first('broker_email') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="address" class="form-control-label">Broker Address *</label>
            {!! Form::textarea('address', null, ['id' => 'address', 'class' => 'form-control','required','rows'=>1]) !!}
            @if ($errors->has('address'))
            <span class="text-danger alert">{{ $errors->first('address') }}</span>
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
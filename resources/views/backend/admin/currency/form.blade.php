<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="currency_name" class="form-control-label">Currency Name * </label>
            {!! Form::text('currency_name', null, ['id' => 'currency_name', 'class' => 'form-control', 'required']) !!}
            @if ($errors->has('currency_name'))
            <span class="text-danger alert">{{ $errors->first('currency_name') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="currency_rate" class="form-control-label">Currency Rate * </label>
            {!! Form::number('currency_rate', null, ['id' => 'currency_rate', 'class' => 'form-control', 'step'=>'any', 'required','max'=>99999]) !!}
            @if ($errors->has('currency_rate'))
            <span class="text-danger alert">{{ $errors->first('currency_rate') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="currency_symbol" class="form-control-label">Currency Symbol * </label>
            {!! Form::select('currency_symbol',Helper::symbolIcon(),null, ['id' => 'currency_symbol','class' => 'form-control
            select2','required'
            ]) !!}
            @if ($errors->has('currency_symbol')) <span class="text-danger alert">{{ $errors->first('currency_symbol') }}</span> @endif
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
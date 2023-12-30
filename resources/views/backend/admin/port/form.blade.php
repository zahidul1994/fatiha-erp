<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="port_name" class="form-control-label">Port Name * </label>
            {!! Form::text('port_name', null, ['id' => 'port_name', 'class' => 'form-control', 'required']) !!}
            @if ($errors->has('port_name'))
            <span class="text-danger alert">{{ $errors->first('port_name') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="port_address" class="form-control-label">Port Address * </label>
            {!! Form::text('port_address', null, ['id' => 'port_address', 'class' => 'form-control', 'required']) !!}
            @if ($errors->has('port_address'))
            <span class="text-danger alert">{{ $errors->first('port_address') }}</span>
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
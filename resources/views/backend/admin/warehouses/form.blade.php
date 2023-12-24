<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="warehouse_name" class="form-control-label">Warehouse Name * </label>
            {!! Form::text('warehouse_name', null, ['id' => 'warehouse_name', 'class' => 'form-control', 'required']) !!}
            @if ($errors->has('warehouse_name'))
            <span class="text-danger alert">{{ $errors->first('warehouse_name') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="warehouse_phone" class="form-control-label">Warehouse Phone Number * </label>
            {!! Form::tel('warehouse_phone', null, ['id' => 'warehouse_phone', 'class' => 'form-control', 'required','max'=>11]) !!}
            @if ($errors->has('warehouse_phone'))
            <span class="text-danger alert">{{ $errors->first('warehouse_phone') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="warehouse_email" class="form-control-label">Warehouse  Email Address  </label>
            {!! Form::email('warehouse_email', null, ['id' => 'warehouse_email', 'class' => 'form-control', 'max'=>11]) !!}
            @if ($errors->has('warehouse_email'))
            <span class="text-danger alert">{{ $errors->first('warehouse_email') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="warehouse_address" class="form-control-label">Warehouse  Address  *</label>
            {!! Form::textarea('warehouse_address', null, ['id' => 'warehouse_address', 'class' => 'form-control','required','rows'=>1]) !!}
            @if ($errors->has('warehouse_address'))
            <span class="text-danger alert">{{ $errors->first('warehouse_address') }}</span>
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
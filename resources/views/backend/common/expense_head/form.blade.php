<div class="row">
    

    <div class="col-md-12">
        <div class="form-group">
            <label for="expense_name" class="form-control-label">Expense Head Name [Ex: Expense Category] * </label>
            {!! Form::text('expense_name', null, ['id' => 'expense_name','placeholder' => 'Expense Head', 'class' => 'form-control','required']) !!}
            @if ($errors->has('expense_name'))
            <span class="text-danger alert">{{ $errors->first('expense_name') }}</span>
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
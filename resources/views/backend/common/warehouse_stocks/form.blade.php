<div class="row">
   
    <div class="col-md-12">
      <div class="form-group">
        <label for="product_name" class="form-control-label">Product Name</label>
        {!! Form::text('product_name',null, ['id' => 'product_name','class'
        => 'form-control','readonly']) !!}
  
      </div>
    </div>
   
    <div class="col-md-6">
      <div class="form-group">
        <label for="last_purchase_price" class="form-control-label">Last Purehase Price</label>
        {!! Form::text('last_purchase_price',null, ['id' => 'last_purchase_price','class'
        => 'form-control','readonly']) !!}
  
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="last_purchase_vat" class="form-control-label">Last Purehase Vat</label>
        {!! Form::text('last_purchase_vat',null, ['id' => 'last_purchase_vat','class'
        => 'form-control','readonly']) !!}
  
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="last_sale_price" class="form-control-label">Sale Price *</label>
        {!! Form::text('last_sale_price',null, ['id' => 'last_sale_price','class'
        => 'form-control','required','min'=>1,'max'=>999999999]) !!}
  
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="discount" class="form-control-label">Discount(%)*</label>
        {!! Form::select('discount', Helper::discoutPluckValue(), null, ['id' => 'discount', 'class' =>
            'form-control select2', 'required','placeholder'=>'Select One']) !!}
  
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label for="expire_date" class="form-control-label">Expire Date</label>
        {!! Form::date('expire_date',null, ['id' => 'expire_date', 'class' =>
        'form-control','placeholder'=>'Expire date']) !!}
  
      </div>
    </div>
    </div>
  
  
  
<div class="col-md-12">
   
    <div class="col-md-12 col-sm-1 mt-1">
        <label for="name" class="form-control-label">Title * </label>
        {!! Form::text('title', null, ['id' => 'title', 'class' => 'form-control', 'required']) !!}
        @if ($errors->has('title'))
            <span class="text-danger alert">{{ $errors->first('title') }}</span>
        @endif
    </div>
    <div class="row">
    <div class="col-md-6 col-sm-1 mt-1">
        <label for="shop_id">Shop *</label>
        {!! Form::select('shop_id',Helper::shopPluckValue(), null, ['id' => 'shop_id', 'class' => 'form-control select2', 'tabindex' => 2]) !!}
      
      </div>
      <div class="col-md-6 col-sm-1 mt-1">
        <label>Discount (%)  *</label>
        {!! Form::select('product_new_discount', Helper::discoutPluckValue(), null, ['id' => 'product_new_discount', 'class' =>
        'form-control select2', 'required','placeholder'=>'Select One']) !!}
        @if ($errors->has('product_new_discount'))
        <span class="text-danger alert">{{ $errors->first('product_new_discount') }}</span>
        @endif
      </div>
    </div>
    @if (Request::segment(3)=='create')
    <button title="queryModal" type="button"  class="btn btn-primary mt-2 ms-auto" data-bs-toggle="modal" data-bs-target="#queryModal">
        Select Query
      </button>
    <div class="form-group">
        <label for="product_ids" class="form-control-label">Select Product *  [Select Minimum One]
        </label>
        {!! Form::select('product_ids[]',[], null, ['id' => 'product_ids', 'class' => 'form-control select2','multiple'=>true,'required']) !!}
        @if ($errors->has('product_ids'))
            <span class="text-danger alert">{{ $errors->first('product_ids') }}</span>
        @endif
    </div>
    @else
    <button title="query modal" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#queryModal">
        Update Query
      </button>
    <div class="form-group">
        <label for="product_ids" class="form-control-label">Select Product *  [Select Minimum One]</label>
        {!! Form::select('product_ids[]',$shopProducts, json_decode($procategory->product_ids), ['id' => 'product_ids', 'class' => 'form-control select2','multiple'=>true,'required']) !!}
        @if ($errors->has('product_ids'))
            <span class="text-danger alert">{{ $errors->first('product_ids') }}</span>
        @endif
    </div>
    @endif
   
   
    
    <div id='queryinfo'></div>
</div>


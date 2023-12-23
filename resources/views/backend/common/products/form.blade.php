@php
  if (Request::segment(3)=='create'){
    $setup= Helper::companySetup();
  }
   

@endphp
<div class="row mt-4">
  <div class="col-lg-4">
    <div class="card h-100">
      <div class="card-body">
        <h5 class="font-weight-bolder">Product Image</h5>
        <div class="row">
          <div class="col-12">
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
          <div class="col-12 mt-5">

            <div class="d-flex" title="Please Click The Choose File For Upload Photo">
              {!!Form::file('photo', array('accept'=>".jpg,.jpeg,.png","id"=>"image",'class'=>'form-control'))!!}
            </div>

          </div>
          <div class="col-12 mt-3">
            <label for="made_in" class="mt-4">Made In</label>
            {!! Form::select('made_in', Helper::countryPluckValue(), null, ['id' => 'made_in', 'class' =>
            'form-control select2', 'required']) !!}
            @if ($errors->has('made_in')) <span class="text-danger alert">{{ $errors->first('made_in') }}</span> @endif
         </div>
         <div class="col-12 mt-3">
          <label for="discount" class="mt-4">Discount (%) *</label>
          {!! Form::select('discount', Helper::discoutPluckValue(),  @$setup->default_discount?:null, ['id' => 'discount', 'class' =>
          'form-control select2', 'required','placeholder'=>'Select One']) !!}
          @if ($errors->has('discount'))
          <span class="text-danger alert">{{ $errors->first('discount') }}</span>
          
          @endif
        </div>
          <div class="col-12 mt-3">
            <label for="expire_date">Expire Date</label>
        {!! Form::date('expire_date',null, ['id' => 'expire_date', 'class' =>
        'form-control','placeholder'=>'Expire date']) !!}
        @if ($errors->has('expire_date'))
        <span class="text-danger alert">{{ $errors->first('expire_date') }}</span>
        @endif
          </div>
          <div class="col-12 mt-3">
            <label for="status">Status</label>
            {!! Form::select('status',[1=>'Active',0=>'In-Active'],null, ['id' => 'status','class' => 'form-control select2','required'
            ]) !!}
            @if ($errors->has('status')) <span class="text-danger alert">{{ $errors->first('status') }}</span> @endif
          </div>
          
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-8 mt-lg-0 mt-4">
    <div class="card">
      <div class="card-body">
        <h5 class="font-weight-bolder">Product Information</h5>
        <div class="row">
          <div class="col-12 col-sm-4">
            <label for="brand_id" >Select Brand * </label>
            {!! Form::select('brand_id',Helper::brandPluckValue(), @$setup->default_brand_id?:null, ['id' => 'brand_id', 'class' =>
            'form-control select2', 'required']) !!}
            @if ($errors->has('brand_id'))
            <span class="text-danger alert">{{ $errors->first('brand_id') }}</span>
            @endif
          </div>
          <div class="col-12 col-sm-5">
            <label>Product Name</label>
            {!! Form::text('product_name', null, ['id' => 'product_name','class' =>
            'form-control','required','placeholder'=>'Your Product Name'
            ]) !!}
            @if ($errors->has('product_name')) <span class="text-danger alert">{{ $errors->first('product_name')
              }}</span>
            @endif
          </div>
          <div class="col-12 col-sm-3 mt-3 mt-sm-0">
            <label for="weight_size">Weight/Size & Unit *</label>
            <div class="input-group">
            
            {!! Form::text('weight_size', null, ['id' => 'weight_size','class' => 'form-control','required','placeholder'=>'1'
            ]) !!}
            @if ($errors->has('weight_size')) <span class="text-danger alert">{{ $errors->first('weight_size') }}</span>
            @endif
           
            {!! Form::select('unit', Helper::unitPluckValue(), @$setup->default_unit?:null, ['id' => 'unit', 'class' =>
            'form-control', 'required']) !!}
            @if ($errors->has('unit'))
            <span class="text-danger alert">{{ $errors->first('unit') }}</span>
            @endif

          </div>
          </div>
          
        </div>
        <div class="row">
          <div class="col-md-4">
            <label class="mt-4">HS Code *</label>
            <div class="input-group">
              {!! Form::number('hs_code', null, ['id' => 'hsCode','class' => 'form-control','required',
              ]) !!}
             
              <button class="btn btn-outline-primary mb-0" type="button" id="hsCodeBtn"><i title="Click Here"
                  class="fa fa-random"></i></button>
                  @if ($errors->has('hs_code')) <span class="text-danger alert">{{ $errors->first('hs_code') }}</span>
                  @endif
            </div>
          </div>
          <div class="col-md-4">
            <label for="unit_price" class="mt-4">Unit Price *</label>
            
            {!! Form::text('unit_price', null, ['id' => 'unit_price','class' =>
            'form-control','required','data-cell'=>"U1",'data-format'=>"0[.]00", 'onkeypress'=>"calculateFx()", 'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('unit_price')) <span class="text-danger alert">{{ $errors->first('unit_price')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="cd" class="mt-4">CD (%) *</label>
            {!! Form::text('cd', null, ['id' => 'cd','class' =>
            'form-control','required','data-cell'=>"A1",'data-format'=>"0[.]00", 'onkeypress'=>"calculateFx()", 'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('cd')) <span class="text-danger alert">{{ $errors->first('cd')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="rd" class="mt-4">RD  (%) *</label>
            {!! Form::text('rd', null, ['id' => 'rd','class' =>
            'form-control','required','data-cell'=>"B1",'data-format'=>"0[.]00", 'onkeypress'=>"calculateFx()", 'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('rd')) <span class="text-danger alert">{{ $errors->first('rd')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="cd_rd_value" class="mt-4">CD+RD Value (Total) *</label>
            {!! Form::text('cd_rd_value', null, ['id' => 'rd','class' =>
            'form-control','required','data-cell'=>"CDRD1",'data-format'=>"0[.]00",'data-formula'=>"SUM(U1,((U1/100)*(A1+B1)))", 'readonly'
            ]) !!}
            
          </div>
          <div class="col-md-4">
            <label for="sd" class="mt-4">SD  (%) *</label>
            {!! Form::text('sd', null, ['id' => 'sd','class' =>
            'form-control','required','data-cell'=>"C1",'data-format'=>"0[.]00", 'onkeypress'=>"calculateFx()", 'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('sd')) <span class="text-danger alert">{{ $errors->first('sd')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="sd_value" class="mt-4">SD Value  (Total) *</label>
            {!! Form::text('sd_value', null, ['id' => 'sd_value','class' =>
            'form-control','required','data-cell'=>"SDVALUE1",'data-format'=>"0[.]00",'data-formula'=>"SUM(CDRD1,((CDRD1/100)*(C1)))", 'readonly'
            ]) !!}
            
          </div>
          <div class="col-md-4">
            <label for="vat" class="mt-4">Vat (%)*</label>
            {!! Form::text('vat', null, ['id' => 'vat','class' =>
            'form-control','required','data-cell'=>"D1",'data-format'=>"0[.]0", 'onkeypress'=>"calculateFx()", 'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('vat')) <span class="text-danger alert">{{ $errors->first('vat')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="vat_value" class="mt-4">Vat Value  (Total) *</label>
            {!! Form::text('vat_value', null, ['id' => 'vat_value','class' =>
            'form-control','required','data-cell'=>"VATVALUE1",'data-format'=>"0[.]00",'data-formula'=>"SUM(SDVALUE1,((SDVALUE1/100)*(D1)))", 'readonly'
            ]) !!}
            
          </div>
          <div class="col-md-4">
            <label for="ait" class="mt-4">AIT (%) *</label>
            {!! Form::text('ait', null, ['id' => 'ait','class' =>
            'form-control','required','data-cell'=>"F1",'data-format'=>"0[.]00", 'onkeypress'=>"calculateFx()", 'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('ait')) <span class="text-danger alert">{{ $errors->first('ait')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="ait_value" class="mt-4">AIT Value  (Total) *</label>
            {!! Form::text('ait_value', null, ['id' => 'ait_value','class' =>
            'form-control','required','data-cell'=>"AITVALUE1",'data-format'=>"0[.]00",'data-formula'=>"SUM(CDRD1,((CDRD1/100)*(F1)))", 'readonly'
            ]) !!}
            
          </div>
          <div class="col-md-4">
            <label for="at" class="mt-4">AT *</label>
            {!! Form::text('at', null, ['id' => 'at','class' =>
            'form-control','required','data-cell'=>"G1",'data-format'=>"0[.]00", 'onkeypress'=>"calculateFx()", 'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('at')) <span class="text-danger alert">{{ $errors->first('at')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="at_value" class="mt-4">AT Value  (Total) *</label>
            {!! Form::text('at_value', null, ['id' => 'at_value','class' =>
            'form-control','required','data-cell'=>"ATALUE1",'data-format'=>"0[.]00",'data-formula'=>"SUM(CDRD1,((CDRD1/100)*(G1)))", 'readonly'
            ]) !!}
            
          </div>
          <div class="col-md-4">
            <label for="atv" class="mt-4">ATV *</label>
            {!! Form::text('atv', null, ['id' => 'atv','class' =>
            'form-control','required','data-cell'=>"H1",'data-format'=>"0[.]00", 'onkeypress'=>"calculateFx()", 'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('atv')) <span class="text-danger alert">{{ $errors->first('atv')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="atv_value" class="mt-4">ATV Value  (Total) *</label>
            {!! Form::text('atv_value', null, ['id' => 'atv_value','class' =>
            'form-control','required','data-cell'=>"ATVALUE1",'data-format'=>"0[.]00",'data-formula'=>"SUM(CDRD1,((CDRD1/100)*(H1)))", 'readonly'
            ]) !!}
            
          </div>
    {{-- mark::total_duty --}}
          <div class="col-md-4">
            <label for="total_duty" class="mt-4">Total Duty *</label>
            {!! Form::text('total_duty', null, ['id' => 'total_duty','class' =>
            'form-control','readonly','data-cell'=>"I1",'data-format'=>"0[.]00", 'data-formula'=>"SUM(A1,B1,C1,D1,E1,F1,G1,H1)"
            ]) !!}
            @if ($errors->has('total_duty')) <span class="text-danger alert">{{ $errors->first('total_duty')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="insurance" class="mt-4">Insurance *</label>
            {!! Form::text('insurance', null, ['id' => 'insurance','class' =>
            'form-control','required','data-cell'=>"J1",'data-format'=>"0[.]00", 'onkeypress'=>"calculateFx()", 'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('insurance')) <span class="text-danger alert">{{ $errors->first('insurance')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="bank_charge" class="mt-4">Bank Charge *</label>
            {!! Form::text('bank_charge', null, ['id' => 'bank_charge','class' =>
            'form-control','required','data-cell'=>"K1",'data-format'=>"0[.]00", 'onkeypress'=>"calculateFx()", 'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('bank_charge')) <span class="text-danger alert">{{ $errors->first('bank_charge')
              }}</span>
            @endif
          </div>
    
          <div class="col-md-4">
            <label for="clearing" class="mt-4">Clearing Charge *</label>
            {!! Form::text('clearing', null, ['id' => 'clearing','class' =>
            'form-control','required','data-cell'=>"L1",'data-format'=>"0[.]00", 'onkeypress'=>"calculateFx()", 'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('clearing')) <span class="text-danger alert">{{ $errors->first('clearing')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="carring" class="mt-4">Carring Charge *</label>
            {!! Form::number('carring', null, ['id' => 'carring','class' =>
            'form-control','required','data-cell'=>"M1",'data-format'=>"0[.]00", 'onkeypress'=>"calculateFx()", 'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('carring')) <span class="text-danger alert">{{ $errors->first('carring')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="lc_value" class="mt-4">Carring Charge *</label>
            {!! Form::number('lc_value', null, ['id' => 'lc_value','class' =>
            'form-control','required','data-cell'=>"N1",'data-format'=>"0[.]00", 'onkeypress'=>"calculateFx()", 'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('lc_value')) <span class="text-danger alert">{{ $errors->first('lc_value')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="other_cost" class="mt-4">Other Cost *</label>
            {!! Form::text('other_cost', null, ['id' => 'other_cost','class' =>
            'form-control','required','data-cell'=>"O1",'data-format'=>"0[.]00", 'onkeypress'=>"calculateFx()", 'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('other_cost')) <span class="text-danger alert">{{ $errors->first('other_cost')
              }}</span>
            @endif
          </div>
    
          <div class="col-md-4">
            <label for="purchase_price" class="mt-4">Purchase Price *</label>
            {!! Form::text('purchase_price', null, ['id' => 'purchase_price','class' =>
            'form-control','readonly','data-cell'=>"P1",'data-format'=>"0[.]00",'data-formula'=>"SUM(U1,(((A1+B1)/U1)*100))" 
            ]) !!}
            @if ($errors->has('purchase_price')) <span class="text-danger alert">{{ $errors->first('purchase_price')
              }}</span>
            @endif
          </div>
         
          <div class="col-md-4">
            <label class="mt-4">Sale Price *</label>
            {!! Form::number('sale_price', null, ['id' => 'sale_price','class' =>
            'form-control','required','step'=>'any','min'=>1, 'max'=>999999
            ]) !!}
            @if ($errors->has('sale_price')) <span class="text-danger alert">{{ $errors->first('sale_price') }}</span>
            @endif
          </div>

        </div>
        <div class="row">
          
          <div class="col-sm-12">
            <label class="mt-4">Description</label>
            <p class="form-text text-muted text-xs ms-1 d-inline">
              (optional)
            </p>
            <div id="edit-deschiption-edit" class="h-50">
              {!! Form::textarea('description', null, [
              'id' => 'description',
              'class' => 'form-control',
              'rows' => 3,
              ]) !!}
              @if ($errors->has('description'))
              <span class="text-danger alert">{{ $errors->first('description') }}</span>
              @endif
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>

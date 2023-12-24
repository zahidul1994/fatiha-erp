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
            {!! Form::select('discount', Helper::discoutPluckValue(), @$setup->default_discount?:null, ['id' =>
            'discount', 'class' =>
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
            {!! Form::select('status',[1=>'Active',0=>'In-Active'],null, ['id' => 'status','class' => 'form-control
            select2','required'
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
            <label for="brand_id">Select Brand * </label>
            {!! Form::select('brand_id',Helper::brandPluckValue(), @$setup->default_brand_id?:null, ['id' => 'brand_id',
            'class' =>
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

              {!! Form::text('weight_size', 1?:null, ['id' => 'weight_size','class' =>
              'form-control','required','placeholder'=>'1'
              ]) !!}
              @if ($errors->has('weight_size')) <span class="text-danger alert">{{ $errors->first('weight_size')
                }}</span>
              @endif

              {!! Form::select('unit', Helper::unitPluckValue(), @$setup->default_unit?:null, ['id' => 'unit', 'class'
              =>
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
            'form-control','required','data-cell'=>"U1",'data-format'=>"0[.]00",'keydown'=>'calculateFx()',
            'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('unit_price')) <span class="text-danger alert">{{ $errors->first('unit_price')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="insurance_before" class="mt-4">Insurance(B) (%) *</label>
            {!! Form::text('insurance_before', null, ['id' => 'insurance_before','class' =>
            'form-control','required','data-cell'=>"INSB1",'data-format'=>"0[.]00", 'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('insurance_before')) <span class="text-danger alert">{{ $errors->first('insurance_before')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="insurance_before_value" class="mt-4 text-xs">Insurance Value (B) *</label>
            {!! Form::text('insurance_before_value', null, ['id' => 'insurance_before_value','class' =>
            'form-control','required','data-cell'=>"INSBVAL1",'data-format'=>"0[.]00",'data-formula'=>"SUM(((U1/100)*(INSB1)))",
            'readonly'
            ]) !!}

          </div>
          <div class="col-md-4">
            <label for="clearing_before" class="mt-4"> Clearing (%) (B)*</label>
            {!! Form::text('clearing_before', null, ['id' => 'clearing_before','class' =>
            'form-control','required','data-cell'=>"CLRB1",'data-format'=>"0[.]00", 'keydown'=>"calculateFx()",
            'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('clearing_before')) <span class="text-danger alert">{{ $errors->first('clearing_before')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="clearing_before_value" class="mt-4 text-xs"> Clearing Value (B) *</label>
            {!! Form::text('clearing_before_value', null, ['id' => 'clearing_before_value','class' =>
            'form-control','required','data-cell'=>"CLRBVAL1",'data-format'=>"0[.]00",'data-formula'=>"SUM((((U1+INSBVAL1)/100)*(CLRB1)))",
            'readonly'
            ]) !!}

          </div>
          <div class="col-md-4">
            <label for="convert_rate" class="mt-4">Converted Rate *</label>

            {!! Form::text('convert_rate', null, ['id' => 'convert_rate','class' =>
            'form-control','required','data-cell'=>"CONVR1",'data-format'=>"0[.]00", 'keydown'=>"calculateFx()",
            'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('convert_rate')) <span class="text-danger alert">{{ $errors->first('convert_rate')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="duty_assessment_value" class="mt-4 text-xs"> Duty Assessment Value *</label>
            {!! Form::text('duty_assessment_value', null, ['id' => 'duty_assessment_value','class' =>
            'form-control','required','data-cell'=>"DUTYAVAL1",'data-format'=>"0[.]00",'data-formula'=>"SUM((U1+INSBVAL1+CLRBVAL1)*CONVR1)",
            'readonly'
            ]) !!}

          </div>
          <div class="col-md-4">
            <label for="cd" class="mt-4">CD (%) *</label>
            {!! Form::text('cd', null, ['id' => 'cd','class' =>
            'form-control','required','data-cell'=>"CD1",'data-format'=>"0[.]00", 'keydown'=>"calculateFx()",
            'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('cd')) <span class="text-danger alert">{{ $errors->first('cd')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="cd_value" class="mt-4">CD Value (Total) *</label>
            {!! Form::text('cd_value', null, ['id' => 'cd_value','class' =>
            'form-control','required','data-cell'=>"CDVAL1",'data-format'=>"0[.]00",'data-formula'=>"SUM(((DUTYAVAL1/100)*(CD1)))",
            'readonly'
            ]) !!}

          </div>
          <div class="col-md-4">
            <label for="rd" class="mt-4">RD (%) *</label>
            {!! Form::text('rd', null, ['id' => 'rd','class' =>
            'form-control','required','data-cell'=>"RD1",'data-format'=>"0[.]00", 'keydown'=>"calculateFx()",
            'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('rd')) <span class="text-danger alert">{{ $errors->first('rd')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="rd_value" class="mt-4">RD Value (Total) *</label>
            {!! Form::text('rd_value', null, ['id' => 'rd_value','class' =>
            'form-control','required','data-cell'=>"RDVAL1",'data-format'=>"0[.]00",'data-formula'=>"SUM(((DUTYAVAL1/100)*(RD1)))",
            'readonly'
            ]) !!}

          </div>
          <div class="col-md-4">
            <label for="cd_rd_total" class="mt-4">DAV+CD+RD</label>
            {!! Form::text('cd_rd_total', null, ['id' => 'cd_rd_total','class' =>
            'form-control','required','data-cell'=>"DAVCDRDTOTAL1",'data-format'=>"0[.]00",'data-formula'=>"SUM(DUTYAVAL1+CDVAL1+RDVAL1)",
            'readonly'
            ]) !!}

          </div>
          <div class="col-md-4">
            <label for="sd" class="mt-4">SD (%) *</label>
            {!! Form::text('sd', null, ['id' => 'sd','class' =>
            'form-control','required','data-cell'=>"SD1",'data-format'=>"0[.]00", 'keydown'=>"calculateFx()",
            'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('sd')) <span class="text-danger alert">{{ $errors->first('sd')
              }}</span>
            @endif
          </div>


          <div class="col-md-4">
            <label for="sd_value" class="mt-4">SD Value (Total) *</label>
            {!! Form::text('sd_value', null, ['id' => 'sd_value','class' =>
            'form-control','required','data-cell'=>"SDVAL1",'data-format'=>"0[.]00",'data-formula'=>"SUM(((DAVCDRDTOTAL1/100)*SD1))",
            'readonly'
            ]) !!}

          </div>
          <div class="col-md-4">
            <label for="vat" class="mt-4">Vat (%)*</label>
            {!! Form::text('vat', null, ['id' => 'vat','class' =>
            'form-control','required','data-cell'=>"VAT1",'data-format'=>"0[.]00", 'keydown'=>"calculateFx()",
            'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('vat')) <span class="text-danger alert">{{ $errors->first('vat')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="vat_value" class="mt-4">Vat Value (Total) *</label>
            {!! Form::text('vat_value', null, ['id' => 'vat_value','class' =>
            'form-control','required','data-cell'=>"VATVAL1",'data-format'=>"0[.]00",'data-formula'=>"SUM(((DAVCDRDTOTAL1/100)*VAT1))",
            'readonly'
            ]) !!}

          </div>
          <div class="col-md-4">
            <label for="ait" class="mt-4">AIT (%) *</label>
            {!! Form::text('ait', null, ['id' => 'ait','class' =>
            'form-control','required','data-cell'=>"AIT1",'data-format'=>"0[.]00", 'keydown'=>"calculateFx()",
            'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('ait')) <span class="text-danger alert">{{ $errors->first('ait')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="ait_value" class="mt-4">AIT Value (Total) *</label>
            {!! Form::text('ait_value', null, ['id' => 'ait_value','class' =>
            'form-control','required','data-cell'=>"AITVAL1",'data-format'=>"0[.]00",'data-formula'=>"SUM(((DUTYAVAL1/100)*(AIT1)))",
            'readonly'
            ]) !!}

          </div>
          <div class="col-md-4">
            <label for="at" class="mt-4">AT (%) *</label>
            {!! Form::text('at', null, ['id' => 'at','class' =>
            'form-control','required','data-cell'=>"AT1",'data-format'=>"0[.]00", 'keydown'=>"calculateFx()",
            'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('at')) <span class="text-danger alert">{{ $errors->first('at')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="at_value" class="mt-4">AT Value (Total) *</label>
            {!! Form::text('at_value', null, ['id' => 'at_value','class' =>
            'form-control','required','data-cell'=>"ATVAL1",'data-format'=>"0[.]00",'data-formula'=>"SUM((DAVCDRDTOTAL1/100)*(AT1))",
            'readonly'
            ]) !!}

          </div>
          <div class="col-md-4">
            <label for="atv" class="mt-4">ATV *</label>
            {!! Form::text('atv', null, ['id' => 'atv','class' =>
            'form-control','required','data-cell'=>"ATV1",'data-format'=>"0[.]00", 'keydown'=>"calculateFx()",
            'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('atv')) <span class="text-danger alert">{{ $errors->first('atv')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="atv_value" class="mt-4">ATV Value (Total) *</label>
            {!! Form::text('atv_value', null, ['id' => 'atv_value','class' =>
            'form-control','required','data-cell'=>"ATVVAL1",'data-format'=>"0[.]00",'data-formula'=>"SUM((DAVCDRDTOTAL1/100)*(ATV1))",
            'readonly'
            ]) !!}

          </div>

          <div class="col-md-4">
            <label for="total_duty" class="mt-4">Total Duty *</label>
            {!! Form::text('total_duty', null, ['id' => 'total_duty','class' =>
            'form-control','readonly','data-cell'=>"I1",'data-format'=>"0[.]00",
            'data-formula'=>"SUM(CD1,RD1,SD1,VAT1,AIT1,AT1,ATV1)"
            ]) !!}
            @if ($errors->has('total_duty')) <span class="text-danger alert">{{ $errors->first('total_duty')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="insurance_after" class="mt-4">Insurance (A) *</label>
            {!! Form::text('insurance_after', null, ['id' => 'insurance_after','class' =>
            'form-control','required','data-cell'=>"INSUAFTR1",'data-format'=>"0[.]00", 'keydown'=>"calculateFx()",
            'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('insurance_after')) <span class="text-danger alert">{{ $errors->first('insurance_after')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="insurance_after_value" class="mt-4 text-xs">Insurance Value (A) *</label>
            {!! Form::text('insurance_after_value', null, ['id' => 'insurance_after_value','class' =>
            'form-control','required','data-cell'=>"INSUAFTRVAL1",'data-format'=>"0[.]00",'data-formula'=>"SUM(((DUTYAVAL1/100)*(INSUAFTR1)))",
            'readonly'
            ]) !!}

          </div>
          <div class="col-md-4">
            <label for="bank_charge" class="mt-4">Bank Charge *</label>
            {!! Form::text('bank_charge', null, ['id' => 'bank_charge','class' =>
            'form-control','required','data-cell'=>"BNKCRG1",'data-format'=>"0[.]00", 'keydown'=>"calculateFx()",
            'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('bank_charge')) <span class="text-danger alert">{{ $errors->first('bank_charge')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="bank_charge_value" class="mt-4 text-xs">Bank Charge Value (A) *</label>
            {!! Form::text('bank_charge_value', null, ['id' => 'bank_charge_value','class' =>
            'form-control','required','data-cell'=>"BNKCRGVAL1",'data-format'=>"0[.]00",'data-formula'=>"SUM(((DUTYAVAL1/100)*(BNKCRG1)))",
            'readonly'
            ]) !!}

          </div>
          <div class="col-md-4">
            <label for="clearing_after" class="mt-4"> Clearing (%) (A)*</label>
            {!! Form::text('clearing_after', null, ['id' => 'clearing_after','class' =>
            'form-control','required','data-cell'=>"CLRAFTR1",'data-format'=>"0[.]00", 'keydown'=>"calculateFx()",
            'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('clearing_after')) <span class="text-danger alert">{{ $errors->first('clearing_after')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="clearing_after_value" class="mt-4 text-xs"> Clearing Value (A) *</label>
            {!! Form::text('clearing_after_value', null, ['id' => 'clearing_after_value','class' =>
            'form-control','required','data-cell'=>"CLRAFTRVAL1",'data-format'=>"0[.]00",'data-formula'=>"SUM(((DUTYAVAL1/100)*(CLRAFTR1)))",
            'readonly'
            ]) !!}

          </div>

          <div class="col-md-4">
            <label for="carrying_charge" class="mt-4">Carrying Charge *</label>
            {!! Form::number('carrying_charge', null, ['id' => 'carrying_charge','class' =>
            'form-control','required','data-cell'=>"CRRING1",'data-format'=>"0[.]00", 'keydown'=>"calculateFx()",
            'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('carrying_charge')) <span class="text-danger alert">{{ $errors->first('carrying_charge')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="carrying_value" class="mt-4 text-xs"> Carrying Value *</label>
            {!! Form::text('carrying_value', null, ['id' => 'carrying_value','class' =>
            'form-control','required','data-cell'=>"CRRINGVAL1",'data-format'=>"0[.]00",'data-formula'=>"SUM(((DUTYAVAL1/100)*(CRRING1)))",
            'readonly'
            ]) !!}

          </div>
          <div class="col-md-4">
            <label for="lc_value" class="mt-4">LC Value *</label>
            {!! Form::text('lc_value', null, ['id' => 'lc_value','class' =>
            'form-control','required','data-cell'=>"LCVAL1",'data-format'=>"0[.]00", 'keydown'=>"calculateFx()",
            'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('lc_value')) <span class="text-danger alert">{{ $errors->first('lc_value')
              }}</span>
            @endif
          </div>
          <div class="col-md-4">
            <label for="other_cost" class="mt-4">Other Cost *</label>
            {!! Form::text('other_cost', null, ['id' => 'other_cost','class' =>
            'form-control','required','data-cell'=>"OTR1",'data-format'=>"0[.]00", 'keydown'=>"calculateFx()",
            'onblur'=>"calculateFx()"
            ]) !!}
            @if ($errors->has('other_cost')) <span class="text-danger alert">{{ $errors->first('other_cost')
              }}</span>
            @endif
          </div>

          <div class="col-md-4">
            <label for="purchase_price" class="mt-4">Purchase Price *</label>
            {!! Form::text('purchase_price', null, ['id' => 'purchase_price','class' =>
            'form-control','readonly','data-cell'=>"PPRICE1",'data-format'=>"0[.]00",'data-formula'=>"SUM(CDVAL1+RDVAL1+SDVA1+AITVAL1+ATVAL1+ATVVAL1+VATVAL1+INSUAFTRVAL1+BNKCRGVAL1+CLRAFTRVAL1+CRRINGVAL1+LCVAL1+OTR1)"
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
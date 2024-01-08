@extends('backend.layouts.master')
@section('title', 'Requisition Receive')
@push('css')
<link href="{{ asset('backend/assets/select2/css/select2.min.css') }}" rel="stylesheet" />

<style>
  .select2-selection__choice {
    background-color: var(--bs-gray-200);
    border: none !important;
    font-size: 12px;
    font-size: 0.85rem !important;
  }

  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }

  .fxd {
    position: fixed;
    width: 75%;
    left: 20%;
    bottom: 0;
    text-align: center;
  }
</style>
@endpush
@section('content')
<div class="container-fluid py-4">
  <div class="row" id="dynamic">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header pb-4">
          <div class="d-flex align-items-center">
            <a href="{{ route(Request::segment(1) . '.requisition-receive.index') }}"
              class="btn btn-primary btn-sm ms-auto">Back</a>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            @include('partial.formerror')
            {!! Form::model($requisition, [
            'route' => [Request::segment(1) . '.requisition-receive.update', $requisition->id],
            'method' => 'PATCH',
            'id' => 'formReset'
            ]) !!}

            <div class="row">
              <div class="col-12 col-sm-6">
                <h5 class="font-weight-bolder mb-0">Requisition Received Form</h5>
              </div>
              <div class="col-12 col-sm-6 text-end page-custom-buttons pcb-desktop">
                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit" title="Save"><svg
                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-folder-check" viewBox="0 0 16 16">
                    <path
                      d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z" />
                    <path
                      d="M15.854 10.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.707 0l-1.5-1.5a.5.5 0 0 1 .707-.708l1.146 1.147 2.646-2.647a.5.5 0 0 1 .708 0z" />
                  </svg> Save</button>
                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" id="clear"> <svg
                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                    <path
                      d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                    <path fill-rule="evenodd"
                      d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                  </svg> Clear</button>

                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit" value="print"
                  id="print"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-printer-fill" viewBox="0 0 16 16">
                    <path
                      d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z" />
                    <path
                      d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                  </svg> Print</button>
              </div>
            </div>
            <div class="container-fluid">
              <div class="row mt-3">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-3 col-sm-1">
                      <label for="date">Date *</label>
                      {!! Form::date('date', date('Y-m-d'), ['id' => 'date', 'class' => 'form-control', 'required',
                      'tabindex' => 1,'autofocus','max'=>date('Y-m-d')]) !!}

                    </div>

                    <div class="col-md-3 col-sm-1">
                      <label for="work_order_id">Workorder Invoice </label>
                      {!!
                      Form::text('work_order_id',@Helper::getWorkorder($requisition->work_order_id)->invoice_no?:null,
                      ['id' => 'work_order_id', 'readonly','class' => 'form-control']) !!}

                    </div>
                    <div class="col-md-3 col-sm-1">
                      <label for="supplierId">Supplier * </label>
                     {!! Form::select('supplier_id',Helper::supplierPluckValue(), null, ['id' =>
                      'supplierId','disabled', 'class' => 'form-control select2','placeholder'=>'Select Supplier']) !!}
                       {!! Form::hidden('supplier_id',$requisition->supplier_id) !!}
                    </div>
                    <div class="col-md-3 col-sm-1">
                      <label for="warehouse_id">Select Warehouse * </label>
                      {!! Form::select('warehouse_id',Helper::warehousePluckValue(), null, ['id' =>
                      'warehouse_id','required', 'class' => 'form-control select2','placeholder'=>'Select One']) !!}
                    </div>


                    <div class="col-md-9 col-sm-1 mt-1">
                      <label for="note">Note</label>
                      {!! Form::textarea('description', null, ['id' => 'note', 'class' =>
                      'form-control','rows'=>1,'placeholder'=>'Note ', 'tabindex' =>2]) !!}
                    </div>
                    <div class="col-md-3 col-sm-1 mt-1">
                      <label for="note">Receive Status</label>
                      {!! Form::select('status',['Receive'=>'Receive','Partial'=>'Partial'], null, ['id' => 'note',
                      'class' =>
                      'form-control select2', 'tabindex' =>3]) !!}
                    </div>

                  </div>
                </div>
              </div>


              <div class="card mt-3 bottom-table-card">
                <div class="table table-responsive">
                  <table class="table">

                    <tbody id="itemlist">
                      @php
                      $loopKey=1;
                      @endphp
                      @foreach ($requisition->requisitiondetails as $key=>$order)
                      @php
                      $product=Helper::getProduct(@$order->product_id);
                      $loopKey +=$key;
                      @endphp


                      <tr>

                        <div class="row p-3">
                          <div class="col-md-3">
                            <label>Product Name</label>
                            {!! Form::hidden('product_id[]', $product->id) !!}
                            {!! Form::text('product_name[]', $product->product_name?:null, ['id' =>
                            'product_name','class' =>
                            'form-control','required','placeholder'=>'Your Product Name'
                            ]) !!}
                            @if ($errors->has('product_name')) <span class="text-danger alert">{{
                              $errors->first('product_name')
                              }}</span>
                            @endif
                          </div>
                          <div class="col-md-3">
                            <label for="weight_size">Weight/Size & Unit *</label>
                            <div class="input-group">

                              {!! Form::text('weight_size[]', $product->weight_size?:null, ['id' =>
                              'weight_size','class' =>
                              'form-control','required','placeholder'=>'1'
                              ]) !!}
                              @if ($errors->has('weight_size')) <span class="text-danger alert">{{
                                $errors->first('weight_size')
                                }}</span>
                              @endif

                              {!! Form::select('unit[]', Helper::unitPluckValue(), @$product->unit?:null, ['id' =>
                              'unit', 'class'
                              =>
                              'form-control', 'required']) !!}
                              @if ($errors->has('unit'))
                              <span class="text-danger alert">{{ $errors->first('unit') }}</span>
                              @endif

                            </div>
                          </div>
                          <div class="col-md-3">
                            <label for="">HS Code *</label>
                            <div class="input-group">
                              {!! Form::number('hs_code[]', @$product->hs_code?:null, ['id' => 'hsCode','class' =>
                              'form-control','required',
                              ]) !!}
                              @if ($errors->has('hs_code')) <span class="text-danger alert">{{ $errors->first('hs_code')
                                }}</span>
                              @endif
                            </div>
                          </div>

                          <div class="col-md-3">
                            <label for="">Receive Quantity *</label>
                            <div class="input-group">
                              {!! Form::number('product_quantity[]', @$order->qty?:null, ['id' => 'product_quantity','class' =>
                              'form-control','required','step'=>'any','data-cell'=>"Q$loopKey",'data-format'=>"",'keydown'=>'calculateFx()',
                              'onblur'=>"calculateFx()",
                              ]) !!}
                              @if ($errors->has('product_quantity')) <span class="text-danger alert">{{ $errors->first('product_quantity')
                                }}</span>
                              @endif
                            </div>
                          </div>

                        </div>
                        <div class="row">

                          <div class="col-md-4">
                            <label for="unit_price" class="mt-4">Unit Price *</label>

                            {!! Form::text('unit_price[]', @$product->unit_price?:null, ['id' => 'unit_price','class' =>
                            'form-control','required','data-cell'=>"U$loopKey",'data-format'=>"0[.]00",'keydown'=>'calculateFx()',
                            'onblur'=>"calculateFx()",'placeholder'=>'Unit Price'
                            ]) !!}
                            @if ($errors->has('unit_price')) <span class="text-danger alert">{{
                              $errors->first('unit_price')
                              }}</span>
                            @endif
                          </div>
                          <div class="col-md-4">
                            <label for="govt_price" class="mt-4">Gov't Price *</label>
                            {!! Form::text('govt_price[]', @$product->govt_price?:null, ['id' => 'govt_price','class' =>
                            'form-control','required','data-cell'=>"GP$loopKey",'data-format'=>"0[.]00",
                            'keydown'=>'calculateFx()',
                            'onblur'=>"calculateFx()",'placeholder'=>'Govt Price'
                            ]) !!}
                            @if ($errors->has('govt_price')) <span class="text-danger alert">{{
                              $errors->first('govt_price')
                              }}</span>
                            @endif
                          </div>
                          <div class="col-md-4">
                            <label for="insurance_before" class="mt-4">Insurance(B) (%) *</label>
                            {!! Form::text('insurance_before[]', @$product->insurance_before?:null, ['id' =>
                            'insurance_before','class' =>
                            'form-control','required','data-cell'=>"INSB$loopKey",'data-format'=>"0[.]00",
                            'onblur'=>"calculateFx()",'placeholder'=>'Insurance Before'
                            ]) !!}
                            @if ($errors->has('insurance_before')) <span class="text-danger alert">{{
                              $errors->first('insurance_before')
                              }}</span>
                            @endif
                          </div>
                          <div class="col-md-4">
                            <label for="insurance_before_value" class="mt-4 text-xs">Insurance Value (B) *</label>
                            {!! Form::text('insurance_before_value[]', @$product->insurance_before_value?:null, ['id' =>
                            'insurance_before_value','class' =>
                            'form-control','required','data-cell'=>"INSBVAL$loopKey",'data-format'=>"0[.]00",'data-formula'=>"SUM(Q$loopKey*((U$loopKey/100)*(INSB$loopKey)))",
                            'readonly'
                            ]) !!}

                          </div>
                          <div class="col-md-4">
                            <label for="clearing_before" class="mt-4"> Clearing (%) (B)*</label>
                            {!! Form::text('clearing_before[]', @$product->clearing_before?:null, ['id' =>
                            'clearing_before','class' =>
                            'form-control','required','data-cell'=>"CLRB$loopKey",'data-format'=>"0[.]00",
                            'keydown'=>"calculateFx()",
                            'onblur'=>"calculateFx()",'placeholder'=>'Clearing Before'
                            ]) !!}
                            @if ($errors->has('clearing_before')) <span class="text-danger alert">{{
                              $errors->first('clearing_before')
                              }}</span>
                            @endif
                          </div>
                          <div class="col-md-4">
                            <label for="clearing_before_value" class="mt-4 text-xs"> Clearing Value (B) *</label>
                            {!! Form::text('clearing_before_value[]', @$product->clearing_before_value?:null, ['id' =>
                            'clearing_before_value','class' =>
                            'form-control','required','data-cell'=>"CLRBVAL$loopKey",'data-format'=>"0[.]00",'data-formula'=>"SUM(Q$loopKey*((U$loopKey/100)*(CLRB$loopKey)))",
                            'readonly'
                            ]) !!}

                          </div>
                          <div class="col-md-4">
                            <label for="convert_rate" class="mt-4">Converted Rate *</label>

                            {!! Form::text('convert_rate[]', @$product->convert_rate?:null, ['id' =>
                            'convert_rate','class' =>
                            'form-control','required','data-cell'=>"CONVR$loopKey",'data-format'=>"0[.]00",
                            'keydown'=>"calculateFx()",
                            'onblur'=>"calculateFx()"
                            ]) !!}
                            @if ($errors->has('convert_rate')) <span class="text-danger alert">{{
                              $errors->first('convert_rate')
                              }}</span>
                            @endif
                          </div>
                          <div class="col-md-4">
                            <label for="duty_assessment_value" class="mt-4 text-xs"> Duty Assessment Value *</label>
                            {!! Form::text('duty_assessment_value[]', @$product->duty_assessment_value?:null, ['id' =>
                            'duty_assessment_value','class' =>
                            'form-control','required','data-cell'=>"DUTYAVAL$loopKey",'data-format'=>"0[.]00",'data-formula'=>"SUM(Q$loopKey*(GP$loopKey+INSBVAL$loopKey+CLRBVAL$loopKey)*CONVR$loopKey)",
                            'readonly'
                            ]) !!}

                          </div>
                          <div class="col-md-4">
                            <label for="cd" class="mt-4">CD (%) *</label>
                            {!! Form::text('cd[]', @$product->cd?:null, ['id' => 'cd','class' =>
                            'form-control','required','data-cell'=>"CD$loopKey",'data-format'=>"0[.]00",
                            'keydown'=>"calculateFx()",
                            'onblur'=>"calculateFx()",'placeholder'=>'CD'
                            ]) !!}
                            @if ($errors->has('cd')) <span class="text-danger alert">{{ $errors->first('cd')
                              }}</span>
                            @endif
                          </div>
                          <div class="col-md-4">
                            <label for="cd_value" class="mt-4">CD Value (Total) *</label>
                            {!! Form::text('cd_value[]', @$product->cd_value?:null, ['id' => 'cd_value','class' =>
                            'form-control','required','data-cell'=>"CDVAL$loopKey",'data-format'=>"0[.]00",'data-formula'=>"SUM(((DUTYAVAL$loopKey/100)*(CD$loopKey)))",
                            'readonly'
                            ]) !!}

                          </div>
                          <div class="col-md-4">
                            <label for="rd" class="mt-4">RD (%) *</label>
                            {!! Form::text('rd[]', @$product->rd?:null, ['id' => 'rd','class' =>
                            'form-control','required','data-cell'=>"RD$loopKey",'data-format'=>"0[.]00",
                            'keydown'=>"calculateFx()",
                            'onblur'=>"calculateFx()",'placeholder'=>'RD'
                            ]) !!}
                            @if ($errors->has('rd')) <span class="text-danger alert">{{ $errors->first('rd')
                              }}</span>
                            @endif
                          </div>
                          <div class="col-md-4">
                            <label for="rd_value" class="mt-4">RD Value (Total) *</label>
                            {!! Form::text('rd_value[]', @$product->rd_value?:null, ['id' => 'rd_value','class' =>
                            'form-control','required','data-cell'=>"RDVAL$loopKey",'data-format'=>"0[.]00",'data-formula'=>"SUM(((DUTYAVAL$loopKey/100)*(RD$loopKey)))",
                            'readonly'
                            ]) !!}

                          </div>
                          <div class="col-md-4">
                            <label for="cd_rd_total" class="mt-4">DAV+CD+RD</label>
                            {!! Form::text('cd_rd_total[]', @$product->cd_rd_total?:null, ['id' => 'cd_rd_total','class'
                            =>
                            'form-control','required','data-cell'=>"DAVCDRDTOTAL$loopKey",'data-format'=>"0[.]00",'data-formula'=>"SUM(DUTYAVAL$loopKey+CDVAL$loopKey+RDVAL$loopKey)",
                            'readonly'
                            ]) !!}

                          </div>
                          <div class="col-md-4">
                            <label for="sd" class="mt-4">SD (%) *</label>
                            {!! Form::text('sd[]', @$product->sd?:null, ['id' => 'sd','class' =>
                            'form-control','required','data-cell'=>"SD$loopKey",'data-format'=>"0[.]00",
                            'keydown'=>"calculateFx()",
                            'onblur'=>"calculateFx()",'placeholder'=>'SD'
                            ]) !!}
                            @if ($errors->has('sd')) <span class="text-danger alert">{{ $errors->first('sd')
                              }}</span>
                            @endif
                          </div>


                          <div class="col-md-4">
                            <label for="sd_value" class="mt-4">SD Value (Total) *</label>
                            {!! Form::text('sd_value[]', @$product->sd_value?:null, ['id' => 'sd_value','class' =>
                            'form-control','required','data-cell'=>"SDVAL$loopKey",'data-format'=>"0[.]00",'data-formula'=>"SUM(((DAVCDRDTOTAL$loopKey/100)*SD$loopKey))",
                            'readonly'
                            ]) !!}

                          </div>
                          <div class="col-md-4">
                            <label for="vat" class="mt-4">VAT (%)*</label>
                            {!! Form::text('vat[]', @$product->vat?:null, ['id' => 'vat','class' =>
                            'form-control','required','data-cell'=>"VAT$loopKey",'data-format'=>"0[.]00",
                            'keydown'=>"calculateFx()",
                            'onblur'=>"calculateFx()",'placeholder'=>'VAT'
                            ]) !!}
                            @if ($errors->has('vat')) <span class="text-danger alert">{{ $errors->first('vat')
                              }}</span>
                            @endif
                          </div>
                          <div class="col-md-4">
                            <label for="vat_value" class="mt-4">VAT Value (Total) *</label>
                            {!! Form::text('vat_value[]', @$product->vat_value?:null, ['id' => 'vat_value','class' =>
                            'form-control','required','data-cell'=>"VATVAL$loopKey",'data-format'=>"0[.]00",'data-formula'=>"SUM(((DAVCDRDTOTAL$loopKey/100)*VAT$loopKey))",
                            'readonly'
                            ]) !!}

                          </div>
                          <div class="col-md-4">
                            <label for="ait" class="mt-4">AIT (%) *</label>
                            {!! Form::text('ait[]', @$product->ait?:null, ['id' => 'ait','class' =>
                            'form-control','required','data-cell'=>"AIT$loopKey",'data-format'=>"0[.]00",
                            'keydown'=>"calculateFx()",
                            'onblur'=>"calculateFx()",'placeholder'=>'AIT'
                            ]) !!}
                            @if ($errors->has('ait')) <span class="text-danger alert">{{ $errors->first('ait')
                              }}</span>
                            @endif
                          </div>
                          <div class="col-md-4">
                            <label for="ait_value" class="mt-4">AIT Value (Total) *</label>
                            {!! Form::text('ait_value[]', @$product->ait_value?:null, ['id' => 'ait_value','class' =>
                            'form-control','required','data-cell'=>"AITVAL$loopKey",'data-format'=>"0[.]00",'data-formula'=>"SUM(((DUTYAVAL$loopKey/100)*(AIT$loopKey)))",
                            'readonly'
                            ]) !!}

                          </div>
                          <div class="col-md-4">
                            <label for="at" class="mt-4">AT (%) *</label>
                            {!! Form::text('at[]', @$product->at?:null, ['id' => 'at','class' =>
                            'form-control','required','data-cell'=>"AT$loopKey",'data-format'=>"0[.]00",
                            'keydown'=>"calculateFx()",
                            'onblur'=>"calculateFx()",'placeholder'=>'AT'
                            ]) !!}
                            @if ($errors->has('at')) <span class="text-danger alert">{{ $errors->first('at')
                              }}</span>
                            @endif
                          </div>
                          <div class="col-md-4">
                            <label for="at_value" class="mt-4">AT Value (Total) *</label>
                            {!! Form::text('at_value[]', @$product->at_value?:null, ['id' => 'at_value','class' =>
                            'form-control','required','data-cell'=>"ATVAL$loopKey",'data-format'=>"0[.]00",'data-formula'=>"SUM((DAVCDRDTOTAL$loopKey/100)*(AT$loopKey))",
                            'readonly'
                            ]) !!}

                          </div>
                          <div class="col-md-4">
                            <label for="atv" class="mt-4">ATV *</label>
                            {!! Form::text('atv[]', @$product->atv?:null, ['id' => 'atv','class' =>
                            'form-control','required','data-cell'=>"ATV$loopKey",'data-format'=>"0[.]00",
                            'keydown'=>"calculateFx()",
                            'onblur'=>"calculateFx()",'placeholder'=>'ATV'
                            ]) !!}
                            @if ($errors->has('atv')) <span class="text-danger alert">{{ $errors->first('atv')
                              }}</span>
                            @endif
                          </div>
                          <div class="col-md-4">
                            <label for="atv_value" class="mt-4">ATV Value (Total) *</label>
                            {!! Form::text('atv_value[]', @$product->atv_value?:null, ['id' => 'atv_value','class' =>
                            'form-control','required','data-cell'=>"ATVVAL$loopKey",'data-format'=>"0[.]00",'data-formula'=>"SUM((DAVCDRDTOTAL$loopKey/100)*(ATV$loopKey))",
                            'readonly'
                            ]) !!}

                          </div>

                          <div class="col-md-4">
                            <label for="total_duty" class="mt-4">Total Duty *</label>
                            {!! Form::text('total_duty[]', @$product->total_duty?:null, ['id' => 'total_duty','class' =>
                            'form-control','readonly','data-cell'=>"I1",'data-format'=>"0[.]00",
                            'data-formula'=>"SUM(CD$loopKey,RD$loopKey,SD$loopKey,VAT$loopKey,AIT$loopKey,AT$loopKey,ATV$loopKey)"
                            ]) !!}
                            @if ($errors->has('total_duty')) <span class="text-danger alert">{{
                              $errors->first('total_duty')
                              }}</span>
                            @endif
                          </div>
                          <div class="col-md-4">
                            <label for="insurance_after" class="mt-4">Insurance (A) *</label>
                            {!! Form::text('insurance_after[]', @$product->insurance_after?:null, ['id' =>
                            'insurance_after','class' =>
                            'form-control','required','data-cell'=>"INSUAFTR$loopKey",'data-format'=>"0[.]00",
                            'keydown'=>"calculateFx()",
                            'onblur'=>"calculateFx()",'placeholder'=>'Insurance After'
                            ]) !!}
                            @if ($errors->has('insurance_after')) <span class="text-danger alert">{{
                              $errors->first('insurance_after')
                              }}</span>
                            @endif
                          </div>
                          <div class="col-md-4">
                            <label for="insurance_after_value" class="mt-4 text-xs">Insurance Value (A) *</label>
                            {!! Form::text('insurance_after_value[]', @$product->insurance_after_value?:null, ['id' =>
                            'insurance_after_value','class' =>
                            'form-control','required','data-cell'=>"INSUAFTRVAL$loopKey",'data-format'=>"0[.]00",'data-formula'=>"SUM((((U$loopKey+INSBVAL$loopKey+CLRBVAL$loopKey)*CONVR$loopKey)/100)*(INSUAFTR$loopKey))",
                            'readonly'
                            ]) !!}

                          </div>
                          <div class="col-md-4">
                            <label for="bank_charge" class="mt-4">Bank Charge *</label>
                            {!! Form::text('bank_charge[]', @$product->bank_charge?:null, ['id' => 'bank_charge','class'
                            =>
                            'form-control','required','data-cell'=>"BNKCRG$loopKey",'data-format'=>"0[.]00",
                            'keydown'=>"calculateFx()",
                            'onblur'=>"calculateFx()",'placeholder'=>'Bank Charge'
                            ]) !!}
                            @if ($errors->has('bank_charge')) <span class="text-danger alert">{{
                              $errors->first('bank_charge')
                              }}</span>
                            @endif
                          </div>
                          <div class="col-md-4">
                            <label for="bank_charge_value" class="mt-4 text-xs">Bank Charge Value *</label>
                            {!! Form::text('bank_charge_value[]', @$product->bank_charge_value?:null, ['id' =>
                            'bank_charge_value','class' =>
                            'form-control','required','data-cell'=>"BNKCRGVAL$loopKey",'data-format'=>"0[.]00",'data-formula'=>"SUM((((U$loopKey+INSBVAL$loopKey+CLRBVAL$loopKey)*CONVR$loopKey)/100)*(BNKCRG$loopKey))",
                            'readonly'
                            ]) !!}

                          </div>
                          <div class="col-md-4">
                            <label for="clearing_after" class="mt-4"> Clearing (%) (A)*</label>
                            {!! Form::text('clearing_after[]', @$product->clearing_after?:null, ['id' =>
                            'clearing_after','class' =>
                            'form-control','required','data-cell'=>"CLRAFTR$loopKey",'data-format'=>"0[.]00",
                            'keydown'=>"calculateFx()",
                            'onblur'=>"calculateFx()",'placeholder'=>'Clearing After'
                            ]) !!}
                            @if ($errors->has('clearing_after')) <span class="text-danger alert">{{
                              $errors->first('clearing_after')
                              }}</span>
                            @endif
                          </div>
                          <div class="col-md-4">
                            <label for="clearing_after_value" class="mt-4 text-xs"> Clearing Value (A) *</label>
                            {!! Form::text('clearing_after_value[]', @$product->clearing_after_value?:null, ['id' =>
                            'clearing_after_value','class' =>
                            'form-control','required','data-cell'=>"CLRAFTRVAL$loopKey",'data-format'=>"0[.]00",'data-formula'=>"SUM((((U$loopKey+INSBVAL$loopKey+CLRBVAL$loopKey)*CONVR$loopKey)/100)*(CLRAFTR$loopKey))",
                            'readonly'
                            ]) !!}

                          </div>

                          <div class="col-md-4">
                            <label for="carrying_charge" class="mt-4">Carrying Charge (%)*</label>
                            {!! Form::number('carrying_charge[]', @$product->carrying_charge?:null, ['id' =>
                            'carrying_charge','class'=>'form-control','required','data-cell'=>"CRRING$loopKey",'data-format'=>"",
                            'keydown'=>"calculateFx()",'step'=>'any', 'onblur'=>"calculateFx()"
                            ]) !!}
                            @if ($errors->has('carrying_charge')) <span class="text-danger alert">{{
                              $errors->first('carrying_charge')
                              }}</span>
                            @endif
                          </div>
                          <div class="col-md-4">
                            <label for="carrying_value" class="mt-4 text-xs"> Carrying Value *</label>
                            {!! Form::text('carrying_value[]', @$product->carrying_value?:null, ['id' =>
                            'carrying_value','class' =>
                            'form-control','required','data-cell'=>"CARRINGVAL$loopKey",'data-format'=>"0[.]00",'data-formula'=>"SUM((((U$loopKey+INSBVAL$loopKey+CLRBVAL$loopKey)*CONVR$loopKey)/100)*(CRRING$loopKey))",
                            'readonly'
                            ]) !!}

                          </div>
                          <div class="col-md-4">
                            <label for="lc_value" class="mt-4">LC Value *</label>
                            {!! Form::text('lc_value[]', @$product->lc_value?:null, ['id' => 'lc_value','class' =>
                            'form-control','required','data-cell'=>"LCVAL$loopKey",'data-format'=>"0[.]00",'data-formula'=>"SUM(U$loopKey*CONVR$loopKey)",
                            'readonly'
                            ]) !!}
                            @if ($errors->has('lc_value')) <span class="text-danger alert">{{ $errors->first('lc_value')
                              }}</span>
                            @endif
                          </div>
                          <div class="col-md-4">
                            <label for="other_cost" class="mt-4">Other Cost *</label>
                            {!! Form::text('other_cost[]', @$product->other_cost?:null, ['id' => 'other_cost','class' =>
                            'form-control','required','data-cell'=>"OTR$loopKey",'data-format'=>"0[.]00",
                            'keydown'=>"calculateFx()",
                            'onblur'=>"calculateFx()",'placeholder'=>'Other Cost'
                            ]) !!}
                            @if ($errors->has('other_cost')) <span class="text-danger alert">{{
                              $errors->first('other_cost')
                              }}</span>
                            @endif
                          </div>

                          <div class="col-md-4">
                            <label for="purchase_price" class="mt-4">Purchase Priace</label>
                            {!! Form::text('purchase_price[]', @$product->purchase_price?:null, ['id' =>
                            'purchase_price','class' =>
                            'form-control','readonly','data-cell'=>"PPRICE$loopKey",'data-format'=>"0[.]00",'data-formula'=>"SUM(CDVAL$loopKey,RDVAL$loopKey,SDVAl$loopKey,VATVAL$loopKey,AITVAL$loopKey,ATVAL$loopKey,ATVVAL$loopKey,INSUAFTRVAL$loopKey,BNKCRGVAL$loopKey,CLRAFTRVAL$loopKey,CARRINGVAL$loopKey,LCVAL$loopKey,OTR$loopKey)"
                            ]) !!}
                            @if ($errors->has('purchase_price')) <span class="text-danger alert">{{
                              $errors->first('purchase_price')
                              }}</span>
                            @endif
                          </div>
                          <div class="col-md-4">
                            <label for="purchase_price" class="mt-4">Cancel</label>
                            <button class="form-control btn btn-sm btn-danger" disabled><i
                                class="fa fa-times fa-fw"></i></button>
                          </div>
                        </div>
                      </tr>

                      @endforeach

                    </tbody>

                  </table>


                </div>

              </div>


              <div class="row">
                <div class=" table-responsive">
                  <table class="table bg-success fxd">


                    <tbody>


                      <tr>

                        <th>Total Quantity :</th>
                        <td>
                          <input type="number" name="total_quantity" data-format="0[.]00" data-formula="(SUM(Q1:Q5000))"
                            class="form-control" readonly data-cell="TQ1" data-format="0[.]00" step="any" min="0"
                            value="{{$requisition->total_quantity}}" max="99999999999999">

                        </td>
                        <th>Grand Total:</th>
                        <td>

                          <input type="number" name="grand_total" data-format="0[.]00"
                            data-formula="(SUM(PPRICE1:PPRICE5000))" readonly class="form-control" readonly
                            data-cell="G1" data-format="0[.]00" step="any" min="0" max="99999999999999">
                        </td>

                        <th>Paid:</th>
                        <td id="paid">
                          {!! Form::number('paid', null, ['id' => 'paid','class' =>
                          'form-control','data-cell'=>"PD1",'data-format'=>"0[.]00", 'keydown'=>"calculateFx()",'step'
                          => 'any',
                          'onblur'=>"calculateFx()",'placeholder'=>'Paid Amount','min' => '0',
                          'max' => '9999999999999999',
                          ]) !!}

                        </td>
                        <th>Due:</th>
                        <td>
                          {!! Form::number('due', null, ['id' => 'due','class' =>
                          'form-control','data-cell'=>"DE1",'data-format'=>"0[.]00", 'data-formula'=>"(SUM(G1-PD1))",
                          'keydown'=>"calculateFx()",'step' => 'any', 'onblur'=>"calculateFx()",'placeholder'=>'Paid
                          Amount','min' => '0', 'readonly',
                          'max' => '9999999999999999',
                          ]) !!}

                        </td>
                        <td>
                          <button type="submit" class="btn btn-primary" id="submitbtn SUBMIT_BTN">Submit</button>

                        </td>
                      </tr>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>





@endsection
@section('calx')
<script src="{{ asset('backend/assets/js/jquery-calx-sample-2.2.8.min.js') }}"></script>
@endsection
@push('js')
<script src="{{ asset('backend/assets/select2/js/select2.min.js') }}"></script>
<!-- jquery ui -->


<script>
  $('.select2').select2();
  $(document).ready(function () {
    calculateFx();
    $( "#formReset" ).on( "click", function() {
         calculateFx()
      }); 
       
    });

function calculateFx() {
  $form = $('#dynamic').calx();
    $form.calx('update');
}

</script>

@endpush
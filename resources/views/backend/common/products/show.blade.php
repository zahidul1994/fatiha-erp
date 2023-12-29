@php

$setup=Helper::adminSetup();

@endphp
@extends('backend.layouts.master')
@section('title', 'Show Product')
@push('css')

@endpush
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-4">Product Details</h5>
                    <div class="row">
                        
                        <div class="col-xl-4 col-lg-4 text-center">
                            
                            <img class="img-fluid border-radius-lg shadow-lg mx-auto"
                                src="{{asset(@$product->path.'/'.@$product->photo)}}" alt="{{$product->product_name}}"
                                style="max-width: 180px !important">
                            <div class="my-gallery d-flex mt-4 pt-2">
                                @php $info = " Id : $product->sku \n Product : $product->product_name \n Code :
                                $product->hs_code \n Price : $product->sale_price"
                                @endphp
                                <a href="data:image/png;base64,{!! DNS2D::getBarcodePNG($info, 'QRCODE') !!}"
                                    class="image-fluid mx-auto" download="{{$product->product_name}}"> <img
                                        class="img-fluid"
                                        src="data:image/png;base64,{!! DNS2D::getBarcodePNG($info, 'QRCODE') !!}"
                                        alt="hs_code" /> </a>
                            </div>
                            <div class="row border-radius-lg shadow-lg mx-auto mt-1">
                            <table class="table table-bordered">
   
    <tbody>
    <tr>
        <td colspan="2" class="text-uppercase">{{$product->product_name}}</td>
        
      </tr>
      <tr>
        <td>Brand</td>
        
        <td> {{$product->brand->brand_name}} </td>
      </tr>
      <tr>
        <td>Made IN</td>
        
        <td> {{$product->made_in}} </td>
      </tr>
      <tr>
        <td>SKU</td>
        
        <td> {{$product->sku}} </td>
      </tr>
      <tr>
        <td>Expire Date</td>
        <td>{{$product->expire_date?:'No'}}</td>
        
      </tr>
      <tr>
        
        <td colspan="2">  <label class="mt-2">Description</label>
                          
                                {!! @$product->description?:'There are no proudct description' !!}
                            </td>
      </tr>
     
     
    </tbody>
  </table>
                               
                               
                            
                            </div>
                        </div>
                        <div class="col-lg-8 mx-auto">
                            <h3 class="mt-lg-0 mt-2 text-uppercase">{{@$product->product_full_name}}</h3>
                            <div class="rating">
                                <img class="img-fluid"
                                    src="data:image/png;base64, {!!DNS1D::getBarcodePNG(@$product->hs_code, 'C39+')!!}" />
                                <h6 class="text-center h6">{{$product->hs_code}} ( <small>HS Code</small> )</h6>
                            </div>
                            <br>
                            <br>

                            <br>
                            <div class="row border-radius-lg shadow-lg mx-auto">
                            <table class="table table-bordered">
    <thead>
      <tr>
        <th colspan="2">Duty</th>
        <th>Amount</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan="3">Unit ( {{$product->weight_size}} {{$product->unit}} )</td>
        
      </tr>
      <tr>
        <td colspan="2">Unit Price</td>
        
        <td>                  {{$product->unit_price}} </td>
      </tr>
      <tr>
        <td colspan="2">Government Price</td>
        
        <td>                   {{$product->govt_price}} </td>
      </tr>
      <tr>
        <td colspan="2">Insurance Before ( {{$product->insurance_before}}% )</td>
        <td> {{$product->insurance_before_value}}</td>
      </tr>  
      <tr>
        <td colspan="2">Clearing Before ( {{$product->clearing_before}}% )</td>
        <td> {{$product->clearing_before_value}}</td>
      </tr>  
      <tr>
        <td colspan="2">Convaert Rate</td>
        
        <td>     {{$product->convert_rate}} {{ @$setup->currency_name}}</td>
      </tr>
      <tr>
        <td colspan="2">Duty Assessment Value</td>
        
        <td>     {{$product->duty_assessment_value}} {{ @$setup->currency_name}}</td>
      </tr>
      <tr>
        <td colspan="2">CD ( {{$product->cd}}% )</td>
        <td>{{$product->cd_value}}</td>
      </tr>      
      <tr class="success">
        <td colspan="2">RD (  {{$product->rd}}% )</td>
        <td>{{$product->rd_value}}</td>
      </tr>
      <tr class="danger">
        <td colspan="2">DAV+CD+RD Total</td>
        
        <td>{{$product->cd_rd_total}}</td>
      </tr>
      <tr class="success">
        <td colspan="2">SD (  {{$product->sd}}% )</td>
        <td>{{$product->sd_value}}</td>
      </tr>
      <tr class="success">
        <td colspan="2">VAT (  {{$product->vat}}% )</td>
        <td>{{$product->vat_value}}</td>
      </tr>
      <tr class="success">
        <td colspan="2">AIT (  {{$product->ait}}% )</td>
        <td>{{$product->ait_value}}</td>
      </tr>
      <tr class="success">
        <td colspan="2">AT (  {{$product->at}}% )</td>
        <td>{{$product->at_value}}</td>
      </tr>
      <tr class="success">
        <td colspan="2">ATV (  {{$product->atv}}% )</td>
        <td>{{$product->atv_value}}</td>
      </tr>
      
      <tr class="success">
        <td colspan="3">Total Duty (  {{$product->total_duty}}% )</td>
      </tr>
      <tr class="success">
        <td colspan="2">Bank Charge (  {{$product->bank_charge}}% )</td>
        <td>{{$product->bank_charge_value}}</td>
      </tr>
      <tr class="success">
        <td colspan="2">Insurance after (  {{$product->insurance_after}}% )</td>
        <td>{{$product->insurance_after_value}}</td>
      </tr>
      <tr class="success">
        <td colspan="2">Clearing After (  {{$product->clearing_after}}% )</td>
        <td>{{$product->clearing_after_value}}</td>
      </tr>
      <tr class="success">
        <td colspan="2">Carrying (  {{$product->carrying_charge}}% )</td>
        <td>{{$product->carrying_value}}</td>
      </tr>
      <tr class="success">
        <td colspan="2">LC Value </td>
        <td>{{$product->lc_value}}</td>
      </tr>
      <tr class="success">
        <td colspan="2">Other Cost </td>
        <td>{{$product->other_cost}}</td>
      </tr>
      <tr class="success">
        <td colspan="2">Total Landed Cost </td>
        <td>{{$product->purchase_price}}</td>
      </tr>
     
    </tbody>
  </table>
                            </div>
                            
                          <hr>
                        

                            <a href="{{ url()->previous() }}" class="btn bg-gradient-secondary ms-auto mb-0">Back</a>

                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="{{ asset('backend/assets/select2/js/select2.min.js') }}"></script>

<script>



</script>

@endpush
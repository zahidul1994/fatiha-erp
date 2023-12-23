@extends('backend.layouts.master')
@section('title', 'Create Purchase Return')
@push('css')
<link href="{{ asset('backend/assets/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('backend/assets/css/jquery-ui.min.css') }}" rel="stylesheet" />
<style>
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }

  .select2-selection__choice {
    background-color: var(--bs-gray-200);
    border: none !important;
    font-size: 12px;
    font-size: 0.85rem !important;
  }

  .bottom-table-card th {
    font-size: 12px;
    text-align: center;
  }

  .bottom-table-card td {
    font-size: 12px;
    text-align: center;
  }

  .bottom-table-card td p {
    font-size: 12px;
    text-align: center;
    margin-bottom: 0 !important;
  }

  .page-custom-buttons button {
    font-weight: 400;
    padding: 5px 10px;
    margin-bottom: 5px !important;
  }

  .pa-box {
    background-color: #FFC425;
    font-size: 18px;
    font-weight: 700;
    color: #000;
  }

  .table-responsive-custom {
    overflow-x: scroll !important;
  }


  @media (max-width: 575px) {
    .pcb-mobile {
      display: block;
      text-align: center;
    }

    .pcb-desktop {
      display: none;
    }
  }


  @media (min-width: 576px) and (max-width: 767px) {
    .pcb-mobile {
      display: block;
    }

    .pcb-desktop {
      display: none;
    }
  }

  @media (min-width: 768px) and (max-width: 991px) {
    .pcb-mobile {
      display: block;
    }

    .pcb-desktop {
      display: none;
    }
  }

  @media (min-width: 992px) and (max-width: 1199px) {
    .pcb-mobile {
      display: none;
    }

    .pcb-desktop {
      display: block;
    }
  }

  /* // Extra large devices (large desktops, 1200px and up) */
  @media (min-width: 1200px) {
    .pcb-mobile {
      display: none;
    }

    .pcb-desktop {
      display: block;
    }
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

            <a href="{{ route(Request::segment(1) . '.purchase-returns.index') }}"
              class="btn btn-primary btn-sm ms-auto">Back</a>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            @include('partial.formerror')
            {!! Form::open(['route' => Request::segment(1) . '.purchase-returns.store', 'method' => 'POST', 'id' =>
            'formReset']) !!}

            <div class="row">
              <div class="col-12 col-sm-6">
                <h5 class="font-weight-bolder mb-0">Purchase Return Form</h5>
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

                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit" name="print"><svg
                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-printer-fill" viewBox="0 0 16 16">
                    <path
                      d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z" />
                    <path
                      d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                  </svg> Save & Print</button>
              </div>
            </div>



            <div class="multisteps-form__content">
              <div class="row mt-3">
                <div class="col-md-8">
                  <div class="row">
                    <div class="col-md-6 col-sm-1">
                      <label for="date">Date *</label>
                      {!! Form::date('date', date('Y-m-d'), ['id' => 'date', 'class' => 'form-control', 'required', 'tabindex' =>
                      1,'autofocus']) !!}

                    </div>
                          <input type="hidden" name="purchase_id" value="{{encrypt(Request::segment(3))}}">
                    <div class="col-md-6 col-sm-1 mt-1">
                      <label for="shop_id">Shop *</label>
                      {!! Form::select('shop_id',Helper::shopPluckValue(), null, ['id' => 'shop_id', 'class' =>
                      'form-control select2', 'disabled']) !!}

                    </div>
                    <div class="col-md-6 col-sm-1 mt-1">
                      <label for="name">Supplier</label>
                      {!! Form::select('supplier_id',Helper::supplierPluckValue(), null, ['id' => 'name', 'class' =>
                      'form-control select2', 'disabled']) !!}

                    </div>
                    <div class="col-md-6 col-sm-1 mt-1">
                      <label for="payment_method">Payment Method *</label>
                      {!! Form::select('payment_method',Helper::paymentMethodPluckValue(), null, ['id' =>
                      'payment_method', 'class' => 'form-control select2', 'tabindex' => 2]) !!}

                    </div>
                    <div class=" row d-none" id="MobileBankPayment">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="phone_number" class="form-control-label">Sending Mobile Number * </label>
                          {!! Form::tel('phone_number', null, ['id' => 'phone_number',
                          'class' =>'form-control']) !!}
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="transaction_number" class="form-control-label">Transaction Number/ID * </label>
                          {!! Form::text('transaction_number',null, ['id' => 'transaction_number',
                          'class' =>'form-control'
                          ]) !!}
                        </div>
                      </div>
                    </div>
                    <div class=" row d-none" id="BankPayment">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="bank_name" class="form-control-label">Bank Name * </label>
                          {!! Form::text('bank_name',null, ['id' => 'bank_name', 'class'
                          =>'form-control']) !!}
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="bank_account_number" class="form-control-label">Bank Acouunt NO * </label>
                          {!! Form::number('bank_account_number',null, ['id' =>
                          'bank_account_number', 'class'
                          =>'form-control'
                          ]) !!}
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-1 mt-1">
                      <label for="note">Note</label>
                      {!! Form::textarea('description', null, ['id' => 'note', 'class' => 'form-control','rows'=>1,
                      'tabindex' =>3]) !!}
                    </div>
                  </div>
                </div>


                <div class="col-md-4 col-sm-1 mt-3 mt-sm-0">
                  <div class="card">
                    <div class="card-pa-head">
                      <div class="d-flex mb-1">
                        <div class="w-25 pe-2 align-self-center"></div>
                        <div class="w-75 ps-3 align-self-center">
                          <p class="text-center pa-box">
                            <span class="d-block">Returnable Amount</span>
                            <strong data-formula="(SUM(F1:F500)-(N1+D1))"></strong>
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="card-body pt-0 pr-0">
                      <div class="d-flex mb-1">
                        <div class="w-25 pe-2 align-self-center">Vat/Tax</div>
                        <div class="w-75 align-self-center">
                          <input type="number" name="total_vat" id="total_vat" class="form-control text-end py-1 px-1"
                            readonly data-format="0[.]00" data-formula="SUM(V1:V5000)" step="any" min="0"
                            max="99999999999999" data-cell="N1">
                        </div>
                      </div>
                      <div class="d-flex mb-1">
                        <div class="w-25 pe-2 align-self-center">R Dis</div>
                        <div class="w-75 align-self-center">
                          <div class="row">
                              <div class="col-md-7"><input type="number" name="total_discount"  readonly class="form-control text-end py-1 px-1"  data-cell="D1" data-format="0[.]00"  step="any" ></div>
                              <div class="col-md-5"><input type="number" step="any" value="{{$purchase->extra_discount_percent}}"  readonly name="extra_discount_percent" class="form-control text-end py-1 px-1" data-cell="Z1" data-format="0[.]00"></div>
                          </div>
                         </div>
                      </div>
                      <div class="d-flex mb-1">
                        <div class="w-25 pe-2 align-self-center">Grand Total</div>
                        <div class="w-75 align-self-center">
                          <input type="number" name="total_amount" id="grand_total"
                            class="form-control text-end py-1 px-1" readonly data-cell="G1" data-format="0[.]00"
                            step="any" min="0" max="99999999999999">
                        </div>
                      </div>

                    </div>

                  </div>

                </div>


              </div>

              <div class="card mt-3 bottom-table-card" style="border-radius: 0 !important; font-size:150px">
                <div class="col-md-12 mx-auto">
                  <table class="table align-items-center mb-0 table-success table-striped">
                    <thead>
                      <tr style="font-weight:900;background:peru; color:black">
                        <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product
                          Name
                        </th>
                        <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Price
                        </th>
                        <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">P
                          Qty
                        </th>
                        <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                          Return Qty
                        </th>
                        <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">New Return Qty
                        </th>
                        <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Vat(%)
                        </th>
                        <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Vat Val
                        </th>
                        <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total
                        </th>


                      </tr>
                    </thead>
                    <tbody id="itemlist">
                      @foreach ($purchase->purchasedetails as $purchasedetail)
                      @php
                        $avaboleqty= @$purchasedetail->qty-$purchasedetail->already_return_qty
                      @endphp
                     @if ($avaboleqty>0)

                      <td style="width:250px; vertical-align: top; padding-top: 17px;"><input
                          class="form-control input-sm" type="hidden" id="pid" name="product_id[]"
                          value="{{ @$purchasedetail->product_id}}" data-format="0">{{
                        @$purchasedetail->product->product_name}} ({{ @$purchasedetail->product->barcode}}) <input
                          type="hidden" name="product_name[]" value="{{ @$purchasedetail->product_name}}"></td>

                      <td style="width:100px;"><input class="form-control input-sm text-end" placeholder="0.00"
                          tabindex="10" name="product_price[]" readonly data-cell="P{{$loop->index+1}}"
                          value="{{@$purchasedetail->purchase_price}}" data-format=""></td>
                      <td style="width:80px;"><input class="form-control input-sm text-end" required step="any" min=1
                          max=999999999 required value="{{ @$purchasedetail->qty}}" readonly name="product_quantity[]">
                      </td>
                      <td style="width:80px;"><input class="form-control input-sm text-end" step="any" min=1
                          max=999999999 value="{{ @$purchasedetail->already_return_qty}}" readonly
                          name="already_return_qty[]"></td>
                      <td style="width:120px;"><input class="form-control input-sm text-end"  type="number"
                          step="any" min=0 max="{{$avaboleqty}}"
                          onblur="getQty({{$loop->index+1}},this);"  onClick="getQty({{$loop->index+1}},this);" name="return_quantity[]"
                          data-cell="Q{{$loop->index+1}}"></td>

                      <td style="width:80px;"><input type="number" step="any" min=0 max=999999999
                          class="form-control input-sm text-end" readonly onblur="getVat({{$loop->index+1}},this);" onClick="getVat({{$loop->index+1}},this);"
                          placeholder="0.00" name="product_vat[]" data-cell="T{{$loop->index+1}}"
                          value="{{ @$purchasedetail->vat_percent}}" data-format="0[.]0000"> </td>

                      <td style="width:100px;"><input name="product_vat_amount[]"
                          type="number" step="any" min=0 max=999999999
                          class="form-control input-sm text-end" placeholder="0.00" readonly
                          data-cell="V{{$loop->index+1}}"
                          data-formula="(P{{$loop->index+1}}/100*T{{$loop->index+1}})*Q{{$loop->index+1}}"
                          data-format="0[.]00"></td>

                      <td style="width:160px;"><input type="number" readonly
                          step="any" min=1 max=999999999 class="form-control input-sm text-end" placeholder="0.00"
                          name="product_total_price[]" data-cell="F{{$loop->index+1}}" data-format="0[.]00"
                          data-formula="(Q{{$loop->index+1}})*(P{{$loop->index+1}})">
                      </td>
                      @endif

                      </tr>

                      @endforeach
                    </tbody>
                    <tfoot>
                      <th colspan="4"></th>

                      <th> <strong data-formula="(SUM(Q1:Q500))"></strong>
                      </th>
                      <th> <strong data-formula="(SUM(T1:T500))"></strong>
                      </th>
                      <th> <strong data-formula="(SUM(V1:V500))">
                        </strong></th>
                      <th> <strong data-formula="(SUM(F1:F500))"></strong>
                      </th>

                    </tfoot>
                  </table>

                </div>

              </div>
              <div class="row">
                <div class="col-md-9"></div>
                <div class="col-md-3 mt-3"><button class="btn btn-success" type="submit" tabindex="5">Save & Return</button>

                </div>
              </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
  @section('calx')
<!-- calx -->
<script src="{{ asset('backend/assets/js/jquery-calx-sample-2.2.8.min.js') }}"></script>
@endsection
  @push('js')
  <script src="{{ asset('backend/assets/select2/js/select2.min.js') }}"></script>
  <!-- jquery ui -->
  <script src="{{ asset('backend/assets/js/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/plugins/sweetalert.min.js') }}"></script>

  <script>
    $('.select2').select2();
  $(document).ready(function () {
$('#payment_method').change(function(){
if($(this).val()=='Bkash'|| $(this).val()=='Nagad' || $(this).val()=='Rocket'){
$('#MobileBankPayment').removeClass('d-none');
$('#BankPayment').addClass('d-none');
$('#paid').prop('disabled', false);
}
else if($(this).val()=='Bank'){
 $('#BankPayment').removeClass('d-none');
 $('#MobileBankPayment').addClass('d-none');
 $('#paid').prop('disabled', false);
}

else{
  $('#paid').prop('disabled', false);
 $('#MobileBankPayment').addClass('d-none');
 $('#BankPayment').addClass('d-none');

}
 });


});

//onkeyup
function getQty() {
 $form = $('#dynamic').calx();
 $form.calx('getCell', 'G1').setFormula('(SUM(F1:F5000)-(D1)+(N1))');
  $form.calx('getCell', 'D1').setFormula('SUM(Q1:Q5000)*Z1');
  $form.calx('getCell', 'G1','D1').calculate();
  $form.calx('update');
}
//onkeyup
function getVat() {
  getQty()
}


  </script>

  @endpush

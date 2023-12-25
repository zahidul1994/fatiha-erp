@extends('backend.layouts.master')
@section('title', 'Update Sale')
@push('css')
<link href="{{ asset('backend/assets/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('backend/assets/css/jquery-ui.min.css') }}" rel="stylesheet" />
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
                        <a href="{{ route(Request::segment(1) . '.sales.index') }}"
                            class="btn btn-primary btn-sm ms-auto">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @include('partial.formerror')
                        {!! Form::model($sale, [
                        'route' => [Request::segment(1) . '.sales.update', $sale->id],
                        'method' => 'PATCH',
                        'id' => 'formReset'
                        ]) !!}
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <h5 class="font-weight-bolder mb-0">Sale Form</h5>
                            </div>
                            <div class="col-12 col-sm-6 text-end page-custom-buttons pcb-desktop">
                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit"
                                    title="Save"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-folder-check" viewBox="0 0 16 16">
                                        <path
                                            d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z" />
                                        <path
                                            d="M15.854 10.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.707 0l-1.5-1.5a.5.5 0 0 1 .707-.708l1.146 1.147 2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    </svg> Save</button>
                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" id="clear">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                        <path
                                            d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                                        <path fill-rule="evenodd"
                                            d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                                    </svg> Clear</button>
                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit" id="paid"><i
                                        class="fas fa-money-check-alt" width="16" height="16"></i> Paid & Save</button>
                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit"
                                    value="print" id="print"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z" />
                                        <path
                                            d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                                    </svg> Paid & Print</button>
                            </div>
                        </div>
                        <div class="multisteps-form__content">
                            <div class="row mt-3">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-1">
                                            <label for="date">Date *</label>
                                            {!! Form::date('date', null, ['id' => 'date', 'class' => 'form-control',
                                            'required', 'tabindex' =>
                                            1,'autofocus']) !!}

                                        </div>
                                        <div class="col-md-6 col-sm-1">
                                            <label for="customer_id">Customer * </label>
                                            {!! Form::select('customer_id',Helper::customerPluckValue(), null, ['id' =>
                                            'customerId', 'class'
                                            => 'form-control select2', 'tabindex' => 4,'disabled']) !!}

                                        </div>
                                        <div class="col-md-4 col-sm-1 mt-1">
                                            <label for="shop_id">Shop *</label>
                                            {!! Form::select('shop_id',Helper::shopPluckValue(), null, ['id' =>
                                            'shop_id', 'class' =>
                                            'form-control select2', 'tabindex' => 3,'disabled']) !!}

                                        </div>
                                        <div class="col-md-4 col-sm-1 mt-1">
                                            <label for="reference">Reference</label>
                                            {!! Form::text('reference', null, ['id' => 'reference', 'class' =>
                                            'form-control', 'tabindex' =>
                                            2]) !!}

                                        </div>
                                        <div class="col-md-4 col-sm-1 mt-1">
                                            <label for="payment_method">Payment Method *</label>
                                            {!! Form::select('payment_method',Helper::custompaymentMethodPluckValue(),
                                            null, ['id' =>
                                            'payment_method', 'class' => 'form-control select2', 'tabindex' => 5]) !!}

                                        </div>
                                        <div class=" row d-none" id="MobileBankPayment">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone_number" class="form-control-label">Sending Mobile
                                                        Number * </label>
                                                    {!! Form::tel('phone_number', @$paymentInfo->phone_number?:null,
                                                    ['id' => 'phone_number', 'class' =>'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="transaction_number"
                                                        class="form-control-label">Transaction Number/ID * </label>
                                                    {!!
                                                    Form::text('transaction_number',@$paymentInfo->transaction_number?:null,
                                                    ['id' => 'paid', 'class' =>'form-control'
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" row d-none" id="BankPayment">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="bank_name" class="form-control-label">Bank Name *
                                                    </label>
                                                    {!! Form::text('bank_name',@$paymentInfo->bank_name?:null, ['id' =>
                                                    'bank_name', 'class' =>'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="bank_account_number" class="form-control-label">Bank
                                                        Acouunt * </label>
                                                    {!!
                                                    Form::number('bank_account_number',@$paymentInfo->bank_account_number?:null,
                                                    ['id' => 'bank_account_number', 'class'
                                                    =>'form-control'
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-1 mt-1">
                                            <label for="note">Note</label>
                                            {!! Form::textarea('description', null, ['id' => 'note', 'class' =>
                                            'form-control','rows'=>2,
                                            'tabindex' =>6]) !!}
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
                                                        <span id="Cachback"></span>
                                                        <span class="d-block">Payable Amount</span>
                                                        <strong data-format="0[.]00"
                                                            data-formula="(SUM(F1:F5000)-O1)"></strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0 pr-0">

                                            <div class="d-flex mb-1">
                                                <div class="w-25 pe-2 align-self-center">Vat & Discount</div>
                                                <div class="w-75 align-self-center">
                                                    <div class="row">
                                                        <div class="col-md-6"> <input type="number" name="total_vat"
                                                                id="total_vat" class="form-control text-end py-1 px-1"
                                                                readonly value="{{$sale->total_vat}}"
                                                                data-format="0[.]00" data-formula="SUM(V1:V500)"
                                                                step="any" min="0" max="99999999999999"></div>
                                                        <div class="col-md-6"> <input type="number"
                                                                name="product_total_discount"
                                                                id="product_total_discount"
                                                                class="form-control text-end py-1 px-1" data-cell="M1"
                                                                data-format="0[.]00" data-formula="SUM(N1:N500)"
                                                                value="{{$sale->discount}}" step="any" min="0"
                                                                max="99999999999999" readonly></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex mb-1">
                                                <div class="w-25 pe-2 align-self-center">Extra D</div>
                                                <div class="w-75 align-self-center">
                                                    <div class="row">
                                                        <div class="col-md-7"><input type="number" name="other_discount"
                                                             onkeypress="getQty()"  onblur="getQty()" id="other_discount"
                                                                value="{{$sale->other_discount}}"
                                                                class="form-control text-end py-1 px-1" data-cell="L1"
                                                                data-format="0[.]00" step="any" min="0"
                                                                max="99999999999999"></div>
                                                        <div class="col-md-5"><input type="number" step="any"
                                                            value="{{$sale->extra_discount_percent}}" readonly
                                                            name="extra_discount_percent"
                                                            class="form-control text-end py-1 px-1" data-cell="Z1"
                                                            data-format="0[.]00"></div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="d-flex mb-1">
                                                <div class="w-25 pe-2 align-self-center">Paid A</div>
                                                <div class="w-75 align-self-center">
                                                    <div class="row">
                                                        <div class="col-md-7">{!! Form::number('paid',
                                                            $sale->pay_amount?:null, ['id' => 'total_paid', 'class' =>
                                                            'form-control text-end py-1
                                                            px-1','step'=>'any','min'=>0,'max'=>9999999999999,
                                                            'tabindex' => 9]) !!}</div>
                                                        <div class="col-md-5"><input type="number" name="total_discount"
                                                            id="total_discount"
                                                            class="form-control text-end py-1 px-1" data-cell="O1"
                                                            data-format="0[.]00" data-format="0[.]00"
                                                            data-formula="SUM(M1+L1)" readonly
                                                            value="{{$sale->total_discount}}" step="any" min="0"
                                                            max="99999999999999"></div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="d-flex mb-1">
                                                <div class="w-25 pe-2 align-self-center">Grand Total</div>
                                                <div class="w-75 align-self-center">
                                                    <input type="hidden" value="{{$sale->total_quantity}}"
                                                        name="total_quantity" data-format="0[.]00"
                                                        data-formula="(SUM(Q1:Q5000))">
                                                    <input type="number" value="{{$sale->grand_total}}"
                                                        name="total_amount" id="grand_total"
                                                        class="form-control text-end py-1 px-1" readonly data-cell="G1"
                                                        data-format="0[.]0000"
                                                        step="any" min="0" max="99999999999999">
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>


                            </div>
                            <div class="mt-5">


                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-4">
                                                <span class="input-group-text bg-alert"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                                        fill="currentColor" class="bi bi-upc" viewBox="0 0 16 16">
                                                        <path
                                                            d="M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z" />
                                                    </svg></span>
                                                <input value="" type="text" class="form-control ui-autocomplete-input"
                                                    id="add_item" placeholder="Please add products to order list"
                                                    autocomplete="off" style="font-size:1.5em;color:blueviolet">

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="card mt-3 bottom-table-card"
                                style="border-radius: 0 !important; font-size:150px">
                                <div class="table table-responsive">
                                    <table class="table table-bordered table-success align-items-center mb-0 table-striped">
                                        <thead>
                                            <tr style="font-weight:900;background:peru; color:black">
                                                <th
                                                    class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Product
                                                    Name
                                                </th>
                                                <th
                                                    class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Sale Price
                                                </th>
                                                <th
                                                    class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Qty
                                                </th>
                                                <th
                                                    class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Vat(%)
                                                </th>
                                                <th
                                                    class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Vat Val
                                                </th>
                                                <th
                                                    class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Discount(%)
                                                </th>
                                                <th
                                                    class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Dis Val
                                                </th>
                                                <th
                                                    class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Total
                                                </th>
                                                <th
                                                    class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Remove
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody id="itemlist">
                                            @foreach ($sale->saledetails as $saledetail)
                                            <td style="width:250px; vertical-align: top; padding-top: 17px;"><input
                                                    class="form-control input-sm" type="hidden" id="pid"
                                                    name="product_id[]" value="{{ @$saledetail->product_id}}"
                                                    data-format="0">{{ @$saledetail->product_name}} <input type="hidden"
                                                    name="product_name[]" value="{{ @$saledetail->product_name}}"></td>

                                            <td style="width:120px;"><input class="form-control input-sm text-end"
                                                    placeholder="0.00" tabindex="10" name="product_price[]"
                                                    data-cell="P{{$loop->index+1}}"
                                                    value="{{ @$saledetail->sale_price}}"
                                                    onblur="getQty({{$loop->index+1}},this);" data-format=""><i
                                                    class="text-black-50">&nbsp;</i></td>

                                            <td style="width:120px;" ><input
                                                    class="form-control input-sm text-end pquentity" required
                                                    type="number" readonly step="any" min=1 max=999999999 required
                                                    id="id{{ @$saledetail->product_id}}" data-format=""
                                                    data-format="0[.]00" onblur="getQty({{$loop->index+1}},this);"
                                                    value="{{ @$saledetail->qty}}" name="product_quantity[]"
                                                    data-cell="Q{{$loop->index+1}}"><i class="text-black-50">S-
                                                    {{Helper::getShopCurrentStock(@$saledetail->product_id)->stock_qty}}</i>
                                            </td>

                                            <td style="width:80px;"><input type="number" step="any" min=0 max=999999999
                                                    class="form-control input-sm text-end" readonly
                                                    onblur="getVat({{$loop->index+1}},this);" placeholder="0.00"
                                                    name="product_vat[]" data-cell="T{{$loop->index+1}}"
                                                    value="{{ @$saledetail->vat_percent}}" data-format="0[.]0000"><i
                                                    class="text-black-50">&nbsp;</i> </td>

                                            <td style="width:100px;"><input name="product_vat_amount[]"
                                                    value="{{ @$saledetail->vat_amount}}" type="number" step="any" min=0
                                                    max=999999999 class="form-control input-sm text-end"
                                                    placeholder="0.00" readonly data-cell="V{{$loop->index+1}}"
                                                    data-formula="(P{{$loop->index+1}}/100*T{{$loop->index+1}})*Q{{$loop->index+1}}"
                                                    data-format="0[.]00"><i class="text-black-50">&nbsp;</i></td>

                                            <td style="width:100px;"><input name="product_discount[]"
                                                    value="{{ @$saledetail->discount_percent}}" type="number" step="any"
                                                    min=0 max=999999999 class="form-control input-sm text-end"
                                                    placeholder="0.00" data-cell="D{{$loop->index+1}}"
                                                    onblur="getVat({{$loop->index+1}})" data-format="0[.]00"><i
                                                    class="text-black-50">&nbsp;</i>
                                            </td>

                                            <td style="width:160px;"><input type="number"
                                                    value="{{@$saledetail->discount_amount}}" step="any" min=1
                                                    max=999999999 class="form-control input-sm text-end"
                                                    placeholder="0.00" name="product_discount_amount[]" readonly
                                                    data-cell="N{{$loop->index+1}}" data-format="0[.]00"
                                                    data-formula="(P{{$loop->index+1}}/100*D{{$loop->index+1}})*Q{{$loop->index+1}}"><i
                                                    class="text-black-50">&nbsp;</i></td>

                                            <td style="width:160px;"><input type="number"
                                                    value="{{@$saledetail->sale_price}}" step="any" min=1 max=999999999
                                                    class="form-control input-sm text-end" placeholder="0.00"
                                                    name="product_total_price[]" readonly
                                                    data-cell="F{{$loop->index+1}}" data-format="0[.]00"
                                                    data-formula="((Q{{$loop->index+1}})*((P{{$loop->index+1}})+(V{{$loop->index+1}}))-(N{{$loop->index+1}}))"><i
                                                    class="text-black-50">&nbsp;</i></td>

                                            <td class="text-center"><button class="btn-remove btn btn-sm btn-danger"
                                                    disabled><i class="fa fa-times fa-fw"></i></button></td>

                                            </tr>

                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <th colspan="1"></th>
                                            <th> <strong data-format="0[.]00"
                                                    data-formula="(SUM(P1:P5000))">{{@$sale->saledetails->sum('sale_price')}}</strong>
                                            </th>
                                            <th> <strong data-format="0[.]00"
                                                    data-formula="(SUM(Q1:Q5000))">{{@$sale->saledetails->sum('qty')}}</strong>
                                            </th>
                                            <th> <strong data-format="0[.]00"
                                                    data-formula="(SUM(T1:T5000))">{{@$sale->saledetails->sum('vat_percent')}}</strong>
                                            </th>
                                            <th> <strong data-format="0[.]00"
                                                    data-formula="(SUM(V1:V5000))">{{@$sale->saledetails->sum('product_vat_amount')}}</strong>
                                            </th>
                                            <th> <strong data-format="0[.]00"
                                                    data-formula="(SUM(D1:D5000))">{{@$sale->saledetails->sum('product_discount')}}</strong>
                                            </th>
                                            <th> <strong data-format="0[.]00"
                                                    data-formula="(SUM(N1:N5000))">{{@$sale->saledetails->sum('product_discount_amount')}}</strong>
                                            </th>
                                            <th> <strong data-format="0[.]0000"
                                                    data-formula="(SUM(F1:F5000))">{{@$sale->saledetails->sum('total_price')}}</strong>
                                            </th>
                                            <th></th>
                                        </tfoot>
                                    </table>

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-9"></div>
                                <div class="col-md-3 mt-3"><button class="btn btn-success" type="submit"
                                        tabindex="10">Update</button>

                                </div>
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
    $(document).ready(function () {
        getQty();
    $('.select2').select2();
    $("#add_item").autocomplete({
    source: function (request, response) {
        if (!$('#customerId').val()) {
                    $('#add_item').val('').removeClass('ui-autocomplete-loading');
                    Swal.fire('Please select Customer first');
                    $('#add_item').focus();
                    return false;
                }
               $.ajax({
                type: 'POST',
               url: "{{ URL(Request::segment(1).'/find-shop-current-stock') }}",
               data: {
                term: request.term,
                shop_id: '{{$sale->shop_id}}',
            },
            success: function (data) {
                $(this).removeClass('ui-autocomplete-loading');
                response(data);
            }
        });
    },
    minLength: 1,
    autoFocus: false,
       delay: 250,
    response: function (event, ui) {
        if ($(this).val().length >= 10 && ui.content== 0) {
          Swal.fire('No matching result found! Product might be not entry or active.');
        }
        else if (ui.content.length == 1 && ui.content != 0) {
            ui.item = ui.content[0];
            $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
            $(this).autocomplete('close');
            $(this).removeClass('ui-autocomplete-loading');
        }

    },
    select: function (event, ui) {
        event.preventDefault();
         if (ui.item.id !== 0) {
            var row = ui.item;
            $(this).val('');
            if($('#id' + row.id).serializeArray().length){
            $("#id"+row.id).val(parseInt($("#id"+row.id).val())+1);
            $itemlist   = $('#itemlist');
            $counter    = 0;
            $counter = $("#itemlist tr").length;
                var i = ++$counter;
                $form = $('#dynamic').calx();
                $form.calx('update');
                getQty();
                }
                else{
                    $itemlist   = $('#itemlist');
            $counter    = 0;
            $counter = $("#itemlist tr").length;
                var i = ++$counter;
               $itemlist.append( '<tr>\
                        <td style="width:250px; vertical-align: top; padding-top: 17px;"><input class="form-control input-sm" type="hidden" id="pid" name="product_id[]" value="'+row.id+'" data-format="0" >\ '+row.value+' \<input type="hidden" name="product_name[]" value="'+row.value+'"></td>\
                        <td style="width:120px;"><input class="form-control input-sm text-end" placeholder="0.00" tabindex="10" name="product_price[]" data-cell="P'+i+'" value="'+row.price+'" data-format=""><i class="text-black-50">&nbsp;</i></td>\
                        <td style="width:120px;"><input class="form-control input-sm text-end pquentity" required  type="number" step="any" min=1 max=999999999 required id="id'+row.id+'" data-format="" data-format="0[.]00" onblur="getQty(' + i + ',this);"   name="product_quantity[]"  data-cell="Q'+i+'"><i class="text-black-50">'+'S-' +row.stock+'</i></td> \
                        <td style="width:80px;"><input type="number" step="any" min=0 max=999999999 class="form-control input-sm text-end" onblur="getVat(' + i + ',this);" placeholder="0.00" name="product_vat[]" data-cell="T'+i+'" readonly value="'+row.vat+'" data-format="0[.]0000"><i class="text-black-50">&nbsp;</i></td>\
                          <td style="width:100px;"><input name="product_vat_amount[]" type="number" step="any" min=0 max=999999999 class="form-control input-sm text-end" placeholder="0.00" readonly data-cell="V' + i + '" data-formula="(P' + i + '/100*T' + i +')*Q' +i + ' " data-format="0[.]00"><i class="text-black-50">&nbsp;</i></td>\
                            <td style="width:80px;"><input type="number" step="any" min=0 max=999999999 class="form-control input-sm text-end" onblur="getVat(' + i + ',this);" placeholder="0.00" name="product_discount[]" data-cell="D'+i+'" value="'+row.discount+'" data-format="0[.]0000"><i class="text-black-50">&nbsp;</i></td>\
                          <td style="width:100px;"><input name="product_discount_amount[]" type="number" step="any" min=0 max=999999999 class="form-control input-sm text-end" placeholder="0.00" readonly data-cell="N' + i + '" data-formula="(P' + i + '/100*D' + i +')*Q' +i + ' " data-format="0[.]00"><i class="text-black-50">&nbsp;</i></td>\
                        <td style="width:160px;"><input type="number" readonly step="any" min=1 max=999999999 class="form-control input-sm text-end" placeholder="0.00" name="product_total_price[]"  data-cell="F'+i+'" data-format="0[.]00" data-formula="((Q'+i+')*((P'+i+')+(V'+i+'))-(N'+i+'))"><i class="text-black-50">&nbsp;</i></td>\
                    <td class="text-center"><button class="btn-remove btn btn-sm btn-danger"><i class="fa fa-times fa-fw"></i></button></td>\
                    </tr>');

                 $("#id"+row.id).val(1);
                $form = $('#dynamic').calx();
                $form.calx('update');
                getQty();
                }

        } else {
           Swal.fire('No matching result found! Product might be not listing.');
        }
        $('#itemlist').on('click', '.btn-remove', function(){
                $(this).parent().parent().remove();
                $form.calx('update');
                getQty();
            });
    }
});
//clear
$('#clear').click(function (e) {
  $('#formReset').get(0).reset();
  $('#itemlist').html('');
  Swal.fire('Form Reset Successfully');

});
$("#total_paid, other_discount").keyup(function() {
  var ttotal = $("#grand_total").val() - $("#total_paid").val();
  if(ttotal>0){
    $("#Cachback").html('<strong>Due TK: ' + ttotal.toFixed(2) + '</strong>');
  }else{
    var ctotal = $("#total_paid").val()-$("#grand_total").val();
    $("#Cachback").html('<strong>Change TK: ' + ctotal.toFixed(2) + '</strong>');
  }

  });

//paid save
$('#paid').click(function (e) {
e.preventDefault();
if($('#total_paid').val()==0 && $('#payment_method').val() !=='Due'){
  $('#total_paid').val($('#grand_total').val());
}

  $('#formReset').submit();
});
$('#print').click(function (e) {
e.preventDefault();
if($('#total_paid').val()==0 && $('#payment_method').val() !=='Due'){
  $('#total_paid').val($('#grand_total').val());
}

$('.multisteps-form__content').append('<input type="hidden" name="print">');
  $('#formReset').submit();
});


paymentChange();

$('#payment_method').change(function(){
  paymentChange();
});

});

//onkeyup
function getQty() {
  $form = $('#dynamic').calx();
$form.calx('getCell', 'G1').setFormula('SUM(F1:F5000,C1)-D1');
  $form.calx('getCell', 'Z1').setFormula('L1/(SUM(Q1:Q5000))');
  $form.calx('getCell', 'G1','Z1').calculate();
  $form.calx('update');
}
//onkeyup
function getVat() {
  getQty()
}
function paymentChange() {
  if($('#payment_method').val()=='Bkash'|| $('#payment_method').val()=='Nagad' || $('#payment_method').val()=='Rocket'){
$('#MobileBankPayment').removeClass('d-none');
$('#BankPayment').addClass('d-none');
$('#total_paid').prop('readonly', false);
}
else if($('#payment_method').val()=='Bank'){
 $('#BankPayment').removeClass('d-none');
 $('#MobileBankPayment').addClass('d-none');
 $('#total_paid').prop('readonly', false);
}
else if($('#payment_method').val()=='Due'){
  $('#total_paid').prop('readonly', true);
 $('#BankPayment').removeClass('d-none');
 $('#MobileBankPayment').addClass('d-none');

}
else{
  $('#total_paid').prop('readonly', false);
 $('#MobileBankPayment').addClass('d-none');
 $('#BankPayment').addClass('d-none');

}


}


</script>

@endpush

@extends('backend.layouts.master')
@section('title', 'saleReturn Return Information')
@push('css')
@endpush
@section('content')

<div class="container-fluid py-4">
    <div class="row mb-lg-5">
        <div class="col-lg-12 mx-auto">
            <div class="card my-5">
                <div class="card-header p-3 pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6>saleReturn Information Details</h6>
                            <p class="text-sm mb-0">
                                Date Time. <b>{{ @$saleReturn->created_at->format('m-d-Y') }}</b>
                            </p>
                            <p class="text-sm">
                                Total Due : <b>{{ @$saleReturn->customer->total_balance }}</b>
                            </p>
                        </div>
                        <a href="{{ url()->previous() }}" class="btn bg-gradient-secondary ms-auto mb-0">Back</a>
                    </div>
                </div>
                <div class="card-body p-3 pt-0">
                    <hr class="horizontal dark mt-0 mb-4">
                    <div class="row">
                        <hr class="horizontal dark mt-4 mb-4">
                        <div class="row">
                            <div class="col-lg-2 col-md-4 col-12">
                                <h6 class="mb-3">Customer Information</h6>
                                <div class="timeline timeline-one-side">
                                    <div class="timeline-block mb-3">
                                        <span class="timeline-step">
                                            <i class="ni ni-user-run text-secondary"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">Name</h6>
                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                {{ @$saleReturn->customer->customer_name }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline-block mb-3">
                                        <span class="timeline-step">
                                            <i class="ni ni-circle-08 text-secondary"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">Phone</h6>
                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                {{ @$saleReturn->customer->customer_phone }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline-block mb-3">
                                        <span class="timeline-step">
                                            <i class="ni ni-send text-secondary"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">Email
                                            </h6>
                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                {{ @$saleReturn->customer->customer_email }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline-block mb-3">
                                        <span class="timeline-step">
                                            <i class="ni ni-check-bold text-success text-gradient"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">Address</h6>
                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                {{ @$saleReturn->customer->address }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-8 col-12">
                                <h6 class="mb-3">saleReturn Information details</h6>
                                <div
                                    class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                    <div class="table table-responsive">
                                        <table class="table align-items-center mb-0">

                                            <thead>
                                                <tr>
                                                    <th width="8%">SL </th>
                                                    <th width="30%">Product Name </th>
                                                    <th width="5%"> Qty </th>
                                                    <th width="15%"> UN Price </th>
                                                    <th width="10%"> Vat (%)</th>
                                                    <th width="15%"> Vat Amount </th>
                                                    <th width="10%"> Dis (%)</th>
                                                    <th width="15%"> Dis Amount</th>
                                                    <th width="20%" class="text-right"> Amount </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($saleReturn->saleReturndetails as $saleReturndetail)
                                                <tr class="">
                                                    <td> {{ $loop->index + 1 }}
                                                    </td>
                                                    <td>{{ Str::limit(@$saleReturndetail->product_name, 50, '..') }}</td>
                                                    <td>{{ @$saleReturndetail->return_qty }}</td>
                                                    <td>{{ (@$saleReturndetail->sale_price) }}</td>
                                                    <td>{{(@$saleReturndetail->vat_percent) }}</td>
                                                    <td>{{ (@$saleReturndetail->vat_amount) }}</td>
                                                    <td>{{ (@$saleReturndetail->discount_percent) }}</td>
                                                    <td>{{ (@$saleReturndetail->discount_amount) }}</td>
                                                    <td>{{ (@$saleReturndetail->total_price) }}</td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="2">
                                                        Total
                                                    </td>
                                                    <td colspan="1">
                                                        {{$saleReturn->saleReturndetails->sum('return_qty') }}
                                                    </td>
                                                  
                                                    <td> {{($saleReturn->saleReturndetails->sum('sale_price')) }}
                                                    </td>
                                                    <td></td>
                                                    <td> {{($saleReturn->saleReturndetails->sum('vat_amount')) }}
                                                    </td>
                                                    <td></td>
                                                    <td> {{($saleReturn->saleReturndetails->sum('discount_amount'))
                                                        }}</td>
                                                    <td>
                                                        {{($saleReturn->saleReturndetails->sum('total_price')) }}
                                                    </td>
                                                </tr>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="6"></td>
                                                    <td colspan="2"> Other Discount</td>
                                                    <td>
                                                        {{ (@$saleReturn->other_discount) }}

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6">Payment Method:
                                                        {{@$saleReturn->payment_method}}</td>
                                                    <td colspan="2" >Grand Total</td>
                                                    <td> {{(@$saleReturn->grand_total) }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6"> @if(@$saleReturn->payment_method=='Bkash'
                                                        ||@$saleReturn->payment_method=='Nagad'||
                                                        @$saleReturn->payment_method=='Rocket' )
                                                        Mobile Number: {{$saleReturn->customerdue->phone_number}}
                                                        @elseif(@$saleReturn->payment_method=='Bank')
                                                        Bank Name: {{$saleReturn->customerdue->bank_name}}
                                                        @elseif(@$saleReturn->payment_method=='Other')
                                                        Payment Note: {{$saleReturn->customerdue->note}}
                                                        @endif </td>
                                                    <td colspan="2" >Paid</td>
                                                    <td> {{ (@$saleReturn->pay_amount) }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" > @if(@$saleReturn->payment_method=='Bkash'
                                                        ||@$saleReturn->payment_method=='Nagad'||
                                                        @$saleReturn->payment_method=='Rocket' )
                                                        Transaction Number: {{$saleReturn->customerdue->transaction_number}}
                                                        @elseif(@$saleReturn->payment_method=='Bank')
                                                        Bank Acount: {{$saleReturn->customerdue->bank_account_number}}

                                                        @endif </td>
                                                    @if (@$saleReturn->change_amount>0)
                                                    <td colspan="2">Change</td>
                                                    <td> {{(@$saleReturn->change_amount) }}</td>
                                                    @else
                                                    <td colspan="2">Due</td>
                                                    <td> {{(@$saleReturn->due) }}</td>
                                                    @endif
                                                </tr>
                                            </tfoot>
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
    @endsection
    @push('js')
    <script></script>
    @endpush

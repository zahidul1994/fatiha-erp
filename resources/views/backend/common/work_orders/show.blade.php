@extends('backend.layouts.master')
@section('title', 'Sale Information')
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
                            <h6>Sale Information Details</h6>
                            <p class="text-sm mb-0">
                                Date Time. <b>{{ @$sale->created_at->format('m-d-Y') }}</b>
                            </p>
                            <p class="text-sm">
                                Total Due : <b>{{ @$sale->customer->total_balance }}</b>
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
                                                {{ @$sale->customer->customer_name }}
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
                                                {{ @$sale->customer->customer_phone }}
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
                                                {{ @$sale->customer->customer_email }}
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
                                                {{ @$sale->customer->address }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-8 col-12">
                                <h6 class="mb-3">Sale Information details</h6>
                                <div
                                    class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                    <div class="table table-responsive">
                                        <table class="table align-items-center mb-0">

                                            <thead>
                                                <tr class="text-right">
                                                    <th width="8%">SL </th>
                                                    <th width="30%">Product Name </th>
                                                    <th width="5%"> Qty </th>
                                                    <th width="5%">R Qty </th>
                                                    <th width="15%"> UN Price </th>
                                                    <th width="10%"> Vat (%)</th>
                                                    <th width="15%"> Vat Amount </th>
                                                    <th width="10%"> Dis (%)</th>
                                                    <th width="15%"> Dis Amount</th>
                                                    <th width="20%" class="text-right"> Amount </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sale->saledetails as $saledetail)
                                                <tr class="text-right">
                                                    <td> {{ $loop->index + 1 }}
                                                    </td>
                                                    <td>{{ Str::limit(@$saledetail->product_name, 50, '..') }}</td>
                                                    <td>{{ @$saledetail->qty }}</td>
                                                    <td>{{ @$saledetail->already_return_qty }}</td>
                                                    <td>{{ (@$saledetail->sale_price) }}</td>
                                                    <td>{{(@$saledetail->vat_percent) }}</td>
                                                    <td>{{ (@$saledetail->vat_amount) }}</td>
                                                    <td>{{ (@$saledetail->discount_percent) }}</td>
                                                    <td>{{ (@$saledetail->discount_amount) }}</td>
                                                    <td>{{ (@$saledetail->total_price) }}</td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="2">
                                                        Total
                                                    </td>
                                                    <td colspan="1">
                                                        {{$sale->saledetails->sum('qty') }}
                                                    </td>
                                                    <td>
                                                        {{$sale->saledetails->sum('already_return_qty') }}
                                                    </td>
                                                    <td> {{($sale->saledetails->sum('sale_price')) }}
                                                    </td>
                                                    <td></td>
                                                    <td> {{($sale->saledetails->sum('vat_amount')) }}
                                                    </td>
                                                    <td></td>
                                                    <td> {{($sale->saledetails->sum('discount_amount'))
                                                        }}</td>
                                                    <td>
                                                        {{($sale->saledetails->sum('total_price')) }}
                                                    </td>
                                                </tr>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="7"></td>
                                                    <td colspan="2"> Other Discount</td>
                                                    <td>
                                                        {{ (@$sale->other_discount) }}

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="7">Payment Method:
                                                        {{@$sale->payment_method}}</td>
                                                    <td colspan="2" >Grand Total</td>
                                                    <td> {{(@$sale->grand_total) }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="7"> @if(@$sale->payment_method=='Bkash'
                                                        ||@$sale->payment_method=='Nagad'||
                                                        @$sale->payment_method=='Rocket' )
                                                        Mobile Number: {{$sale->customerdue->phone_number}}
                                                        @elseif(@$sale->payment_method=='Bank')
                                                        Bank Name: {{$sale->customerdue->bank_name}}
                                                        @elseif(@$sale->payment_method=='Other')
                                                        Payment Note: {{$sale->customerdue->note}}
                                                        @endif </td>
                                                    <td colspan="2" >Paid</td>
                                                    <td> {{ (@$sale->pay_amount) }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="7" > @if(@$sale->payment_method=='Bkash'
                                                        ||@$sale->payment_method=='Nagad'||
                                                        @$sale->payment_method=='Rocket' )
                                                        Transaction Number: {{$sale->customerdue->transaction_number}}
                                                        @elseif(@$sale->payment_method=='Bank')
                                                        Bank Acount: {{$sale->customerdue->bank_account_number}}

                                                        @endif </td>
                                                    @if (@$sale->change_amount>0)
                                                    <td colspan="2">Change</td>
                                                    <td> {{(@$sale->change_amount) }}</td>
                                                    @else
                                                    <td colspan="2">Due</td>
                                                    <td> {{(@$sale->due) }}</td>
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

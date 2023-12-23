@extends('backend.layouts.master')
@section('title', 'Show Customer due')
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
                            <h6>Purchase Details</h6>
                            <p class="text-sm mb-0">
                                Invoice no. <b>{{ @$purchase->invoice_no }}</b>
                            </p>
                            <p class="text-sm">
                                Date: <b>{{@$purchase->created_at->format('m-d-Y h:m a')}}</b>
                            </p>
                        </div>
                        <a href="{{ url()->previous()}}" class="btn bg-gradient-secondary ms-auto mb-0">Back</a>
                    </div>
                </div>
                <div class="card-body p-3 pt-0">
                    <hr class="horizontal dark mt-0 mb-4">
                    <div class="row">

                        <hr class="horizontal dark mt-4 mb-4">
                        <div class="row">
                            <div class="col-lg-2 col-md-4 col-12">
                                <h6 class="mb-3">Supplier Information</h6>
                                <div class="timeline timeline-one-side">
                                    <div class="timeline-block mb-3">
                                        <span class="timeline-step">
                                            <i class="ni ni-user-run text-secondary"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">Name</h6>
                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                {{@$purchase->supplier->supplier_name}}
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
                                                {{@$purchase->supplier->supplier_phone}}
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
                                                {{@$purchase->supplier->supplier_email}}
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
                                                {{@$purchase->supplier->address}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-8 col-12">
                                <h6 class="mb-3">Purchase details</h6>
                                <div
                                    class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                    <div class="table table-responsive">
                                        <table class="table align-items-center mb-0">

                                            <thead>
                                                <tr>
                                                    <th width="8%">SL </th>
                                                    <th width="30%">Product Name </th>
                                                    <th width="15%"> Qty </th>
                                                    <th width="15%">R Qty </th>
                                                    <th width="15%"> P Price </th>
                                                    <th width="10%"> Vat (%)</th>
                                                    <th width="15%"> Vat Amount </th>
                                                    <th width="20%" class="text-right"> Amount </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($purchase->purchasedetails as $purchasedetail)
                                                <tr class="">
                                                    <td> {{ $loop->index + 1 }}
                                                    </td>
                                                    <td>{{ Str::limit(@$purchasedetail->product_name, 50, '..') }}</td>
                                                    <td>{{ @$purchasedetail->qty }}</td>
                                                    <td>{{ @$purchasedetail->already_return_qty }}</td>
                                                    <td>{{ (@$purchasedetail->purchase_price) }}</td>
                                                    <td>{{(@$purchasedetail->vat_percent) }}</td>
                                                    <td>{{(@$purchasedetail->vat_amount) }}</td>
                                                    <td>{{ (@$purchasedetail->total_price+$purchasedetail->vat_amount)
                                                        }}</td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="2">
                                                        Total
                                                    </td>
                                                    <td colspan="1">
                                                        {{$purchase->purchasedetails->sum('qty') }}
                                                    </td>
                                                    <td>
                                                        {{$purchase->purchasedetails->sum('already_return_qty') }}
                                                    </td>
                                                    <td> {{($purchase->purchasedetails->sum('purchase_price')) }}</td>
                                                    <td></td>
                                                    <td> {{($purchase->purchasedetails->sum('vat_amount')) }}</td>

                                                    <td>
                                                        {{($purchase->purchasedetails->sum('total_price')+$purchase->purchasedetails->sum('vat_amount'))
                                                        }}
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td colspan="6"></td>
                                                    <td>Discount</td>
                                                    <td>
                                                        {{($purchase->total_discount) }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>

                                                <tr>
                                                    <td colspan="5" style="text-align: center">Payment Method:
                                                        {{@$purchase->payment_method}}</td>
                                                    <td colspan="2" style="text-align: right">Grand Total</td>
                                                    <td> {{(@$purchase->grand_total) }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" style="text-align: center"> @if(@$purchase->payment_method=='Bkash'
                                                        ||@$purchase->payment_method=='Nagad'||
                                                        @$purchase->payment_method=='Rocket' )
                                                        Mobile Number: {{$purchase->customerdue->phone_number}}
                                                        @elseif(@$purchase->payment_method=='Bank')
                                                        Bank Name: {{$purchase->customerdue->bank_name}}
                                                        @elseif(@$purchase->payment_method=='Other')
                                                        Payment Note: {{$purchase->customerdue->note}}
                                                        @endif </td>
                                                    <td colspan="2" style="text-align: right">Paid</td>
                                                    <td> {{(@$purchase->paid) }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" style="text-align: center"> @if(@$purchase->payment_method=='Bkash'
                                                        ||@$purchase->payment_method=='Nagad'||
                                                        @$purchase->payment_method=='Rocket' )
                                                        Transaction Number:
                                                        {{$purchase->customerdue->transaction_number}}
                                                        @elseif(@$purchase->payment_method=='Bank')
                                                        Bank Acount: {{$purchase->customerdue->bank_account_number}}

                                                        @endif </td>
                                                    <td colspan="2" style="text-align: right">Due</td>
                                                    <td> {{(@$purchase->due) }}</td>
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

    <script>

    </script>

    @endpush

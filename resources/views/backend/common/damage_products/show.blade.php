@extends('backend.layouts.master')
@section('title', 'Damage Product Information')
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
                            <h6>Damage Information Details</h6>
                            <p class="text-sm mb-0">
                                Date. <b>{{ @$damageProducts->created_at->format('m-d-Y') }}</b>
                            </p>
                            <p class="text-sm">
                                Damage Amount: <b>{{ @$damageProducts->grand_total }}</b>
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
                                <h6 class="mb-3">Shop Information</h6>
                                <div class="timeline timeline-one-side">
                                    <div class="timeline-block mb-3">
                                        <span class="timeline-step">
                                            <i class="ni ni-user-run text-secondary"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">Name</h6>
                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                {{ @$damageProducts->shop->shop_name }}
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
                                                {{ @$damageProducts->shop->shop_phone }}
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
                                                {{ @$damageProducts->shop->shop_email }}
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
                                                {{ @$damageProducts->shop->shop_address }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-8 col-12">
                                <h6 class="mb-3">Damage product Information details</h6>
                                <div
                                    class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                    <div class="table table-responsive">
                                        <table class="table align-items-center mb-0">
                                             <caption>  Note: {{$damageProducts->note?:'No Note'}}</caption>
                                            <thead>
                                                <tr>
                                                    <th width="8%">SL </th>
                                                    <th width="30%">Product Name </th>
                                                    <th width="10%"> Expire Date </th>
                                                    <th width="10%"> Purchase Price</th>
                                                    <th width="10%"> Qty</th>
                                                    <th width="10%"> Vat (%) </th>
                                                    <th width="10%">Vat Amount</th>
                                                    <th width="20%">Total Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($damageProducts->damageproductdetails as $item)
                                                <tr class="">
                                                    <td> {{ $loop->index + 1 }}</td>
                                                    <td>{{ Str::limit(@$item->product_name, 50, '..') }}</td>
                                                    <td>{{$item->product_expire_date}} </td>
                                                    <td>{{$item->purchase_price}} </td>
                                                    <td>{{$item->qty}} </td>
                                                    <td>{{$item->vat_percent}} </td>
                                                    <td>{{$item->vat_amount}} </td>
                                                    <td>{{$item->total_price}} </td>
                                                </tr>
                                                @endforeach


                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3">
                                                        Total
                                                    </td>
                                                    <td>{{$damageProducts->damageproductdetails->sum('purchase_price')}}
                                                    </td>
                                                    <td>{{$damageProducts->damageproductdetails->sum('qty')}}</td>
                                                    <td></td>
                                                    <td>{{$damageProducts->damageproductdetails->sum('vat_amount')}}
                                                    </td>
                                                    <td>{{$damageProducts->damageproductdetails->sum('total_price')}}
                                                    </td>
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

    </div>
    @endsection
    @push('js')
    <script></script>
    @endpush

@extends('backend.layouts.master')
@section('title', 'Requisition Information')
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
                            <h6>Requisition Information Details</h6>
                            <p class="text-sm mb-0">
                                Date Time. <b>{{ @$requisition->created_at->format('m-d-Y') }}</b>
                            </p>
                            <p class="text-sm">
                                Status : <b>{{ @$requisition->status }}</b>
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
                                <h6 class="mb-3">Supplier Information</h6>
                                <div class="timeline timeline-one-side">
                                    <div class="timeline-block mb-3">
                                        <span class="timeline-step">
                                            <i class="ni ni-user-run text-secondary"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">Name</h6>
                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                {{ @$requisition->supplier->supplier_name }}
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
                                                {{ @$requisition->supplier->supplier_phone }}
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
                                                {{ @$requisition->supplier->supplier_email }}
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
                                                {{ @$requisition->supplier->supplier_address }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-8 col-12">
                                <h6 class="mb-3">Requisition  Information details</h6>
                                <div
                                    class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                    <div class="table table-responsive">
                                        <table class="table align-items-center mb-0">

                                            <thead>
                                                <tr class="text-right">
                                                    <th width="8%">SL </th>
                                                    <th width="60%">Product Name </th>
                                                    <th width="5%"> Qty </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($requisition->requisitiondetails as $work)
                                                <tr class="text-right">
                                                    <td> {{ $loop->index + 1 }}</td>
                                                    <td>{{ Str::limit(@$work->product_name, 50, '..') }}</td>
                                                    <td>{{ @$work->qty }}</td>
                                                   
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="2">
                                                        Total
                                                    </td>
                                                    <td colspan="1">
                                                        {{$requisition->total_quantity }}
                                                    </td>
                                                 
                                                    <td></td>
                                                    
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
    @endsection
    @push('js')
    <script></script>
    @endpush

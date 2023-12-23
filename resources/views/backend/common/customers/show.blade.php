@extends('backend.layouts.master')
@section('title', 'Customer Information')
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
                                <h6>Customer Information Details</h6>
                                <p class="text-sm mb-0">
                                    Date Time. <b>{{ @$customer->created_at->format('m-d-Y') }}</b>
                                </p>
                                <p class="text-sm">
                                    Total Due : <b>{{ @$customer->total_balance }}</b>
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
                                                    {{ @$customer->customer_name }}
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
                                                    {{ @$customer->customer_phone }}
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
                                                    {{ @$customer->customer_email }}
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
                                                    {{ @$customer->address }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-8 col-12">
                                    <h6 class="mb-3">Customer Information details</h6>
                                    <div
                                        class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                        <div class="table table-responsive">
                                            <table class="table align-items-center mb-0">

                                                <thead>
                                                    <tr>
                                                        <th width="8%">SL </th>
                                                        <th width="25%">Date </th>
                                                        <th width="25%">Note </th>
                                                        <th width="15%"> Payment Method </th>
                                                        <th width="20%"> Due </th>
                                                        <th width="20%"> Paid </th>
                                                        <th width="20%"> Total </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($customer->customerdue as $due)
                                                        <tr>
                                                            <td>
                                                                {{ $loop->index+1 }}
                                                            </td>
                                                            <td>
                                                                {{ $due->created_at }}
                                                            </td>
                                                            <td>
                                                                {{ $due->note }}
                                                            </td>
                                                            <td>
                                                                {{ @$due->payment_method }}
                                                            </td>
                                                            <td>
                                                                {{ $due->due }}
                                                            </td>
                                                            <td>
                                                                {{ $due->paid }}
                                                            </td>
                                                            <td>
                                                                {{ $due->paid - $due->due }}
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                                <tfoot>
                                              <tr class="text-bold">
                                                <td colspan="4">Total</td>
                                                <td>{{ @$customer->total_due}}</td>
                                                <td>{{ @$customer->total_paid}}</td>
                                                <td>{{ @$customer->total_balance}}</td>
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

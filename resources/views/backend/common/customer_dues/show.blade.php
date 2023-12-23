@extends('backend.layouts.master')
@section('title', 'Customer Due Payment')
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
                                    Date Time. <b>{{ @$customerDue->created_at->format('m-d-Y') }}</b>
                                </p>
                                <p class="text-sm">
                                    Total Paid : <b>  {{$customerDue->paid}} </b>
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
                                                    {{ @$customerDue->customer->customer_name }}
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
                                                    {{ @$customerDue->customer->customer_phone }}
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
                                                    {{ @$customerDue->customer->customer_email }}
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
                                                    {{ @$customerDue->customer->address }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-8 col-12">
                                    <h6 class="mb-3">Customer Payment details</h6>
                                    <div
                                        class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                        <div class="table table-responsive">
                                            <table class="table align-items-center mb-0">

                                                <thead>
                                                    <tr>
                                                        <th width="15%">Date </th>
                                                        <th width="25%">Note </th>
                                                        <th width="15%"> Payment Method </th>
                                                       <th width="20%"> Due </th>
                                                       <th width="20%"> Paid </th>
                                                       <th width="20%"> Total </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="text-bold">
                                                        <td>
                                                            {{$customerDue->created_at}}
                                                        </td>
                                                        <td>
                                                            {{$customerDue->note}}
                                                        </td>
                                                        <td>
                                                            {{@$customerDue->payment_method}}
                                                        </td>
                                                        <td>
                                                            {{$customerDue->due}}
                                                        </td>
                                                        <td>
                                                            {{$customerDue->paid}}
                                                        </td>
                                                        <td>
                                                            {{$customerDue->paid-$customerDue->due}}
                                                        </td>
                                                    </tr>

                                                </tbody>
                                                <tfoot>

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

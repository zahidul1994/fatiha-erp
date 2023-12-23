@extends('backend.layouts.master')
@section('title', 'Shop Details')
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
                            <h6>Shop Details</h6>
                            <p class="text-sm mb-0">
                                Opening Date. <b>{{@$shop->created_at->format('m-d-Y')}}</b>
                            </p>
                            <p class="text-sm">
                                Opening  Time: <b>{{@$shop->created_at->format('h:m a')}}</b>
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
                                <h6 class="mb-3">Shop Information</h6>
                                <div class="timeline timeline-one-side">
                                    <div class="timeline-block mb-3">
                                        <span class="timeline-step">
                                            <i class="ni ni-user-run text-secondary"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">Name</h6>
                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                {{@$shop->shop_name}}
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
                                                {{@$shop->shop_phone}}
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
                                                {{@$shop->shop_email}}
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
                                                {{@$shop->shop_address}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-8 col-12">
                                <h6 class="mb-3">Stock details</h6>
                                <div
                                    class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                    <div class="table table-responsive">
                                        <table class="table align-items-center mb-0">

                                            <thead>
                                                <tr>
                                                    <th>Sl</th>
                                                    <th>Expire</th>
                                                    <th>Product </th>
                                                    <th>Barcode </th>
                                                    <th>Vat</th>
                                                    <th>Discount</th>
                                                    <th>LPP</th>
                                                    <th>LSP</th>
                                                    <th>Stock</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($shopCurrentStocks as $stock)
                                                <tr>
                                                    <td> {{ $loop->index + 1 }}</td>
                                                    <td>{{ @$stock->expire_date }}</td>
                                                    <td>{{ @$stock->product_name }}</td>
                                                    <td>{{ @$stock->barcode }}</td>
                                                    <td>{{ (@$stock->last_purchase_price) }}</td>
                                                    <td>{{ (@$stock->discount) }}</td>
                                                    <td>{{(@$stock->last_purchase_vat) }}</td>
                                                    <td>{{(@$stock->last_sale_price) }}</td>
                                                    <td>{{ (@$stock->stock_qty) }}</td>
                                                </tr>
                                                @endforeach


                                            </tbody>
                                            <tfoot>

                                                <tr class="text-bold">
                                                    <td colspan="4">
                                                        Total
                                                    </td>
                                                    <td colspan="1">
                                                        {{($shopCurrentStocks->sum('last_purchase_price'))}}
                                                    </td>
                                                    <td>
                                                        {{($shopCurrentStocks->sum('last_purchase_vat')) }}
                                                    </td>
                                                    <td> {{($shopCurrentStocks->sum('discount')) }}</td>

                                                    <td> {{($shopCurrentStocks->sum('last_sale_price'))
                                                        }}</td>

                                                    <td>
                                                        {{($shopCurrentStocks->sum('stock_qty')) }}
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
    @endsection
    @push('js')

    <script>

    </script>

    @endpush

@php

$setup=Helper::adminSetup();

@endphp
@extends('backend.layouts.master')
@section('title', 'Show Product')
@push('css')

@endpush
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-4">Product Details</h5>
                    <div class="row">
                        
                        <div class="col-xl-5 col-lg-6 text-center">
                            
                            <img class="img-fluid border-radius-lg shadow-lg mx-auto"
                                src="{{asset(@$product->path.'/'.@$product->photo)}}" alt="chair"
                                style="max-width: 250px !important">
                            <div class="my-gallery d-flex mt-4 pt-2">
                                @php $info = " Id : $product->sku \n Product : $product->name \n Code :
                                $product->hs_code \n Price : $product->sale_price"
                                @endphp
                                <a href="data:image/png;base64,{!! DNS2D::getBarcodePNG($info, 'QRCODE') !!}"
                                    class="image-fluid mx-auto" download="{{$product->product_name}}"> <img
                                        class="img-fluid"
                                        src="data:image/png;base64,{!! DNS2D::getBarcodePNG($info, 'QRCODE') !!}"
                                        alt="hs_code" /> </a>
                            </div>
                            <div class="row border-radius-lg shadow-lg mx-auto mt-2">
                                <div class="col-md-4">Alert QTY :<br>
                                    {{$product->low_quantity}}
                                </div>
                                <div class="col-md-4">Expire: <br>
                                    {{$product->expire_date?:'No'}}
                                </div>
                                <div class="col-md-4">Rack : <br>
                                    {{$product->rack_number?:'No'}}
                                </div>
                                <hr />
                                <br />
                                <br />
                                <div class="row border-radius-lg shadow-lg mx-auto">
                                    <div class="col-md-3">Brand :<br>
                                        {{$product->brand->brand_name}}
                                    </div>
                                    <div class="col-md-6">Category: <br>
                                        {{$product->category->category_name}}
                                    </div>
                                    <div class="col-md-3">Subcate: <br>
                                        {{$product->subcategory->sub_category_name?:'No Add'}}
                                    </div>
    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 mx-auto">
                            <h3 class="mt-lg-0 mt-4 text-uppercase">{{@$product->product_full_name}}</h3>
                            <div class="rating">
                                <img class="img-fluid"
                                    src="data:image/png;base64, {!!DNS1D::getBarcodePNG(@$product->hs_code, 'C39+')!!}" />
                                <h6 class="text-center h6">{{$product->hs_code}}</h6>
                            </div>
                            <br>
                            <br>

                            <br>
                            <div class="row border-radius-lg shadow-lg mx-auto">
                                <div class="col-md-4">Unit/Mesurement :<br>
                                    {{$product->weight_size}} : {{$product->unit}}
                                </div>
                                <div class="col-md-4">Purchase Price: <br>
                                    {{ @$setup->currency_name}} {{$product->purchase_price}} {{ @$setup->currency_icon}}
                                </div>
                                <div class="col-md-4">Sale Price: <br>
                                    {{ @$setup->currency_name}} {{$product->sale_price}} {{ @$setup->currency_icon}}
                                </div>

                            </div>
                            
                            <hr />
                            <div class="row border-radius-lg shadow-lg mx-auto">
                                <div class="col-md-3">AVG Price :<br>
                                    {{ @$setup->currency_name}} {{$product->average_price}} {{ @$setup->currency_icon}}
                                </div>
                                <div class="col-md-6">Vat: <br>
                                    {{$product->vat}} (%)
                                </div>
                                <div class="col-md-3">Discount: <br>
                                    {{$product->discount}}(%)
                                </div>

                            </div>
                            <hr />
                            <div class="row border-radius-lg shadow-lg mx-auto">
                                <div class="col-md-3">Product: <br>
                                    {{$product->product_name}}
                                </div>
                                <div class="col-md-3">Sku :<br>
                                    {{$product->sku}}
                                </div>

                                <div class="col-md-6">Made: <br>
                                    {{$product->made_in}}
                                </div>
                                <a href="{{ url()->previous() }}" class="btn bg-gradient-secondary ms-auto mb-0">Back</a>

                            </div>

                            <label class="mt-4">Description</label>
                            <ul>
                                {!! @$product->description?:'There are no proudct description' !!}
                            </ul>

                        </div>
                    </div>
                    {{-- <div class="row mt-5">
                        <div class="col-12">
                            <h5 class="ms-3">Other Products</h5>
                            <div class="table table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Product</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Price</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Review</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Availability</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Id</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>

                                                        <img src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/product-thumb-1.jpg"
                                                            class="avatar avatar-md me-3" alt="table image">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Christopher Knight Home</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm text-secondary mb-0">$89.53</p>
                                            </td>
                                            <td>
                                                <div class="rating ms-lg-n4">
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star-half-alt" aria-hidden="true"></i>
                                                </div>
                                            </td>
                                            <td class="align-middle text-sm">
                                                <div class="progress mx-auto">
                                                    <div class="progress-bar bg-gradient-success" role="progressbar"
                                                        style="width: 80%" aria-valuenow="80" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-sm">230019</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/product-thumb-2.jpg"
                                                            class="avatar avatar-md me-3" alt="table image">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Bar Height Swivel Barstool</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm text-secondary mb-0">$99.99</p>
                                            </td>
                                            <td>
                                                <div class="rating ms-lg-n4">
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                </div>
                                            </td>
                                            <td class="align-middle text-sm">
                                                <div class="progress mx-auto">
                                                    <div class="progress-bar bg-gradient-success" role="progressbar"
                                                        style="width: 90%" aria-valuenow="90" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-sm">87120</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/product-thumb-3.jpg"
                                                            class="avatar avatar-md me-3" alt="table image">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Signature Design by Ashley</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm text-secondary mb-0">$129.00</p>
                                            </td>
                                            <td>
                                                <div class="rating ms-lg-n4">
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star-half-alt" aria-hidden="true"></i>
                                                </div>
                                            </td>
                                            <td class="align-middle text-sm">
                                                <div class="progress mx-auto">
                                                    <div class="progress-bar bg-gradient-warning" role="progressbar"
                                                        style="width: 60%" aria-valuenow="60" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-sm">412301</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/product-thumb-4.jpg"
                                                            class="avatar avatar-md me-3" alt="table image">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Modern Square</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm text-secondary mb-0">$59.99</p>
                                            </td>
                                            <td>
                                                <div class="rating ms-lg-n4">
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star-half-alt" aria-hidden="true"></i>
                                                </div>
                                            </td>
                                            <td class="align-middle text-sm">
                                                <div class="progress mx-auto">
                                                    <div class="progress-bar bg-gradient-warning" role="progressbar"
                                                        style="width: 40%" aria-valuenow="40" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-sm">001992</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="{{ asset('backend/assets/select2/js/select2.min.js') }}"></script>

<script>



</script>

@endpush
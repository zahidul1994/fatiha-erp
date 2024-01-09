@extends('backend.layouts.master')
@section('title', 'Stock Product Update')
@push('css')
<link href="{{ asset('backend/assets/select2/css/select2.min.css') }}" rel="stylesheet" />
<style>
    .select2-selection__choice {
        background-color: var(--bs-gray-200);
        border: none !important;
        font-size: 12px;
        font-size: 0.85rem !important;
    }
</style>
@endpush
@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header pb-4">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Shop Current Stock </p>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @include('partial.formerror')
                        {!! Form::model($shopCurrentStock, [
                        'route' => [Request::segment(1) . '.shop-current-stocks.update', $shopCurrentStock->id],
                        'method' => 'PATCH',
                        'id' => 'formReset'
                        ]) !!}

                        @include('backend.common.shop_current_stocks.form')

                        <div class="text-center mt-3">
                            <a href="{{ url()->previous()}}" class="btn btn-success">
                                <i class="fa fa-backward"> </i> Back

                            </a>
                            <button type="submit" class="btn btn-primary  ms-auto">Update</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<!-- select2 init -->
<script src="{{ asset('backend/assets/select2/js/select2.min.js') }}"></script>

<script>
    $(".select2").select2();
 
</script>

@endpush

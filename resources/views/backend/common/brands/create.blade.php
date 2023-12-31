@extends('backend.layouts.master')
@section('title', 'Create Product')
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
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Brand Create</p>
                            <a href="{{ route(Request::segment(1) . '.brands.index') }}"
                                class="btn btn-primary btn-sm ms-auto">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @include('partial.formerror')
                            {!! Form::open(['route' => Request::segment(1) . '.brands.store', 'method' => 'POST', 'files' => true]) !!}
                            @include('backend.common.brands.form')
                            <div class="text-center mt-3">
                                <button type="submit" name="saveandback"  class="btn btn-info btn-sm ms-auto">Save & Back</button>
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Save</button>
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
       $(".select2").select2({
  tags: true
});
  </script>

@endpush


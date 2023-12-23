@extends('backend.layouts.master')
@section('title', 'Update Business Setup')
@push('css')
<link href="{{ asset('backend/assets/select2/css/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Business Setup Update</p>
                        <a href="{{ route(Request::segment(1) . '.dashboard.index') }}"
                            class="btn btn-primary btn-sm ms-auto">Dashboard</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @include('partial.formerror')
                        {!! Form::model($setup, [
                        'route' => [Request::segment(1) . '.businessSetupUpdate'],
                        'method' => 'POST',
                        'files' => true,
                        ]) !!}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="default_customer_id" class="form-control-label">Default Customer * </label>
                                {!! Form::select('default_customer_id',Helper::customerPluckValue(), null, ['id' =>
                                'customerId', 'class'
                                => 'form-control select2']) !!}
                                @if ($errors->has('default_customer_id'))
                                <span class="text-danger alert">{{ $errors->first('default_customer_id') }}</span>
                                @endif
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Update</button>
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
    <script src="{{ asset('backend/assets/select2/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
   
    $('.select2').select2();
  });
    </script>
    @endpush
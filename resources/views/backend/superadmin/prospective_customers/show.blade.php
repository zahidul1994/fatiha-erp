@extends('backend.layouts.superadminmaster')
@section('title', 'Show Prospective Customers')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header pb-4">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Prospective Customers Show</p>
                        <a href="{{route(Request::segment(1).'.prospective-customers.index')}}"
                            class="btn btn-primary btn-sm ms-auto"><i class="fa fa-backward"> </i> Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @include('partial.formerror')

                        {!! Form::model($customer, [
                        'route' => [Request::segment(1) . '.prospective-customers.update', $customer->id],
                        'method' => 'PATCH',
                        'files' => true,
                        ]) !!}
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">Full Name (Customer) * </label>
                                    {!! Form::text('name', null, ['id' => 'name','class' => 'form-control','readonly',
                                    ]) !!}
                                    @if ($errors->has('name')) <span class="text-danger alert">{{ $errors->first('name')
                                        }}</span> @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-control-label">Email * </label>
                                    {!! Form::email('email', null, ['id' => 'email','class' =>
                                    'form-control','readonly',
                                    ]) !!}
                                    @if ($errors->has('email')) <span class="text-danger alert">{{
                                        $errors->first('email')
                                        }}</span> @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone" class="form-control-label">Phone * </label>
                                    {!! Form::tel('phone', null, ['id' => 'phone','class' => 'form-control','readonly',
                                    ]) !!}
                                    @if ($errors->has('phone')) <span class="text-danger alert">{{
                                        $errors->first('phone')
                                        }}</span> @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address" class="form-control-label">City * </label>
                                    {!! Form::text('address', null, ['id' => 'address','class' =>
                                    'form-control','readonly',
                                    ]) !!}
                                    @if ($errors->has('address')) <span class="text-danger alert">{{
                                        $errors->first('address')
                                        }}</span> @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="comment" class="form-control-label">Comment * </label>
                                    {!! Form::text('comment', null, ['id' => 'comment','class' =>
                                    'form-control','readonly',
                                    ]) !!}
                                    @if ($errors->has('comment')) <span class="text-danger alert">{{
                                        $errors->first('comment')
                                        }}</span> @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="refer_code" class="form-control-label">Refer Code </label>
                                    {!! Form::text('refer_code', null, ['id' => 'refer_code','class' =>
                                    'form-control','readonly',
                                    ]) !!}
                                    @if ($errors->has('refer_code')) <span class="text-danger alert">{{
                                        $errors->first('refer_code')
                                        }}</span> @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="status" class="form-control-label">Status * </label>
                                {!! Form::select('status',[2=>'Reject',1=>'Customer',0=>'Pending'],null, ['id' =>
                                'status','class' =>
                                'form-control','disabled'
                                ]) !!}
                                @if ($errors->has('status')) <span class="text-danger alert">{{ $errors->first('status')
                                    }}</span> @endif
                            </div>
                        </div>
                    </div>
                    
            </div>
        </div>
    </div>

</div>
</div>
@endsection

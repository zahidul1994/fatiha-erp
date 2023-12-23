@extends('backend.layouts.master')
@section('title', 'Settings')
@push('css')
    <link href="{{ asset('backend/assets/select2/css/select2.min.css') }}" rel="stylesheet" />
    <style>
        .select2-selection__choice {
            background-color: var(--bs-gray-200);
            border: none !important;
            font-size: 12px;
            font-size: 0.85rem !important;
        }


    .c-rating>label {
        color: #dad9dc;
        float: right;
        margin-bottom: 0;
    }

    .c-rating>label:before {
        margin: 0 2px;
        content: '\f005';
        font-family: "Font Awesome 5 Free";
        font-style: normal;
        font-weight: normal;
        font-size: 25px;
        display: inline-block;
    }

    .c-rating>input {
        display: none;
    }


    .c-rating>input:checked~label,
    .c-rating:not(:checked)>label:hover,
    .c-rating:not(:checked)>label:hover~label {
        color: #9500ff;
    }


    </style>
@endpush
@section('content')
<div class="container-fluid my-5 py-2">
    <div class="row mb-5">
        <div class="col-lg-3">
            <div class="card position-sticky top-1">
                <ul class="nav flex-column bg-white border-radius-lg p-3">
                    <li class="nav-item">
                        <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#profile">
                            <i class="ni ni-spaceship me-2 text-dark opacity-6"></i>
                            <span class="text-sm">Profile</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#basic-info">
                            <i class="ni ni-books me-2 text-dark opacity-6"></i>
                            <span class="text-sm">Basic Info</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#password">
                            <i class="ni ni-atom me-2 text-dark opacity-6"></i>
                            <span class="text-sm">Change Password</span>
                        </a>
                    </li>



                    <li class="nav-item pt-2">
                        <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#sessions">
                            <i class="ni ni-watch-time me-2 text-dark opacity-6"></i>
                            <span class="text-sm">Sessions</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-9 mt-lg-0 mt-4">

            <div class="card card-body" id="profile">
                <div class="row justify-content-center align-items-center">
                    <div class="col-sm-auto col-4">
                        <div class="avatar avatar-xl position-relative">

                            <img src="{{asset($profileInfo->image)}}" alt="{{@$profileInfo->name}}"
                                class="w-100 border-radius-lg shadow-sm">
                        </div>
                    </div>
                    <div class="col-sm-auto col-8 my-auto">
                        <div class="h-100">
                            <h5 class="mb-1 font-weight-bolder">
                                {{@$profileInfo->name}}
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                {{@$profileInfo->user_type}}
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
                        <label class="form-check-label mb-0">
                            <small id="profileVisibility">Switch to visible</small>
                        </label>
                        <div class="form-check form-switch ms-2">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault23" checked=""
                                onchange="visible()">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4" id="basic-info">
                @include('partial.formerror')
                {!! Form::model($profileInfo, [
                    'route' => [Request::segment(1) . '.profilesUpdate'],
                    'method' => 'POST',
                    'files' => true,
                ]) !!}

                <div class="card-header pb-4">
                    <h5>Basic Info</h5>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label">Full Name</label>
                            <div class="input-group">
                                {!! Form::text('name', null, ['id' => 'name','class' => 'form-control','required',
                                ]) !!}
                              @if ($errors->has('name')) <span class="text-danger alert">{{ $errors->first('name') }}</span> @endif

                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Position *</label>
                            <div class="input-group">
                                {!! Form::text('position', @$profileInfo->profile->position?:null, ['id' => 'position','class' => 'form-control','required',
                                ]) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label class="form-label mt-4">Phone *</label>
                            <div class="input-group">
                                {!! Form::tel('phone',null, ['id' => 'phone','class' => 'form-control','required']) !!}
                               @if ($errors->has('phone')) <span class="text-danger alert">{{ $errors->first('phone') }}</span> @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label mt-4">Email *</label>
                            <div class="input-group">
                                {!! Form::email('email', null, ['id' => 'email','class' => 'form-control','required',
                                ]) !!}
                              @if ($errors->has('email')) <span class="text-danger alert">{{ $errors->first('email') }}</span> @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-6">
                            <label class="form-label mt-4">Country *</label>
                            <div class="input-group">
                                {!! Form::select('country',Helper::getCountryName(),@$profileInfo->profile->country?:null, ['id' => 'country','class' => 'form-control select2','required']) !!}@if ($errors->has('country')) <span class="text-danger alert">{{ $errors->first('country') }}</span> @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label mt-4" id="shop">Shop *</label>
                            <div class="input-group">
                                {!! Form::text('shop',@$profileInfo->shop->shop_name, ['id' => 'shop','class' => 'form-control','readonly']) !!}@if ($errors->has('shop')) <span class="text-danger alert">{{ $errors->first('shop') }}</span> @endif
                            </div>
                        </div>


                        <div class="col-6">
                            <label class="form-label mt-4">Gender</label>
                            <div class="input-group">
                                {!! Form::select('gender',['Male'=>'Male','Female'=>'Female','Other'=>'Other'], @$profileInfo->profile->gender?:null, ['id' => 'gender','class' => 'form-control','required',]) !!}
                            </div>
                        </div>


                        <div class="col-6">
                            <label class="form-label mt-4">Your Photo [150*150]</label>
                            <div class="input-group">
                                {!! Form::file('image', ['id' => 'example-text-input', 'class' => 'form-control']) !!}
                                @if ($errors->has('image')) <span class="text-danger alert">{{ $errors->first('image') }}</span> @endif
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="input-group">
                            <img src="{{asset($profileInfo->image)}}" class="img-fluid mt-1" style="max-width:150px; max-height:150px;">
                        </div>
                        </div>

                        <div class="col-12 mt-2">
                        <button type="submit" class="btn btn-primary btn-sm ms-auto">Update</button>
                        </div>
                    </div>

                </div>

                {!! Form::close() !!}

            </div>

            <div class="card mt-4" id="password">
                <div class="card-header pb-4">
                    <h5>Change Password</h5>
                </div>
               {!! Form::open(['route' => Request::segment(1) . '.passwordUpdate', 'method' => 'POST']) !!}
                <div class="card-body pt-0">
                    <label class="form-label">Current password</label>
                    <div class="form-group">
                      {!! Form::text('currentpassword',null, ['id' => 'currentpassword','class' => 'form-control'
                        ]) !!}
                      @if ($errors->has('currentpassword')) <span class="text-danger alert">{{ $errors->first('currentpassword') }}</span> @endif
                    </div>
                    <label class="form-label">New password</label>
                    <div class="form-group">
                        {!! Form::password('password', ['id' => 'password','class' => 'form-control']) !!}
                      @if ($errors->has('password')) <span class="text-danger alert">{{ $errors->first('password') }}</span> @endif
                    </div>
                    <label class="form-label">Confirm new password</label>
                    <div class="form-group">
                        {!! Form::password('confirm', ['id' => 'confirm','class' => 'form-control']) !!}
                      @if ($errors->has('confirm')) <span class="text-danger alert">{{ $errors->first('confirm') }}</span> @endif
                    </div>
                    <h5 class="mt-5">Password requirements</h5>
                    <p class="text-muted mb-2">
                        Please follow this guide for a strong password:
                    </p>
                    <ul class="text-muted ps-4 mb-0 float-start">
                        <li>
                            <span class="text-sm">One special characters</span>
                        </li>
                        <li>
                            <span class="text-sm">Min 6 characters</span>
                        </li>
                        <li>
                            <span class="text-sm">One number (2 are recommended)</span>
                        </li>
                        <li>
                            <span class="text-sm">Change it often</span>
                        </li>
                    </ul>
                    <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0">Update Password</button>
                </div>
                {!! Form::close() !!}
            </div>




            <div class="card mt-4" id="sessions">
                <div class="card-header pb-3">
                    <h5>Sessions</h5>
                    <p class="text-sm">This is a list of devices that have logged into your account. Remove those that
                        you do not recognize.</p>
                </div>
                <div class="card-body pt-0">
                    <div class="d-flex align-items-center">
                        <div class="text-center w-5">
                            <i class="fas fa-desktop text-lg opacity-6" aria-hidden="true"></i>
                        </div>
                        <div class="my-auto ms-3">
                            <div class="h-100">
                                <p class="text-sm mb-1">
                                    Bucharest {{@$profileInfo->ip_address}}
                                </p>
                                <p class="mb-0 text-xs">
                                    Your current session
                                </p>
                            </div>
                        </div>
                        <span class="badge badge-success badge-sm my-auto ms-auto me-3">Active</span>
                        <p class="text-secondary text-sm my-auto me-3">{{(Request::header('user-agent'))}}</p>

                    </div>

                </div>
            </div>

           
        </div>
    </div>

</div>
@endsection

@push('js')
<!-- CKEditor init -->
<script src="{{ asset('backend/assets/select2/js/select2.min.js') }}"></script>
<script>
$('.select2').select2();

    $('#deleteAccount').click(function (e) {
        alert();

        });
</script>
@endpush

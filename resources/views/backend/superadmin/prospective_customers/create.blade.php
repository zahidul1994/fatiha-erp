@extends('backend.layouts.superadminmaster')
@section('title', 'Create Prospective Customers')
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
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header pb-4">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Prospective Customers Create</p>
                            <a href="{{route(Request::segment(1).'.admins.index')}}" class="btn btn-primary btn-sm ms-auto"><i class="fa fa-backward"> </i>  Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        @include('partial.formerror')
                        {!! Form::open(['route' => Request::segment(1) . '.prospective-customers.store', 'method' => 'POST', 'files' => true]) !!}
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">Full Name (Customer) * </label>
                                    {!! Form::text('name', null, ['id' => 'name','class' => 'form-control','required',
                                    ]) !!}
                                    @if ($errors->has('name')) <span class="text-danger alert">{{ $errors->first('name')
                                        }}</span> @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-control-label">Email * </label>
                                    {!! Form::email('email', null, ['id' => 'email','class' =>
                                    'form-control','required',
                                    ]) !!}
                                    @if ($errors->has('email')) <span class="text-danger alert">{{
                                        $errors->first('email')
                                        }}</span> @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone" class="form-control-label">Phone * </label>
                                    {!! Form::tel('phone', null, ['id' => 'phone','class' => 'form-control','required',
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
                                    'form-control','required',
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
                                    'form-control','required',
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
                                    'form-control'
                                    ]) !!}
                                    @if ($errors->has('refer_code')) <span class="text-danger alert">{{
                                        $errors->first('refer_code')
                                        }}</span> @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="status" class="form-control-label">Status * </label>
                                {!! Form::select('status',[0=>'Pending'],null, ['id' =>
                                'status','class' =>
                                'form-control','disabled'
                                ]) !!}
                                @if ($errors->has('status')) <span class="text-danger alert">{{ $errors->first('status')
                                    }}</span> @endif
                            </div>
                        </div>
                    </div>

                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary btn-sm ms-auto">Submit</button>
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
<!-- CKEditor init -->
<script src="{{ asset('backend/assets/select2/js/select2.min.js') }}"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/ckeditor.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/adapters/jquery.js"></script>
<script>
      $('.select2').select2();
$('#lfm').filemanager('filemanager');
$('#company_logo').filemanager('filemanager');
    var route_prefix = "/filemanager";
        $('textarea[name=description]').ckeditor({

          filebrowserImageBrowseUrl: route_prefix + '?type=Images',
          filebrowserImageUploadUrl: route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
          filebrowserBrowseUrl: route_prefix + '?type=Files',
          filebrowserUploadUrl: route_prefix + '/upload?type=Files&_token={{csrf_token()}}',
            extraAllowedContent: 'a[rel]',
             extraPlugins: 'embed,autoembed,uicolor,colorbutton,colordialog,font',
            autoEmbed_widget:'customEmbed',
            format_tags: 'p;h1;h2;h3;h4;h5;h6;pre;address;div',

            allowedContent:true
        });




  </script>

@endpush


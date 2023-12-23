@extends('backend.layouts.superadminmaster')
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
                        <a href="{{ route(Request::segment(1) . '.dashboard') }}"
                            class="btn btn-primary btn-sm ms-auto">Dashboard</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @include('partial.formerror')
                        {!! Form::model($setup, [
                        'route' => [Request::segment(1) . '.setupUpdate', $setup->admin_id],
                        'method' => 'POST',
                        'files' => true,
                        ]) !!}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label">Compnay Name * </label>
                                    {!! Form::text('company_name',null, ['id' => 'company_name','class' => 'form-control','required',
                                    ]) !!}
                                    @if ($errors->has('company_name')) <span class="text-danger alert">{{ $errors->first('company_name') }}</span> @endif

                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Web Address</label>

                                    {!! Form::text('web_address',null, ['id' => 'web_address','class' => 'form-control'
                                    ]) !!}
                                    @if ($errors->has('web_address')) <span class="text-danger alert">{{ $errors->first('web_address') }}</span> @endif

                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="sms_user" class="form-control-label">SMS User *</label>
                                    {!! Form::text('sms_user',null, ['id' =>'sms_user', 'class'
                                    => 'form-control','required']) !!}
                                    @if ($errors->has('sms_user'))
                                    <span class="text-danger alert">{{ $errors->first('sms_user') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="sms_password" class="form-control-label">SMS Password  *</label>
                                    {!! Form::text('sms_password',null, ['id' =>'sms_password', 'class'
                                    => 'form-control','required']) !!}
                                    @if ($errors->has('sms_password'))
                                    <span class="text-danger alert">{{ $errors->first('sms_password') }}</span>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="api_key" class="form-control-label">SMS Api Key *</label>
                                    {!! Form::text('api_key',null, ['id' =>'api_key', 'class'
                                    => 'form-control','required']) !!}
                                    @if ($errors->has('api_key'))
                                    <span class="text-danger alert">{{ $errors->first('api_key') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="api_secret" class="form-control-label">SMS Api Secret *</label>
                                    {!! Form::text('api_secret',null, ['id' =>'api_secret', 'class'
                                    => 'form-control','required']) !!}
                                    @if ($errors->has('api_secret'))
                                    <span class="text-danger alert">{{ $errors->first('api_secret') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="sender_id" class="form-control-label">SMS Sender ID *</label>
                                    {!! Form::text('sender_id',null, ['id' =>'sender_id', 'class'
                                    => 'form-control']) !!}
                                    @if ($errors->has('sender_id'))
                                    <span class="text-danger alert">{{ $errors->first('sender_id') }}</span>
                                    @endif
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="sms_type" class="form-control-label">SMS Type *</label>
                                    {!! Form::text('sms_type',null, ['id' =>'sms_type', 'class'
                                    => 'form-control']) !!}
                                    @if ($errors->has('sms_type'))
                                    <span class="text-danger alert">{{ $errors->first('sms_type') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="sms_rate" class="form-control-label">SMS Rate *</label>
                                    {!! Form::text('sms_rate',null, ['id' =>'sms_rate', 'class'
                                    => 'form-control','required']) !!}
                                    @if ($errors->has('sms_rate'))
                                    <span class="text-danger alert">{{ $errors->first('sms_rate') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6  input-field">
                                  <br>
                                   Sending SMS Status For Sale  <br>
                                    <p>
                                        <label>
                                            <input class="with-gap" name="sms_status" value="1" type="radio" {{
                                                ($setup->sms_status=="1")? "checked" : "" }} />
                                            <span>Yes</span>
                                        </label>
                                        <label>
                                            <input class="with-gap" name="sms_status" value="0" type="radio" {{
                                                ($setup->sms_status=="0")? "checked" : "" }} />
                                            <span>No</span>
                                        </label>
                                    </p>
                                </div>
                                <div class="input-field col-md-12">
                                    <label for="sms_text" class="form-control-label">Do Not Change #CUSTOMer# , #AMOUNT# &  #COMPANYNAME#  </label>
                                    {!!Form::textarea('sms_text',null, array('id'=>'sms_text','class'=>'form-control',
                                    'rows' => 2,'required'))!!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="bin_number" class="form-control-label">Bin Number</label>
                                    {!! Form::text('bin_number',null, ['id' =>'bin_number', 'class'
                                    => 'form-control']) !!}
                                    @if ($errors->has('bin_number'))
                                    <span class="text-danger alert">{{ $errors->first('bin_number') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="vat_number" class="form-control-label">Vat Number</label>
                                    {!! Form::text('vat_number',null, ['id' =>'vat_number', 'class'
                                    => 'form-control']) !!}
                                    @if ($errors->has('vat_number'))
                                    <span class="text-danger alert">{{ $errors->first('vat_number') }}</span>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="currency_name" class="form-control-label">Select Currency Name *</label>
                                    {!! Form::select('currency_name',['BDT'=>'BDT','TK'=>'TK','USD'=>'USD'], null, ['id'
                                    => 'currency_name','class' => 'form-control select2','required',
                                    ]) !!}
                                    @if ($errors->has('currency_name')) <span class="text-danger alert">{{
                                        $errors->first('currency_name') }}</span> @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="currency_icon" class="form-control-label">Select Currency Icon *</label>
                                    {!! Form::select('currency_icon',['৳'=>'৳','$'=>'$'], null, ['id' =>
                                    'currency_icon','class' => 'form-control select2','required',
                                    ]) !!}
                                    @if ($errors->has('currency_icon')) <span class="text-danger alert">{{
                                        $errors->first('currency_icon') }}</span> @endif
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="print_first_note" class="form-control-label">Print First Note *</label>
                                    {!! Form::text('print_first_note',null, ['id' =>'print_first_note', 'class'
                                    => 'form-control']) !!}
                                    @if ($errors->has('print_first_note'))
                                    <span class="text-danger alert">{{ $errors->first('print_first_note') }}</span>
                                    @endif
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="print_second_note" class="form-control-label">Print Second Note</label>
                                    {!! Form::text('print_second_note',null, ['id' =>'print_second_note', 'class'
                                    => 'form-control']) !!}
                                    @if ($errors->has('print_second_note'))
                                    <span class="text-danger alert">{{ $errors->first('print_second_note') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="office_phone" class="form-control-label">Office Phone</label>
                                    {!! Form::tel('office_phone',null, ['id' =>'office_phone', 'class'
                                    => 'form-control']) !!}
                                    @if ($errors->has('office_phone'))
                                    <span class="text-danger alert">{{ $errors->first('office_phone') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-7">
                                    <label for="office_email" class="form-control-label">Office Email</label>
                                    {!! Form::email('office_email',null, ['id' =>'office_email', 'class'
                                    => 'form-control']) !!}
                                    @if ($errors->has('office_email'))
                                    <span class="text-danger alert">{{ $errors->first('office_email') }}</span>
                                    @endif
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="company_address" class="form-control-label">Company Address</label>
                                    {!! Form::textarea('company_address',null, ['id' =>'company_address', 'class'
                                    => 'form-control','rows'=>1]) !!}
                                    @if ($errors->has('company_address'))
                                    <span class="text-danger alert">{{ $errors->first('company_address') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="facebook" class="form-control-label">Facebook Link</label>
                                    {!! Form::text('facebook',null, ['id' =>'facebook', 'class'
                                    => 'form-control']) !!}
                                    @if ($errors->has('facebook'))
                                    <span class="text-danger alert">{{ $errors->first('facebook') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="twitter" class="form-control-label">Twitter Link</label>
                                    {!! Form::text('twitter',null, ['id' =>'twitter', 'class'
                                    => 'form-control']) !!}
                                    @if ($errors->has('twitter'))
                                    <span class="text-danger alert">{{ $errors->first('twitter') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="youtube" class="form-control-label">Youtube Link</label>
                                    {!! Form::text('youtube',null, ['id' =>'youtube', 'class'
                                    => 'form-control']) !!}
                                    @if ($errors->has('youtube'))
                                    <span class="text-danger alert">{{ $errors->first('youtube') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="instagram" class="form-control-label">Instagram Link</label>
                                    {!! Form::text('instagram',null, ['id' =>'instagram', 'class'
                                    => 'form-control']) !!}
                                    @if ($errors->has('instagram'))
                                    <span class="text-danger alert">{{ $errors->first('instagram') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">About Yourself and Your Company*</label>
                                         {!! Form::textarea('description', null, [
                                            'id' => 'description',
                                            'class' => 'form-control',
                                            'rows' => 2,
                                            ]) !!}
                                            @if ($errors->has('description'))
                                            <span class="text-danger alert">{{ $errors->first('description') }}</span>
                                            @endif

                                </div>

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
<!-- CKEditor init -->
<script src="{{ asset('backend/assets/select2/js/select2.min.js') }}"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/ckeditor.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/adapters/jquery.js"></script>
<script>
$('.select2').select2();

    var route_prefix = "/image";
        $('textarea[name=description]').ckeditor({
            width: '100%',
            extraAllowedContent: 'a[rel]',
             extraPlugins: 'uicolor,colorbutton,colordialog,font',
              format_tags: 'p;h1;h2;h3;h4;h5;h6;pre;address;div',
              removePlugins: 'image,pwimage,about,blockquotes,link',

            allowedContent: true
        });


        $('#image').change(function(event){
    let file=event.target.files[0];
            let reader = new FileReader();
            if (file.size > 800 * 800) {
                event.target.value = "";
      alert('Please Upload Image Size Less Than 500kb');
        return false;
      }
            reader.onload = (e) => {

              $('#preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

    });
    $('#preview').click(function(event){
    $('#image').click();
    });


</script>
@endpush


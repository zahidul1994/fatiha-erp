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
                        <a href="{{ route(Request::segment(1) . '.dashboard') }}"
                            class="btn btn-primary btn-sm ms-auto">Dashboard</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @include('partial.formerror')
                        {!! Form::model($setup, [
                        'route' => [Request::segment(1) . '.businessSetupUpdate', $setup->id],
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
                                <label for="default_shop_id" class="form-control-label">Default Shop * </label>
                                {!! Form::select('default_shop_id',Helper::shopPluckValue(), null, ['id' =>
                                'default_shop_id', 'class' => 'form-control select2']) !!}
                                @if ($errors->has('default_shop_id'))
                                <span class="text-danger alert">{{ $errors->first('default_shop_id') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="default_brand_id" class="form-control-label">Default Brand * </label>
                                {!! Form::select('default_brand_id',Helper::brandPluckValue(), null, ['id' => 'default_brand_id', 'class' =>
                                     'form-control select2']) !!}
                                @if ($errors->has('default_brand_id'))
                                <span class="text-danger alert">{{ $errors->first('default_brand_id') }}</span>
                                @endif
                            </div>
                        
                            <div class="form-group col-md-4">
                                <label for="default_unit" class="form-control-label">Default Unit </label>
                                {!! Form::select('default_unit', Helper::unitPluckValue(), null, ['id' => 'default_unit', 'class' =>
                                'form-control', 'required']) !!}
                                @if ($errors->has('default_unit'))
                                <span class="text-danger alert">{{ $errors->first('default_unit') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-4">
                                <label for="default_vat" class="form-control-label">Default Vat * </label>
                                {!! Form::select('default_vat',@Helper::vatPluckValue(), null, ['id' => 'default_vat', 'class' =>
                                'form-control select2', 'required']) !!}
                                @if ($errors->has('default_vat'))
                                <span class="text-danger alert">{{ $errors->first('default_vat') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-4">
                                <label for="default_discount" class="form-control-label">Default Discount * </label>
                                {!! Form::select('default_discount',@Helper::discoutPluckValue(), null, ['id' => 'default_discount', 'class' =>
                                'form-control select2', 'required']) !!}
                                @if ($errors->has('default_discount'))
                                <span class="text-danger alert">{{ $errors->first('default_discount') }}</span>
                                @endif
                            </div>
                        
                                <div class="form-group col-md-6">
                                    <label for="default_supplier_id" class="form-control-label">Default Supplier
                                    </label>
                                    {!! Form::select('default_supplier_id',Helper::supplierPluckValue(), null, ['id' =>
                                    'default_supplier_id', 'class' => 'form-control select2']) !!}
                                    @if ($errors->has('default_supplier_id'))
                                    <span class="text-danger alert">{{ $errors->first('default_supplier_id') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="default_customer_id" class="form-control-label">Default Customer
                                    </label>
                                    {!! Form::select('default_customer_id',Helper::customerPluckValue(), null, ['id' =>
                                    'default_customer_id', 'class'
                                    => 'form-control select2']) !!}
                                    @if ($errors->has('default_customer_id'))
                                    <span class="text-danger alert">{{ $errors->first('default_customer_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label for="default_converted_rate" class="form-control-label">Converted Rate *</label>
                                    {!! Form::number('default_converted_rate',null, ['id' =>'default_converted_rate', 'class'
                                    => 'form-control','required','step'=>'any']) !!}
                                    @if ($errors->has('default_converted_rate'))
                                    <span class="text-danger alert">{{ $errors->first('default_converted_rate') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="sms_rate" class="form-control-label">SMS Rate *</label>
                                    {!! Form::text('sms_rate',null, ['id' =>'sms_rate', 'class'
                                    => 'form-control','disabled']) !!}
                                    @if ($errors->has('sms_rate'))
                                    <span class="text-danger alert">{{ $errors->first('sms_rate') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="sms_type" class="form-control-label">SMS Type *</label>
                                    {!! Form::text('sms_type',null, ['id' =>'sms_type', 'class'
                                    => 'form-control','disabled']) !!}
                                    @if ($errors->has('sms_type'))
                                    <span class="text-danger alert">{{ $errors->first('sms_type') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-4  input-field">
                                  <br>
                                   Sending SMS Status  <br>
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
                                <div class="form-group col-md-12">
                                    <label for="" class="form-control-label">Print Logo Photo Size [80x80]</label>
                                    <div class="d-flex" title="Please Click The Choose File For Upload Photo">
                                        {!!Form::file('printing_logo',
                                        array('accept'=>".jpg,.jpeg,.png","id"=>"image",'class'=>'form-control'))!!}
                                    </div>

                                    <img id="preview" title="Please Click The Choose File For Upload Photo [80X80]"
                                        class="w-100 border-radius-lg shadow-lg mt-3" src="{{asset($setup->printing_logo)}}"
                                        alt="preview image" style="max-width:80px; max-height:80px;">
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
                                    <label class="form-control-label"> Company Logo  [150*150]</label>

                                        {!! Form::file('company_logo', ['id' => 'example-text-input', 'class' => 'form-control']) !!}
                                      @if ($errors->has('company_logo'))
                                        <span class="text-danger alert">{{ $errors->first('company_logo') }}</span>
                                        @endif

                                    <img src="{{asset($setup->company_logo)}}" class="w-100 border-radius-lg shadow-lg mt-3" style="max-width:300px; max-height:300px;">
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

    $('#deleteAccount').click(function (e) {
        alert();

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


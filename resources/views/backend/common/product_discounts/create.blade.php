@extends('backend.layouts.master')
@section('title', 'Create Product Discount')
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
                        <p class="mb-0">Product Discount Create</p>
                        <a href="{{ route(Request::segment(1) . '.product-discounts.index') }}"
                            class="btn btn-primary btn-sm ms-auto">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @include('partial.formerror')
                        {!! Form::open(['route' => Request::segment(1) . '.product-discounts.store', 'method' => 'POST',
                        'id' => 'submit']) !!}
                        @include('backend.common.product_discounts.form')
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary btn-sm ms-auto">Submit</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="queryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true"  style="overflow:hidden;">
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Shop Product Find Query </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-danger">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="ccccc">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="brand_id">Product Brand </label><br>
                                {!! Form::select('brand_id',Helper::brandPluckValue(), null, ['id' => 'brand_id','class'
                                => 'form-control select2','style'=>'width:100%','placeholder'=>'Select Product Brand']) !!}
                                @if ($errors->has('brand_id'))
                                <span class="text-danger alert">{{ $errors->first('brand_id') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-12">
                                <label for="brand_id">Product Brand </label><br>
                                {!! Form::select('category_id',Helper::categoryPluckValue(), null, ['id' => 'category_id', 'class' =>
                                          'form-control select2','style'=>'width:100%', 'required','placeholder'=>'Select One']) !!}
                                @if ($errors->has('category_id'))
                                <span class="text-danger alert">{{ $errors->first('category_id') }}</span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <button type="button" id="search" class="btn btn-primary mr-2">Search</button>
                            <button type="button" class="btn btn-success" id="SearhDone">Done</button>
                            <button type="button" class="btn btn-warning" id="SearchReSet">Reset</button>

                        </div>

                    </form>


                    <div class="form-row" id="ProductVal">
                        <h5 class="blod"> Total Product Found <strong id="totalProduct"></strong> </h5> <br>

                        <div class="row" id="searchResult">

                        </div>

                    </div>

                    <!--bp area end-->
                </div>
                <!--bp area end-->

            </div>

        </div>

    </div>


    @endsection
    @push('js')
    <script src="{{ asset('backend/assets/select2/js/select2.min.js') }}"></script>
    <!-- CKEditor init -->

    <script>
        $('.select2').select2();
        $('#mySelect2').select2({
        dropdownParent: $('#queryModal')
    });


        $(document).ready(function () {

           function clearform() {
            $('#ccccc')[0].reset();
            $("#brand_id").val('').trigger('change');
            $("#category_id").val('').trigger('change');
            $('#totalProduct').html('');
            $('#searchResult').html('');

            }


  $(document).on('click', '#search', function() {
    var producttype=[];
    $('#totalProduct').html('');
     $('#searchResult').html('');
 $('#mySelect2 :selected').each(function(){
    producttype.push($(this).val());
    });

    $info_url = url +'/'+ '{{Request::segment(1)}}'+'/find-product-for-discount';
$.ajax({
    url: $info_url,
    method: "POST",
    type: "POST",
    data: {
    brand:$('#brand_id').val(),
    category:$('#category_id').val(),
    shop:$('#shop_id').val(),

    },
    success: function(data) {
        if (data) {

           $('#totalProduct').html(data.length);
           window.globalData = data;
            data.forEach(pro => {
           $('#searchResult').append(`
           <div class="col-md-6">
             <div class="card-top p-2 pr-5">
                      <img src="${url+'/'+(pro.path+'/'+pro.photo)}" alt="${pro.product_full_name}" class="img-fluid" style="width:120px;height:120px">
                       </div>
                       <div class="card-body text-center brp-cb">
                         <p style="font-size:20px; font-weight:700;" class="mb-0">${pro.product_full_name}</p>
                         <p style="font-size:20px; font-weight:700;" class="mb-0">Barcode :${pro.barcode}</p>
                        </div>

             </div>`)
           });

        }
    },
    error: function(data) {
        $('#searchResult').html('');
     alert('No Data Found')
    }
});
});

  $(document).on('click', '#SearchReSet', function() {
    clearform();
    $('#product_ids').html('');
    $('#searchResult').html('');
});
  $(document).on('click', '#SearhDone', function() {
    $('#queryinfo').html(null);
    $('#queryinfo').val(($('#ccccc').serializeArray()));


    $(($('#ccccc').serializeArray())).each(function(i, field){


     $('#queryinfo').append(`<input type="hidden" name="${field.name}" value="${field.value}" />`);

});

$('#searchResult').html('');
    globalData.forEach(data => {
        $('#product_ids').append(`<option value="${data.id}" selected>${data.product_full_name}</option>`);
   });
$('#queryModal').modal('hide');
});


});



    </script>

    @endpush

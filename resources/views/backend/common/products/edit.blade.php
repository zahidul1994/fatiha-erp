@extends('backend.layouts.master')
@section('title', 'Update Product')
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-4">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Product Update</p>
                            <a href="{{ route(Request::segment(1) . '.products.index') }}"
                                class="btn btn-primary btn-sm ms-auto">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @include('partial.formerror')
                            {!! Form::model($product, [
                                'route' => [Request::segment(1) . '.products.update', $product->id],
                                'method' => 'PATCH',
                                'files' => true,
                            ]) !!}
                            @include('backend.common.products.form')

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
<!-- CKEditor init -->
<script src="https://cdn.ckeditor.com/4.21.0/basic/ckeditor.js"></script>
<script src="{{ asset('backend/assets/js/ckeditor-jquery.js') }}"></script>
<script>
    $('.select2').select2();
    var catid = $('#category_id').val();
    var subcategory = '{{$product->sub_category_id}}';
$.ajax({
        type: "GET",
        url: url + '/get-sub-category/'+catid,
        dataType: "JSON",
        success:function(data) {
         if(data){
                  $.each(data, function(key, value){
                    if(value.id==subcategory){
                        $('#sub_category_id').append('<option value="'+value.id+'" selected>' + value.sub_category_name + '</option>');
                       }else{
                        $('#sub_category_id').append('<option value="'+value.id+'">' + value.sub_category_name + '</option>');

                       }

                    });
                }

            },
    });
  $(document).ready(function () {


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

//ckeditor

        $('textarea[name=description]').ckeditor({
            removeButtons: 'PasteFromWord'
         });

//hs_code
         $('#hs_code').blur(function() {
             $.ajax({
                url: "{{ URL(Request::segment(1).'/check-product-hs_code') }}"+'/'+$(this).val(),
                method: "GET",
                success: function(res) {
            if (res.success == false) {
                    $('#hs_code').val('');
                    $('#hs_code').css({'border-color':'red', 'box-shadow': '0 0 0 0.2rem rgb(255, 0, 0)'});
                    alert('hs_code Number already exists, please add another Code !');
                    $('#hs_code').focus();
                }
                else{
                $('#hs_code').css({'border-color':'#28a745', 'box-shadow': '0 0 0 0.2rem rgba(40, 167, 69, 0.25)'});
                }
            },
            error: function(err) {
            $('#hs_code').css({'border-color':'red', 'box-shadow': '0 0 0 0.2rem rgb(255, 0, 0)'});
            }
            })
        });
            // for random value
            var gRandLength = 9;
            $('#hs_codeBtn').click(function() {
                var num = Math.floor(1 + (Math.random() * Math.pow(10, gRandLength)));
                $('#hs_code').val(num);

            });


//category change
$('#category_id').change(function(){

  $('#sub_category_id').empty();

 var catid = $(this).val();
$.ajax({
        type: "GET",
        url: url + '/get-sub-category/'+catid,
        dataType: "JSON",
        success:function(data) {
         if(data){
                  $.each(data, function(key, value){
                       $('#sub_category_id').append('<option value="'+value.id+'">' + value.sub_category_name + '</option>');

                    });
                }

            },
    });
  });



});


</script>

@endpush

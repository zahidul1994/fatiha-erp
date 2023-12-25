@extends('backend.layouts.master')
@section('title', 'Create Product')
@push('css')
<link href="{{ asset('backend/assets/select2/css/select2.min.css') }}" rel="stylesheet" />
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

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
                        <p class="mb-0">Product Create</p>
                        <a href="{{ route(Request::segment(1) . '.products.index') }}"
                            class="btn btn-primary btn-sm ms-auto">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @include('partial.formerror')
                        {!! Form::open(['route' => Request::segment(1) . '.products.store', 'method' =>
                        'POST','id'=>'productForm', 'files'
                        => true]) !!}
                        @include('backend.common.products.form')
                        <div class="text-center mt-3" id="inputform">

                            <button type="submit" name="saveandback" class="btn btn-info btn-sm ms-auto">Save &
                                Back</button>
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
@section('calx')
<!-- calx -->
<script src="{{ asset('backend/assets/js/jquery-calx-sample-2.2.8.min.js') }}"></script>
@endsection
@push('js')
<script src="{{ asset('backend/assets/select2/js/select2.min.js') }}"></script>
<!-- CKEditor init -->
<script src="https://cdn.ckeditor.com/4.21.0/basic/ckeditor.js"></script>
<script src="{{ asset('backend/assets/js/ckeditor-jquery.js') }}"></script>
<script>
    $('.select2').select2();
  $(document).ready(function () {
    $( "#unit_price" ).on( "change", function() {
    $('#govt_price').val(($('#unit_price').val()));
        calculateFx()
} );
    $( "#productForm" ).on( "click", function() {
    
        calculateFx()
} );
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
         $('#hsCode').blur(function() {
             $.ajax({
                url: "{{ URL(Request::segment(1).'/check-product-hscode') }}"+'/'+$(this).val(),
                method: "GET",
                success: function(res) {
            if (res.success == false) {
                    $('#hsCode').val('');
                    $('#hsCode').css({'border-color':'red', 'box-shadow': '0 0 0 0.2rem rgb(255, 0, 0)'});
                    alert('Barcode Number already exists, please add another Code !');
                    $('#hsCode').focus();
                }
                else{
                $('#hsCode').css({'border-color':'#28a745', 'box-shadow': '0 0 0 0.2rem rgba(40, 167, 69, 0.25)'});
                }
            },
            error: function(err) {
            $('#hsCode').css({'border-color':'red', 'box-shadow': '0 0 0 0.2rem rgb(255, 0, 0)'});
            }
            })
        });
            // for random value
            var gRandLength = 9;
            $('#hsCodeBtn').click(function() {
                var num = Math.floor(1 + (Math.random() * Math.pow(10, gRandLength)));
                $('#hsCode').val(num);

            });




});

function calculateFx() {
  $form = $('#productForm').calx();
  $form.calx('update');
//   console.log($form);
}

</script>

@endpush
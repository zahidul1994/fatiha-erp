@extends('backend.layouts.master')
@section('title', 'Barcode')
@push('css')
<link href="{{ asset('backend/assets/css/jquery-ui.min.css') }}" rel="stylesheet" />
@push('css')
<link href="{{ asset('backend/assets/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('backend/assets/css/jquery-ui.min.css') }}" rel="stylesheet" />
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

  .bottom-table-card th {
    font-size: 12px;
    text-align: center;
  }

  .bottom-table-card td {
    font-size: 12px;
    text-align: center;
  }

  .bottom-table-card td p {
    font-size: 12px;
    text-align: center;
    margin-bottom: 0 !important;
  }

  .page-custom-buttons button {
    font-weight: 400;
    padding: 5px 10px;
    margin-bottom: 5px !important;
  }

  .pa-box {
    background-color: #FFC425;
    font-size: 18px;
    font-weight: 700;
    color: #000;
  }

  .table-responsive-custom {
    overflow-x: scroll !important;
  }
</style>
@endpush
@section('content')
<div class="container-fluid py-4">

  <div class="row" id="dynamic">
    <div class="col-md-8 mx-auto">

      <div class="card p-4">
        <h3 class="font-weight-bolder text-center pb-4">Barcode Print</h3>
        @include('partial.formerror')
        {!! Form::open(['route' => Request::segment(1) . '.barcodes.store', 'method' => 'POST', 'files' => true]) !!}


        <div class="row">
          <div class="col-md-4 align-center">
            <div class="form-group">
              {!! Form::label('sku', 'Product SKU',['id'=>'price']) !!}
              <div class="form-check form-switch">
                {{ Form::checkbox('sku', 'sku', true, array('class' => 'form-check-input','id'=>'sku','disabled')) }}
              </div>

            </div>
          </div>

          <div class="col-md-4">
            {!! Form::label('price', 'Currency & Price',['id'=>'price']) !!}
            <div class="form-check form-switch">
              {{ Form::checkbox('price', 'price', true, array('class' => 'form-check-input','id'=>'price')) }}
            </div>
          </div>
          <div class="col-md-4">
            {!! Form::label('expire_date', 'Expire Date',['id'=>'expire_date']) !!}
            <div class="form-check form-switch">
              {{ Form::checkbox('expire_date', 'expire_date', false, array('class' =>
              'form-check-input','id'=>'expire_date')) }}
            </div>
          </div>
          <div class="col-md-12">

            <div class="form-group">
              <div class="input-group input-group-alternative mb-4">
                <span class="input-group-text bg-alert"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                    fill="currentColor" class="bi bi-upc" viewBox="0 0 16 16">
                    <path
                      d="M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z" />
                  </svg></span>
                <input value="" type="text" class="form-control ui-autocomplete-input" id="add_item"
                  placeholder="Please add products to hs_code list" autocomplete="off"
                  style="font-size:1.5em;color:blueviolet">

              </div>
            </div>
          </div>
        </div>
        <div class="card mt-3 bottom-table-card" style="border-radius: 0 !important; font-size:150px">
            <div class="table table-responsive">
                <table class="table table-bordered table-success align-items-center mb-0 table-striped">
              <thead>
                <tr style="font-weight:900;background:peru; color:black">
                  <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product % Barcode
                  </th>
                  <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SKU
                  </th>
                  <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Expire Date
                  </th>
                  <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sale Price
                  </th>
                  <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Barcode Qty
                  </th>
                  <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Action
                  </th>


                </tr>
              </thead>
              <tbody id="itemlist">


              </tbody>
            </table>
          </div>
        </div>

        <div class="text-center mt-3">
          <button type="submit" class="btn btn-primary  ms-auto">Generate Barcode </button>
        </div>

        {!! Form::close() !!}
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

<!-- jquery ui -->
<script src="{{ asset('backend/assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugins/sweetalert.min.js') }}"></script>

<script>
  $(document).ready(function () {

    $("#add_item").autocomplete({
    source: function (request, response) {
               $.ajax({
                type: 'get',
               url: "{{ URL(Request::segment(1).'/find-product') }}",
               data: {
                term: request.term,
            },
            success: function (data) {
                $(this).removeClass('ui-autocomplete-loading');
                response(data);
            }
        });
    },
    minLength: 1,
    autoFocus: false,
       delay: 250,
    response: function (event, ui) {
        if ($(this).val().length >= 10 && ui.content== 0) {
          Swal.fire('No matching result found! Product might be not entry or active.');
        }
        else if (ui.content.length == 1 && ui.content != 0) {
            ui.item = ui.content[0];
            $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
            $(this).autocomplete('close');
            $(this).removeClass('ui-autocomplete-loading');
        }

    },
    select: function (event, ui) {
        event.preventDefault();
         if (ui.item.id !== 0) {
            var row = ui.item;
            $(this).val('');
            if($('#id' + row.id).serializeArray().length){
            $("#id"+row.id).val(parseInt($("#id"+row.id).val())+1);
            $itemlist   = $('#itemlist');
            $counter    = 0;
            $counter = $("#itemlist tr").length;
                var i = ++$counter;
                $form = $('#dynamic').calx();
                $form.calx('update');
                }
                else{
                    $itemlist   = $('#itemlist');
            $counter    = 0;
            $counter = $("#itemlist tr").length;
                var i = ++$counter;
               $itemlist.append( '<tr>\
                    <td style="width:250px; vertical-align: top; padding-top: 17px;"><input class="form-control input-sm" type="hidden" name="barcodes[]" id="pid" value="'+row.hs_code+'" data-format="0" >\ '+row.value+' \<input type="hidden" name="product_sku[]" value="'+row.sku+'"></td>\
                    <td style="width:120px; vertical-align: top; padding-top: 17px;">'+row.sku+' \<input type="hidden"  value="'+row.sku+'"></td>\
                    <td style="width:80px;"><input type="date" class="form-control input-sm text-end" value="'+row.date+'" name="product_expire_date[]"></td>\
                    <td style="width:130px;"><input type="number" step="any" name="sale_price[]" readonly  class="form-control input-sm text-end" required    value="'+row.saleprice+'"></td>\
                        <td style="width:80px;"><input class="form-control input-sm text-end" required  type="number" step="any" min=1 max=999999999 required id="id'+row.id+'" data-format="" data-format="0[.]00"    name="print_qty[]"  data-cell="Q'+i+'"></td>\
                       <td class="text-center" style="padding-top:17px;"><button class="btn-remove btn  btn-danger"><i class="fa fa-times fa-fw" ></i></button></td>\
                    </tr>');
                    $("#id"+row.id).val(1);

                }
        } else {
           Swal.fire('No matching result found! Product might be not listing.');
        }
        $('#itemlist').on('click', '.btn-remove', function(){
                $(this).parent().parent().remove();

            });
    }
});
});



</script>

@endpush

@extends('backend.layouts.master')
@section('title', 'Products Bulk Update')
@push('css')

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
  .pa-box {
    background-color: #FFC425;
    font-size: 18px;
    font-weight: 700;
    color: #000;
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


  .table-responsive-custom {
    overflow-x: scroll !important;
  }



</style>
@endpush
@section('content')
<div class="container-fluid py-4">
  <div class="row" id="dynamic">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <a href="{{ route(Request::segment(1) . '.products.index') }}" class="btn btn-primary btn-sm ms-auto">Back</a>
          </div>
          <div class="row">
            @include('partial.formerror')
            {!! Form::open(['route' => Request::segment(1) . '.productBulkUpdateStore', 'method' => 'POST', 'id' =>
            'formReset']) !!}
            <div class="multisteps-form__content">
                <div class="row">

                    <div class="col-md-12">

                      <div class="form-group">
                        <div class="input-group input-group-alternative mb-4">
                          <span class="input-group-text bg-alert"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                              fill="currentColor" class="bi bi-upc" viewBox="0 0 16 16">
                              <path
                                d="M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z" />
                            </svg></span>
                          <input value="" type="text" class="form-control ui-autocomplete-input" id="add_item"
                            placeholder="Please Select products to list" autocomplete="off"
                            style="font-size:1.5em;color:blueviolet">

                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card mt-3 bottom-table-card" style="border-radius: 0 !important; font-size:150px" >
                    <div class="table table-responsive">
                      <table class="table table-bordered table-success align-items-center mb-0 table-striped">
                        <thead>
                          <tr style="font-weight:900;background:peru; color:black">
                            <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product Name
                            </th>
                            <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Expire Date
                            </th>
                            <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Purchase Price
                            </th>
                            <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Avg Price
                            </th>
                            <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sale Price
                            </th>

                            <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Update Shop Price <input type="checkbox" id="checkAll"> <span class="text-light text-bold">click for  select all </span>
                            </th>
                            <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Remove
                            </th>

                          </tr>
                        </thead>
                        <tbody id="itemlist">

                        </tbody>
                      <tfoot>
                        <th colspan="2"></th>
                       <th> <strong data-formula="(SUM(P1:P5000))"></strong></th>
                       <th> <strong data-formula="(SUM(A1:Q5000))"></strong></th>
                        <th> <strong data-formula="(SUM(S1:F5000))"></strong></th>
                        <th></th>
                        <th></th>
                      </tfoot>
                      </table>

                    </div>

                  </div>
                  <div class="row">
                    <div class="col-md-9"></div><div class="col-md-3 mt-3"><button class="btn btn-success" type="submit" >Update</button></div>
                  </div>
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

<!-- jquery ui -->
<script src="{{ asset('backend/assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugins/sweetalert.min.js') }}"></script>

<script>

  $(document).ready(function () {
    $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    $("#add_item").autocomplete({
    source: function (request, response) {
     $.ajax({
                type: 'GET',
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
                        <td style="width:250px; vertical-align: top; padding-top: 17px;"><input class="form-control input-sm" type="hidden" id="pid" name="product_id[]" value="'+row.id+'" data-format="0" >\ '+row.value+'</td>\
                        <td style="width:100px;"><input type="date" class="form-control input-sm"  name="expire_date[]" value="'+row.date+'" style="margin-top:-20px"></td>\
                        <td style="width:120px;"><input class="form-control input-sm text-end" placeholder="0.00" tabindex="1" name="purchase_price[]"  data-cell="P'+i+'" value="'+row.price+'" required data-format=""><i class="text-black-50">&nbsp;</i></td>\
                        <td style="width:120px;"><input class="form-control input-sm text-end" placeholder="0.00"  name="average_price[]"  data-cell="A'+i+'" value="'+row.averageprice+'" readonly data-format=""><i class="text-black-50">&nbsp;</i></td>\
                         <td style="width:180px;"><input class="form-control input-sm text-end"   type="number" step="any" min=1 max="99999999" required id="id'+row.id+'" data-format="" value="'+row.saleprice+'"  name="sale_price[]" tabindex="2" data-cell="S'+i+'"><i class="text-black-50">&nbsp;</i></td>\
                         <td id="group_1"><div class="form-check form-switch"><input type="checkbox" class="form-check-input  group_1"   name="shop_sale_price_update[]"   value="'+row.id+'" ></div><i class="text-black-50">&nbsp;</i></td>\
                    <td class="text-center"><button class="btn-remove btn btn-sm btn-danger"><i class="fa fa-times fa-fw"></i></button></td>\
                    </tr>');
                  $form = $('#dynamic').calx();
                    $form.calx('update');
                }

        } else {
           Swal.fire('No matching result found! Product might be not listing.');
        }
        $('#itemlist').on('click', '.btn-remove', function(){
                $(this).parent().parent().remove();
                $form.calx('update');
               getQty();
            });
    }
});

//clear
$('#clear').click(function (e) {
  $('#formReset').get(0).reset();
  $('#itemlist').html('');
  Swal.fire('Form Reset Successfully');

});


});



</script>

@endpush

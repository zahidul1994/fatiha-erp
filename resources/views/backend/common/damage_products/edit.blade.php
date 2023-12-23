@extends('backend.layouts.master')
@section('title', 'Edit Damage Products')
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
            <a href="{{ route(Request::segment(1) . '.stock-adjustments.index') }}" class="btn btn-primary btn-sm ms-auto">Back</a>
          </div>
          <div class="row">
            @include('partial.formerror')
            {!! Form::model($stockAdjustment, [
              'route' => [Request::segment(1) . '.stock-adjustments.update', $stockAdjustment->id],
              'method' => 'PATCH',
              'id' => 'formReset'
              ]) !!}

          <div class="multisteps-form__content">
            <div class="row mt-3">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6 col-sm-1">
                    <label for="date">Date *</label>
                    {!! Form::date('date', date('Y-m-d'), ['id' => 'date', 'class' => 'form-control', 'required', 'tabindex' => 1,'autofocus']) !!}

                  </div>

                  <div class="col-md-6 col-sm-1 mt-1">
                    <label for="shop_id">Shop *</label>
                    {!! Form::select('shop_id',Helper::shopPluckValue(), null, ['id' => 'shop_id', 'class' => 'form-control select2', 'tabindex' => 3,'disabled']) !!}


                  </div>

                  <div class="col-md-12 col-sm-1 mt-1">
                    <label for="note">Note</label>
                    {!! Form::textarea('description', null, ['id' => 'note', 'class' => 'form-control','rows'=>2, 'tabindex' =>6]) !!}
                  </div>
                </div>
              </div>
            </div>
            <div class="mt-5">


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
                        placeholder="Please add products to Stock list" autocomplete="off"
                        style="font-size:1.5em;color:blueviolet">

                    </div>
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
                      <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Previous Stock
                      </th>
                      <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Decrement
                      </th>
                      <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Update Stock
                      </th>
                      <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Increment
                      </th>
                      <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Remove
                      </th>

                    </tr>
                  </thead>
                  <tbody id="itemlist">
                   @foreach ($stockAdjustment->stockadjustmentdetails as $item)
                   <tr>
                   <td style="width:250px; vertical-align: top; padding-top: 17px;"><input class="form-control input-sm" type="hidden" id="pid" name="product_id[]" value="{{$item->product_id}}" data-format="0" >{{$item->product_name}}<input type="hidden" name="product_name[]" value="{{$item->product_name}}"></td>
                   <td style="width:120px;"><input class="form-control input-sm text-end" placeholder="0.00" tabindex="10" readonly name="previous_qty[]" data-cell="P'{{$loop->index+1}}'" value="{{$item->previous_qty}}" data-format=""><i class="text-black-50">&nbsp;</i></td>
                   <td style="width:40px;"><button type="button" id="decrementBtn" pid="{{$item->product_id}}" class="btn btn-sm btn-danger"><i class="fa fa-minus"></i></button></td>
                   <td style="width:120px;"><input class=" form-control input-sm mb-3" required  type="number" step="any" min=1 max=999999999  id="id{{$item->product_id}}"  onblur="getQty({{$loop->index+1}},this);" value="{{$item->current_qty}}"   name="current_qty[]"  data-cell="Q{{$loop->index+1}}"></td>
                   <td style="width:40px;"><button  type="button" id="incrementBtn" pid="{{$item->product_id}}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></button></td>
                  <td class="text-center"><button class="btn-remove btn btn-sm btn-danger" disabled><i class="fa fa-times fa-fw"></i></button></td>
                  </tr>
                   @endforeach
                  </tbody>
                <tfoot>
                  <th colspan="1"></th>
                 <th> <strong data-formula="(SUM(P1:P500))">{{$stockAdjustment->total_previous_stock}}</strong></th>
                 <th> </th>
                 <th> <strong data-formula="(SUM(Q1:Q500))">{{$stockAdjustment->total_current_stock}}</strong></th>
                 <th> </th>
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
<script src="{{ asset('backend/assets/select2/js/select2.min.js') }}"></script>
<!-- jquery ui -->
<script src="{{ asset('backend/assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugins/sweetalert.min.js') }}"></script>

<script>
  $('.select2').select2();
  $(document).ready(function () {
    $("#add_item").autocomplete({
    source: function (request, response) {
        $.ajax({
                type: 'POST',
               url: "{{ URL(Request::segment(1).'/find-shop-current-stock') }}",
               data: {
                term: request.term,
                shop_id: '{{$stockAdjustment->shop_id}}',
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
                getQty();

                }
                else{
                    $itemlist   = $('#itemlist');
            $counter    = 0;
            $counter = $("#itemlist tr").length;
                var i = ++$counter;
               $itemlist.append( '<tr>\
                        <td style="width:250px; vertical-align: top; padding-top: 17px;"><input class="form-control input-sm" type="hidden" id="pid" name="product_id[]" value="'+row.id+'" data-format="0" >\ '+row.value+' \<input type="hidden" name="product_name[]" value="'+row.value+'"></td>\
                        <td style="width:120px;"><input class="form-control input-sm text-end" placeholder="0.00" tabindex="10" readonly name="previous_qty[]" data-cell="P'+i+'" value="'+row.stock+'" data-format=""><i class="text-black-50">&nbsp;</i></td>\
                        <td style="width:40px;"><button type="button" id="decrementBtn" pid="'+row.id+'" class="btn btn-sm btn-danger"><i class="fa fa-minus"></i></button></td> \
                        <td style="width:120px;"><input class=" form-control input-sm mb-3" required  type="number" step="any" min=1 max=999999999  id="id'+row.id+'"  onblur="getQty(' + i + ',this);" value="'+row.stock+'"   name="current_qty[]"  data-cell="Q'+i+'"></td> \
                        <td style="width:40px;"><button  type="button" id="incrementBtn" pid="'+row.id+'"class="btn btn-sm btn-success"><i class="fa fa-plus"></i></button></td> \
                       <td class="text-center"><button class="btn-remove btn btn-sm btn-danger"><i class="fa fa-times fa-fw"></i></button></td>\
                    </tr>');
                  $form = $('#dynamic').calx();
                    $form.calx('update');
                    getQty();

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

$(document).on('click', '#incrementBtn', function (){
        $id = $(this).attr('pid');
        $("#id"+$id).val(parseInt($("#id"+$id).val())+1);
        getQty();
            });
            $(document).on('click', '#decrementBtn',function () {
        $id = $(this).attr('pid');
       $("#id"+$id).val(parseInt($("#id"+$id).val())-1);
       getQty();
          });


});

//onkeyup
function getQty() {
  $form = $('#dynamic').calx();
  $form.calx('update');

}

</script>
@endpush

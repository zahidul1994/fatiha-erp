@extends('backend.layouts.master')
@section('title', 'Update Requisition')
@push('css')
<link href="{{ asset('backend/assets/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('backend/assets/css/jquery-ui.min.css') }}" rel="stylesheet" />
<style>
  .select2-selection__choice {
    background-color: var(--bs-gray-200);
    border: none !important;
    font-size: 12px;
    font-size: 0.85rem !important;
  }

  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
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


  @media (max-width: 575px) {
    .pcb-mobile {
      display: block;
      text-align: center;
    }

    .pcb-desktop {
      display: none;
    }
  }


  @media (min-width: 576px) and (max-width: 767px) {
    .pcb-mobile {
      display: block;
    }

    .pcb-desktop {
      display: none;
    }
  }

  @media (min-width: 768px) and (max-width: 991px) {
    .pcb-mobile {
      display: block;
    }

    .pcb-desktop {
      display: none;
    }
  }

  @media (min-width: 992px) and (max-width: 1199px) {
    .pcb-mobile {
      display: none;
    }

    .pcb-desktop {
      display: block;
    }
  }

  /* // Extra large devices (large desktops, 1200px and up) */
  @media (min-width: 1200px) {
    .pcb-mobile {
      display: none;
    }

    .pcb-desktop {
      display: block;
    }
  }
</style>
@endpush
@section('content')
<div class="container-fluid py-4">
  <div class="row" id="dynamic">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header pb-4">
          <div class="d-flex align-items-center">
            <a href="{{ route(Request::segment(1) . '.requisitions.index') }}"
              class="btn btn-primary btn-sm ms-auto">Back</a>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            @include('partial.formerror')
            {!! Form::model($requisition, [
            'route' => [Request::segment(1) . '.requisitions.update', $requisition->id],
            'method' => 'PATCH',
            'id' => 'formReset'
            ]) !!}

            <div class="row">
              <div class="col-12 col-sm-6">
                <h5 class="font-weight-bolder mb-0">Requisition Form</h5>
              </div>
              <div class="col-12 col-sm-6 text-end page-custom-buttons pcb-desktop">
                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit" title="Save"><svg
                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-folder-check" viewBox="0 0 16 16">
                    <path
                      d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z" />
                    <path
                      d="M15.854 10.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.707 0l-1.5-1.5a.5.5 0 0 1 .707-.708l1.146 1.147 2.646-2.647a.5.5 0 0 1 .708 0z" />
                  </svg> Save</button>
                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" id="clear"> <svg
                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                    <path
                      d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                    <path fill-rule="evenodd"
                      d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                  </svg> Clear</button>

                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit" value="print"
                  id="print"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-printer-fill" viewBox="0 0 16 16">
                    <path
                      d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z" />
                    <path
                      d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                  </svg> Print</button>
              </div>
            </div>
            <div class="multisteps-form__content">
              <div class="row mt-3">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-4 col-sm-1">
                      <label for="date">Date *</label>
                      {!! Form::date('date', date('Y-m-d'), ['id' => 'date', 'class' => 'form-control', 'required',
                      'tabindex' => 1,'autofocus','max'=>date('Y-m-d')]) !!}

                    </div>

                    <div class="col-md-4 col-sm-1">
                      <label for="work_order_id">Workorder Invoice  </label>
                      {!!
                      Form::text('work_order_id',@Helper::getWorkorder($requisition->work_order_id)->invoice_no?:null,
                      ['id' => 'work_order_id', 'readonly','class' => 'form-control']) !!}

                    </div>
                    <div class="col-md-4 col-sm-1">
                      <label for="supplierId">Supplier * </label>
                      {!! Form::select('supplier_id',Helper::supplierPluckValue(), null, ['id' =>
                      'supplierId','required', 'class' => 'form-control select2','placeholder'=>'Select Customer',
                      'tabindex' =>2]) !!}
                    </div>


                    <div class="col-md-9 col-sm-1 mt-1">
                      <label for="note">Note</label>
                      {!! Form::textarea('description', null, ['id' => 'note', 'class' =>
                      'form-control','rows'=>1,'placeholder'=>'Note ', 'tabindex' =>3]) !!}
                    </div>
                    <div class="col-md-3 col-sm-1 mt-1">
                      <label for="note">Total Quantity</label>
                      <input type="number" name="total_quantity" data-format="0[.]00" data-formula="(SUM(Q1:Q5000))"
                        class="form-control" readonly data-cell="G1" data-format="0[.]00" step="any" min="0" value="{{$requisition->total_quantity}}"
                        max="99999999999999">
                    </div>
                  </div>
                </div>




              </div>
              <div class="mt-5">


                <div class="row">

                  <div class="col-md-12">

                    <div class="form-group">
                      <div class="input-group input-group-alternative mb-4">
                        <span class="input-group-text bg-alert"><svg xmlns="http://www.w3.org/2000/svg" width="35"
                            height="35" fill="currentColor" class="bi bi-upc" viewBox="0 0 16 16">
                            <path
                              d="M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z" />
                          </svg></span>
                        <input value="" type="text" class="form-control ui-autocomplete-input" id="add_item"
                          placeholder="Please add products to order list" autocomplete="off" tabindex="7"
                          style="font-size:1.5em;color:blueviolet">

                      </div>
                    </div>
                  </div>
                </div>


              </div>

              <div class="card mt-3 bottom-table-card" style="border-radius: 0 !important; font-size:150px">
                <div class="table table-responsive">
                  <table class="table table-bordered table-success align-items-center mb-0 table-striped">
                    <thead>
                      <tr style="font-weight:900;background:peru; color:black">
                        <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product
                          Name
                        </th>
                        <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quantity
                        </th>
                        <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Remove
                        </th>

                      </tr>
                    </thead>
                    <tbody id="itemlist">
                      @foreach ($requisition->requisitiondetails as $order)
                      <td style="width:350px; vertical-align: top; padding-top: 17px;"><input
                          class="form-control input-sm" type="hidden" id="pid" name="product_id[]"
                          value="{{ @$order->product_id}}" data-format="0">{{ @$order->product_name}} <input
                          type="hidden" name="product_name[]" value="{{ @$order->product_name}}"></td>

                      <td style="width:180px;"><input class="form-control input-sm text-end pquentity" required
                          type="number" step="any" min=1 max=999999999 required id="id{{ @$order->product_id}}"
                          data-format="" data-format="0[.]00" onblur="calculateFx({{$loop->index+1}},this);"
                          keydown="calculateFx({{$loop->index+1}},this);" value="{{ @$order->qty}}"
                          name="product_quantity[]" data-cell="Q{{$loop->index+1}}"><i class="text-black-50">&nbsp;</i>
                      </td>
                      <td class="text-center"><button class="btn-remove btn btn-sm btn-danger" disabled><i
                            class="fa fa-times fa-fw"></i></button></td>

                      </tr>

                      @endforeach

                    </tbody>
                    <tfoot>
                      <th colspan="1"></th>
                      <th> <strong data-format="0[.]00" data-formula="(SUM(Q1:Q50000))"></strong></th>

                      <th></th>
                    </tfoot>
                  </table>

                </div>

              </div>
              <div class="row">
                <div class="col-md-9"></div>
                <div class="col-md-3 mt-3"><button class="btn btn-success" type="submit" tabindex="4">Save & Update</button>
                
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>





@endsection
@section('calx')
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
    $( "#formReset" ).on( "click", function() {
         calculateFx()
      });

    $("#add_item").autocomplete({
    source: function (request, response) {
        if (!$('#supplierId').val()) {
                    $('#add_item').val('').removeClass('ui-autocomplete-loading');
                   Swal.fire({
                      icon: 'warning',
                      title: 'Please Select A Supplier',
                      })
                    return false;
                }

               $.ajax({
                type: 'POST',
               url: "{{ URL(Request::segment(1).'/find-work-order-product') }}",
               data: {
                term: request.term               
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
                calculateFx();
                }
                else{
                    $itemlist   = $('#itemlist');
            $counter    = 0;
            $counter = $("#itemlist tr").length;
                var i = ++$counter;
               $itemlist.append( '<tr>\
                        <td style="width:350px; vertical-align: top; padding-top: 17px;"><input class="form-control input-sm" type="hidden" id="pid" name="product_id[]" value="'+row.id+'" data-format="0" >\ '+row.value+' \<input type="hidden" name="product_name[]" value="'+row.value+'"></td>\
                        <td style="width:180px;"><input class="form-control input-sm text-end pquentity" required  type="number" step="any" min=1 max=999999999 required id="id'+row.id+'" data-format="" data-format="0[.]00" keydown="calculateFx(' + i + ',this);" onblur="calculateFx(' + i + ',this);"  name="product_quantity[]"  data-cell="Q'+i+'"><i class="text-black-50">&nbsp;</i></td> \
                        <td class="text-center"><button class="btn-remove btn btn-sm btn-danger"><i class="fa fa-times fa-fw"></i></button></td>\
                    </tr>');

                 $("#id"+row.id).val(1);
                $form = $('#dynamic').calx();
                $form.calx('update');
                calculateFx();
                }


        } else {
           Swal.fire('No matching result found! Product might be not listing.');
        }
        $('#itemlist').on('click', '.btn-remove', function(){
                $(this).parent().parent().remove();
                $form.calx('update');
                calculateFx();
            });
    }
});



//clear
$('#clear').click(function (e) {
  $('#formReset').get(0).reset();
  $('#itemlist').html('');
  Swal.fire('Form Reset Successfully');

});



$('#print').click(function (e) {
e.preventDefault();

$('.multisteps-form__content').append('<input type="hidden" name="print">');
  $('#formReset').submit();
});


});

//onkeyup
function calculateFx() {
  $form = $('#dynamic').calx();
    $form.calx('update');
}

</script>

@endpush

@extends('backend.layouts.master')
@section('title', 'Create Sale')
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
            <a href="{{ route(Request::segment(1) . '.sales.index') }}" class="btn btn-primary btn-sm ms-auto">Back</a>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            @include('partial.formerror')
            {!! Form::open(['route' => Request::segment(1) . '.sales.store', 'method' => 'POST', 'id' => 'formReset'])
            !!}
            @include('backend.common.sales.form')

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
    $('#customerId').select2({
       placeholder: 'Type Customer Name Or Phone',
       minimumInputLength: 1,
       ajax: {
         type: "POST",
         url: "{{ URL(Request::segment(1).'/find-customer') }}",
          dataType: "JSON",
             delay: 250,
            processResults: function (data) {
           return {
             results:  $.map(data, function (item) {
                   return {
                       text: item.customer_name + '('+ item.customer_phone + ')',
                       id: item.id

                   }

               })

           };

         },

         cache: true

       }

     });

    $("#add_item").autocomplete({
    source: function (request, response) {
        if (!$('#customerId').val()) {
                    $('#add_item').val('').removeClass('ui-autocomplete-loading');
                   Swal.fire({
                      icon: 'warning',
                      title: 'Please Select A Customer',
                      })
                    return false;
                }

               $.ajax({
                type: 'POST',
               url: "{{ URL(Request::segment(1).'/find-shop-current-stock') }}",
               data: {
                term: request.term,
                shop_id: $('#shop_id').val(),
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
                        <td style="width:120px;"><input class="form-control input-sm text-end" placeholder="0.00" tabindex="10" name="product_price[]" data-cell="P'+i+'" value="'+row.price+'" data-format=""><i class="text-black-50">&nbsp;</i><input type="hidden" name="avg_price[]" value="'+row.value+'"></td>\
                        <td style="width:120px;"><input class="form-control input-sm text-end pquentity" required  type="number" step="any" min=1 max=999999999 required id="id'+row.id+'" data-format="" data-format="0[.]00" onblur="getQty(' + i + ',this);"   name="product_quantity[]"  data-cell="Q'+i+'"><i class="text-black-50">'+'S -' +row.stock+'</i></td> \
                        <td style="width:80px;"><input type="number" step="any" min=0 max=999999999 class="form-control input-sm text-end" onblur="getVat(' + i + ',this);" placeholder="0.00" name="product_vat[]" data-cell="T'+i+'" readonly value="'+row.vat+'" data-format="0[.]0000"><i class="text-black-50">&nbsp;</i></td>\
                          <td style="width:100px;"><input name="product_vat_amount[]" type="number" step="any" min=0 max=999999999 class="form-control input-sm text-end" placeholder="0.00" readonly data-cell="V' + i + '" data-formula="(P' + i + '/100*T' + i +')*Q' +i + ' " data-format="0[.]00"><i class="text-black-50">&nbsp;</i></td>\
                            <td style="width:80px;"><input type="number" step="any" min=0 max=999999999 class="form-control input-sm text-end" onblur="getVat(' + i + ',this);" placeholder="0.00" name="product_discount[]" data-cell="D'+i+'" value="'+row.discount+'" data-format="0[.]0000"><i class="text-black-50">&nbsp;</i></td>\
                          <td style="width:100px;"><input name="product_discount_amount[]" type="number" step="any" min=0 max=999999999 class="form-control input-sm text-end" placeholder="0.00" readonly data-cell="N' + i + '" data-formula="(P' + i + '/100*D' + i +')*Q' +i + ' " data-format="0[.]00"><i class="text-black-50">&nbsp;</i></td>\
                        <td style="width:160px;"><input type="number" readonly step="any" min=1 max=999999999 class="form-control input-sm text-end" placeholder="0.00" name="product_total_price[]"  data-cell="F'+i+'" data-format="0[.]00" data-formula="((Q'+i+')*((P'+i+')+(V'+i+'))-(N'+i+'))"><i class="text-black-50">&nbsp;</i></td>\
                    <td class="text-center"><button class="btn-remove btn btn-sm btn-danger"><i class="fa fa-times fa-fw"></i></button></td>\
                    </tr>');

                 $("#id"+row.id).val(1);
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
$("#total_paid, other_discount").keyup(function() {
  var ttotal = $("#grand_total").val() -$("#total_paid").val();
  if(ttotal>0){
    $("#Cachback").html('<strong>Due TK: ' + ttotal.toFixed(2) + '</strong>');
  }else{
    var ctotal =$("#total_paid").val()-$("#grand_total").val();
    $("#Cachback").html('<strong>Change TK: ' + ctotal.toFixed(2) + '</strong>');
  }

  });

//paid save
$('#paid').click(function (e) {
e.preventDefault();
if($('#total_paid').val()==0 && $('#payment_method').val() !=='Due'){
  $('#total_paid').val($('#grand_total').val());
}

  $('#formReset').submit();
});
$('#print').click(function (e) {
e.preventDefault();
if($('#total_paid').val()==0 && $('#payment_method').val() !=='Due'){
  $('#total_paid').val($('#grand_total').val());
}

$('.multisteps-form__content').append('<input type="hidden" name="print">');
  $('#formReset').submit();
});


$('#payment_method').change(function(){
if($(this).val()=='Bkash'|| $(this).val()=='Nagad' || $(this).val()=='Rocket'){
$('#MobileBankPayment').removeClass('d-none');
$('#BankPayment').addClass('d-none');
$('#total_paid').prop('readonly', false);
}
else if($(this).val()=='Bank'){
 $('#BankPayment').removeClass('d-none');
 $('#MobileBankPayment').addClass('d-none');
 $('#total_paid').prop('readonly', false);
}
else if($(this).val()=='Due'){
  $('#total_paid').prop('readonly', true);
 $('#BankPayment').addClass('d-none');
 $('#MobileBankPayment').addClass('d-none');

}
else{
  $('#total_paid').prop('readonly', false);
 $('#MobileBankPayment').addClass('d-none');
 $('#BankPayment').addClass('d-none');

}
 });



});

//onkeyup
function getQty() {
  $form = $('#dynamic').calx();
 $form.calx('getCell', 'G1').setFormula('SUM(F1:F5000)-(O1)');
  $form.calx('getCell', 'Z1').setFormula('L1/(SUM(Q1:Q5000))');
  $form.calx('getCell', 'G1','Z1').calculate();
  $form.calx('update');
}
//onkeyup
function getVat() {
  getQty()
}

function showCustomerForm() {
            var page = "{{ url(Request::segment(1) . '/customers/create') }}";
            var myWindow = window.open(page, "_blank", "scrollbars=yes,width=700,height=1000,top=30");
            myWindow.focus();
        }
</script>

@endpush

<div class="multisteps-form__content">
  <div class="row mt-3">
    <div class="col-md-8">
      <div class="row">
        <div class="col-md-6 col-sm-1">
          <label for="date">Date *</label>
          {!! Form::date('date', date('Y-m-d'), ['id' => 'date', 'class' => 'form-control', 'required', 'tabindex' => 1,'autofocus']) !!}

        </div>

        <div class="col-md-6 col-sm-1">
          <label for="shop_id">Shop *</label>
          {!! Form::select('shop_id',Helper::shopPluckValue(), null, ['id' => 'shop_id', 'class' => 'form-control select2', 'tabindex' => 2]) !!}
        </div>



        <div class="col-md-12 col-sm-1 mt-1">
          <label for="note">Note</label>
          {!! Form::textarea('note', null, ['id' => 'note', 'class' => 'form-control','rows'=>1, 'tabindex' =>3]) !!}
        </div>
      </div>
    </div>


    <div class="col-md-4 col-sm-1 mt-3 mt-sm-0">
      <div class="card">
        <div class="card-pa-head">
          <div class="d-flex mb-1">
            <div class="w-25 pe-2 align-self-center"></div>
            <div class="w-75 ps-3 align-self-center">
              <p class="text-center pa-box">
                <span class="d-block">Damage Amount</span>
                 <strong data-formula="(SUM(F1:F5000))"></strong>
              </p>
            </div>
          </div>
        </div>
        <div class="card-body pt-0 pr-0">

          <div class="d-flex mb-1">
            <div class="w-25 pe-2 align-self-center">Vat/Tax</div>
            <div class="w-75 align-self-center">
              <input type="number" name="total_vat"  id="total_vat" class="form-control text-end py-1 px-1" readonly  data-format="0[.]00" data-formula="SUM(V1:V5000)" step="any" min="0" max="99999999999999">
            </div>
          </div>

          <div class="d-flex mb-1">
            <div class="w-25 pe-2 align-self-center">Grand Total</div>
            <div class="w-75 align-self-center">
              <input type="number" name="total_amount"  id="grand_total" class="form-control text-end py-1 px-1" readonly data-cell="G1" data-format="0[.]00" data-formula="SUM(F1:F5000)" step="any" min="0" max="99999999999999">
              </div>
          </div>

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
                placeholder="Please add products to Damage list" autocomplete="off" tabindex="4"
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
              <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Expire Date
              </th>
              <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Price
              </th>
              <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quantity
              </th>
              <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Vat(%)
              </th>
              <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Vat Val
              </th>
              <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total
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
         <th> <strong data-formula="(SUM(Q1:Q5000))"></strong></th>
          <th> <strong data-formula="(SUM(T1:T5000))"></strong></th>
          <th> <strong data-formula="(SUM(V1:V5000))"></strong></th>
          <th> <strong data-formula="(SUM(F1:F5000))"></strong></th>
          <th></th>
        </tfoot>
        </table>

      </div>

    </div>
    <div class="row">
      <div class="col-md-9"></div><div class="col-md-3 mt-3"><button class="btn btn-success" type="submit" tabindex="5">Save</button> <button class="btn btn-info" name="damage" type="submit" tabindex="6">Save & Damage</button></div>
    </div>
   </div>


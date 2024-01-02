
  <div class="row">
    <div class="col-12 col-sm-6">
      <h5 class="font-weight-bolder mb-0">(Quotation) Form</h5>
    </div>
    <div class="col-12 col-sm-6 text-end page-custom-buttons pcb-desktop">
      <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit" title="Save"><svg
          xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-check"
          viewBox="0 0 16 16">
          <path
            d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z" />
          <path
            d="M15.854 10.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.707 0l-1.5-1.5a.5.5 0 0 1 .707-.708l1.146 1.147 2.646-2.647a.5.5 0 0 1 .708 0z" />
        </svg> Save</button>
      <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" id="clear"> <svg
          xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat"
          viewBox="0 0 16 16">
          <path
            d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
          <path fill-rule="evenodd"
            d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
        </svg> Clear</button>
      
      <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next"  type="submit" value="print"  id="print"><svg
          xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill"
          viewBox="0 0 16 16">
          <path
            d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z" />
          <path
            d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
        </svg>  Print</button>
    </div>
  </div>
  <div class="multisteps-form__content">
    <div class="row mt-3">
      <div class="col-md-8">
        <div class="row">
          <div class="col-md-4 col-sm-1">
            <label for="date">Date *</label>
            {!! Form::date('date', date('Y-m-d'), ['id' => 'date', 'class' => 'form-control', 'required', 'tabindex' => 1,'autofocus','max'=>date('Y-m-d')]) !!}

          </div>
          <div class="col-md-4 col-sm-1">
            <label for="customerId">Customer * </label>
          {!! Form::select('customer_id',Helper::customerPluckValue(), Helper::adminSetup()->default_customer_id?:null, ['id' => 'customerId','required', 'class' => 'form-control select2','placeholder'=>'Select Customer', 'tabindex' => 2]) !!}
          </div>
          <div class="col-md-4 col-sm-1">
            <label for="borker_id">Broker * </label>
        {!! Form::select('broker_id',Helper::brokerPluckValue(), Helper::adminSetup()->default_broker_id?:null, ['id' => 'borker_id', 'class' => 'form-control select2', 'tabindex' => 3]) !!}
        
          </div>
          <div class="col-md-4 col-sm-1">
            <label for="port_name">Select Port * </label>
        {!! Form::select('port_name',Helper::portPluckValue(), null, ['id' => 'port_name', 'class' => 'form-control select2', 'tabindex' => 4]) !!}
        
          </div>
          <div class="col-md-4 col-sm-1">
            <label for="bin_number">Customer BIN</label>
          {!! Form::text('bin_number',null, ['id' => 'bin_number', 'class' => 'form-control', 'readonly']) !!}
          </div>
          <div class="col-md-4 col-sm-1">
            <label for="currencyId">Select Currency * </label>
        {!! Form::select('currency_name',Helper::currencyPluckValue(), null, ['id' => 'currencyId', 'class' => 'form-control select2','class' => 'form-control select2', 'placeholder'=>'Select One ', 'tabindex' => 5,'required']) !!}
        
          </div>
          <div class="col-md-12 col-sm-1 mt-1">
            <label for="note">Note</label>
            {!! Form::textarea('description', null, ['id' => 'note', 'class' => 'form-control','rows'=>1,'placeholder'=>'Note ', 'tabindex' =>6]) !!}
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
                  <span id="Cachback"></span>
                  <span class="d-block">Payable Amount</span>
                   <strong data-format="0[.]00" data-formula="(SUM(F1:F500)*CR1)"></strong>
                </p>
              </div>
            </div>
          </div>
          <div class="card-body pt-0 pr-0">
            <div class="d-flex mb-1">
              <div class="w-35 pe-2 align-self-center">Broker Bonus</div>
              <div class="w-65 align-self-center">
              <div class="col-md-12"> <input type="number" name="broker_bonus"  id="broker_bonus" class="form-control text-end py-1 px-1"  step="any" min="0" max="99999999999999"></div>
              </div>
            </div>
            <div class="d-flex mb-1">
              <div class="w-35 pe-2 align-self-center">Total Vat</div>
              <div class="w-65 align-self-center">
              <div class="col-md-12"> <input type="number" name="total_vat"  id="total_vat" class="form-control text-end py-1 px-1" readonly  data-format="0[.]00" data-formula="SUM(V1:V500)" step="any" min="0" max="99999999999999"></div>
              </div>
            </div>
            
            <div class="d-flex mb-1">
              <div class="w-35 pe-2 align-self-center">Convert Rate</div>
              <div class="w-65 align-self-center">
                    <div class="col-md-12">{!! Form::number('convert_rate', null, ['id' => 'convert_rate', 'class' => 'form-control text-end py-1 px-1 convert_rate','step'=>'any','min'=>0,'max'=>999, 'tabindex' => 8, 'data-cell'=>"CR1",'keydown'=>"calculateFx()",'onblur'=>"calculateFx()",'required']) !!}</div>
                </div>
            </div>

            <div class="d-flex mb-1">
              <div class="w-35 pe-2 align-self-center">Grand Total</div>
              <div class="w-65 align-self-center">
                <input type="hidden" name="total_quantity" data-format="0[.]00" data-formula="(SUM(Q1:Q5000))" >
                <input type="number" name="total_amount"  data-formula="(SUM(F1:F500)*CR1)" class="form-control text-end py-1 px-1" readonly data-cell="G1" data-format="0[.]00"  step="any" min="0" max="99999999999999">
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
                placeholder="Please add products to order list" autocomplete="off" tabindex="7"
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
              <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quotation Price
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
          <th colspan="1"></th>
         <th> <strong data-format="0[.]00" data-formula="(SUM(P1:P5000))"></strong></th>
         <th> <strong data-format="0[.]00" data-formula="(SUM(Q1:Q50000))"></strong></th>
          <th> <strong data-format="0[.]00" data-formula="(SUM(T1:T5000))"></strong></th>
          <th> <strong data-format="0[.]00" data-formula="(SUM(V1:V5000))"></strong></th>
          <th> <strong data-format="0[.]0000" data-formula="(SUM(F1:F5000))"></strong></th>
          <th></th>
        </tfoot>
        </table>

      </div>

    </div>
    <div class="row">
      <div class="col-md-9"></div><div class="col-md-3 mt-3"><button class="btn btn-success" type="submit" tabindex="10">Save</button>
         <button class="btn btn-info" name="quotation" type="submit" tabindex="11">Save & Quotation</button>
        </div>
    </div>
   </div>




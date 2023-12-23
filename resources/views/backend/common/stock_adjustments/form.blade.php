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
            {!! Form::select('shop_id',Helper::shopPluckValue(), null, ['id' => 'shop_id', 'class' => 'form-control select2', 'tabindex' => 2]) !!}


          </div>

          <div class="col-md-12 col-sm-1 mt-1">
            <label for="note">Note</label>
            {!! Form::textarea('description', null, ['id' => 'note', 'class' => 'form-control','rows'=>2, 'tabindex' =>3]) !!}
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
                placeholder="Please add products to Stock list" autocomplete="off" tabindex="4"
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
              <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Current Stock
              </th>
              <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Decrement
              </th>
              <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">New Stock
              </th>
              <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Increment
              </th>
              <th class="px-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Remove
              </th>

            </tr>
          </thead>
          <tbody id="itemlist">

          </tbody>
        <tfoot>
          <th colspan="1"></th>
         <th> <strong data-formula="(SUM(P1:P500))"></strong></th>
         <th> </th>
         <th> <strong data-formula="(SUM(Q1:Q500))"></strong></th>
         <th> </th>
          <th></th>
        </tfoot>
        </table>

      </div>

    </div>
    <div class="row">
      <div class="col-md-9"></div><div class="col-md-3 mt-3"><button class="btn btn-success" type="submit" tabindex="5">Save Stock Adjustment</button> </div>
    </div>
   </div>


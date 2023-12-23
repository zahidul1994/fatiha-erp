<aside class="sidenav bg-white  navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{url('/')}} " >
            <img src="{{ asset(Auth::user()->image) }}" class="navbar-brand-img border-radius-sm shadow-sm" alt="main_logo">
            <br>
            <span class="ms-1 font-weight-bold">{{Auth::user()->name}}</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{Request::is(Request::segment(1) .'/dashboard*') ? 'active' : ''}}"
                    href="{{route(Request::segment(1) . '.dashboard')}}">
                    <div
                        class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-dashboard text-primary text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            @can('sale-list')
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#saleId" class="nav-link" aria-controls="saleId" role="button"
                    aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-cart text-primary text-lg opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Sales</span>
                </a>

                <div class="collapse {{Request::is(Request::segment(1) .'/sales*') ? 'show' : ''}}  {{Request::is(Request::segment(1) .'/sale-returns*') ? 'show' : ''}} "
                    id="saleId">
                    <ul class="nav ms-4">
                        @can('sale-list')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/sales*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.sales.index')}}">
                                <span class="sidenav-mini-icon">S </span>
                                <i class="fa fa-cart-plus text-info text-lg opacity-10"></i> <span class="sidenav-normal">Sale </span>
                            </a>
                        </li>
                        @endcan
                        @can('sale-return-list')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/sale-returns*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.sale-returns.index')}}">
                                 <span class="sidenav-mini-icon">SR </span>
                                 <i class="ni ni-curved-next text-danger text-lg opacity-10"></i> <span class="sidenav-normal">Sale Return </span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </div>

            </li>
            @endcan
            @can('purchase-list')
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#purchases" class="nav-link" aria-controls="visaes" role="button"
                    aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-basket text-primary text-lg opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Purchase</span>
                </a>
                <div class="collapse {{Request::is(Request::segment(1) .'/purchases*') ? 'show' : ''}} {{Request::is(Request::segment(1) .'/purchase-returns*') ? 'show' : ''}}" id="purchases">
                    <ul class="nav ms-4">
                        @can('purchase-list')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/purchases*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.purchases.index')}}">
                                <span class="sidenav-mini-icon"> P </span>
                                <i class="ni ni-basket text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Purchase </span>
                            </a>
                        </li>
                        @endcan
                        @can('purchase-return-list')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/purchase-returns*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.purchase-returns.index')}}">
                                 <span class="sidenav-mini-icon">PR </span>
                                 <i class="ni ni-curved-next text-danger text-lg opacity-10"></i> <span class="sidenav-normal">Purchase Return </span>
                            </a>
                        </li>
                        @endcan

                    </ul>
                </div>
            </li>
        @endcan
        @can('product-list')
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#products" class="nav-link" aria-controls="products"
                    role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-cubes text-primary text-lg opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Products</span>
                </a>
                <div class="collapse  {{Request::is(Request::segment(1) .'/products*') ? 'show' : ''}} {{Request::is(Request::segment(1) .'/products*') ? 'show' : ''}} {{Request::is(Request::segment(1) .'/brands*') ? 'show' : ''}} {{Request::is(Request::segment(1) .'/barcodes*') ? 'show' : ''}} {{Request::is(Request::segment(1) .'/product-bulk-updates*') ? 'show' : ''}}"
                    id="products">
                    <ul class="nav ms-4">
                        @can('product-list')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/products*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.products.index')}}">
                                <span class="sidenav-mini-icon"> P</span>
                                <i class="fa fa-cubes text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Product</span>
                            </a>
                        </li>
                        @endcan

                        @can('brand-list')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/brands*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.brands.index')}}">
                                <span class="sidenav-mini-icon"> B </span>
                                <i class="fa fa-tags text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Brand </span>
                            </a>
                        </li>
                        @endcan
                        @can('product-edit')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/product-bulk-updates*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.productBulkUpdate')}}">
                                <span class="sidenav-mini-icon"> B </span>
                                <i class=" 	fa fa-magic text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Bulk Updates </span>
                            </a>
                        </li>
                        @endcan
                        @can('barcode-list')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/barcodes*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.barcodes.index')}}">
                                <span class="sidenav-mini-icon"> B </span>
                                <i class="fa fa-barcode text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Barcode </span>
                            </a>
                        </li>
                        @endcan

                    </ul>
                </div>
            </li>
            @endcan
            @can('shop-list')
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#shops" class="nav-link" aria-controls="products"
                    role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-shop text-primary text-lg opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Shops</span>
                </a>
                <div class="collapse  {{Request::is(Request::segment(1) .'/shops*') ? 'show' : ''}} {{Request::is(Request::segment(1) .'/shop-current-stocks*') ? 'show' : ''}} {{Request::is(Request::segment(1) .'/stock-adjustments*') ? 'show' : ''}} {{Request::is(Request::segment(1) .'/product-discounts*') ? 'show' : ''}}"
                    id="shops">
                    <ul class="nav ms-4">

                        @can('shop-current-stock-list')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/shop-current-stocks*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.shop-current-stocks.index')}}">
                                <span class="sidenav-mini-icon"> ST </span>
                                <i class="fa fa-database text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Shop  Stock </span>
                            </a>
                        </li>
                        @endcan
                        @can('stock-adjustment-list')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/stock-adjustments*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.stock-adjustments.index')}}">
                                 <span class="sidenav-mini-icon"> SA </span>
                                 <i class="fa fa-balance-scale text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Stock Adjustment</span>
                            </a>
                        </li>
                        @endcan
                        @can('product-discount-list')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/product-discounts*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.product-discounts.index')}}">
                                <span class="sidenav-mini-icon"> PD</span>
                                <i class="fa fa-trophy text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Shop Discounts </span>
                            </a>
                        </li>
                        @endcan

                    </ul>
                </div>
            </li>
@endcan

             @can('supplier-list')
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#suppliers" class="nav-link" aria-controls="visaes" role="button"
                    aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-address-book text-primary text-lg opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Suppliers</span>
                </a>
                <div class="collapse  {{Request::is(Request::segment(1) .'/suppliers*') ? 'show' : ''}}  {{Request::is(Request::segment(1) .'/supplier-due*') ? 'show' : ''}}" id="suppliers">
                    <ul class="nav ms-4">
                        @can('supplier-list')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/suppliers*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.suppliers.index')}}">
                                <span class="sidenav-mini-icon"> S </span>
                                <i class="fa fa-id-card text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Supplier </span>
                            </a>
                        </li>
                        @endcan

                        @can('supplier-due-list')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/supplier-due*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.supplier-due.index')}}">
                                <span class="sidenav-mini-icon"> SD </span>
                                <i class="fa fa-fax text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Supplier Due </span>
                            </a>
                        </li>
                        @endcan


                    </ul>
                </div>
            </li>
       @endcan

@can('customer-list')
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#customers" class="nav-link" aria-controls="saleId" role="button"
                    aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-users text-primary text-lg opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Customers</span>
                </a>
                <div class="collapse {{Request::is(Request::segment(1) .'/customers*') ? 'show' : ''}} {{Request::is(Request::segment(1) .'/customer-due*') ? 'show' : ''}} "
                    id="customers">
                    <ul class="nav ms-4">

                        @can('customer-list')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/customers*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.customers.index')}}">

                                <span class="sidenav-mini-icon">C </span>
                                <i class="fa fa-user-plus text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Customer </span>
                            </a>
                        </li>
                        @endcan

                        @can('customer-due-list')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/customer-due*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.customer-due.index')}}">
                                <span class="sidenav-mini-icon">R </span>
                                <i class="fa fa-edit text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Customer Due </span>
                            </a>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </li>
@endcan
@can('damage-product-list')
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#damages" class="nav-link" aria-controls="damages" role="button"
                    aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-bug text-primary text-lg opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Damages</span>
                </a>
                <div class="collapse {{Request::is(Request::segment(1) .'/damage-products*') ? 'show' : ''}}"
                    id="damages">
                    <ul class="nav ms-4">
                     @can('damage-product-list')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/damage-products*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.damage-products.index')}}">
                                <span class="sidenav-mini-icon">DP</span>
                                <i class="fa fa-bug text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Damage Products </span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </li>
     @endcan

     @can('expense-list')

            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#dashboardsAccounts" class="nav-link"
                    aria-controls="dashboardsAccounts" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-money-coins text-primary text-lg opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Accounts</span>
                </a>
                <div class="collapse  {{Request::is(Request::segment(1) .'/agent-ledger*') ? 'show' : ''}} {{Request::is(Request::segment(1) .'/office-expense*') ? 'show' : ''}} {{Request::is(Request::segment(1) .'/daily-receive*') ? 'show' : ''}} {{Request::is(Request::segment(1) .'/balance-sheet*') ? 'show' : ''}} {{Request::is(Request::segment(1) .'/expenses*') ? 'show' : ''}}"
                    id="dashboardsAccounts">
                    <ul class="nav ms-4">
                         @can('expense-list')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/expenses*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.expenses.index')}}">
                                <span class="sidenav-mini-icon"> E </span>
                                <i class="fa fa-etsy text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Expenses </span>
                            </a>
                        </li>
                        @endcan

                    </ul>
                </div>
            </li>
            @endcan

            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#dashboardsReport" class="nav-link" aria-controls="dashboardsReport"
                    role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-line-chart text-primary text-lg opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Reports</span>
                </a>
                <div class="collapse {{Request::is(Request::segment(1) .'/purchase-report*') ? 'show' : ''}}{{Request::is(Request::segment(1) .'/product-report*') ? 'show' : ''}}{{Request::is(Request::segment(1) .'/analytics-report*') ? 'show' : ''}}{{Request::is(Request::segment(1) .'/activity-log-report*') ? 'show' : ''}}{{Request::is(Request::segment(1) .'/sale-report*') ? 'show' : ''}}{{Request::is(Request::segment(1) .'/damage-product-report*') ? 'show' : ''}}{{Request::is(Request::segment(1) .'/expense-report*') ? 'show' : ''}}{{Request::is(Request::segment(1) .'/damage-report*') ? 'show' : ''}}{{Request::is(Request::segment(1) .'/sale-return-report*') ? 'show' : ''}}{{Request::is(Request::segment(1) .'/purchase-return-report*') ? 'show' : ''}}"
                    id="dashboardsReport">
                    <ul class="nav ms-4">
                       <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/analytics-report*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.analyticsReport')}}">
                                <span class="sidenav-mini-icon">AnR</span>
                                <i class="fa fa-pie-chart text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Analytics Report </span>
                            </a>
                        </li>

                        @can('product-report')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/product-report*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.productReport')}}">
                                <span class="sidenav-mini-icon">PrR</span>
                                <i class="fa fa-area-chart text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Product Report </span>
                            </a>
                        </li>
                        @endcan

                        @can('purchase-report')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/purchase-report*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.purchaseReport')}}">
                                <span class="sidenav-mini-icon">PuR</span>
                                <i class="fa fa-signal text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Purchase Report </span>
                            </a>
                        </li>
                        @endcan

                        @can('sale-report')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/sale-report*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.saleReport')}}">
                                <span class="sidenav-mini-icon">SaR</span>
                                <i class="fa fa-line-chart text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Sale Report </span>
                            </a>
                        </li>
                        @endcan

                        @can('loss-profit-report')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/loss-profit-report*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.lossProfitReport')}}">
                                <span class="sidenav-mini-icon">LPR</span>
                                <i class="fa fa-line-chart text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Loss Profit Report </span>
                            </a>
                        </li>
                        @endcan

                        @can('damage-report')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/damage-report*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.damageReport')}}">
                                <span class="sidenav-mini-icon">DaR</span>
                                <i class="fa fa-linux text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Damage Report </span>
                            </a>
                        </li>
                        @endcan
                        @can('expense-report')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/expense-report*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.expenseReport')}}">
                                <span class="sidenav-mini-icon">ExR</span>
                                <i class="fa fa-sort-numeric-desc text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Expense Report </span>
                            </a>
                        </li>
                        @endcan
                       
                        @can('sale-return-report')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/sale-return-report*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.saleReturnReport')}}">
                                <span class="sidenav-mini-icon">SRR</span>
                                <i class="fa fa-stack-overflow text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Sales Return Report </span>
                            </a>
                        </li>
                        @endcan

                        @can('purchase-return-report')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/purchase-return-report*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.purchaseReturnReport')}}">
                                <span class="sidenav-mini-icon">PRR</span>
                                <i class="fa fa-sellsy text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Purchase Return Report </span>
                            </a>
                        </li>
                        @endcan

                    </ul>
                </div>
            </li>


        </ul>
    </div>
    </li>


</aside>

<aside
    class="sidenav bg-white  navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{url('/')}} ">
            <img src="{{ asset(Auth::user()->image) }}" class="navbar-brand-img border-radius-sm shadow-sm"
                alt="main_logo">
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

                <div class="collapse {{Request::is(Request::segment(1) .'/work-orders*') ? 'show' : ''}} {{Request::is(Request::segment(1) .'/sales*') ? 'show' : ''}}"
                    id="saleId">
                    <ul class="nav ms-4">
                        @can('work-order-list')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/work-orders*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.work-orders.index')}}">
                                <span class="sidenav-mini-icon">W </span>
                                <i class="ni ni-curved-next text-danger text-lg opacity-10"></i> <span
                                    class="sidenav-normal">Work Order </span>
                            </a>
                        </li>
                        @endcan
                        @can('sale-list')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/sales*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.sales.index')}}">
                                <span class="sidenav-mini-icon">S </span>
                                <i class="fa fa-cart-plus text-info text-lg opacity-10"></i> <span
                                    class="sidenav-normal">Sale </span>
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
                <div class="collapse {{Request::is(Request::segment(1) .'/purchases*') ? 'show' : ''}} {{Request::is(Request::segment(1) .'/purchase-returns*') ? 'show' : ''}}"
                    id="purchases">
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
                                <i class="ni ni-curved-next text-danger text-lg opacity-10"></i> <span
                                    class="sidenav-normal">Purchase Return </span>
                            </a>
                        </li>
                        @endcan

                    </ul>
                </div>
            </li>
            @endcan

            @can('requisition-list')
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#requisitions" class="nav-link" aria-controls="requisitions" role="button"
                    aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-basket text-primary text-lg opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Requisition</span>
                </a>
                <div class="collapse {{Request::is(Request::segment(1) .'/requisitions*') ? 'show' : ''}} {{Request::is(Request::segment(1) .'/requisition-receive*') ? 'show' : ''}}"
                    id="requisitions">
                    <ul class="nav ms-4">
                        @can('requisition-list')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/requisitions*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.requisitions.index')}}">
                                <span class="sidenav-mini-icon"> R </span>
                                <i class="ni ni-basket text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Requisition </span>
                            </a>
                        </li>
                        @endcan
                        @can('requisition-edit')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/requisition-receive*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.requisition-receive.index')}}">
                                <span class="sidenav-mini-icon">RR </span>
                                <i class="ni ni-curved-next text-danger text-lg opacity-10"></i> <span
                                    class="sidenav-normal">Requisition Receive </span>
                            </a>
                        </li>
                        @endcan

                    </ul>
                </div>
            </li>
            @endcan

            @can('product-list')
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#products" class="nav-link" aria-controls="products" role="button"
                    aria-expanded="false">
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
                <a data-bs-toggle="collapse" href="#shops" class="nav-link" aria-controls="products" role="button"
                    aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-shop text-primary text-lg opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Warehouse </span>
                </a>
                <div class="collapse {{Request::is(Request::segment(1) .'/warehouses*') ? 'show' : ''}}  {{Request::is(Request::segment(1) .'/shops*') ? 'show' : ''}} {{Request::is(Request::segment(1) .'/shop-current-stocks*') ? 'show' : ''}} {{Request::is(Request::segment(1) .'/stock-adjustments*') ? 'show' : ''}} {{Request::is(Request::segment(1) .'/product-discounts*') ? 'show' : ''}}"
                    id="shops">
                    <ul class="nav ms-4">
                        @can('warehouse-list')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/warehouses*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.warehouses.index')}}">
                                <span class="sidenav-mini-icon">S</span>
                                <i class="fa fa-home text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Warehouse</span>
                            </a>
                        </li>
                        @endcan
                        @can('product-list')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/shops*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.shops.index')}}">
                                <span class="sidenav-mini-icon">S</span>
                                <i class="fa fa-home text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Shop</span>
                            </a>
                        </li>
                        @endcan
                        @can('shop-current-stock-list')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/shop-current-stocks*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.shop-current-stocks.index')}}">
                                <span class="sidenav-mini-icon"> ST </span>
                                <i class="fa fa-database text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Shop Stock </span>
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
                <div class="collapse  {{Request::is(Request::segment(1) .'/suppliers*') ? 'show' : ''}}  {{Request::is(Request::segment(1) .'/supplier-due*') ? 'show' : ''}}"
                    id="suppliers">
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
                <div class="collapse {{Request::is(Request::segment(1) .'/customers*') ? 'show' : ''}} {{Request::is(Request::segment(1) .'/brokers*') ? 'show' : ''}} "
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

                        @can('broker-list')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/brokers*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.brokers.index')}}">
                                <span class="sidenav-mini-icon">R </span>
                                <i class="fa fa-edit text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Broker </span>
                            </a>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </li>
            @endcan
            @can('stock-transfer-list')
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#stocktransfers" class="nav-link" aria-controls="stocktransfers"
                    role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="fa fa-exchange text-primary text-lg opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Transfers</span>
                </a>
                <div class="collapse {{Request::is(Request::segment(1) .'/stock-transfers*') ? 'show' : ''}}"
                    id="stocktransfers">
                    <ul class="nav ms-4">
                        @can('stock-transfer-list')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/stock-transfers*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.stock-transfers.index')}}">
                                <span class="sidenav-mini-icon">ST </span>
                                <i class="fa fa-retweet text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Stock Transfers </span>
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
                <div class="collapse {{Request::is(Request::segment(1) .'/wallets*') ? 'show' : ''}}  {{Request::is(Request::segment(1) .'/agent-ledger*') ? 'show' : ''}} {{Request::is(Request::segment(1) .'/office-expense*') ? 'show' : ''}} {{Request::is(Request::segment(1) .'/daily-receive*') ? 'show' : ''}} {{Request::is(Request::segment(1) .'/balance-sheet*') ? 'show' : ''}} {{Request::is(Request::segment(1) .'/expenses*') ? 'show' : ''}}"
                    id="dashboardsAccounts">
                    <ul class="nav ms-4">
                        @can('wallet-list')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/wallets*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.wallets.index')}}">
                                <span class="sidenav-mini-icon"> W</span>
                                <i class="fa fa-google-wallet text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Wallet </span>
                            </a>
                        </li>
                        @endcan
                        @can('wallet-list')
                        <li class="nav-item {{Request::is(Request::segment(1) .'/payments*') ? 'active' : ''}}">
                            <a class="nav-link " href="{{route(Request::segment(1) . '.payments')}}">
                                <span class="sidenav-mini-icon"> PA </span>
                                <i class="fa fa-google-wallet text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Payment </span>
                            </a>
                        </li>
                        @endcan
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
                        @can('activity-report')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/activity-log-report*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.activityLogReport')}}">
                                <span class="sidenav-mini-icon">AcR</span>
                                <i class="fa fa-bar-chart text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Activity Report </span>
                            </a>
                        </li>
                        @endcan
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
                        @can('purchase-report')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/purchase-product-report*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.purchaseProductReport')}}">
                                <span class="sidenav-mini-icon">PuPrR</span>
                                <i class="fa fa-sitemap text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Purchase Product Report </span>
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
                        @can('sale-report')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/sale-product-report*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.saleProductReport')}}">
                                <span class="sidenav-mini-icon">SaPrR</span>
                                <i class="fa fa-linode text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Sale Product Report </span>
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
                        @can('loss-profit-report')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/product-loss-profit-report*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.productLossProfitReport')}}">
                                <span class="sidenav-mini-icon">pL&PR</span>
                                <i class="fa fa-line-chart text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Product Loss Profit Report </span>
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
                        @can('damage-product-report')
                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/damage-product-report*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.damageProductReport')}}">
                                <span class="sidenav-mini-icon">DaPR</span>
                                <i class="fa fa-slideshare text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Damage Product Report </span>
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
            @can('user-list')
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#dashboardsExamples" class="nav-link"
                    aria-controls="dashboardsExamples" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-settings text-primary text-lg opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Users & Setup</span>
                </a>
                <div class="collapse  {{Request::is(Request::segment(1) .'/roles*') ? 'show' : ''}} {{Request::is(Request::segment(1) .'/users*') ? 'show' : ''}} {{Request::is(Request::segment(1) .'/currency*') ? 'show' : ''}} {{Request::is(Request::segment(1) .'/ports*') ? 'show' : ''}}"
                    id="dashboardsExamples">
                    <ul class="nav ms-4">

                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/business-setup*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.businessSetup')}}">
                                <span class="sidenav-mini-icon"> BS</span>
                                <i class="fa fa-cogs text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Business Setup </span>
                            </a>
                        </li>
                        @can('currency-list')
                        <li class="nav-item {{Request::is(Request::segment(1) .'/currency*') ? 'active' : ''}}">
                            <a class="nav-link " href="{{route(Request::segment(1) . '.currency.index')}}">
                                <span class="sidenav-mini-icon"> C </span>
                                <i class="fa fa-money-bill-alt text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Currency </span>
                            </a>
                        </li>
                        @endcan
                        @can('port-list')
                        <li class="nav-item {{Request::is(Request::segment(1) .'/ports*') ? 'active' : ''}}">
                            <a class="nav-link " href="{{route(Request::segment(1) . '.ports.index')}}">
                                <span class="sidenav-mini-icon"> C </span>
                                <i class="fa fa-ship text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Ports </span>
                            </a>
                        </li>
                        @endcan


                        <li class="nav-item">
                            <a class="nav-link {{Request::is(Request::segment(1) .'/roles*') ? 'active' : ''}}"
                                href="{{route(Request::segment(1) . '.roles.index')}}">
                                <span class="sidenav-mini-icon"> RO </span>
                                <i class="fa fa-registered text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Roles </span>
                            </a>
                        </li>

                        @can('user-list')
                        <li class="nav-item {{Request::is(Request::segment(1) .'/users*') ? 'active' : ''}}">
                            <a class="nav-link " href="{{route(Request::segment(1) . '.users.index')}}">
                                <span class="sidenav-mini-icon"> U </span>
                                <i class="fa fa-street-view text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Users </span>
                            </a>
                        </li>
                        @endcan

                        <li class="nav-item {{Request::is(Request::segment(1) .'/profiles*') ? 'active' : ''}}">
                            <a class="nav-link " href="{{route(Request::segment(1) . '.profiles')}}">
                                <span class="sidenav-mini-icon"> PR </span>
                                <i class="fa fa-user-secret text-info text-lg opacity-10"></i>
                                <span class="sidenav-normal">Profile </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endcan

        </ul>
    </div>
    </li>


</aside>
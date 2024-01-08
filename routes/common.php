<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Common\SaleReturnController;
use App\Http\Controllers\Common\RoleController;
use App\Http\Controllers\Common\SaleController;
use App\Http\Controllers\Common\UserController;
use App\Http\Controllers\Common\BrandController;
use App\Http\Controllers\Common\BarcodeController;
use App\Http\Controllers\Common\ExpenseController;
use App\Http\Controllers\Common\ProductController;
use App\Http\Controllers\Common\CustomerController;
use App\Http\Controllers\Common\PurchaseController;
use App\Http\Controllers\Common\SupplierController;
use App\Http\Controllers\Common\CustomerDueController;
use App\Http\Controllers\Common\SupplierDueController;
use App\Http\Controllers\Common\NotificationController;
use App\Http\Controllers\Common\DamageProductController;
use App\Http\Controllers\Common\StockTransferController;
use App\Http\Controllers\Common\PurchaseReturnController;
use App\Http\Controllers\Common\ProductDiscountController;
use App\Http\Controllers\Common\StockAdjustmentController;
use App\Http\Controllers\Common\ShopCurrentStockController;
use App\Http\Controllers\Common\WorkOrderController;
use App\Http\Controllers\Common\BrokerController;
use App\Http\Controllers\Common\RequisitionController;
use App\Http\Controllers\Common\RequisitionReceiveController;
use App\Http\Controllers\Common\ReportController;


Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::post('user-status', [UserController::class, 'updateStatus'])->name('userStatus');
Route::get('admin-login-as-employee/{id}', [UserController::class, 'loginAsEmployee']);


##notification
 Route::resource('notifications', NotificationController::class);

##product
Route::resource('products', ProductController::class);
Route::post('product-status', [ProductController::class, 'updateStatus'])->name('productStatus');
Route::get('check-product-name/{id}', [ProductController::class, 'checkProductName'])->name('checkProductName');
Route::get('product-duplicate/{id}', [ProductController::class, 'duplicateProduct'])->name('productDuplicate');
Route::get('product-bulk-updates', [ProductController::class, 'productBulkUpdate'])->name('productBulkUpdate');
Route::post('product-bulk-updates', [ProductController::class, 'productBulkUpdateStore'])->name('productBulkUpdateStore');

##for brand wise products show
Route::get('brand-products/{id}', [ProductController::class, 'brandProducts'])->name('brandProducts');
Route::get('check-product-hscode/{id}', [ProductController::class, 'checkHscode'])->name('checkHscode');

##for hole system  product finding
Route::get('find-product', [ProductController::class, 'findProduct'])->name('findProduct');

##barcode
Route::resource('barcodes', BarcodeController::class);

##for  products discount
Route::resource('product-discounts', ProductDiscountController::class);
Route::post('find-product-for-discount', [ProductDiscountController::class, 'getProductForDiscount'])->name('getProductForDiscount');
Route::get('product-discount-pdf/{id}', [ProductDiscountController::class, 'productDiscountPdf'])->name('productDiscountPdf');


##purchase
Route::resource('purchases', PurchaseController::class);
Route::get('purchase-pdf/{id}', [PurchaseController::class, 'purchasePdf'])->name('purchasePdf');
Route::get('purchase-chalan/{id}', [PurchaseController::class, 'purchaseChalan'])->name('purchaseChalan');



##brands
Route::resource('brands', BrandController::class);
Route::post('brand-status', [BrandController::class, 'updateStatus'])->name('brandStatus');

##supplier
Route::resource('suppliers', SupplierController::class);
Route::post('supplier-status', [SupplierController::class, 'updateStatus'])->name('supplierStatus');
Route::get('supplier-pdf/{id}', [SupplierController::class, 'supplierPdf'])->name('supplierPdf');

##supplier due
Route::resource('supplier-due', SupplierDueController::class);
Route::get('supplier-due-pdf/{id}', [SupplierDueController::class, 'supplierDuePdf'])->name('supplierDuePdf');


##shop current stock
Route::resource('shop-current-stocks', ShopCurrentStockController::class);

##customer
Route::resource('customers', CustomerController::class);
Route::post('customer-status', [CustomerController::class, 'updateStatus'])->name('customerStatus');
Route::get('customer-pdf/{id}', [CustomerController::class, 'customerPdf'])->name('customerPdf');
##supplier due
Route::resource('customer-due', CustomerDueController::class);
Route::get('customer-due-pdf/{id}', [CustomerDueController::class, 'customerDuePdf'])->name('customerDuePdf');

##broker
Route::resource('brokers', BrokerController::class);


##work order

Route::post('find-work-order-product', [WorkOrderController::class, 'findWorkOrderProduct']);
Route::resource('work-orders', WorkOrderController::class);
Route::get('work-order-pdf/{id}', [WorkOrderController::class, 'workOrderPdf'])->name('workOrderPdf');


##requisition 
Route::resource('requisitions', RequisitionController::class);
Route::get('requisition-pdf/{id}', [RequisitionController::class, 'requisitionPdf'])->name('requisitionPdf');
Route::get('requisition-receive', [RequisitionReceiveController::class, 'index'])->name('requisition-receive.index');
Route::patch('requisition-receive/{id}', [RequisitionReceiveController::class, 'index'])->name('requisition-receive.store');
Route::get('requisition-reject/{id}', [RequisitionReceiveController::class, 'reject'])->name('requisition-reject');
Route::get('requisition-purchase/{id}', [RequisitionReceiveController::class, 'purchase'])->name('requisition-purchase');
##sale
Route::resource('sales', SaleController::class);
Route::post('find-customer', [SaleController::class, 'findCustomer'])->name('findCustomer');
Route::post('find-shop-current-stock', [SaleController::class, 'findShopCurrentStock'])->name('findShopCurrentStock');
Route::get('sale-print/{id}', [SaleController::class, 'salePrint'])->name('salePrint');
Route::get('sale-pdf/{id}', [SaleController::class, 'salePdf'])->name('salePdf');

##damage
Route::resource('damage-products', DamageProductController::class);
Route::post('find-damage-product', [DamageProductController::class, 'findDamageProduct'])->name('findDamageProduct');
Route::get('damage-product-pdf/{id}', [DamageProductController::class, 'damageProductPdf'])->name('damageProductPdf');



##purchase return
Route::resource('purchase-returns', PurchaseReturnController::class);
Route::post('find-purchase', [PurchaseReturnController::class, 'findPurchases'])->name('findPurchases');
Route::get('purchase-return-create/{id}', [PurchaseReturnController::class, 'purchaseReturnCreate'])->name('purchaseReturnCreate');
Route::get('purchase-return-pdf/{id}', [PurchaseReturnController::class, 'purchaseReturnPdf'])->name('purchaseReturnPdf');
Route::get('purchase-return-chalan/{id}', [PurchaseReturnController::class, 'purchaseReturnChalan'])->name('purchaseReturnChalan');

##sale return
Route::resource('sale-returns', SaleReturnController::class);
Route::post('find-sale', [SaleReturnController::class, 'findSales'])->name('findSales');
Route::get('sale-return-create/{id}', [SaleReturnController::class, 'saleReturnCreate'])->name('saleReturnCreate');
Route::get('sale-return-pdf/{id}', [SaleReturnController::class, 'saleReturnPdf'])->name('saleReturnPdf');



##stock adjustment
Route::resource('stock-adjustments', StockAdjustmentController::class);
Route::get('stock-adjustment-pdf/{id}', [StockAdjustmentController::class, 'stockAdjustmentPdf'])->name('stockAdjustmentPdf');
##product transfer
Route::resource('stock-transfers', StockTransferController::class);
Route::post('find-stock-transfer-product', [StockTransferController::class, 'getProductForTransfer'])->name('getProductForTransfer');

## Expenses
Route::resource('expenses', ExpenseController::class);

## report start
Route::get('finding-reporting-product', [ReportController::class, 'findReportingProduct'])->name('findReportingProduct');
Route::get('analytics-report', [ReportController::class, 'analyticsReport'])->name('analyticsReport');

Route::get('product-report', [ReportController::class, 'productReportIndex'])->name('productReport');
Route::post('product-report', [ReportController::class, 'productReportShow'])->name('productReportShow');

Route::get('activity-log-report', [ReportController::class, 'activityLogReportIndex'])->name('activityLogReport');
Route::post('activity-log-report', [ReportController::class, 'activityLogReportShow'])->name('activityLogReportShow');

Route::get('purchase-report', [ReportController::class, 'purchaseReportIndex'])->name('purchaseReport');
Route::post('purchase-report', [ReportController::class, 'purchaseReportShow'])->name('purchaseReportShow');

Route::get('purchase-product-report', [ReportController::class, 'purchaseProductReportIndex'])->name('purchaseProductReport');
Route::post('purchase-product-report', [ReportController::class, 'purchaseProductReportShow'])->name('purchaseProductReportShow');

Route::get('sale-report', [ReportController::class, 'saleReportIndex'])->name('saleReport');
Route::post('sale-report', [ReportController::class, 'saleReportShow'])->name('saleReportShow');

Route::get('sale-product-report', [ReportController::class, 'saleProductReportIndex'])->name('saleProductReport');
Route::post('sale-product-report', [ReportController::class, 'saleProductReportShow'])->name('saleProductReportShow');

Route::get('loss-profit-report', [ReportController::class, 'lossProfitReportIndex'])->name('lossProfitReport');
Route::post('loss-profit-report', [ReportController::class, 'lossProfitReportShow'])->name('lossProfitReportShow');

Route::get('product-loss-profit-report', [ReportController::class, 'productLossProfitReportIndex'])->name('productLossProfitReport');
Route::post('product-loss-profit-report', [ReportController::class, 'productLossProfitReportShow'])->name('productLossProfitReportShow');

Route::get('sale-return-report', [ReportController::class, 'saleReturnReportIndex'])->name('saleReturnReport');
Route::post('sale-return-report', [ReportController::class, 'saleReturnReportShow'])->name('saleReturnReportShow');

Route::get('purchase-return-report', [ReportController::class, 'purchaseReturnReportIndex'])->name('purchaseReturnReport');
Route::post('purchase-return-report', [ReportController::class, 'purchaseReturnReportShow'])->name('purchaseReturnReportShow');

Route::get('damage-report', [ReportController::class, 'damageReportIndex'])->name('damageReport');
Route::post('damage-report', [ReportController::class, 'damageReportShow'])->name('damageReportShow');

Route::get('expense-report', [ReportController::class, 'expenseReportIndex'])->name('expenseReport');
Route::post('expense-report', [ReportController::class, 'expenseReportShow'])->name('expenseReportShow');

Route::get('damage-product-report', [ReportController::class, 'damageProductIndex'])->name('damageProductReport');
Route::post('damage-product-report', [ReportController::class, 'damageProductReportShow'])->name('damageProductReportShow');

## report end

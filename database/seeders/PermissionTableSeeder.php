<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{


        public function run()
        {
            $permission=array(
              'barcode-list',
              'barcode-create',
              'barcode-edit',
              'barcode-delete',
              'brand-list',
              'brand-create',
              'brand-edit',
              'brand-delete',
              'customer-list',
              'customer-create',
              'customer-edit',
              'customer-delete',
              'customer-due-list',
              'customer-due-create',
              'customer-due-edit',
              'customer-due-delete',
              'damage-product-list',
              'damage-product-create',
              'damage-product-edit',
              'damage-product-delete',
              'employee-list',
              'employee-list',
              'employee-create',
              'employee-edit',
              'employee-delete',
              'expense-list',
              'expense-create',
              'expense-edit',
              'expense-delete',
              'product-exchange-list',
              'product-exchange-create',
              'product-exchange-edit',
              'product-exchange-delete',

              'product-list',
              'product-create',
              'product-edit',
              'product-delete',

              'product-discount-list',
              'product-discount-create',
              'product-discount-edit',
              'product-discount-delete',

              'stock-transfer-list',
              'stock-transfer-create',
              'stock-transfer-edit',
              'stock-transfer-delete',


              'purchase-list',
              'purchase-create',
              'purchase-edit',
              'purchase-delete',

              'purchase-return-list',
              'purchase-return-create',
              'purchase-return-edit',
              'purchase-return-delete',

              'role-list',
              'role-create',
              'role-edit',
              'role-delete',

              'shop-list',
              'shop-create',
              'shop-edit',
              'shop-delete',
              'shop-current-stock-list',
              'shop-current-stock-create',
              'shop-current-stock-edit',
              'shop-current-stock-delete',
              'supplier-list',
              'supplier-create',
              'supplier-edit',
              'supplier-delete',
              'supplier-due-list',
              'supplier-due-create',
              'supplier-due-edit',
              'supplier-due-delete',
              'sale-list',
              'sale-create',
              'sale-edit',
              'sale-delete',
              'sale-return-list',
              'sale-return-create',
              'sale-return-edit',
              'sale-return-delete',
              'stock-adjustment-list',
              'stock-adjustment-create',
              'stock-adjustment-edit',
              'stock-adjustment-delete',
              'user-list',
              'user-create',
              'user-edit',
              'user-delete',

              'product-report',
              'purchase-report',
              'sale-report',
              'transfer-report',
              'damage-report',
              'expense-report',
              'damage-product-report',
              'purchase-return-report',
              'sale-return-report',
              'supplier-due-report',
              'customer-due-report',
              'activity-report',
              'loss-profit-report',

              'wallet-list',
              'wallet-create',
              'wallet-edit',
              'wallet-delete',
            );
            foreach($permission as $v) {
                $newlist  = new Permission();
                $info=Permission::wherename($v)->first();
                if(empty($info)){
                  $newlist->guard_name ='web';
                $newlist->name =$v;
                $newlist->save();
              }
            }


    }
}

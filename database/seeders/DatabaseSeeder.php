<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\PackageSeeder;
use Database\Seeders\PaymentSeeder;
use Database\Seeders\PermissionTableSeeder;
use Database\Seeders\VatSeeder;
use Database\Seeders\UnitSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\ExpenseHeadSeeder;
use Database\Seeders\DiscountSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(CreateSuperAdmin::class);
        $this->call(SettingTableSeeder::class);
        $this->call(PackageSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(PaymentSeeder::class);
		 $this->call(UnitSeeder::class);
        $this->call(CountrySeeder::class);
         $this->call(VatSeeder::class);
        $this->call(DiscountSeeder::class);
        $this->call(CategorySeeder::class);
        //  $this->call(ProductSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(ExpenseHeadSeeder::class);
    }
}

<?php

namespace Database\Seeders;
use App\Models\Discount;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $info = Discount::first();
        if (is_null($info)) {
           for ($i=0; $i<101 ; $i++) { 
            $size = new Discount();
            $size->discount = $i;
            $size->superadmin_id = 1;
            $size->save();
        }
        }
    }
}

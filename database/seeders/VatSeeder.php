<?php

namespace Database\Seeders;
use App\Models\Vat;
use Illuminate\Database\Seeder;

class VatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $info = Vat::first();
        if (is_null($info)) {
           for ($i=0; $i<101; $i++) { 
            $size = new Vat();
            $size->vat = $i;
            $size->superadmin_id = 1;
            $size->save();
        }
        }
    }
}

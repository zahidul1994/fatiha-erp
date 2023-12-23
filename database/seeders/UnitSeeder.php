<?php

namespace Database\Seeders;
use App\Models\Unit;
use Illuminate\Database\Seeder;


class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $info = Unit::latest()->first();
        if (is_null($info)) {
            $colorList = array(
                'PCS','CARTON','KG','GM','PACKET','ML','DZN','BOX','BAG','PACKAGE','TRAY','EACH','CTN','ROFTA','TIN'
                
                
            );
    
            foreach ($colorList as $color) {
                $count = new Unit();
                $count->unit_name = $color;
                $count->superadmin_id = 1;
                $count->save();
            }
    
            
        }
    }
}

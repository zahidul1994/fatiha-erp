<?php

namespace Database\Seeders;
use App\Models\ExpenseHead;
use Illuminate\Database\Seeder;


class ExpenseHeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $info = ExpenseHead::latest()->first();
        if (is_null($info)) {
            $headList = array(
                 'House Rent',
                 'Transform',
                 'Guest',
                 'Net Bill',
                 'Other'
                
            );
    
            foreach ($headList as $list) {
                $expense_head = new ExpenseHead();
                $expense_head->expense_name = $list;
                $expense_head->superadmin_id = 1;
               $expense_head->status =1;
               $expense_head->save();
            }
    
            
        }
    }
}

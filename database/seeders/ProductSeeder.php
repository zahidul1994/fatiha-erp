<?php

namespace Database\Seeders;
use App\Models\Size;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Sohibd\Laravelslug\Generate;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


       $request=Product::first();
       if (!is_null($request)) {
           for ($i=0; $i<5000; $i++) { 
            $product = new Product();
            $product->admin_id = $request->admin_id;
            $product->product_name = $request->product_name. $i;
            $product->brand_id = $request->brand_id;
            $product->barcode = mt_rand(000000000,999999999);
            $product->slug = Generate::Slug($request->product_name);
            $product->category_id = $request->category_id;
            $product->sub_category_id = $request->sub_category_id;
            $product->rack_number = $request->rack_number;
            $product->made_in = $request->made_in;
            $product->purchase_price = $request->purchase_price;
            $product->average_price = $request->purchase_price;
            $product->sale_price = $request->sale_price;
            $product->vat = $request->vat;
            $product->discount = $request->discount;
            $product->low_quantity = $request->low_quantity ?: 0;
            $product->photo = $request->photo;
            $product->path = $request->path;
            $product->description = $request->description;
            $product->status = $request->status;
            $product->created_user_id =2;
            $product->updated_user_id = 2;
            $product->save();

        }
        }
    }
}

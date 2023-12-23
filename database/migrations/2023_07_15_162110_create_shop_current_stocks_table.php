<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shop_current_stocks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('admin_id')->unsigned()->nullable();
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('shop_id')->unsigned()->nullable();
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            $table->string('product_name')->nullable();
            $table->string('sku')->nullable();
            $table->string('hs_code',20)->nullable();
            $table->float('last_purchase_price',16,2)->default(0);
            $table->float('last_sale_price',16,2)->default(0);
            $table->float('last_purchase_discount',16,2)->default(0);
            $table->float('last_purchase_vat',10,2)->default(0);
            $table->float('stock_qty',16,2)->default(0);
            $table->float('old_discount',10,2)->default(0);
            $table->float('discount',10,2)->default(0);
            $table->date('expire_date')->nullable();
            $table->unique(['shop_id','product_id']);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_current_stocks');
    }
};

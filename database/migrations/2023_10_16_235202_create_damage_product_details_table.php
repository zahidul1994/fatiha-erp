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
        Schema::create('damage_product_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('damage_product_id')->unsigned()->nullable();
            $table->foreign('damage_product_id')->references('id')->on('damage_products')->onDelete('cascade');
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('product_id');
            $table->string('product_name');
            $table->date('product_expire_date')->nullable();
            $table->float('qty', 16, 2);
            $table->float('purchase_price', 16, 2)->default(0);
            $table->float('vat_percent', 16, 2)->default(0);
            $table->float('vat_amount', 16, 2)->default(0);
            $table->float('total_price', 16, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('damage_product_details');
    }
};

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
        Schema::create('sale_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sale_id')->unsigned()->nullable();
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('product_id');
            $table->string('product_name');
            $table->float('qty',16,2);
            $table->float('already_return_qty',16,2)->default(0);
            $table->float('average_purchase_price',16,2)->default(0);
            $table->float('sale_price',16,2)->default(0);
            $table->float('loss_profit_amount',16,2)->default(0);
            $table->float('vat_percent',16,2)->default(0);
            $table->float('vat_amount',16,2)->default(0);
            $table->float('discount_percent',16,2)->default(0);
            $table->float('discount_amount',16,2)->default(0);
            $table->float('total_price',16,2)->default(0);
            $table->date('product_expire_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_details');
    }
};

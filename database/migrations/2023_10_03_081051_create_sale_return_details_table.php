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
        Schema::create('sale_return_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sale_return_id')->unsigned()->nullable();
            $table->foreign('sale_return_id')->references('id')->on('sale_returns')->onDelete('cascade');
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('product_id');
            $table->string('product_name');
            $table->float('return_qty',16,2)->default(0);
            $table->float('sale_price',16,2)->default(0);
            $table->float('average_purchase_price',16,2)->default(0);
            $table->float('return_loss_profit_amount',16,2)->default(0);
            $table->float('vat_percent',16,2)->default(0);
            $table->float('vat_amount',16,2)->default(0);
            $table->float('discount_percent',16,2)->default(0);
            $table->float('discount_amount',16,2)->default(0);
            $table->float('total_price',16,2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_return_details');
    }
};

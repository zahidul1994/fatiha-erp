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
        Schema::create('stock_adjustment_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('stock_adjustment_id')->unsigned()->nullable();
            $table->foreign('stock_adjustment_id')->references('id')->on('stock_adjustments')->onDelete('cascade');
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('product_id');
            $table->string('product_name');
            $table->float('previous_qty',16,2);
            $table->float('current_qty',16,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_adjustment_details');
    }
};

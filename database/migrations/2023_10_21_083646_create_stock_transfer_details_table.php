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
        Schema::create('stock_transfer_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('stock_transfer_id')->unsigned()->nullable();
            $table->foreign('stock_transfer_id')->references('id')->on('stock_transfers')->onDelete('cascade');
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('current_stock_id');
            $table->string('product_name');
            $table->float('current_qty',16,2);
            $table->float('transfer_qty',16,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_transfer_details');
    }
};

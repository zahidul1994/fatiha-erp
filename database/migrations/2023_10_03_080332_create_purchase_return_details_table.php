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
        Schema::create('purchase_return_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('purchase_return_id')->unsigned()->nullable();
            $table->foreign('purchase_return_id')->references('id')->on('purchase_returns')->onDelete('cascade');
            $table->unsignedBigInteger('admin_id');
             $table->unsignedBigInteger('product_id');
             $table->string('product_name');
            $table->float('return_qty',16,2)->default(0);
            $table->float('purchase_price',16,2)->default(0);
             $table->float('vat_percent',16,2)->default(0);
            $table->float('vat_amount',16,2)->default(0);
            $table->float('total_price',16,2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_return_details');
    }
};

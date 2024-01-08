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
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('purchase_id')->unsigned()->nullable();
            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
             $table->unsignedBigInteger('admin_id');
             $table->unsignedBigInteger('product_id');
             $table->string('product_name');
           $table->string('hs_code',50)->nullable();
            $table->string('unit',30)->default('PCS');
            $table->string('weight_size')->nullable();
            $table->string('sku')->nullable();
            $table->float('unit_price',16,2)->default(0);
            $table->float('govt_price',16,2)->default(0);
            $table->float('insurance_before',16,2)->default(0);
            $table->float('insurance_before_value',16,2)->default(0);
            $table->float('clearing_before',16,2)->default(0);
            $table->float('clearing_before_value',16,2)->default(0);
            $table->float('convert_rate',16,2)->default(0);
            $table->float('duty_assessment_value',16,2)->default(0);
            $table->float('cd',16,2)->default(0);
            $table->float('cd_value',16,2)->default(0);
            $table->float('rd',16,2)->default(0);
            $table->float('rd_value',16,2)->default(0);
            $table->float('cd_rd_total',16,2)->default(0);
            $table->float('sd',16,2)->default(0);
            $table->float('sd_value',16,2)->default(0);
            $table->float('vat',16,2)->default(0);
            $table->float('vat_value',16,2)->default(0);
            $table->float('ait',16,2)->default(0);
            $table->float('ait_value',16,2)->default(0);
            $table->float('at',16,2)->default(0);
            $table->float('at_value',16,2)->default(0);
            $table->float('atv',16,2)->default(0);
            $table->float('atv_value',16,2)->default(0);
            $table->float('total_duty',16,2)->default(0);
            $table->float('insurance_after',16,2)->default(0);
            $table->float('insurance_after_value',16,2)->default(0);
            $table->float('bank_charge',16,2)->default(0);
            $table->float('bank_charge_value',16,2)->default(0);
            $table->float('clearing_after',16,2)->default(0);
            $table->float('clearing_after_value',16,2)->default(0);
            $table->float('carrying_charge',16,2)->default(0);
            $table->float('carrying_value',16,2)->default(0);
            $table->float('lc_value',16,2)->default(0);
            $table->float('other_cost',16,2)->default(0);
            $table->float('qty',16,2);
            $table->float('already_return_qty',16,2)->default(0);
            $table->float('purchase_price',16,2)->default(0);
            $table->float('product_total_price',16,2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_details');
    }
};

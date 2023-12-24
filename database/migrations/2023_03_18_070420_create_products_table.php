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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('admin_id')->unsigned()->nullable();
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('product_name')->nullable();
            $table->string('hs_code',50)->nullable();
            $table->enum('unit',['PCS','CARTON','KG','GM','PACKET','ML','DZN','BOX','BAG','PACKAGE','TRAY','EACH','CTN','ROFTA','TIN'])->default('PCS');
            $table->string('rack_number')->nullable();
            $table->string('weight_size')->nullable();
            $table->string('made_in')->default('Bangladesh');
            $table->string('product_full_name')->nullable();
            $table->string('slug')->nullable();
            $table->string('sku')->nullable();
            $table->float('unit_price',16,2)->default(0);
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
            $table->float('purchase_price',16,2)->default(0);
            $table->float('average_price',16,2)->default(0);
            $table->float('sale_price',16,2)->default(0);
            $table->float('discount',10,2)->default(0);
            $table->float('old_discount',10,2)->default(0);
            $table->string('path')->nullable();
            $table->string('photo')->nullable();
            $table->date('expire_date')->nullable();
            $table->unsignedBigInteger('created_user_id')->default(1);
            $table->unsignedBigInteger('updated_user_id')->default(1);
            $table->integer('low_quantity')->default(0);
            $table->mediumText('description')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->unique(['product_full_name', 'brand_id']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

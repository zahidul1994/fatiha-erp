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
        Schema::create('setups', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('admin_id')->unsigned()->nullable();
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('owner_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_logo')->nullable();
            $table->unsignedBigInteger('default_shop_id')->nullable();
            $table->unsignedBigInteger('default_brand_id')->nullable();
            $table->string('default_unit',50)->nullable();
            $table->float('default_vat',10,0)->default(0);
            $table->float('default_discount',10,0)->default(0);
            $table->unsignedBigInteger('default_supplier_id')->nullable();
            $table->unsignedBigInteger('default_customer_id')->nullable();
            $table->string('sms_user')->default('biz1994');
            $table->string('sms_password')->default('22932044');
            $table->string('api_key')->default('noapi');
            $table->string('api_secret')->default('nokey');
            $table->string('sender_id')->default('noid');
            $table->float('sms_rate',8,2)->default('0.25');
            $table->enum('sms_type',['Masking','Non-Masking'])->default('Non-Masking');
            $table->tinyInteger('sms_status')->default(0);
            $table->string('sms_text',300)->default('Dear #CUSTOMER# Your Total Amount Is BDT #AMOUNT# TK. Thank For Shopping With Us. #COMPANYNAME#');
            $table->string('currency_name',20)->default('BDT');
            $table->string('currency_icon',16,2)->default('৳');
            $table->string('bin_number',50)->nullable();
            $table->string('vat_number',30)->nullable();
            $table->string('printing_logo',300)->nullable();
            $table->string('print_first_note')->default('You cannot exchange any product');
            $table->string('print_second_note')->default('Thank For Shopping');
            $table->string('office_phone',50)->nullable();
            $table->string('office_email')->nullable();
            $table->string('company_address',300)->nullable();
            $table->string('facebook',300)->nullable();
            $table->string('youtube',300)->nullable();
            $table->string('twitter',300)->nullable();
            $table->string('instagram',300)->nullable();
            $table->string('web_address',400)->nullable();
            $table->mediumText('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setups');
    }
};

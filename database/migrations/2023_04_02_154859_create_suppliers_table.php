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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('admin_id')->unsigned()->nullable();
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('supplier_name');
            $table->string('supplier_phone')->nullable();
            $table->string('supplier_email')->nullable();
            $table->string('supplier_country')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('bank_currency')->default('USD');
            $table->string('bank_name')->nullable();
            $table->string('bank_address',500)->nullable();
            $table->string('supplier_address',500)->nullable();
            $table->float('total_due',30,2)->default(0);
            $table->float('total_paid',30,2)->default(0);
            $table->float('total_balance',30,2)->default(0);
            $table->unsignedBigInteger('created_user_id');
            $table->unsignedBigInteger('updated_user_id');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};

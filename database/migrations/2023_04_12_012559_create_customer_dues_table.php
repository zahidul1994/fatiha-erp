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
        Schema::create('customer_dues', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('admin_id')->unsigned()->nullable();
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->string('invoice_no');
            $table->unsignedBigInteger('sale_id')->nullable();
            $table->unsignedBigInteger('sale_return_id')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('transaction_number')->nullable();
            $table->float('paid',16,2)->default(0);
            $table->float('due',16,2)->default(0);
            $table->string('note',350)->nullable();
            $table->unsignedBigInteger('created_user_id');
            $table->unsignedBigInteger('updated_user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_dues');
    }
};

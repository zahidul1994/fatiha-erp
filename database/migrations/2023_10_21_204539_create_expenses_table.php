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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('admin_id')->unsigned()->nullable();
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('expense_head_id')->unsigned()->nullable();
            $table->foreign('expense_head_id')->references('id')->on('expense_heads')->onDelete('cascade');
            $table->string('date');
            $table->unsignedBigInteger('shop_id')->nullable();
            $table->float('expense_amount',16,2)->default(0);
            $table->string('payment_method');
            $table->mediumText('notes')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('transaction_number')->nullable();
            $table->string('path')->nullable();
            $table->string('attachment')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->bigInteger('created_user_id');
            $table->bigInteger('updated_user_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};

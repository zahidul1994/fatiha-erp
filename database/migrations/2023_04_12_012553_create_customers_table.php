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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('admin_id')->unsigned()->nullable();
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('customer_name');
            $table->string('card_number');
            $table->string('customer_phone')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('address',500)->nullable();
            $table->float('discount',16,2)->default(0);
            $table->float('total_due',30,2)->default(0);
            $table->float('total_paid',30,2)->default(0);
            $table->float('total_balance',30,2)->default(0);
            $table->date('birth_date')->nullable();
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
        Schema::dropIfExists('customers');
    }
};

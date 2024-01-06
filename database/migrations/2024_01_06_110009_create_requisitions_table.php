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
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('admin_id')->unsigned()->nullable();
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('invoice_no');
            $table->string('date');
            $table->unsignedBigInteger('work_order_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();           
            $table->float('total_quantity',16,2)->default(0);
            $table->bigInteger('created_user_id');
            $table->bigInteger('updated_user_id');
            $table->mediumText('description')->nullable();
            $table->enum('status',['Pending','Accept','Reject'])->default('Pending');
            $table->enum('purchase_status',['Yes','No'])->default('No');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisitions');
    }
};

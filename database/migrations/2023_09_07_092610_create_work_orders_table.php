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
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('admin_id')->unsigned()->nullable();
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('invoice_no');
            $table->string('date');
            $table->unsignedBigInteger('broker_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('bin_no')->nullable();
            $table->string('currency_name')->nullable();
            $table->string('port_name')->nullable();
            $table->float('total_vat',16,2)->default(0);
            $table->float('sub_total',16,2)->default(0);
            $table->float('paid',16,2)->default(0);
            $table->float('pay_amount',16,2)->default(0);
            $table->float('due',16,2)->default(0);
            $table->float('broker_bonus',16,2)->default(0);
            $table->float('convert_rate',10,2)->default(0);
            $table->float('total_quantity',16,2)->default(0);
            $table->float('grand_total',16,2)->default(0);
            $table->bigInteger('created_user_id');
            $table->bigInteger('updated_user_id');
            $table->mediumText('description')->nullable();
            $table->enum('status',['Quotation','WorkOrder','Reject'])->default('Quotation');
            $table->enum('requisition_status',['Yes','No'])->default('No');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_orders');
    }
};

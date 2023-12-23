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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('admin_id')->unsigned()->nullable();
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('invoice_no');
            $table->string('reference')->nullable();
            $table->unsignedBigInteger('shop_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('date');
            $table->float('total_vat',16,2)->default(0);
			$table->float('discount',16,2)->default(0);
			$table->float('other_discount',16,2)->default(0);
            $table->float('total_discount',16,2)->default(0);
            $table->float('sub_total',16,2)->default(0);
            $table->string('payment_method')->default('Cash');
            $table->float('paid',16,2)->default(0);
            $table->float('pay_amount',16,2)->default(0);
            $table->float('change_amount',16,2)->default(0);
            $table->float('due',16,2)->default(0);
            $table->float('extra_discount_percent',16,2)->default(0);
            $table->float('total_loss_profit_amount',16,2)->default(0);
            $table->float('total_quantity',16,2)->default(0);
            $table->float('grand_total',16,2)->default(0);
            $table->bigInteger('created_user_id');
            $table->bigInteger('updated_user_id');
            $table->mediumText('description')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};

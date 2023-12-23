<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
             $table->enum('user_type',['Superadmin','Admin','Employee','Staff'])->default('Admin');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('email')->unique();
            $table->string('invoice_slug')->nullable();
            $table->string('phone')->unique();
            $table->unsignedBigInteger('shop_id')->nullable();
            $table->unsignedBigInteger('package_id')->nullable();
            $table->string('refer_id',30)->nullable();
            $table->string('password');
            $table->string('image')->default('not-found.webp');
            $table->date('account_expire_date')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->bigInteger('created_user_id')->default(1);
            $table->bigInteger('updated_user_id')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->ipAddress('ip_address')->default('101.2.160.0');
            $table->tinyInteger('admin_employee_status')->default(1);
            $table->tinyInteger('lock')->default(0);
            $table->integer('otp')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};

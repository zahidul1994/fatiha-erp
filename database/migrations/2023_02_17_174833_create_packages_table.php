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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('superadmin_id')->unsigned()->nullable();
            $table->foreign('superadmin_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('package_name')->nullable();
            $table->string('slug')->nullable();
            $table->float('price',16,2)->nullable();
            $table->integer('employee_manage')->default(1);
            $table->integer('shop')->default(1);
            $table->integer('duration')->default(30);
            $table->json('features')->nullable();
            $table->mediumText('description')->nullable();
            $table->unsignedBigInteger('created_user_id')->default(1);
            $table->unsignedBigInteger('updated_user_id')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};

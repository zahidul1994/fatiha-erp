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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('position')->nullable();
            $table->enum('gender',['Male','Female','Other'])->default('Male');
            $table->string('refer_code')->nullable();
            $table->integer('rating')->nullable();
            $table->string('comment',1000)->nullable();
            $table->date('package_start_date')->default(date('Y-m-d'));
            $table->date('package_end_date')->nullable();
            $table->string('country')->default('Bangladesh');
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
        Schema::dropIfExists('profiles');
    }
};

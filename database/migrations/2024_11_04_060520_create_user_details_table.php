<?php
// database/migrations/xxxx_xx_xx_create_user_details_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key to admins or advisors table
            $table->string('profile_picture')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->unique()->nullable();
            $table->date('dob')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('admins')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('user_details');
    }
}

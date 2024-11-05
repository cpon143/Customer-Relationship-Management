<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('name', 100); // Name with a maximum length of 100 characters
            $table->string('email', 100); // Email with a maximum length of 100 characters
            $table->string('phone', 20); // Phone with a maximum length of 20 characters
            $table->enum('status', ['new', 'contacted', 'completed'])->default('new'); // Status with predefined values
            $table->decimal('revenue', 10, 2)->default(0.00); // Revenue with precision 10 and scale 2
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leads');
    }
}

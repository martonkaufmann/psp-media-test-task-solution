<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('email')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->unsignedTinyInteger('bonus');
            $table->enum('gender', ['male', 'female']);
            $table->string('country', 2);
            $table->foreign('country')->references('code')->on('countries');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
}

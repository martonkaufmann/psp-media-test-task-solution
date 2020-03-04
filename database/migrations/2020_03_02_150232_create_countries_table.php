<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->string('code', 2);
            $table->primary('code');
            $table->string('name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
}

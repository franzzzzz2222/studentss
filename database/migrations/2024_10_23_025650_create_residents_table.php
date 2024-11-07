<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidentsTable extends Migration
{
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('photo');
            $table->string('full_name');
            $table->string('gender');
            $table->string('purok');
            $table->string('street');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('residents');
    }
}

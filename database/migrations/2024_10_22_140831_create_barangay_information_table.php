<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangayInformationTable extends Migration
{
    public function up()
    {
        Schema::create('barangay_information', function (Blueprint $table) {
            $table->id();
            $table->string('barangay_name');
            $table->string('municipality');
            $table->string('province');
            $table->string('phone_number');
            $table->string('email')->unique();
            $table->string('logo')->nullable();  // For the logo upload
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('barangay_information');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('officials', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('position');
        $table->string('image')->nullable(); // Store the image path
        $table->integer('age');
        $table->string('status')->default('inactive'); // Example: active, inactive
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('officials');
    }
};

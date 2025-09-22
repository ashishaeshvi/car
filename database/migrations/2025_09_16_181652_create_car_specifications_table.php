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
       Schema::create('car_specifications', function (Blueprint $table) {
    $table->id();
    $table->foreignId('car_id')->constrained('cars')->onDelete('cascade');
    $table->enum('fuel_type', ['Petrol','Diesel','CNG','Electric'])->nullable()->index();
    $table->enum('transmission', ['Manual','Automatic'])->nullable()->index();
    $table->integer('engine_cc')->nullable()->index();
    $table->decimal('mileage', 5, 2)->nullable();
    $table->integer('seating_capacity')->nullable()->index();
    $table->string('color')->nullable()->index();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_specifications');
    }
};

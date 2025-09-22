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
        Schema::create('cars', function (Blueprint $table) {
    $table->id();
    $table->foreignId('dealer_id');
    $table->string('brand')->index();
    $table->string('model')->index();
    $table->string('variant')->nullable();
    $table->decimal('price', 12, 2)->nullable()->index();
    $table->year('manufacture_year')->nullable()->index();
    $table->enum('condition', ['New', 'Used'])->default('Used')->index();
    $table->string('image')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};

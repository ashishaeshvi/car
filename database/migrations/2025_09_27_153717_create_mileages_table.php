<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mileages', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // e.g. "City Mileage", "Highway Mileage"
            $table->decimal('value', 8, 2)->nullable(); // e.g. 15.50 (km/l or km/kWh)
            $table->string('unit')->default('kmpl'); // unit: kmpl, km/kg, km/kWh
            $table->enum('status', ['active', 'inactive', 'pending'])->default('active');
            $table->unsignedBigInteger('user_id'); // who added it
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mileages');
    }
};

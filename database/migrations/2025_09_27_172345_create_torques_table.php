<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('torques', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. "200 Nm", "350 Nm"
            $table->integer('value')->nullable(); // numeric value e.g. 200
            $table->string('unit')->default('Nm'); // default Newton meters
            $table->enum('status', ['active', 'inactive', 'pending'])->default('active');
            $table->unsignedBigInteger('user_id'); // who created/added it
            $table->timestamps();
            $table->softDeletes();

            // foreign key reference
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('torques');
    }
};

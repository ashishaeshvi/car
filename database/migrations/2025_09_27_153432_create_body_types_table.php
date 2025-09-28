<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('body_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g. SUV, Sedan, Hatchback
            $table->string('image')->nullable(); // store image path or filename
            $table->enum('status', ['active', 'inactive', 'pending'])->default('active');
            $table->unsignedBigInteger('user_id'); // reference to users table
            $table->timestamps();
            $table->softDeletes();

            // If you want a foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('body_types');
    }
};

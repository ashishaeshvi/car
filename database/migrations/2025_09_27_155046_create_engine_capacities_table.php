<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('engine_capacities', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. "1000cc", "1500cc"
            $table->integer('capacity')->nullable(); // numeric value, e.g. 1500
            $table->enum('status', ['active', 'inactive', 'pending'])->default('active');
            $table->unsignedBigInteger('user_id'); // who created/added it
            $table->timestamps();
            $table->softDeletes();

            // foreign key reference to users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('engine_capacities');
    }
};

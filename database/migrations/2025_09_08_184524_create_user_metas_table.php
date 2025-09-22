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
    Schema::create('user_metas', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // link to users table
        $table->string('meta_key');            // e.g., 'dealer_info'
        $table->json('meta_value');            // stores all dealer data in JSON
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->index(['user_id', 'meta_key']); // for faster lookups
    });
}

public function down(): void
{
    Schema::dropIfExists('user_metas');
}
};

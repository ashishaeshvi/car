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
        Schema::create('fe_documents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['sign','stamp'])->comment('sign,stamp');
            $table->text('attachment')->nullable();
            $table->enum('status', ['active', 'inactive', 'pending'])->default('active');
            $table->foreignId('user_id')->constrained();
            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fe_documents');
    }
};

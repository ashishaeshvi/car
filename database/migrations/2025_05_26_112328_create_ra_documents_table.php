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
        Schema::create('ra_documents', function (Blueprint $table) {
            $table->id();
            $table->string('ra_name');
            $table->string('ra_name_hindi')->nullable();
            $table->string('registration_no')->nullable();
            $table->string('ra_sign')->nullable();
            $table->string('ra_stamp')->nullable();
            $table->mediumText('scan_notary')->nullable();
            $table->mediumText('affidavit_notary')->nullable();
            $table->string('letterpad_logo')->nullable();
            $table->string('letterpad_footer')->nullable();
            $table->string('agency_name')->nullable();
            $table->string('address')->nullable();
            $table->enum('status', ['active', 'inactive', 'pending'])->default('active');
            $table->foreignId('user_id');
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
        Schema::dropIfExists('ra_documents');
    }
};

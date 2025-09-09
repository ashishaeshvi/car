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
        Schema::create('user_passports', function (Blueprint $table) {
            $table->id();
            $table->string('passport_no', 14)->nullable()->index();
            $table->string('candidate_sign')->nullable();
            $table->foreignId('ra_document_id')->constrained();
            $table->unsignedBigInteger('fe_sign_id')->nullable();
            $table->foreign('fe_sign_id')->references('id')->on('fe_documents');
            $table->unsignedBigInteger('fe_stamp_id')->nullable();
            $table->foreign('fe_stamp_id')->references('id')->on('fe_documents');
            $table->string('sponsor_name')->nullable();;
            $table->string('sponsor_id')->nullable();;
            $table->string('fe_name', 100);
            $table->string('fe_no', 50);
            $table->unsignedSmallInteger('fe_age');
            $table->string('fe_phone_no', 15)->nullable();
            $table->unsignedInteger('pobox')->nullable();
            $table->unsignedInteger('pin_code')->nullable();
            $table->string('job')->nullable();
            $table->unsignedSmallInteger('vacancy');
            $table->decimal('salary', 10, 2)->nullable();
            $table->foreignId('all_country_id')->constrained();
            $table->enum('individual_or_company', ['individual', 'company'])->nullable();
            $table->foreignId('user_id')->constrained();
            $table->text('passport')->nullable()->comment('passport attachments');
            $table->text('visa')->nullable()->comment('visa attachments');
            $table->string('ref_no', 100)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
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
        Schema::dropIfExists('user_passports');
    }
};

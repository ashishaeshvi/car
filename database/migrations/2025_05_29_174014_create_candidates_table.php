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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_passport_id')->constrained()->cascadeOnDelete();
            $table->string('visa_no', 100)->nullable();
            $table->string('en_visa_no', 100)->nullable();
            $table->date('visa_issue_date');
            $table->date('visa_expiry_date');
            $table->string('job_on_visa', 100)->nullable();
            $table->string('visa_issue_place', 100)->nullable();

            $table->string('passport_no', 14)->nullable()->index();
            $table->string('first_name_eng', 50);
            $table->string('last_name_eng', 50)->nullable();
            $table->string('name_hindi', 100)->nullable();

            $table->date('dob')->nullable();
            $table->string('birth_place', 50)->nullable();

            $table->string('passport_issue_place', 50)->nullable();
            $table->date('passport_issue_date');
            $table->date('passport_expiry_date');
            $table->string('passport_issue_state', 50)->nullable();
            $table->string('current_city', 50)->nullable();
            $table->string('passport_address', 255)->nullable();
            $table->string('passport_pin_code', 10)->nullable();

            $table->string('father_name', 50);
            $table->enum('nominee_relation', ['Mother', 'Wife'])->default('Wife')->after('father_name');
            $table->string('nominee_name')->nullable()->after('nominee_relation');
            $table->string('candidate_mobile_no', 13);
            $table->string('alternate_no', 13);
            
            $table->string('pobox', 10)->nullable();
            $table->unsignedInteger('pin_code')->nullable();
            $table->string('emigrate_fe_id', 25)->nullable();

            $table->foreignId('user_id')->constrained();
            $table->enum('status', ['filled', 'completed'])->default('filled')->comment('filled, completed');
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
        Schema::dropIfExists('candidates');
    }
};

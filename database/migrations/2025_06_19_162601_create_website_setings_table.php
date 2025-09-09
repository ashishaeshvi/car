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
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            $table->string('web_mobile_number', 15)->nullable();
            $table->string('web_email_id', 100)->nullable();
            $table->string('company_name', 100)->nullable();
            $table->string('footer_description', 255)->nullable();
            $table->string('company_address', 255)->nullable();
            $table->string('website_logo', 255)->nullable();
            $table->string('copyright_text', 255)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_settings');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->boolean('mail_enabled')->default(false);
            $table->string('mail_smtp_host', 255)->nullable();
            $table->unsignedSmallInteger('mail_smtp_port')->nullable();
            $table->string('mail_smtp_username', 255)->nullable();
            $table->text('mail_smtp_password')->nullable();
            $table->string('mail_security', 20)->default('starttls');
            $table->string('mail_from_address', 255)->nullable();
            $table->string('mail_from_name', 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->dropColumn([
                'mail_enabled',
                'mail_smtp_host',
                'mail_smtp_port',
                'mail_smtp_username',
                'mail_smtp_password',
                'mail_security',
                'mail_from_address',
                'mail_from_name',
            ]);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->string('mail_received_subject', 255)->nullable();
            $table->text('mail_received_body')->nullable();
            $table->string('mail_confirmed_subject', 255)->nullable();
            $table->text('mail_confirmed_body')->nullable();
            $table->string('mail_cancelled_subject', 255)->nullable();
            $table->text('mail_cancelled_body')->nullable();
            $table->string('mail_test_subject', 255)->nullable();
            $table->text('mail_test_body')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->dropColumn([
                'mail_received_subject',
                'mail_received_body',
                'mail_confirmed_subject',
                'mail_confirmed_body',
                'mail_cancelled_subject',
                'mail_cancelled_body',
                'mail_test_subject',
                'mail_test_body',
            ]);
        });
    }
};

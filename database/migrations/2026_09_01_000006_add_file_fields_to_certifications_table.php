<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('certifications', function (Blueprint $table) {
            $table->string('file_path', 500)->nullable();
            $table->string('file_type', 120)->nullable();
            $table->string('file_name', 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('certifications', function (Blueprint $table) {
            $table->dropColumn(['file_path', 'file_type', 'file_name']);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->string('phone', 40)->nullable()->after('email');
            $table->string('service', 120)->nullable()->after('phone');
            $table->string('budget', 120)->nullable()->after('service');
            $table->text('detail')->nullable()->after('budget');
        });
    }

    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn(['phone', 'service', 'budget', 'detail']);
        });
    }
};

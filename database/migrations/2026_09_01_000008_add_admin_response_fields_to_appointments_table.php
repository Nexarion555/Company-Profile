<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->text('admin_note')->nullable()->after('notes');
            $table->timestamp('notification_sent_at')->nullable()->after('status');
            $table->string('notified_status', 20)->nullable()->after('notification_sent_at');
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn([
                'admin_note',
                'notification_sent_at',
                'notified_status',
            ]);
        });
    }
};

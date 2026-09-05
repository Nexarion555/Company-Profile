<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->string('username', 50)->nullable()->unique();
        });

        $admins = DB::table('admins')->select('id', 'email')->orderBy('id')->get();

        foreach ($admins as $admin) {
            $emailPrefix = strtolower((string) strtok((string) $admin->email, '@'));
            $base = preg_replace('/[^a-z0-9._-]/', '', $emailPrefix) ?: 'admin';
            $base = substr($base, 0, 40);
            $username = $base;
            $suffix = 1;

            while (DB::table('admins')->where('username', $username)->where('id', '!=', $admin->id)->exists()) {
                $username = substr($base, 0, 35) . '-' . $suffix;
                $suffix++;
            }

            DB::table('admins')->where('id', $admin->id)->update(['username' => $username]);
        }
    }

    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn('username');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->string('short_name', 50)->nullable();
            $table->string('business_type', 100)->nullable();
            $table->string('tagline', 180)->nullable();
            $table->string('marketing_email', 180)->nullable();
            $table->string('office_hours_weekday', 180)->nullable();
            $table->string('office_hours_saturday', 180)->nullable();
            $table->string('instagram_url', 1000)->nullable();
            $table->string('facebook_url', 1000)->nullable();
            $table->string('linkedin_url', 1000)->nullable();
            $table->string('youtube_url', 1000)->nullable();
            $table->string('map_url', 1000)->nullable();
            $table->string('logo_path', 1000)->nullable();
            $table->string('favicon_path', 1000)->nullable();
            $table->string('hero_image_path', 1000)->nullable();
            $table->string('hero_badge', 180)->nullable();
            $table->string('hero_title_primary', 180)->nullable();
            $table->string('hero_title_highlight', 180)->nullable();
            $table->string('hero_title_secondary', 180)->nullable();
            $table->text('hero_description')->nullable();
            $table->unsignedSmallInteger('founded_year')->nullable();
            $table->unsignedInteger('stat_projects')->nullable();
            $table->string('stat_projects_label', 100)->nullable();
            $table->unsignedInteger('stat_clients')->nullable();
            $table->string('stat_clients_label', 100)->nullable();
            $table->unsignedInteger('stat_experience')->nullable();
            $table->string('stat_experience_label', 100)->nullable();
            $table->unsignedInteger('stat_team')->nullable();
            $table->string('stat_team_label', 100)->nullable();
            $table->string('seo_title', 180)->nullable();
            $table->text('seo_description')->nullable();
            $table->text('seo_keywords')->nullable();
            $table->text('footer_description')->nullable();
            $table->string('copyright_text', 255)->nullable();
        });

        DB::table('company_settings')->whereNull('short_name')->update([
            'short_name' => 'KSN',
            'business_type' => 'Konstruksi',
            'tagline' => 'Membangun Masa Depan',
            'marketing_email' => 'marketing@ksn-konstruksi.co.id',
            'office_hours_weekday' => 'Senin - Jumat: 08.00 - 17.00 WIB',
            'office_hours_saturday' => 'Sabtu: 08.00 - 12.00 WIB',
            'map_url' => 'https://maps.google.com',
            'hero_badge' => 'Terpercaya Sejak 2008',
            'hero_title_primary' => 'Membangun',
            'hero_title_highlight' => 'Masa Depan',
            'hero_title_secondary' => 'Merancang Keindahan',
            'hero_description' => 'PT Karya Struktur Nusantara menghadirkan solusi konstruksi, arsitektur, dan desain interior terdepan yang menggabungkan estetika, fungsi, dan keberlanjutan.',
            'founded_year' => 2008,
            'stat_projects' => 350,
            'stat_projects_label' => 'Proyek Selesai',
            'stat_clients' => 180,
            'stat_clients_label' => 'Klien Puas',
            'stat_experience' => 16,
            'stat_experience_label' => 'Tahun Pengalaman',
            'stat_team' => 45,
            'stat_team_label' => 'Tim Profesional',
            'seo_title' => 'PT Karya Struktur Nusantara — Membangun Masa Depan',
            'seo_description' => 'PT Karya Struktur Nusantara menghadirkan solusi konstruksi, arsitektur, dan desain interior profesional.',
            'seo_keywords' => 'konstruksi, arsitektur, desain interior, kontraktor, renovasi',
            'footer_description' => 'Membangun masa depan dengan inovasi, kualitas, dan keberlanjutan. Mitra terpercaya Anda dalam konstruksi dan desain sejak 2008.',
            'copyright_text' => 'Seluruh hak cipta dilindungi.',
        ]);
    }

    public function down(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->dropColumn([
                'short_name',
                'business_type',
                'tagline',
                'marketing_email',
                'office_hours_weekday',
                'office_hours_saturday',
                'instagram_url',
                'facebook_url',
                'linkedin_url',
                'youtube_url',
                'map_url',
                'logo_path',
                'favicon_path',
                'hero_image_path',
                'hero_badge',
                'hero_title_primary',
                'hero_title_highlight',
                'hero_title_secondary',
                'hero_description',
                'founded_year',
                'stat_projects',
                'stat_projects_label',
                'stat_clients',
                'stat_clients_label',
                'stat_experience',
                'stat_experience_label',
                'stat_team',
                'stat_team_label',
                'seo_title',
                'seo_description',
                'seo_keywords',
                'footer_description',
                'copyright_text',
            ]);
        });
    }
};

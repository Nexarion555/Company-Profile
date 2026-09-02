<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->string('about_hero_image_path', 1000)->nullable();
            $table->string('about_hero_eyebrow', 120)->nullable();
            $table->string('about_hero_title_primary', 180)->nullable();
            $table->string('about_hero_title_highlight', 180)->nullable();
            $table->text('about_hero_description')->nullable();

            $table->string('about_story_image_path', 1000)->nullable();
            $table->string('about_story_eyebrow', 120)->nullable();
            $table->string('about_story_title_primary', 180)->nullable();
            $table->string('about_story_title_highlight', 180)->nullable();
            $table->text('about_story_paragraph_1')->nullable();
            $table->text('about_story_paragraph_2')->nullable();
            $table->string('about_feature_1_title', 120)->nullable();
            $table->text('about_feature_1_description')->nullable();
            $table->string('about_feature_2_title', 120)->nullable();
            $table->text('about_feature_2_description')->nullable();

            $table->string('about_vision_title', 120)->nullable();
            $table->text('about_vision')->nullable();
            $table->string('about_mission_title', 120)->nullable();
            $table->json('about_mission_items')->nullable();

            $table->string('about_values_eyebrow', 120)->nullable();
            $table->string('about_values_title_primary', 180)->nullable();
            $table->string('about_values_title_highlight', 180)->nullable();
            $table->json('about_values')->nullable();

            $table->string('organization_chart_path', 1000)->nullable();
            $table->string('organization_eyebrow', 120)->nullable();
            $table->string('organization_title_primary', 180)->nullable();
            $table->string('organization_title_highlight', 180)->nullable();
            $table->text('organization_description')->nullable();

            $table->string('about_team_eyebrow', 120)->nullable();
            $table->string('about_team_title_primary', 180)->nullable();
            $table->string('about_team_title_highlight', 180)->nullable();

            $table->string('about_cert_eyebrow', 120)->nullable();
            $table->string('about_cert_title_primary', 180)->nullable();
            $table->string('about_cert_title_highlight', 180)->nullable();
            $table->text('about_cert_description')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->dropColumn([
                'about_hero_image_path',
                'about_hero_eyebrow',
                'about_hero_title_primary',
                'about_hero_title_highlight',
                'about_hero_description',
                'about_story_image_path',
                'about_story_eyebrow',
                'about_story_title_primary',
                'about_story_title_highlight',
                'about_story_paragraph_1',
                'about_story_paragraph_2',
                'about_feature_1_title',
                'about_feature_1_description',
                'about_feature_2_title',
                'about_feature_2_description',
                'about_vision_title',
                'about_vision',
                'about_mission_title',
                'about_mission_items',
                'about_values_eyebrow',
                'about_values_title_primary',
                'about_values_title_highlight',
                'about_values',
                'organization_chart_path',
                'organization_eyebrow',
                'organization_title_primary',
                'organization_title_highlight',
                'organization_description',
                'about_team_eyebrow',
                'about_team_title_primary',
                'about_team_title_highlight',
                'about_cert_eyebrow',
                'about_cert_title_primary',
                'about_cert_title_highlight',
                'about_cert_description',
            ]);
        });
    }
};

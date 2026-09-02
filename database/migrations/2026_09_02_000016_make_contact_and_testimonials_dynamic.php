<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            // Halaman Hubungi Kami
            $table->string('contact_hero_image_path', 1000)->nullable();
            $table->string('contact_hero_eyebrow', 120)->nullable();
            $table->string('contact_hero_title_primary', 180)->nullable();
            $table->string('contact_hero_title_highlight', 180)->nullable();
            $table->text('contact_hero_description')->nullable();

            $table->string('contact_office_label', 120)->nullable();
            $table->string('contact_phone_label', 120)->nullable();
            $table->string('contact_email_label', 120)->nullable();
            $table->string('contact_hours_label', 120)->nullable();

            $table->string('contact_form_title', 180)->nullable();
            $table->text('contact_form_description')->nullable();
            $table->string('contact_form_name_label', 120)->nullable();
            $table->string('contact_form_name_placeholder', 180)->nullable();
            $table->string('contact_form_email_label', 120)->nullable();
            $table->string('contact_form_email_placeholder', 180)->nullable();
            $table->string('contact_form_phone_label', 120)->nullable();
            $table->string('contact_form_phone_placeholder', 180)->nullable();
            $table->string('contact_form_service_label', 120)->nullable();
            $table->string('contact_form_service_placeholder', 180)->nullable();
            $table->string('contact_form_other_service_label', 180)->nullable();
            $table->string('contact_form_budget_label', 120)->nullable();
            $table->string('contact_form_budget_placeholder', 180)->nullable();
            $table->json('contact_budget_options')->nullable();
            $table->string('contact_form_detail_label', 120)->nullable();
            $table->text('contact_form_detail_placeholder')->nullable();
            $table->string('contact_form_submit_label', 120)->nullable();
            $table->text('contact_form_success_message')->nullable();

            $table->string('contact_schedule_eyebrow', 120)->nullable();
            $table->string('contact_schedule_title_primary', 180)->nullable();
            $table->string('contact_schedule_title_highlight', 180)->nullable();
            $table->text('contact_schedule_description')->nullable();
            $table->string('contact_schedule_detail_title', 180)->nullable();
            $table->string('contact_schedule_type_label', 120)->nullable();
            $table->string('contact_schedule_type_placeholder', 180)->nullable();
            $table->json('contact_schedule_types')->nullable();
            $table->string('contact_schedule_name_label', 120)->nullable();
            $table->string('contact_schedule_name_placeholder', 180)->nullable();
            $table->string('contact_schedule_phone_label', 120)->nullable();
            $table->string('contact_schedule_phone_placeholder', 180)->nullable();
            $table->string('contact_schedule_email_label', 120)->nullable();
            $table->string('contact_schedule_email_placeholder', 180)->nullable();
            $table->string('contact_schedule_notes_label', 120)->nullable();
            $table->text('contact_schedule_notes_placeholder')->nullable();
            $table->string('contact_schedule_summary_title', 180)->nullable();
            $table->string('contact_schedule_date_label', 120)->nullable();
            $table->string('contact_schedule_time_label', 120)->nullable();
            $table->string('contact_schedule_location_label', 120)->nullable();
            $table->string('contact_schedule_submit_label', 180)->nullable();
            $table->text('contact_schedule_submit_note')->nullable();
            $table->string('contact_schedule_success_title', 180)->nullable();
            $table->text('contact_schedule_success_description')->nullable();
            $table->text('contact_schedule_reminder_text')->nullable();
            $table->string('contact_schedule_again_label', 180)->nullable();
            $table->string('contact_schedule_select_datetime_warning', 255)->nullable();
            $table->string('contact_schedule_time_picker_title', 180)->nullable();
            $table->string('contact_schedule_time_picker_hint', 255)->nullable();
            $table->string('contact_schedule_morning_label', 120)->nullable();
            $table->string('contact_schedule_afternoon_label', 120)->nullable();

            // Maps ditampilkan sebagai iframe pada footer.
            $table->string('map_embed_url', 2000)->nullable();
            $table->string('footer_map_title', 180)->nullable();
            $table->string('footer_map_open_label', 120)->nullable();

            // Pengaturan section Testimoni di landing page.
            $table->string('testimonial_eyebrow', 120)->nullable();
            $table->string('testimonial_title_primary', 180)->nullable();
            $table->string('testimonial_title_highlight', 180)->nullable();
            $table->text('testimonial_description')->nullable();
            $table->string('testimonial_empty_text', 255)->nullable();
            $table->string('testimonial_form_title', 180)->nullable();
            $table->text('testimonial_form_description')->nullable();
            $table->string('testimonial_submit_label', 120)->nullable();
            $table->text('testimonial_success_message')->nullable();
            $table->text('testimonial_review_notice')->nullable();
            $table->string('testimonial_name_label', 120)->nullable();
            $table->string('testimonial_name_placeholder', 180)->nullable();
            $table->string('testimonial_email_label', 120)->nullable();
            $table->string('testimonial_email_placeholder', 180)->nullable();
            $table->string('testimonial_company_label', 120)->nullable();
            $table->string('testimonial_company_placeholder', 180)->nullable();
            $table->string('testimonial_position_label', 120)->nullable();
            $table->string('testimonial_position_placeholder', 180)->nullable();
            $table->string('testimonial_phone_label', 120)->nullable();
            $table->string('testimonial_phone_placeholder', 180)->nullable();
            $table->string('testimonial_service_label', 120)->nullable();
            $table->string('testimonial_service_placeholder', 180)->nullable();
            $table->string('testimonial_rating_label', 120)->nullable();
            $table->string('testimonial_rating_5_label', 180)->nullable();
            $table->string('testimonial_rating_4_label', 180)->nullable();
            $table->string('testimonial_rating_3_label', 180)->nullable();
            $table->string('testimonial_rating_2_label', 180)->nullable();
            $table->string('testimonial_rating_1_label', 180)->nullable();
            $table->string('testimonial_content_label', 120)->nullable();
            $table->text('testimonial_content_placeholder')->nullable();
        });

        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name', 160);
            $table->string('email', 180);
            $table->string('phone', 60)->nullable();
            $table->string('company', 180)->nullable();
            $table->string('position', 180)->nullable();
            $table->foreignId('service_id')->nullable()->constrained('services')->nullOnDelete();
            $table->unsignedTinyInteger('rating')->default(5);
            $table->text('testimonial');
            $table->string('status', 20)->default('pending')->index();
            $table->unsignedInteger('display_order')->default(0)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');

        Schema::table('company_settings', function (Blueprint $table) {
            $table->dropColumn([
                'contact_hero_image_path',
                'contact_hero_eyebrow',
                'contact_hero_title_primary',
                'contact_hero_title_highlight',
                'contact_hero_description',
                'contact_office_label',
                'contact_phone_label',
                'contact_email_label',
                'contact_hours_label',
                'contact_form_title',
                'contact_form_description',
                'contact_form_name_label',
                'contact_form_name_placeholder',
                'contact_form_email_label',
                'contact_form_email_placeholder',
                'contact_form_phone_label',
                'contact_form_phone_placeholder',
                'contact_form_service_label',
                'contact_form_service_placeholder',
                'contact_form_other_service_label',
                'contact_form_budget_label',
                'contact_form_budget_placeholder',
                'contact_budget_options',
                'contact_form_detail_label',
                'contact_form_detail_placeholder',
                'contact_form_submit_label',
                'contact_form_success_message',
                'contact_schedule_eyebrow',
                'contact_schedule_title_primary',
                'contact_schedule_title_highlight',
                'contact_schedule_description',
                'contact_schedule_detail_title',
                'contact_schedule_type_label',
                'contact_schedule_type_placeholder',
                'contact_schedule_types',
                'contact_schedule_name_label',
                'contact_schedule_name_placeholder',
                'contact_schedule_phone_label',
                'contact_schedule_phone_placeholder',
                'contact_schedule_email_label',
                'contact_schedule_email_placeholder',
                'contact_schedule_notes_label',
                'contact_schedule_notes_placeholder',
                'contact_schedule_summary_title',
                'contact_schedule_date_label',
                'contact_schedule_time_label',
                'contact_schedule_location_label',
                'contact_schedule_submit_label',
                'contact_schedule_submit_note',
                'contact_schedule_success_title',
                'contact_schedule_success_description',
                'contact_schedule_reminder_text',
                'contact_schedule_again_label',
                'contact_schedule_select_datetime_warning',
                'contact_schedule_time_picker_title',
                'contact_schedule_time_picker_hint',
                'contact_schedule_morning_label',
                'contact_schedule_afternoon_label',
                'map_embed_url',
                'footer_map_title',
                'footer_map_open_label',
                'testimonial_eyebrow',
                'testimonial_title_primary',
                'testimonial_title_highlight',
                'testimonial_description',
                'testimonial_empty_text',
                'testimonial_form_title',
                'testimonial_form_description',
                'testimonial_submit_label',
                'testimonial_success_message',
                'testimonial_review_notice',
                'testimonial_name_label',
                'testimonial_name_placeholder',
                'testimonial_email_label',
                'testimonial_email_placeholder',
                'testimonial_company_label',
                'testimonial_company_placeholder',
                'testimonial_position_label',
                'testimonial_position_placeholder',
                'testimonial_phone_label',
                'testimonial_phone_placeholder',
                'testimonial_service_label',
                'testimonial_service_placeholder',
                'testimonial_rating_label',
                'testimonial_rating_5_label',
                'testimonial_rating_4_label',
                'testimonial_rating_3_label',
                'testimonial_rating_2_label',
                'testimonial_rating_1_label',
                'testimonial_content_label',
                'testimonial_content_placeholder',
            ]);
        });
    }
};

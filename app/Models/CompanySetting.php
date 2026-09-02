<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\EmailTemplateService;
use Illuminate\Support\Facades\Storage;

class CompanySetting extends Model
{
    protected $table = 'company_settings';

    protected $fillable = [
        'company',
        'short_name',
        'business_type',
        'tagline',
        'address',
        'phone',
        'email',
        'marketing_email',
        'whatsapp',
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
        'service_hero_image_path',
        'service_hero_eyebrow',
        'service_hero_title_primary',
        'service_hero_title_highlight',
        'service_hero_description',
        'service_process_eyebrow',
        'service_process_title_primary',
        'service_process_title_highlight',
        'service_process_steps',
        'portfolio_hero_image_path',
        'portfolio_hero_eyebrow',
        'portfolio_hero_title_primary',
        'portfolio_hero_title_highlight',
        'portfolio_hero_description',
        'portfolio_all_label',
        'portfolio_empty_title',
        'portfolio_empty_description',
        'portfolio_modal_cta_label',
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
        'mail_enabled',
        'mail_smtp_host',
        'mail_smtp_port',
        'mail_smtp_username',
        'mail_smtp_password',
        'mail_security',
        'mail_from_address',
        'mail_from_name',
        'mail_received_subject',
        'mail_received_body',
        'mail_confirmed_subject',
        'mail_confirmed_body',
        'mail_cancelled_subject',
        'mail_cancelled_body',
        'mail_test_subject',
        'mail_test_body',
    ];

    protected $casts = [
        'founded_year' => 'integer',
        'stat_projects' => 'integer',
        'stat_clients' => 'integer',
        'stat_experience' => 'integer',
        'stat_team' => 'integer',
        'about_mission_items' => 'array',
        'about_values' => 'array',
        'service_process_steps' => 'array',
        'contact_budget_options' => 'array',
        'contact_schedule_types' => 'array',
        'mail_enabled' => 'boolean',
        'mail_smtp_port' => 'integer',
        'mail_smtp_password' => 'encrypted',
    ];

    public static function defaults(): array
    {
        return [
            'company' => 'PT Karya Struktur Nusantara',
            'short_name' => 'KSN',
            'business_type' => 'Konstruksi',
            'tagline' => 'Membangun Masa Depan',
            'address' => 'Jl. Sudirman Kav. 52-53, Lantai 15, Jakarta Selatan 12190',
            'phone' => '(021) 1234-567',
            'email' => 'info@ksn-konstruksi.co.id',
            'marketing_email' => 'marketing@ksn-konstruksi.co.id',
            'whatsapp' => '+62 812-3456-7890',
            'office_hours_weekday' => 'Senin - Jumat: 08.00 - 17.00 WIB',
            'office_hours_saturday' => 'Sabtu: 08.00 - 12.00 WIB',
            'instagram_url' => null,
            'facebook_url' => null,
            'linkedin_url' => null,
            'youtube_url' => null,
            'map_url' => 'https://maps.google.com',
            'logo_path' => null,
            'favicon_path' => null,
            'hero_image_path' => null,
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

            // Halaman Tentang - seluruh teks dan media dapat diubah dari Admin Panel.
            'about_hero_image_path' => null,
            'about_hero_eyebrow' => 'Tentang Kami',
            'about_hero_title_primary' => 'Membangun Kepercayaan,',
            'about_hero_title_highlight' => 'Mewujudkan Visi',
            'about_hero_description' => 'Mengenal lebih dekat PT. Adiguna Karya Abadi — mitra terpercaya dalam pelaksanaan berbagai proyek konstruksi.',

            'about_story_image_path' => null,
            'about_story_eyebrow' => 'Tentang Perusahaan',
            'about_story_title_primary' => 'Profesional, Berkualitas,',
            'about_story_title_highlight' => 'dan Terpercaya',
            'about_story_paragraph_1' => 'PT. Adiguna Karya Abadi merupakan perusahaan yang bergerak di bidang konstruksi dan berkomitmen memberikan layanan profesional, berkualitas, serta sesuai standar keselamatan dan ketentuan yang berlaku.',
            'about_story_paragraph_2' => 'Dengan dukungan sumber daya manusia yang kompeten, perusahaan siap menjadi mitra terpercaya dalam pelaksanaan berbagai proyek konstruksi.',
            'about_feature_1_title' => 'Bidang Usaha',
            'about_feature_1_description' => 'Jasa konstruksi bangunan, pekerjaan sipil dan infrastruktur, serta renovasi dan pemeliharaan bangunan.',
            'about_feature_2_title' => 'Produk & Layanan',
            'about_feature_2_description' => 'Pembangunan gedung dan fasilitas umum, pekerjaan jalan dan drainase, renovasi, serta konsultasi teknis konstruksi.',

            'about_vision_title' => 'Visi',
            'about_vision' => 'Menjadi perusahaan konstruksi yang profesional, terpercaya, dan berdaya saing tinggi di tingkat nasional.',
            'about_mission_title' => 'Misi',
            'about_mission_items' => [
                'Memberikan hasil pekerjaan konstruksi yang berkualitas dan tepat waktu.',
                'Mengutamakan keselamatan kerja dan kepuasan pelanggan.',
                'Mengembangkan sumber daya manusia yang kompeten dan berintegritas.',
                'Menjalin kerja sama yang berkelanjutan dengan berbagai mitra usaha.',
            ],

            'about_values_eyebrow' => 'Nilai Perusahaan',
            'about_values_title_primary' => 'Prinsip yang',
            'about_values_title_highlight' => 'Kami Pegang',
            'about_values' => [
                ['icon' => '🏆', 'title' => 'Profesionalisme', 'description' => ''],
                ['icon' => '🛡️', 'title' => 'Integritas', 'description' => ''],
                ['icon' => '📐', 'title' => 'Kualitas', 'description' => ''],
                ['icon' => '✅', 'title' => 'Tanggung Jawab', 'description' => ''],
                ['icon' => '🤝', 'title' => 'Kerjasama', 'description' => ''],
            ],

            'organization_chart_path' => null,
            'organization_eyebrow' => 'Organisasi Perusahaan',
            'organization_title_primary' => 'Struktur Organisasi',
            'organization_title_highlight' => 'Perusahaan',
            'organization_description' => 'Struktur organisasi perusahaan yang menggambarkan susunan kepemimpinan dan pelaksana operasional.',

            'about_team_eyebrow' => 'Tim Kami',
            'about_team_title_primary' => 'Para Ahli di Balik',
            'about_team_title_highlight' => '{short_name}',

            'about_cert_eyebrow' => 'Standar & Legalitas',
            'about_cert_title_primary' => 'Sertifikasi',
            'about_cert_title_highlight' => 'Perusahaan',
            'about_cert_description' => 'Sertifikasi dan legalitas yang mendukung standar mutu, keselamatan, serta profesionalisme perusahaan.',

            // Halaman Layanan - hero, daftar layanan, dan proses kerja dikelola dari sub-pengaturan Layanan.
            'service_hero_image_path' => null,
            'service_hero_eyebrow' => 'Layanan',
            'service_hero_title_primary' => 'Layanan',
            'service_hero_title_highlight' => 'Komprehensif',
            'service_hero_description' => 'Solusi end-to-end untuk setiap kebutuhan konstruksi, arsitektur, dan desain Anda.',
            'service_process_eyebrow' => 'Proses Kerja',
            'service_process_title_primary' => 'Bagaimana Kami',
            'service_process_title_highlight' => 'Bekerja',
            'service_process_steps' => [
                ['title' => 'Konsultasi', 'description' => 'Diskusi kebutuhan, visi, anggaran, dan timeline proyek Anda.'],
                ['title' => 'Perencanaan', 'description' => 'Studi kelayakan, desain konseptual, dan penyusunan RAB.'],
                ['title' => 'Eksekusi', 'description' => 'Pelaksanaan proyek dengan pengawasan ketat dan laporan berkala.'],
                ['title' => 'Serah Terima', 'description' => 'Final inspection, dokumentasi, dan garansi pemeliharaan.'],
            ],

            // Halaman Portofolio - hero dan teks halaman dikelola dari sub-pengaturan Portofolio.
            'portfolio_hero_image_path' => null,
            'portfolio_hero_eyebrow' => 'Portofolio',
            'portfolio_hero_title_primary' => 'Karya',
            'portfolio_hero_title_highlight' => 'Terbaik Kami',
            'portfolio_hero_description' => 'Setiap proyek adalah bukti komitmen kami terhadap kualitas dan inovasi.',
            'portfolio_all_label' => 'Semua',
            'portfolio_empty_title' => 'Belum ada portofolio pada layanan ini.',
            'portfolio_empty_description' => 'Silakan pilih kategori layanan lain atau kembali lagi setelah portofolio terbaru ditambahkan.',
            'portfolio_modal_cta_label' => 'Konsultasi Proyek Serupa',

            // Halaman Hubungi Kami
            'contact_hero_image_path' => null,
            'contact_hero_eyebrow' => 'Kontak',
            'contact_hero_title_primary' => 'Mari',
            'contact_hero_title_highlight' => 'Berdiskusi',
            'contact_hero_description' => 'Hubungi kami untuk konsultasi mengenai kebutuhan proyek Anda.',

            'contact_office_label' => 'Kantor Pusat',
            'contact_phone_label' => 'Telepon',
            'contact_email_label' => 'Email',
            'contact_hours_label' => 'Jam Operasional',

            'contact_form_title' => 'Kirim Pesan',
            'contact_form_description' => 'Isi formulir di bawah dan tim kami akan menghubungi Anda sesegera mungkin.',
            'contact_form_name_label' => 'Nama Lengkap',
            'contact_form_name_placeholder' => 'Nama Anda',
            'contact_form_email_label' => 'Email',
            'contact_form_email_placeholder' => 'email@anda.com',
            'contact_form_phone_label' => 'No. Telepon',
            'contact_form_phone_placeholder' => '+62 812-xxxx-xxxx',
            'contact_form_service_label' => 'Layanan',
            'contact_form_service_placeholder' => 'Pilih layanan...',
            'contact_form_other_service_label' => 'Lainnya',
            'contact_form_budget_label' => 'Estimasi Anggaran',
            'contact_form_budget_placeholder' => 'Pilih range anggaran...',
            'contact_budget_options' => [
                '< Rp 500 Juta',
                'Rp 500 Juta - 1 Miliar',
                'Rp 1 - 5 Miliar',
                'Rp 5 - 20 Miliar',
                '> Rp 20 Miliar',
            ],
            'contact_form_detail_label' => 'Detail Proyek',
            'contact_form_detail_placeholder' => 'Ceritakan tentang proyek Anda, lokasi, luas bangunan, timeline yang diharapkan, dan kebutuhan lainnya.',
            'contact_form_submit_label' => 'Kirim Pesan',
            'contact_form_success_message' => 'Pesan Anda berhasil terkirim. Tim kami akan segera menghubungi Anda.',

            'contact_schedule_eyebrow' => 'Penjadwalan',
            'contact_schedule_title_primary' => 'Jadwalkan',
            'contact_schedule_title_highlight' => 'Pertemuan',
            'contact_schedule_description' => 'Pilih tanggal dan waktu yang nyaman untuk konsultasi langsung dengan tim kami, baik secara tatap muka maupun virtual.',
            'contact_schedule_detail_title' => 'Detail Pertemuan',
            'contact_schedule_type_label' => 'Jenis Pertemuan',
            'contact_schedule_type_placeholder' => 'Pilih jenis pertemuan...',
            'contact_schedule_types' => [
                'Konsultasi Proyek Baru',
                'Review Desain',
                'Serah Terima Proyek',
                'Site Visit / Inspeksi',
                'Meeting Virtual (Zoom/Google Meet)',
                'Lainnya',
            ],
            'contact_schedule_name_label' => 'Nama Lengkap',
            'contact_schedule_name_placeholder' => 'Nama Anda',
            'contact_schedule_phone_label' => 'No. Telepon',
            'contact_schedule_phone_placeholder' => '+62 812-xxxx-xxxx',
            'contact_schedule_email_label' => 'Email',
            'contact_schedule_email_placeholder' => 'email@anda.com',
            'contact_schedule_notes_label' => 'Agenda / Catatan',
            'contact_schedule_notes_placeholder' => 'Topik yang ingin dibahas, pertanyaan, dan informasi pendukung lainnya. (opsional)',
            'contact_schedule_summary_title' => 'Ringkasan Jadwal',
            'contact_schedule_date_label' => 'Tanggal',
            'contact_schedule_time_label' => 'Waktu',
            'contact_schedule_location_label' => 'Lokasi',
            'contact_schedule_submit_label' => 'Konfirmasi Jadwal',
            'contact_schedule_submit_note' => 'Konfirmasi akan dikirim ke email Anda.',
            'contact_schedule_success_title' => 'Permintaan Jadwal Berhasil Dikirim!',
            'contact_schedule_success_description' => 'Permintaan jadwal Anda telah diterima dan menunggu validasi admin. Informasi berikutnya akan dikirim melalui email.',
            'contact_schedule_reminder_text' => 'Admin akan mengirim informasi lanjutan setelah jadwal dikonfirmasi atau dibatalkan.',
            'contact_schedule_again_label' => 'Jadwalkan Pertemuan Lain',
            'contact_schedule_select_datetime_warning' => 'Silakan pilih tanggal dan waktu terlebih dahulu.',
            'contact_schedule_time_picker_title' => 'Pilih Waktu',
            'contact_schedule_time_picker_hint' => 'Pilih tanggal terlebih dahulu',
            'contact_schedule_morning_label' => 'Pagi',
            'contact_schedule_afternoon_label' => 'Siang',

            'map_embed_url' => null,
            'footer_map_title' => 'Lokasi Kami',
            'footer_map_open_label' => 'Buka di Google Maps',

            // Testimoni
            'testimonial_eyebrow' => 'Testimoni',
            'testimonial_title_primary' => 'Apa Kata',
            'testimonial_title_highlight' => 'Klien Kami',
            'testimonial_description' => 'Pengalaman klien yang sudah bekerja sama dengan kami.',
            'testimonial_empty_text' => 'Belum ada testimoni yang ditampilkan.',
            'testimonial_form_title' => 'Bagikan Pengalaman Anda',
            'testimonial_form_description' => 'Pernah menggunakan layanan kami? Kirimkan testimoni Anda. Testimoni akan ditinjau admin sebelum ditampilkan.',
            'testimonial_submit_label' => 'Kirim Testimoni',
            'testimonial_success_message' => 'Terima kasih. Testimoni Anda berhasil dikirim dan akan ditinjau admin sebelum ditampilkan.',
            'testimonial_review_notice' => 'Testimoni yang dikirim tidak langsung tampil. Admin akan meninjau terlebih dahulu sebelum dipublikasikan.',
            'testimonial_name_label' => 'Nama Lengkap',
            'testimonial_name_placeholder' => 'Nama Anda',
            'testimonial_email_label' => 'Email',
            'testimonial_email_placeholder' => 'email@anda.com',
            'testimonial_company_label' => 'Perusahaan / Instansi',
            'testimonial_company_placeholder' => 'Opsional',
            'testimonial_position_label' => 'Jabatan / Posisi',
            'testimonial_position_placeholder' => 'Opsional',
            'testimonial_phone_label' => 'No. Telepon',
            'testimonial_phone_placeholder' => 'Opsional',
            'testimonial_service_label' => 'Layanan',
            'testimonial_service_placeholder' => 'Pilih layanan...',
            'testimonial_rating_label' => 'Rating',
            'testimonial_rating_5_label' => '5 - Sangat Puas',
            'testimonial_rating_4_label' => '4 - Puas',
            'testimonial_rating_3_label' => '3 - Cukup',
            'testimonial_rating_2_label' => '2 - Kurang',
            'testimonial_rating_1_label' => '1 - Sangat Kurang',
            'testimonial_content_label' => 'Testimoni',
            'testimonial_content_placeholder' => 'Ceritakan pengalaman Anda menggunakan layanan kami...',

        ];
    }

    public static function current(): self
    {
        return static::query()->firstOrCreate([], static::defaults());
    }

    public function publicData(): array
    {
        $defaults = static::defaults();
        $data = [];

        $nullableKeys = [
            'marketing_email',
            'office_hours_saturday',
            'instagram_url',
            'facebook_url',
            'linkedin_url',
            'youtube_url',
            'map_url',
            'seo_keywords',
        ];

        foreach ($defaults as $key => $default) {
            $value = $this->{$key};

            if (in_array($key, $nullableKeys, true)) {
                $data[$key] = $value;
                continue;
            }

            $data[$key] = ($value === null || $value === '') ? $default : $value;
        }

        $data['logo_path'] = $this->logo_path;
        $data['favicon_path'] = $this->favicon_path;
        $data['hero_image_path'] = $this->hero_image_path;
        $data['about_hero_image_path'] = $this->about_hero_image_path;
        $data['about_story_image_path'] = $this->about_story_image_path;
        $data['organization_chart_path'] = $this->organization_chart_path;
        $data['service_hero_image_path'] = $this->service_hero_image_path;
        $data['portfolio_hero_image_path'] = $this->portfolio_hero_image_path;
        $data['contact_hero_image_path'] = $this->contact_hero_image_path;

        $data['logo_url'] = $this->logo_path
            ? Storage::disk('public')->url($this->logo_path)
            : null;

        // Favicon otomatis mengikuti logo jika favicon khusus tidak diunggah.
        // Dengan begitu, saat logo diganti dari Admin Panel, icon tab browser ikut berubah.
        $data['favicon_url'] = $this->favicon_path
            ? Storage::disk('public')->url($this->favicon_path)
            : $data['logo_url'];

        $data['favicon_uses_logo'] = !$this->favicon_path && !empty($data['logo_url']);

        $data['hero_image_url'] = $this->hero_image_path
            ? Storage::disk('public')->url($this->hero_image_path)
            : 'https://picsum.photos/seed/construction-skyline/1920/1080';

        $data['about_hero_image_url'] = $this->about_hero_image_path
            ? Storage::disk('public')->url($this->about_hero_image_path)
            : 'https://picsum.photos/seed/team-meeting/1920/900';

        $data['about_story_image_url'] = $this->about_story_image_path
            ? Storage::disk('public')->url($this->about_story_image_path)
            : 'https://picsum.photos/seed/architect-plan/800/600';

        $data['organization_chart_url'] = $this->organization_chart_path
            ? Storage::disk('public')->url($this->organization_chart_path)
            : null;

        $data['service_hero_image_url'] = $this->service_hero_image_path
            ? Storage::disk('public')->url($this->service_hero_image_path)
            : 'https://picsum.photos/seed/blueprint-plan/1920/900';

        $data['portfolio_hero_image_url'] = $this->portfolio_hero_image_path
            ? Storage::disk('public')->url($this->portfolio_hero_image_path)
            : 'https://picsum.photos/seed/skyline-night/1920/900';

        $data['contact_hero_image_url'] = $this->contact_hero_image_path
            ? Storage::disk('public')->url($this->contact_hero_image_path)
            : 'https://picsum.photos/seed/city-aerial/1920/900';

        $data['map_embed_url'] = $this->map_embed_url
            ?: 'https://www.google.com/maps?q='.rawurlencode((string) $data['address']).'&output=embed';

        $data['phone_href'] = 'tel:' . preg_replace('/[^0-9+]/', '', (string) $data['phone']);
        $data['logo_letter'] = mb_strtoupper(mb_substr((string) $data['short_name'], 0, 1));

        return $data;
    }
    public function mailAdminData(): array
    {
        return array_merge([
            'mail_enabled' => (bool) $this->mail_enabled,
            'mail_smtp_host' => $this->mail_smtp_host ?: 'smtp.gmail.com',
            'mail_smtp_port' => (int) ($this->mail_smtp_port ?: 587),
            'mail_smtp_username' => $this->mail_smtp_username,
            'mail_smtp_password_set' => !empty($this->mail_smtp_password),
            'mail_security' => $this->mail_security ?: 'starttls',
            'mail_from_address' => $this->mail_from_address ?: $this->mail_smtp_username,
            'mail_from_name' => $this->mail_from_name ?: ($this->company ?: static::defaults()['company']),
        ], app(EmailTemplateService::class)->templateData($this));
    }

}

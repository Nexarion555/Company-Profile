<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->string('service_hero_image_path', 1000)->nullable();
            $table->string('service_hero_eyebrow', 120)->nullable();
            $table->string('service_hero_title_primary', 180)->nullable();
            $table->string('service_hero_title_highlight', 180)->nullable();
            $table->text('service_hero_description')->nullable();

            $table->string('service_process_eyebrow', 120)->nullable();
            $table->string('service_process_title_primary', 180)->nullable();
            $table->string('service_process_title_highlight', 180)->nullable();
            $table->json('service_process_steps')->nullable();
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title', 180);
            $table->text('description');
            $table->string('icon', 120)->default('hard-hat');
            $table->string('image_path', 1000)->nullable();
            $table->string('fallback_image_url', 1000)->nullable();
            $table->json('features')->nullable();
            $table->unsignedInteger('display_order')->default(0)->index();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });

        $now = now();
        DB::table('services')->insert([
            [
                'title' => 'Desain Interior',
                'description' => 'Kami merancang interior yang menggabungkan estetika, kenyamanan, dan fungsionalitas. Dari ruang tamu minimalis hingga lobi hotel mewah, setiap detail dirancang dengan presisi tinggi menggunakan software 3D rendering terkini.',
                'icon' => 'sofa',
                'fallback_image_url' => 'https://picsum.photos/seed/interior-modern-room/800/600',
                'features' => json_encode([
                    'Desain ruang residensial & komersial',
                    '3D visualisasi & rendering fotorealistik',
                    'Pemilihan material & furniture custom',
                    'Lighting design & penataan warna',
                ], JSON_UNESCAPED_UNICODE),
                'display_order' => 1,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Desain Gedung & Arsitektur',
                'description' => 'Layanan arsitektur lengkap dari konsep hingga dokumen gambar kerja (DED). Kami mengintegrasikan prinsip sustainable design, efisiensi energi, dan kepatuhan terhadap regulasi bangunan Indonesia.',
                'icon' => 'building-2',
                'fallback_image_url' => 'https://picsum.photos/seed/tall-building-design/800/600',
                'features' => json_encode([
                    'Perencanaan arsitektur & master plan',
                    'Desain gedung tinggi & kompleks',
                    'BIM (Building Information Modeling)',
                    'Pengurusan IMB/PBG & sertifikasi',
                ], JSON_UNESCAPED_UNICODE),
                'display_order' => 2,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Renovasi & Restorasi',
                'description' => 'Memberikan kehidupan baru pada bangunan yang sudah ada. Kami menangani renovasi skala kecil hingga restorasi bangunan heritage dengan menjaga karakter asli sekaligus memodernisasi fasilitas.',
                'icon' => 'wrench',
                'fallback_image_url' => 'https://picsum.photos/seed/renovation-work/800/600',
                'features' => json_encode([
                    'Assessment struktural & visual',
                    'Renovasi interior & eksterior',
                    'Restorasi bangunan cagar budaya',
                    'Perkuatan struktur & retrofit',
                ], JSON_UNESCAPED_UNICODE),
                'display_order' => 3,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Konstruksi Bangunan Baru',
                'description' => 'Pelaksanaan proyek konstruksi dari ground-breaking hingga serah terima. Didukung oleh tim site manager berpengalaman dan supply chain yang terintegrasi untuk memastikan kualitas dan ketepatan waktu.',
                'icon' => 'hard-hat',
                'fallback_image_url' => 'https://picsum.photos/seed/new-construction/800/600',
                'features' => json_encode([
                    'Konstruksi residensial, komersial & industri',
                    'Manajemen proyek & quality control',
                    'Health, Safety & Environment (HSE)',
                    'Commissioning & serah terima',
                ], JSON_UNESCAPED_UNICODE),
                'display_order' => 4,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Desain Landscape',
                'description' => 'Menciptakan ruang terbuka hijau yang harmonis dengan bangunan dan lingkungan sekitar. Mulai dari taman pribadi, rooftop garden, hingga masterplan landscape kawasan.',
                'icon' => 'trees',
                'fallback_image_url' => 'https://picsum.photos/seed/garden-landscape/800/600',
                'features' => json_encode([
                    'Taman & garden design',
                    'Rooftop & vertical garden',
                    'Hardscape & softscape planning',
                    'Irigasi & pencahayaan taman',
                ], JSON_UNESCAPED_UNICODE),
                'display_order' => 5,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Manajemen Proyek & Konsultansi',
                'description' => 'Layanan pengelolaan proyek profesional untuk memastikan setiap aspek konstruksi berjalan sesuai rencana, anggaran, dan jadwal. Termasuk pengawasan independen dan manajemen risiko.',
                'icon' => 'clipboard-list',
                'fallback_image_url' => 'https://picsum.photos/seed/project-meeting/800/600',
                'features' => json_encode([
                    'Project management & scheduling',
                    'Cost estimation & budget control',
                    'Pengawasan & quality assurance',
                    'Laporan progres & dokumentasi',
                ], JSON_UNESCAPED_UNICODE),
                'display_order' => 6,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('services');

        Schema::table('company_settings', function (Blueprint $table) {
            $table->dropColumn([
                'service_hero_image_path',
                'service_hero_eyebrow',
                'service_hero_title_primary',
                'service_hero_title_highlight',
                'service_hero_description',
                'service_process_eyebrow',
                'service_process_title_primary',
                'service_process_title_highlight',
                'service_process_steps',
            ]);
        });
    }
};

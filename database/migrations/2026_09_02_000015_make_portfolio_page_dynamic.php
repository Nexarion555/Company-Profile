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
            $table->string('portfolio_hero_image_path', 1000)->nullable();
            $table->string('portfolio_hero_eyebrow', 120)->nullable();
            $table->string('portfolio_hero_title_primary', 180)->nullable();
            $table->string('portfolio_hero_title_highlight', 180)->nullable();
            $table->text('portfolio_hero_description')->nullable();
            $table->string('portfolio_all_label', 80)->nullable();
            $table->string('portfolio_empty_title', 180)->nullable();
            $table->text('portfolio_empty_description')->nullable();
            $table->string('portfolio_modal_cta_label', 180)->nullable();
        });

        Schema::table('portfolios', function (Blueprint $table) {
            $table->foreignId('service_id')->nullable()->constrained('services')->nullOnDelete();
            $table->unsignedInteger('display_order')->default(0)->index();
            $table->boolean('is_active')->default(true)->index();
        });

        // Hubungkan data portfolio lama ke layanan yang paling sesuai agar tidak perlu input ulang.
        $services = DB::table('services')->get(['id', 'title']);
        $portfolios = DB::table('portfolios')->get(['id', 'category']);

        $normalize = static function (?string $value): string {
            $value = mb_strtolower(trim((string) $value));
            $value = preg_replace('/[^a-z0-9]+/u', ' ', $value) ?: '';
            return trim(preg_replace('/\s+/', ' ', $value) ?: '');
        };

        foreach ($portfolios as $portfolio) {
            $category = $normalize($portfolio->category);
            if ($category === '') {
                continue;
            }

            $matched = null;
            $bestScore = 0;
            $categoryWords = array_values(array_filter(explode(' ', $category), fn ($w) => mb_strlen($w) >= 4));

            foreach ($services as $service) {
                $serviceTitle = $normalize($service->title);
                $score = 0;

                if ($serviceTitle === $category) {
                    $score = 100;
                } elseif (str_contains($serviceTitle, $category) || str_contains($category, $serviceTitle)) {
                    $score = 80;
                } else {
                    foreach ($categoryWords as $word) {
                        if (str_contains($serviceTitle, $word)) {
                            $score += 10;
                        }
                    }
                }

                if ($score > $bestScore) {
                    $bestScore = $score;
                    $matched = $service;
                }
            }

            if ($matched && $bestScore > 0) {
                DB::table('portfolios')->where('id', $portfolio->id)->update([
                    'service_id' => $matched->id,
                    'category' => $matched->title,
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropConstrainedForeignId('service_id');
            $table->dropColumn(['display_order', 'is_active']);
        });

        Schema::table('company_settings', function (Blueprint $table) {
            $table->dropColumn([
                'portfolio_hero_image_path',
                'portfolio_hero_eyebrow',
                'portfolio_hero_title_primary',
                'portfolio_hero_title_highlight',
                'portfolio_hero_description',
                'portfolio_all_label',
                'portfolio_empty_title',
                'portfolio_empty_description',
                'portfolio_modal_cta_label',
            ]);
        });
    }
};

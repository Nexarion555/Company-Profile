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

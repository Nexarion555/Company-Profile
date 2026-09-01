<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\CompanySetting;

class EmailTemplateService
{
    public static function defaults(): array
    {
        return [
            'mail_received_subject' => 'Permintaan Jadwal Diterima - {nama_singkat}',
            'mail_received_body' => "Halo {nama},\n\nPermintaan jadwal pertemuan Anda telah kami terima dan saat ini masih MENUNGGU VALIDASI ADMIN.\n\nJenis: {jenis}\nTanggal: {tanggal}\nWaktu: {waktu} WIB\n\nAdmin akan memeriksa jadwal tersebut. Setelah jadwal DIKONFIRMASI atau DIBATALKAN, sistem akan mengirimkan informasi hasil validasi ke email ini.\n\nTerima kasih,\n{nama_perusahaan}",
            'mail_confirmed_subject' => 'Jadwal Pertemuan Dikonfirmasi - {nama_singkat}',
            'mail_confirmed_body' => "Halo {nama}, permintaan jadwal pertemuan Anda telah diperiksa dan DIKONFIRMASI oleh admin {nama_singkat}.\n\nMohon hadir sesuai jadwal yang tercantum pada email ini. Jika ada perubahan mendesak, silakan hubungi kami melalui {telepon_perusahaan} atau {email_perusahaan}.",
            'mail_cancelled_subject' => 'Jadwal Pertemuan Dibatalkan - {nama_singkat}',
            'mail_cancelled_body' => "Halo {nama}, setelah ditinjau oleh admin {nama_singkat}, jadwal pertemuan Anda belum dapat dilaksanakan dan telah DIBATALKAN.\n\nSilakan perhatikan catatan admin pada email ini. Anda dapat mengajukan jadwal pertemuan baru melalui website kami pada waktu yang tersedia.",
            'mail_test_subject' => 'Tes Email - {nama_singkat}',
            'mail_test_body' => "Tes pengiriman email berhasil.\n\nJika Anda menerima email ini, konfigurasi SMTP pada Admin Panel sudah benar.\n\nPengirim: {nama_pengirim} <{email_pengirim}>",
        ];
    }

    public function templateData(?CompanySetting $settings = null): array
    {
        $settings ??= CompanySetting::current();
        $defaults = static::defaults();
        $data = [];

        foreach ($defaults as $key => $default) {
            $value = $settings->{$key};
            $data[$key] = ($value === null || trim((string) $value) === '') ? $default : $value;
        }

        return $data;
    }

    public function appointmentContext(
        Appointment $appointment,
        ?CompanySetting $settings = null,
        ?array $company = null
    ): array {
        $settings ??= CompanySetting::current();
        $company ??= $settings->publicData();

        return array_merge(
            $this->companyContext($settings, $company),
            [
                'nama' => (string) $appointment->name,
                'email' => (string) $appointment->email,
                'telepon' => (string) $appointment->phone,
                'jenis' => (string) $appointment->type,
                'tanggal' => $appointment->date?->translatedFormat('l, d F Y') ?: '-',
                'tanggal_singkat' => $appointment->date?->format('d-m-Y') ?: '-',
                'waktu' => $appointment->time ? substr((string) $appointment->time, 0, 5) : '-',
                'catatan_user' => trim((string) ($appointment->notes ?: '-')),
                'catatan_admin' => trim((string) ($appointment->admin_note ?: '-')),
                'status' => $this->statusText((string) $appointment->status),
            ]
        );
    }

    public function companyContext(?CompanySetting $settings = null, ?array $company = null): array
    {
        $settings ??= CompanySetting::current();
        $company ??= $settings->publicData();

        return [
            'nama' => '-',
            'email' => '-',
            'telepon' => '-',
            'jenis' => '-',
            'tanggal' => '-',
            'tanggal_singkat' => '-',
            'waktu' => '-',
            'catatan_user' => '-',
            'catatan_admin' => '-',
            'status' => '-',
            'nama_perusahaan' => (string) ($company['company'] ?? ''),
            'nama_singkat' => (string) ($company['short_name'] ?? ''),
            'email_perusahaan' => (string) ($company['email'] ?? ''),
            'telepon_perusahaan' => (string) ($company['phone'] ?? ''),
            'alamat_perusahaan' => (string) ($company['address'] ?? ''),
            'nama_pengirim' => (string) ($settings->mail_from_name ?: ($company['company'] ?? '')),
            'email_pengirim' => (string) ($settings->mail_from_address ?: $settings->mail_smtp_username ?: ''),
        ];
    }

    public function render(string $template, array $context): string
    {
        $replace = [];

        foreach ($context as $key => $value) {
            $replace['{'.$key.'}'] = (string) $value;
        }

        return strtr($template, $replace);
    }

    public function renderAppointmentTemplate(
        string $templateKey,
        Appointment $appointment,
        ?CompanySetting $settings = null,
        ?array $company = null
    ): string {
        $settings ??= CompanySetting::current();
        $templates = $this->templateData($settings);
        $template = $templates[$templateKey] ?? static::defaults()[$templateKey] ?? '';

        return $this->render(
            $template,
            $this->appointmentContext($appointment, $settings, $company)
        );
    }

    public function renderCompanyTemplate(
        string $templateKey,
        ?CompanySetting $settings = null,
        ?array $company = null
    ): string {
        $settings ??= CompanySetting::current();
        $templates = $this->templateData($settings);
        $template = $templates[$templateKey] ?? static::defaults()[$templateKey] ?? '';

        return $this->render(
            $template,
            $this->companyContext($settings, $company)
        );
    }

    private function statusText(string $status): string
    {
        return match ($status) {
            'confirmed' => 'Dikonfirmasi',
            'cancelled' => 'Dibatalkan',
            'done' => 'Selesai',
            default => 'Menunggu Validasi',
        };
    }
}

<?php

namespace App\Services;

use App\Models\CompanySetting;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use RuntimeException;

class DynamicMailer
{
    private string $mailerName = 'company_smtp';

    public function configure(?CompanySetting $settings = null): CompanySetting
    {
        $settings ??= CompanySetting::current();

        if (!$settings->mail_enabled) {
            throw new RuntimeException('Pengiriman email belum diaktifkan pada Pengaturan Email Admin Panel.');
        }

        $host = trim((string) $settings->mail_smtp_host);
        $username = trim((string) $settings->mail_smtp_username);
        $password = (string) $settings->mail_smtp_password;
        $port = (int) ($settings->mail_smtp_port ?: 587);
        $fromAddress = trim((string) ($settings->mail_from_address ?: $username));
        $fromName = trim((string) ($settings->mail_from_name ?: $settings->company));

        if ($host === '' || $username === '' || $password === '' || $fromAddress === '') {
            throw new RuntimeException('Konfigurasi SMTP belum lengkap. Isi host, username/email, App Password, dan alamat pengirim.');
        }

        $scheme = $settings->mail_security === 'ssl' ? 'smtps' : null;

        config([
            'mail.default' => $this->mailerName,
            'mail.mailers.'.$this->mailerName => [
                'transport' => 'smtp',
                'scheme' => $scheme,
                'url' => null,
                'host' => $host,
                'port' => $port,
                'username' => $username,
                'password' => $password,
                'timeout' => 20,
                'local_domain' => null,
            ],
            'mail.from.address' => $fromAddress,
            'mail.from.name' => $fromName,
        ]);

        app('mail.manager')->purge($this->mailerName);

        return $settings;
    }

    public function sendMailable(string $recipient, Mailable $mailable): void
    {
        $this->configure();

        Mail::mailer($this->mailerName)
            ->to($recipient)
            ->send($mailable);
    }

    public function sendRaw(string $recipient, string $subject, string $body): void
    {
        $this->configure();

        Mail::mailer($this->mailerName)->raw(
            $body,
            fn ($mail) => $mail
                ->to($recipient)
                ->subject($subject)
        );
    }
}

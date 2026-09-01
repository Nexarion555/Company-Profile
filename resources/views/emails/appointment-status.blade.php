<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Informasi Jadwal Pertemuan</title>
</head>
<body style="margin:0;padding:0;background:#f4f6f8;font-family:Arial,Helvetica,sans-serif;color:#1f2937;">
<table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background:#f4f6f8;padding:32px 16px;">
    <tr>
        <td align="center">
            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width:640px;background:#ffffff;border-radius:16px;overflow:hidden;border:1px solid #e5e7eb;">
                <tr>
                    <td style="padding:28px 32px;background:#ffffff;border-bottom:4px solid {{ $appointment->status === 'confirmed' ? '#0b5fdc' : '#e11d48' }};">
                        <div style="font-size:12px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#6b7280;">{{ $company['short_name'] }}</div>
                        <div style="font-size:24px;font-weight:700;margin-top:6px;color:#111827;">{{ $company['company'] }}</div>
                    </td>
                </tr>
                <tr>
                    <td style="padding:32px;">
                        @if($appointment->status === 'confirmed')
                            <div style="display:inline-block;padding:8px 14px;border-radius:999px;background:#ecfdf5;color:#047857;font-size:12px;font-weight:700;">JADWAL DIKONFIRMASI</div>
                            <h1 style="font-size:24px;line-height:1.35;margin:18px 0 10px;color:#111827;">Pertemuan Anda telah disetujui</h1>
                            <div style="font-size:15px;line-height:1.7;color:#4b5563;margin:0 0 24px;">{!! nl2br(e($templateBody)) !!}</div>
                        @else
                            <div style="display:inline-block;padding:8px 14px;border-radius:999px;background:#fff1f2;color:#be123c;font-size:12px;font-weight:700;">JADWAL DIBATALKAN</div>
                            <h1 style="font-size:24px;line-height:1.35;margin:18px 0 10px;color:#111827;">Pertemuan belum dapat dilaksanakan</h1>
                            <div style="font-size:15px;line-height:1.7;color:#4b5563;margin:0 0 24px;">{!! nl2br(e($templateBody)) !!}</div>
                        @endif

                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:12px;margin-bottom:24px;">
                            <tr><td style="padding:14px 18px;color:#6b7280;font-size:13px;width:38%;border-bottom:1px solid #e5e7eb;">Jenis Pertemuan</td><td style="padding:14px 18px;font-size:13px;font-weight:700;border-bottom:1px solid #e5e7eb;">{{ $appointment->type }}</td></tr>
                            <tr><td style="padding:14px 18px;color:#6b7280;font-size:13px;border-bottom:1px solid #e5e7eb;">Tanggal</td><td style="padding:14px 18px;font-size:13px;font-weight:700;border-bottom:1px solid #e5e7eb;">{{ $appointment->date->translatedFormat('l, d F Y') }}</td></tr>
                            <tr><td style="padding:14px 18px;color:#6b7280;font-size:13px;border-bottom:1px solid #e5e7eb;">Waktu</td><td style="padding:14px 18px;font-size:13px;font-weight:700;border-bottom:1px solid #e5e7eb;">{{ substr($appointment->time, 0, 5) }} WIB</td></tr>
                            <tr><td style="padding:14px 18px;color:#6b7280;font-size:13px;">Email</td><td style="padding:14px 18px;font-size:13px;font-weight:700;">{{ $appointment->email }}</td></tr>
                        </table>

                        @if($appointment->admin_note)
                            <div style="padding:18px;border-radius:12px;background:{{ $appointment->status === 'confirmed' ? '#eff6ff' : '#fff1f2' }};border-left:4px solid {{ $appointment->status === 'confirmed' ? '#0b5fdc' : '#e11d48' }};margin-bottom:24px;">
                                <div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:#6b7280;margin-bottom:6px;">Catatan Admin</div>
                                <div style="font-size:14px;line-height:1.7;color:#374151;">{!! nl2br(e($appointment->admin_note)) !!}</div>
                            </div>
                        @endif

                    </td>
                </tr>
                <tr>
                    <td style="padding:22px 32px;background:#f9fafb;border-top:1px solid #e5e7eb;font-size:12px;line-height:1.6;color:#6b7280;">
                        Email ini dikirim otomatis oleh sistem {{ $company['company'] }} sebagai informasi status jadwal pertemuan Anda.<br>
                        {{ $company['address'] }}
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>

FITUR VALIDASI JADWAL + EMAIL USER
==================================

ALUR
1. User mengirim form Jadwal Temu dari landing page.
2. Data masuk ke Admin Panel dengan status "Menunggu Validasi".
3. Admin memilih:
   - ACC -> dapat menulis catatan opsional -> sistem kirim email konfirmasi.
   - Batalkan -> alasan pembatalan wajib diisi -> sistem kirim email pembatalan.
4. Admin dapat melihat indikator "Email terkirim" / "Belum terkirim".
5. Jika email gagal, status jadwal tetap tersimpan dan admin dapat menekan tombol Kirim Ulang Email.
6. Jadwal yang sudah ACC dapat ditandai Selesai.

SETUP GMAIL SMTP
----------------
Gunakan akun Gmail khusus perusahaan bila memungkinkan.

1. Aktifkan Verifikasi 2 Langkah pada akun Google.
2. Buat App Password untuk aplikasi Laravel.
3. Isi .env project:

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME="alamatgmailanda@gmail.com"
MAIL_PASSWORD="APP_PASSWORD_16_KARAKTER"
MAIL_FROM_ADDRESS="alamatgmailanda@gmail.com"
MAIL_FROM_NAME="Nama Perusahaan"

4. Jalankan:
php artisan optimize:clear

5. Jalankan migration baru:
php artisan migrate

CATATAN
-------
- Jangan gunakan password login Gmail biasa. Gunakan Google App Password.
- Jangan push file .env ke GitHub.
- Jika MAIL_MAILER masih "log", email tidak akan masuk ke Gmail user; email hanya dicatat di storage/logs/laravel.log.

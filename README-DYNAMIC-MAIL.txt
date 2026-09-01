PENGATURAN EMAIL DINAMIS - COMPANY PROFILE
===========================================

Fitur:
- Pengiriman email dapat diaktifkan/nonaktifkan dari Admin Panel.
- SMTP host, port, username, password, keamanan, email pengirim dan nama pengirim dapat diedit admin.
- Password SMTP disimpan menggunakan encrypted cast Laravel dan tidak pernah dikirim kembali ke browser.
- Tombol "Simpan & Tes Email" untuk mengetes konfigurasi.
- Email jadwal diterima, ACC, dibatalkan, dan kirim ulang menggunakan pengaturan SMTP dari database.

SETUP GMAIL YANG DISARANKAN
---------------------------
Status Pengiriman : Aktif
SMTP Host          : smtp.gmail.com
SMTP Port          : 587
Keamanan           : STARTTLS
Username           : akun-gmail@gmail.com
App Password       : Google App Password 16 karakter
Email Pengirim     : akun-gmail@gmail.com
Nama Pengirim      : Nama Perusahaan

CATATAN GMAIL
-------------
- Jangan gunakan password login Gmail biasa.
- Aktifkan Verifikasi 2 Langkah lalu buat Google App Password.
- Email Pengirim sebaiknya sama dengan Username Gmail.
- Jika Email Pengirim berbeda, alamat tersebut harus sudah diverifikasi sebagai alias "Send mail as" di Gmail.

SETELAH COPY PATCH
------------------
php artisan migrate
php artisan optimize:clear

Kemudian buka Admin Panel > Pengaturan > Email Pengirim & SMTP.
Isi konfigurasi, masukkan email tujuan tes, lalu klik "Simpan & Tes Email".

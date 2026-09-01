PENGATURAN TEMPLATE EMAIL DINAMIS
================================

Fitur baru:
- Admin Panel > Pengaturan > Template Kalimat Email
- Template untuk:
  1. Jadwal diterima / menunggu validasi
  2. Jadwal di-ACC / dikonfirmasi
  3. Jadwal dibatalkan
  4. Email tes SMTP
- Subjek dan isi email dapat diubah tanpa edit source code.
- Tersedia placeholder dinamis seperti {nama}, {tanggal}, {waktu}, {jenis}, {catatan_admin}, {nama_perusahaan}, dan lainnya.
- Tombol Template Default untuk mengembalikan kalimat bawaan sebelum disimpan.

SETELAH MENYALIN PATCH
-----------------------
php artisan migrate
php artisan optimize:clear

CATATAN
-------
Jangan menjalankan php artisan migrate:fresh pada database yang sudah berisi data karena seluruh tabel akan dibuat ulang.

Placeholder yang tersedia:
{nama}
{email}
{telepon}
{jenis}
{tanggal}
{tanggal_singkat}
{waktu}
{catatan_user}
{catatan_admin}
{status}
{nama_perusahaan}
{nama_singkat}
{email_perusahaan}
{telepon_perusahaan}
{alamat_perusahaan}
{nama_pengirim}
{email_pengirim}

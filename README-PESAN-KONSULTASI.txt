FITUR PESAN & LANJUT KONSULTASI
==============================

Alur:
1. User mengisi form Hubungi Kami di landing page.
2. Pesan disimpan ke tabel messages dengan nama, email, telepon, layanan,
   estimasi anggaran, detail proyek, dan status dibaca.
3. Pesan muncul di Admin Panel > Pesan.
4. Admin dapat membuka detail dan melanjutkan konsultasi melalui:
   - Gmail (membuka compose Gmail dengan To/Subject/Body terisi),
   - Email (membuka aplikasi email default),
   - WhatsApp (membuka wa.me dengan pesan awal terisi).
5. Saat detail dibuka, pesan otomatis ditandai sudah dibaca.

INSTALL UPDATE
--------------
php artisan migrate
php artisan optimize:clear

Migration baru:
2026_09_01_000012_expand_messages_for_consultation.php

Catatan:
- Pesan lama tetap kompatibel. AdminController mencoba membaca Telepon/Layanan/
  Anggaran/Detail dari format msg lama jika kolom baru masih kosong.
- WhatsApp mengubah nomor Indonesia berawalan 0 menjadi format 62.

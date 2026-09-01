PATCH PENGATURAN WEBSITE - COMPANY PROFILE
==========================================

Fitur yang ditambahkan ke menu Pengaturan Admin:
- Nama perusahaan, nama singkat, jenis usaha, tagline
- Upload / ganti / hapus logo
- Upload / ganti / hapus favicon
- Upload / ganti / hapus background hero
- Email resmi, email marketing, telepon, WhatsApp, alamat
- Jam operasional dan URL Google Maps
- Instagram, Facebook, LinkedIn, YouTube
- Badge, judul, deskripsi dan tahun berdiri pada hero
- 4 statistik beranda beserta labelnya
- SEO title, meta description, meta keywords
- Deskripsi footer dan teks hak cipta

File media tersimpan pada storage/app/public/branding.

CARA PASANG PADA PROJECT YANG SUDAH BERJALAN
1. Extract isi ZIP ini ke root project Laravel Company-Profile.
2. Pilih Replace/Overwrite jika diminta.
3. Jalankan:

   php artisan migrate
   php artisan storage:link
   php artisan optimize:clear

4. Buka /admin -> Pengaturan.

PENTING:
- Jangan jalankan php artisan migrate:fresh karena akan menghapus data database.
- Jika storage:link mengatakan link sudah ada, itu normal dan tidak perlu diulang.

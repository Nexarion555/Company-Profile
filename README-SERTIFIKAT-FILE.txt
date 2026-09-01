UPDATE SERTIFIKAT - UPLOAD & PREVIEW FILE
========================================

Fitur:
- Admin dapat upload JPG/JPEG/PNG/WebP/PDF pada data Sertifikasi.
- Maksimal file 10 MB.
- Gambar ditampilkan sebagai preview di landing page.
- PDF ditampilkan sebagai preview dokumen dan tersedia tombol buka PDF.
- Saat edit, file lama dapat dipertahankan, diganti, atau dihapus.
- Saat data Sertifikasi dihapus, file sertifikat ikut dihapus dari storage.

Setelah replace/update file jalankan:

1. php artisan migrate
2. php artisan storage:link
3. php artisan optimize:clear

JANGAN gunakan php artisan migrate:fresh pada database yang sudah berisi data.

File upload tersimpan di:
storage/app/public/certifications

URL publik melalui:
public/storage -> storage/app/public

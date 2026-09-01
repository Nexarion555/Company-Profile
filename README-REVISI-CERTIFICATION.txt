PROJECT SOURCE REVISI CERTIFICATION
===================================

Project ini adalah hasil revisi langsung dari project Company-Profile yang dilampirkan.
File .env, folder .git, vendor, dan node_modules tidak disertakan untuk keamanan dan ukuran file.

Untuk project lama yang sudah berjalan, cukup gunakan ZIP patch agar konfigurasi lokal Anda tidak berubah.

Setelah menyalin revisi ke project lama:
  php artisan migrate
  php artisan optimize:clear

Untuk instalasi baru:
  composer install
  copy .env.example .env
  php artisan key:generate
  # isi konfigurasi PostgreSQL di .env
  php artisan migrate --seed
  php artisan serve

Fitur revisi:
- Section Milestone diganti menjadi Certification.
- Certification diambil dari tabel certifications.
- CRUD Certification dari Admin Panel.
- Data Certification juga digunakan pada badge Sertifikasi di footer.

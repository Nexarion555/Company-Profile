# KSN — Laravel + PostgreSQL

Backend ini dibuat dari **dua HTML yang Anda kirim**. Struktur visual, class Tailwind, layout, loader, modal, toast, dan animasi asli tetap dipertahankan pada Blade view. Yang diubah adalah sumber/aksi data agar memakai Laravel + PostgreSQL.

## URL
- Landing page/user: `http://127.0.0.1:8000/`
- Admin panel: `http://127.0.0.1:8000/admin`

Tidak ada prefix `/backend/` pada URL halaman.

## Data yang sudah terhubung
- **Portfolio:** tambah/edit/hapus di admin -> PostgreSQL -> tampil di halaman Portfolio landing page.
- **Jadwal Pertemuan:** user submit booking -> PostgreSQL -> muncul di menu Jadwal Temu admin; slot pending/confirmed tidak bisa dibooking dua kali.
- **Pesan:** form Hubungi Kami -> PostgreSQL -> muncul di menu Pesan admin; status dibaca tersimpan.
- **Pengaturan perusahaan:** perubahan admin tersimpan di PostgreSQL dan dipakai landing page untuk nama perusahaan/kontak/alamat yang relevan.
- **Klien & Tim:** dibaca dari PostgreSQL (sesuai UI asli yang hanya menampilkan data, tidak menyediakan tombol CRUD).
- **Login admin:** session Laravel, password di-hash.

## Login awal
- Email: `admin@ksn.co.id`
- Password: `admin123`

Ganti password seed untuk deployment produksi.

## Instalasi PostgreSQL
Buat database:

```sql
CREATE DATABASE ksn_db;
```

Lalu dari folder project:

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Di Linux/macOS ganti `copy` menjadi `cp`.

Jika password PostgreSQL Anda bukan `postgres`, edit `.env`:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=ksn_db
DB_USERNAME=postgres
DB_PASSWORD=PASSWORD_POSTGRES_ANDA
```

## Catatan
File HTML asli disimpan di folder `originals/` sebagai pembanding. `resources/views/landing.blade.php` dan `resources/views/admin.blade.php` mempertahankan tampilan asli, lalu hanya menambahkan binding/API untuk backend.

## Email konfirmasi jadwal
Controller sudah memanggil Laravel Mail. Pada `.env.example`, `MAIL_MAILER=log` agar aman untuk lokal; email akan dicatat di log. Untuk pengiriman email sungguhan, isi konfigurasi SMTP/mail provider Anda di `.env` lalu ubah mailer sesuai provider.

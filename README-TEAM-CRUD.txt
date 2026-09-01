CRUD TIM ADMIN PANEL
====================

Fitur:
- Tambah anggota tim
- Edit anggota tim
- Hapus anggota tim
- Upload/ganti/hapus foto (JPG/JPEG/PNG/WebP, maks. 5 MB)
- Nama, jabatan, email, telepon, LinkedIn, bio/profil
- Urutan tampil
- Tampil/sembunyikan dari landing page
- Section Tim Kami di landing page mengambil data langsung dari database

Setelah patch:
1. php artisan migrate
2. php artisan storage:link
3. php artisan optimize:clear

Jangan gunakan migrate:fresh pada database yang sudah berisi data.

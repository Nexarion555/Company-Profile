REVISI PORTFOLIO - CRUD + UPLOAD FOTO

File yang direvisi:
- app/Http/Controllers/AdminController.php
- resources/views/admin.blade.php

Fitur:
- Tambah portfolio dari admin
- Edit portfolio dari admin
- Hapus portfolio dari admin
- Upload foto JPG/JPEG/PNG/WebP, maks. 10 MB
- Preview foto sebelum disimpan
- Saat edit, foto lama tetap dipakai jika tidak memilih foto baru
- Saat mengganti foto, file foto lama di storage dihapus otomatis
- Saat portfolio dihapus, file foto lokal ikut dihapus otomatis
- Data portfolio lama yang masih menggunakan URL gambar tetap dapat ditampilkan
- Field luas/area ikut dapat diedit dari admin

Tidak ada migration baru karena tetap menggunakan kolom image yang sudah ada.

Setelah extract/replace, jalankan:
php artisan storage:link
php artisan optimize:clear

Jika symbolic link public/storage sudah ada, pesan "link already exists" tidak masalah.

Lokasi upload foto:
storage/app/public/portfolios/

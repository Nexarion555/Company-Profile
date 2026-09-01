REVISI CERTIFICATION
====================

1. Extract isi ZIP ini ke root project Company-Profile dan timpa file yang sama.
2. Jalankan:
   php artisan migrate
   php artisan optimize:clear
3. Buka /admin lalu gunakan menu Sertifikasi.
4. Data Sertifikasi yang ditambah/edit/hapus dari admin akan tampil pada halaman Tentang dan badge Sertifikasi di footer.

Catatan:
- Jangan jalankan migrate:fresh pada database yang sudah berisi data karena akan menghapus tabel/data.
- php artisan db:seed hanya diperlukan jika ingin memasukkan data demo dari DatabaseSeeder.

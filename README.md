# easyinventory

easyinventory adalah aplikasi berbasis web yang digunakan untuk memantau stock gudang


## Minimum Requirement

- [x] PHP 8.1 keatas dan extension yang diperlukan selama instalasi menggunakan composer
- [x] Mysql Database minimal versi 8
- [x] Web Server (Apache, Nginx atau IIS)

**NOTE**:

- [x] Sistem ini dikembangkan menggunakan lingkungan pengembangan Linux, pengembang tidak menjamin jika sistem ini dapat berjalan dengan baik pada sistem operasi lain.
- [x] Walaupun dapat berjalan pada DB Engine lain selain MySQL, namun sistem ini hanya mensupport untuk database MySQL.

## Fitur

- [x] Manajemen Gudang
- [x] Manajemen Lokasi Penyimpanan
- [x] Manajemen User
- [x] Manajemen Role
- [x] Manajemen Product
- [x] Manajemen Barang Masuk
- [x] Manajemen Barang Keluar
- [x] Stock Product
- [x] Stock Opname
- [x] History Mutasi Barang
- [x] Soft Delete (data tidak benar-benar dihapus)

## Cara Install (Manual)

- [x] Clone/Download repository `git clone https://github.com/pandigresik/easyinventory.git` dan pindah ke folder `easyinventory`
- [x] Jalankan [Composer](https://getcomposer.org/download) Install/Update `composer install --ignore-platform-reqs` jika menggunakan php versi 8.1 keatas
- [x] Buat database misal easyinventory
- [x] `composer run post-root-package-install` untuk generate file .env
- [x] konfigurasi setting koneksi database pada file .env
- [x] `php artisan key:generate`
- [x] `php artisan migrate`
- [x] `php artisan db:seed`
- [x] Jalankan perintah `php artisan serve` untuk mengaktifkan web server local ( kebutuhan development )
- [x] Buka halaman `localhost:8000`
- [x] Login using username: `admin@admin.com` password:`admin@admin.com`

## Kontributor

Proyek ini dikembangkan oleh [Ahmad Afandi](https://github.com/ppandigresik) dan para [kontributor](https://github.com/pandigresik/easyinventory/graphs/contributors).

## TODO

Untuk apa saja yang sudah dan belum dikerjakan bisa melihat [TODO LIST](TODO.md)

## ROADMAP

Untuk mengetahui roadmap dari aplikasi easyinventory bisa melihat [ROADMAP](ROADMAP.md)

## Lisensi

Proyek ini menggunakan lisensi [MIT](https://tldrlegal.com/license/mit-license) &copy; Ahmad Afandi.
Pastikan Anda memahami kewajiban dan hak Anda sebelum Anda memutuskan untuk menggunakan software ini.

## Donasi

Untuk mensupport proyek ini, Anda dapat memberikan donasi melalui rekening berikut:

## Profesional Support

Bila Anda memerlukan profesional support atau ingin mengadakan kerjasama dengan saya, dapat menghubungi saya melalui:

- Email: [ahmad.afandi85@gmail.com](mailto:ahmad.afandi85@gmail.com)
- WA: 0857-3365-9400
- FB: [Pandigresik](https://facebook.com/pandi.cerme)

## Keamanan Aplikasi

Jika Anda menemukan bug/celah keamaan pada aplikasi ini, Anda dapat mengirimkan email dengan subject: **[easyinventory][security] SUBJECT** ke alamat [ahmad.afandi85@gmail.com](mailto:ahmad.afandi85@gmail.com)



Butuh lebih banyak screenshot? silahkan cek folder [preview](preview)
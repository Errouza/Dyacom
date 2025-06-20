<p align="center">
  <img src="https://via.placeholder.com/150x50?text=DYACOM+LOGO" alt="Dyacom Logo" width="200">
  <h1 align="center">Sistem Manajemen Penjualan Dyacom</h1>
  <p align="center">
    Aplikasi manajemen penjualan dan inventaris untuk toko komputer
    <br>
    Dibangun dengan Laravel 10 dan Tailwind CSS
  </p>
  
  [![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com/)
  [![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com/)
  [![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
  [![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
  [![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](https://opensource.org/licenses/MIT)
</p>

## 🚀 Tentang Aplikasi

Sistem Manajemen Penjualan Dyacom adalah aplikasi berbasis web yang dirancang untuk membantu manajemen operasional toko komputer. Aplikasi ini mencakup fitur manajemen produk, transaksi penjualan, pembuatan invoice, dan laporan keuangan.

## ✨ Fitur Utama

### 📦 Manajemen Produk
- Tambah, edit, dan hapus produk
- Manajemen stok otomatis
- Kategori produk
- Pencarian produk

### 💰 Transaksi Penjualan
- Input transaksi cepat
- Keranjang belanja
- Perhitungan otomatis total belanja
- Diskon dan promo

### 📝 Invoice
- Pembuatan invoice otomatis
- Pencetakan invoice
- Riwayat transaksi
- Pencarian invoice

### 📊 Laporan
- Laporan penjualan harian/bulanan
- Laporan stok barang
- Laporan keuangan

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 10
- **Frontend**: HTML5, Tailwind CSS, JavaScript
- **Database**: MySQL
- **Server**: Apache/Nginx
- **Versi PHP**: 8.1+

## 🚀 Instalasi

### Persyaratan Sistem
- PHP 8.1 atau lebih baru
- Composer
- MySQL 5.7+ atau MariaDB 10.3+
- Node.js & NPM

### Langkah-langkah Instalasi

1. Clone repository:
   ```bash
   git clone https://github.com/username/dyacom.git
   cd dyacom
   ```

2. Install dependensi PHP:
   ```bash
   composer install
   ```

3. Install dependensi JavaScript:
   ```bash
   npm install
   npm run build
   ```

4. Salin file .env:
   ```bash
   cp .env.example .env
   ```

5. Generate key aplikasi:
   ```bash
   php artisan key:generate
   ```

6. Konfigurasi database di file .env:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=dyacom
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. Jalankan migrasi dan seeder:
   ```bash
   php artisan migrate --seed
   ```

8. Jalankan server:
   ```bash
   php artisan serve
   ```

9. Buka browser dan akses:
   ```
   http://localhost:8000
   ```

## 🔐 Login Default

- **Email**: admin@dyacom.com
- **Password**: password

## 📝 Panduan Penggunaan

### 1. Manajemen Produk
- Masuk ke menu "Produk"
- Klik "Tambah Produk" untuk menambahkan produk baru
- Gunakan fitur pencarian untuk menemukan produk dengan cepat

### 2. Transaksi Baru
- Masuk ke menu "Penjualan"
- Tambahkan produk ke keranjang
- Atur jumlah dan diskon jika ada
- Klik "Bayar" untuk menyelesaikan transaksi

### 3. Cetak Invoice
- Masuk ke menu "Invoice"
- Cari transaksi yang ingin dicetak
- Klik ikon printer untuk mencetak invoice

## 🤝 Berkontribusi

Kontribusi sangat diterima! Silakan buat issue terlebih dahulu untuk mendiskusikan perubahan yang ingin Anda buat.

1. Fork Project
2. Buat Branch Fitur (`git checkout -b fitur/namafitur`)
3. Commit Perubahan (`git commit -m 'Menambahkan fitur baru'`)
4. Push ke Branch (`git push origin fitur/namafitur`)
5. Buka Pull Request

## 📄 Lisensi

Proyek ini dilisensikan di bawah Lisensi MIT - liuh file [LICENSE](LICENSE) untuk detail lebih lanjut.

## 💡 Dikembangkan Oleh

- Tim Pengembang Dyacom
- Email: info@dyacom.com
- Website: [www.dyacom.com](https://www.dyacom.com)

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

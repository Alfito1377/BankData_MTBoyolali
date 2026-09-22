🚀 Bank Data

📋 Prasyarat (Prerequisites)
Sebelum menjalankan proyek ini, pastikan komputer Anda telah terinstal beberapa software berikut:

PHP (Versi sesuai kebutuhan proyek, misal: PHP 8.2 atau yang terbaru)

Composer (Manajer dependensi PHP)

Node.js & NPM (Untuk kompilasi aset frontend seperti Vite / Tailwind CSS)

MySQL / MariaDB (Sebagai sistem manajemen database)

Git (Untuk version control)

🛠️ Panduan Instalasi & Setup (Step-by-Step)
Ikuti langkah-langkah di bawah ini secara berurutan untuk menyiapkan proyek di lingkungan lokal:

1. Clone Repository
Buka terminal/command prompt Anda, lalu jalankan perintah berikut untuk mengunduh proyek dari GitHub:

Bash
git clone https://github.com/username/nama-repository.git
2. Masuk ke Direktori Proyek
Pindahkan posisi terminal ke folder proyek yang baru saja di-clone:

Bash
cd nama-repository
3. Instal Dependensi PHP (Composer)
Instal semua pustaka/library PHP yang dibutuhkan oleh proyek melalui Composer:

Bash
composer install
4. Konfigurasi File Lingkungan (.env)
Duplikat file .env.example menjadi .env untuk mengatur konfigurasi lokal Anda (seperti koneksi database):

Bagi pengguna Linux/macOS:

Bash
cp .env.example .env
Bagi pengguna Windows (Command Prompt / PowerShell):

Bash
copy .env.example .env
5. Generate Application Key
Buat kunci enkripsi unik untuk aplikasi Laravel Anda:

Bash
php artisan key:generate
6. Konfigurasi Database
Buka file .env menggunakan teks editor pilihan Anda (VS Code, Sublime Text, dll.), lalu sesuaikan pengaturan database pada bagian berikut:

Cuplikan kode
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_lokal
DB_USERNAME=root
DB_PASSWORD=
Pastikan Anda telah membuat database kosong (misal: nama_database_lokal) terlebih dahulu melalui phpMyAdmin atau klien database lainnya.

7. Jalankan Migrasi & Seeder Database
Jalankan perintah migrasi untuk membuat tabel-tabel database, beserta data awal (jika ada):

Bash
php artisan migrate --seed
8. Instal & Build Aset Frontend (Opsional / Jika menggunakan Vite)
Jika proyek menggunakan Laravel Vite atau Laravel Mix untuk asset bundling:

Bash
# Instal dependensi Node.js
npm install

# Menjalankan development server untuk frontend
npm run dev
9. Jalankan Server Lokal Laravel
Terakhir, jalankan server pengembangan bawaan Laravel:

Bash
php artisan serve
Aplikasi Anda kini dapat diakses melalui browser di alamat: [http://127.0.0.1:8000](http://127.0.0.1:8000)

📂 Penempatan File Penting (Directory Structure)
Untuk memudahkan Anda dalam memahami navigasi struktur proyek ini, berikut adalah penjelasan singkat mengenai penempatan file utama:

Plaintext
nama-repository/
├── app/                  # Berisi logika inti aplikasi (Models, Http/Controllers, Middleware)
├── bootstrap/            # Berisi file untuk bootstrapping framework
├── config/               # Berisi seluruh file konfigurasi aplikasi (database, mail, app, dll.)
├── database/             # Berisi migrasi database, model factories, dan database seeders
├── public/               # Titik masuk publik (Public entry point) untuk web server (berisi index.php, aset gambar/CSS/JS yang di-build)
├── resources/            # Berisi view (Blade templates), aset mentah frontend (JS, CSS, SASS)
├── routes/               # Berisi definisi rute aplikasi (web.php, api.php, console.php)
├── storage/              # Berisi file log, cache, dan file yang diunggah oleh pengguna
├── tests/                # Berisi file unit test dan feature test
├── .env                  # File konfigurasi lingkungan lokal (tidak di-commit ke Git)
├── composer.json         # Daftar dependensi PHP proyek
└── package.json          # Daftar dependensi Node.js proyek

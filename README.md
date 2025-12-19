# Keuangan Pribadi (ReKa)

Aplikasi manajemen keuangan pribadi yang memudahkan Anda untuk mencatat, melacak, dan menganalisis transaksi keuangan Anda dengan antarmuka yang responsif dan intuitif.

## 📋 Deskripsi Proyek

**Rekap Keuangan (ReKa)** adalah aplikasi web yang dirancang untuk membantu pengguna mengelola keuangan pribadi mereka dengan mudah. Aplikasi ini memungkinkan Anda untuk mencatat setiap transaksi, baik pemasukan maupun pengeluaran, serta memberikan laporan dan analisis untuk membantu membuat keputusan keuangan yang lebih baik.

Dibangun dengan **Laravel 12** dan **Tailwind CSS v4**, aplikasi ini menawarkan pengalaman pengguna yang modern dengan antarmuka yang responsif dan dapat diakses di semua perangkat.

## ✨ Fitur-Fitur Utama

### 1. **Manajemen Transaksi**
   - ✅ Tambah transaksi baru (pemasukan/pengeluaran)
   - ✅ Edit transaksi yang sudah ada
   - ✅ Hapus transaksi
   - ✅ Kategorisasi otomatis transaksi
   - ✅ Tambahkan deskripsi/keterangan untuk setiap transaksi

### 2. **Dashboard Interaktif**
   - 📊 Ringkasan statistik keuangan (total pemasukan, pengeluaran, saldo)
   - 📈 Visualisasi data transaksi terbaru
   - 🎯 Tampilan yang responsif untuk semua ukuran layar

### 3. **Daftar Transaksi**
   - 📋 Tampilan tabel untuk desktop
   - 📱 Tampilan kartu untuk mobile
   - 🔍 Fitur pencarian dan filter berdasarkan kategori dan jenis
   - 💾 Akses cepat untuk edit dan hapus transaksi

### 4. **Laporan Keuangan**
   - 📑 Laporan detail transaksi
   - 💾 Cetak laporan detail transaksi berupa file pdf
   - 💼 Laporan berdasarkan kategori

### 5. **Fitur Keamanan**
   - 🔐 Autentikasi pengguna yang aman
   - 👤 Manajemen profil pengguna
   - 🔒 Perlindungan CSRF token
   - 📱 Session management yang handal

### 6. **Tampilan Modern**
   - 📱 Desain responsif dan mobile-first
   - ⚡ Animasi dan transisi yang smooth
   - 🎨 Tailwind CSS v4 dengan custom utilities

## 🚀 Cara Menjalankan Website (Setup)

### Prasyarat
Sebelum memulai, pastikan Anda sudah menginstal:
- **PHP 8.3** atau lebih tinggi
- **Composer** (untuk package manager PHP)
- **Node.js** dan **npm** (untuk JavaScript dependencies)
- **Database** (MySQL/MariaDB atau SQLite)

### Langkah-Langkah Setup

#### 1. Clone Repository
```bash
git clone <repository-url>
cd keuangan_pribadi
```

#### 2. Install PHP Dependencies
```bash
composer install
```

#### 3. Setup Environment
```bash
cp .env.example .env
```

Kemudian edit file `.env` dan sesuaikan konfigurasi database:
```
DB_CONNECTION=mysql (jika memakai mysql)
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=keuangan_pribadi
DB_USERNAME=root
DB_PASSWORD= (masukkan password jika ada)
```

#### 4. Generate Application Key
```bash
php artisan key:generate
```

#### 5. Install JavaScript Dependencies
```bash
npm install
```

#### 6. Jalankan Database Migration
```bash
php artisan migrate
```

Jika ingin menambahkan data dummy untuk testing:
```bash
php artisan migrate:fresh --seed
```

#### 7. Build Assets
```bash
npm run build
```

#### 8. Jalankan Development Server

**Terminal 1 - Artisan Server:**
```bash
php artisan serve
```

**Terminal 2 - Vite Dev Server:**
```bash
npm run dev
```

Aplikasi akan dapat diakses di `http://localhost:8000`

### Alternatif: Menggunakan Laragon

Jika Anda menggunakan **Laragon**, ikuti langkah berikut:

1. Pindahkan folder proyek ke direktori Laragon (`C:\laragon\www\keuangan_pribadi`)
2. Jalankan Laragon dan mulai Apache + MySQL
3. Buka terminal di folder proyek
4. Jalankan langkah-langkah di atas (dari langkah 2 hingga 8)
5. Akses aplikasi di `http://localhost` atau sesuai konfigurasi Laragon Anda

## 📁 Struktur Proyek

```
keuangan_pribadi/
├── app/                      # Aplikasi logic
│   ├── Http/Controllers/     # Controllers
│   └── Models/               # Database models
├── database/
│   ├── migrations/           # Database migrations
│   ├── factories/            # Model factories
│   └── seeders/              # Database seeders
├── resources/
│   ├── css/                  # Tailwind CSS
│   ├── js/                   # JavaScript
│   └── views/                # Blade templates
├── routes/                   # Application routes
├── public/
│   └── images/               # Logo dan gambar
├── storage/                  # File storage
├── config/                   # Configuration files
└── composer.json             # PHP dependencies
```

## 🔧 Teknologi yang Digunakan

- **Backend:** Laravel 12
- **Frontend:** Blade Templating, Tailwind CSS v4
- **Database:** MySQL
- **Build Tool:** Vite
- **JavaScript:** Vanilla JS
- **Package Manager:** Composer, npm


## 📄 Lisensi

Aplikasi ini dilisensikan di bawah lisensi MIT. Lihat file [LICENSE](LICENSE) untuk detailnya.

## 👨‍💻 Kontribusi

Kontribusi sangat diterima! Silakan fork repository ini dan buat pull request untuk fitur atau perbaikan bug.

## 📞 Dukungan

Jika Anda mengalami masalah atau memiliki pertanyaan, silakan buat issue di repository ini.

---

** Happy budgeting! **

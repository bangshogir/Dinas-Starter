# PROJECT BLUEPRINT: SISTEM INFORMASI DISKUMINDAG

**Teknologi:** Laravel 11 | Livewire 3 | Tailwind CSS | MySQL
**Target Deployment:** Shared Hosting (No Terminal Access)
**UI Template:** TailAdmin (Free)

---

## FASE 1: PERSIAPAN & ARSITEKTUR (Minggu 1)

*Karena server produksi terbatas, arsitektur harus "Portable".*

### 1.1 Tech Stack Selection

- **Backend:** Laravel Framework
- **Frontend:** Livewire 3 - Memungkinkan UI interaktif (real-time search, dynamic form) tanpa menulis JavaScript kompleks
- **UI Library:** TailAdmin (Free Version)
  - Jenis: Admin Template
  - Kelebihan: Layout (Sidebar/Header) sudah jadi. Tinggal isi konten. Sangat direkomendasikan untuk mengejar deadline Dashboard Admin
- **Tech:** Native Tailwind CSS & Alpine.js
- **Testing:** Pest
  - Alasan: Modern, sintaks lebih bersih, dan memiliki integrasi first-class dengan Livewire 3. Sangat cocok untuk menulis unit test dan feature test dengan cepat
- **Database:** MySQL

### 1.2 Skema Database (Fokus Awal)

Untuk tahap awal (Auth & Dashboard), kita butuh tabel berikut:

- **users:** Standard Laravel table
- **roles:** Menggunakan library Spatie Permission (Super Admin, Operator Bidang, Kepala Dinas)
- **profiles:** Menyimpan NIP, Jabatan, Bidang (Relasi ke users)

### 1.3 Struktur Folder (Lokal vs Hosting)

Di lokal, struktur standar. Di hosting, kita akan memisahkan folder public dengan folder inti Laravel demi keamanan:

```
public_html/ (Isi dari folder public laravel)
laravel_core/ (Sisa folder project: app, config, vendor, dll)
```

---

## FASE 2: PENGEMBANGAN INTI (LOKAL) (Minggu 2)

*Lakukan semua ini di komputer lokal (Localhost).*

### 2.1 Instalasi & Setup

```bash
Install Laravel: composer create-project laravel/laravel diskumindag-app
Setup Database di .env lokal
```

### 2.2 Autentikasi & Livewire Setup

Kita akan menggunakan Laravel Breeze dengan stack Livewire:

```bash
composer require laravel/breeze --dev
php artisan breeze:install
```

Pilihan:
- Stack: Livewire (Functional/Volt atau Class based)
- Fitur: Dark mode (Yes), SSR (No/False)
- Testing framework: Pest

### 2.3 Role & Permission (RBAC)

Install Spatie Laravel Permission:

```bash
composer require spatie/laravel-permission
```

- Publish config & migration
- Buat Seeder untuk Role: Admin, Operator Pasar, Operator UMKM

### 2.4 Integrasi Template TailAdmin (Step-by-Step)

Tugas utama Anda adalah memindahkan "kulit" TailAdmin ke dalam struktur Laravel.

#### Download & Extract
Unduh TailAdmin Free Version.

#### Asset Management
- Copy folder gambar/icon dari source TailAdmin ke public/images di Laravel

#### ⚠️ PENTING (CSS)
Jangan copy file .css jadi TailAdmin mentah-mentah. Sebaliknya, buka file `tailwind.config.js` di project Laravel Anda, dan sesuaikan warnanya agar mirip dengan konfigurasi TailAdmin, atau copy custom configuration dari `tailwind.config.js` milik TailAdmin ke milik Anda. Ini agar `npm run build` bisa memproses class-nya dengan benar.

#### ⚠️ Alpine.js Warning
TailAdmin biasanya menyertakan Alpine.js sendiri. **JANGAN** include script JS bawaan TailAdmin yang memuat Alpine lagi, karena Laravel Breeze/Livewire sudah otomatis memuat Alpine.js.

Gunakan hanya HTML dan CSS-nya, biarkan Livewire menangani interaktivitas Alpine-nya.

#### Pecah Layout (`resources/views/layouts/app.blade.php`)

1. Ambil struktur `<body>` dari `index.html` TailAdmin
2. Identifikasi bagian Sidebar → Pindahkan ke `resources/views/livewire/layout/sidebar.blade.php`
3. Identifikasi bagian Header/Navbar → Pindahkan ke `resources/views/livewire/layout/header.blade.php`
4. Pastikan variabel `{{ $slot }}` ditempatkan di area konten utama (di dalam tag `<main>`)

---

## FASE 3: FITUR DASHBOARD DENGAN LIVEWIRE (Minggu 3)

### 3.1 Dashboard Home (Livewire Component)

```bash
php artisan make:livewire Dashboard
```

- **View:** Copy HTML "Cards" (Kotak statistik 4 biji di atas) dari TailAdmin
- **Logic:** Mengambil data count (jumlah UMKM, Pasar) di method `mount()`

### 3.2 Manajemen User (Full Livewire CRUD)

```bash
php artisan make:livewire Users.Index
```

#### Search
Gunakan komponen Input dari TailAdmin, tambahkan `wire:model.live="search"`

#### Table
- Gunakan struktur tabel HTML dari TailAdmin
- Bungkus `foreach user` di dalam `<tbody>`
- Tambahkan pagination `$users->links()`

#### Modal (Create/Edit)
- Gunakan Alpine.js untuk state modal (`x-data="{ open: false }"`)
- Copy desain Modal dari dokumentasi TailAdmin/Flowbite, sesuaikan class-nya

### 3.3 Menu Bidang (Contoh: Data UMKM)

```bash
php artisan make:livewire Umkm.Manager
```

- **Fitur:** CRUD Data UMKM + Upload Foto
- **Upload:** Livewire menangani upload file dengan `Use WithFileUploads`
- **Tips Hosting:** Gunakan script symlink generator saat deploy agar gambar tampil

---

## FASE 4: PRE-DEPLOYMENT (KRUSIAL UNTUK SHARED HOSTING)

Sebelum upload, lakukan ini di lokal:

- **Matikan Debug:** Set `APP_DEBUG=false` di .env
- **Optimize Autoloader:** `composer install --optimize-autoloader --no-dev`
- **Build Assets:** `npm run build` (Wajib)
- **Livewire Publish:** `php artisan livewire:publish --assets` (Penting untuk shared hosting agar JS Livewire tidak 404)
- **Database Export:** Export .sql

---

## FASE 5: DEPLOYMENT MANUAL (Minggu 4)

*Karena tidak ada SSH, kita lakukan cara manual yang aman.*

### 5.1 Struktur Direktori Server

Target di File Manager cPanel:

```
/ (Root Directory Hosting)
├── diskumindag_core/  <-- Upload semua file project Laravel KECUALI folder public
└── public_html/       <-- Upload ISI folder public Laravel di sini
```

### 5.2 Upload File

1. Zip folder project (kecuali node_modules)
2. Upload ke `diskumindag_core`
3. Pindahkan isi folder public ke `public_html`

### 5.3 Konfigurasi index.php

Edit `public_html/index.php`:

```php
require __DIR__.'/../diskumindag_core/vendor/autoload.php';
$app = require __DIR__.'/../diskumindag_core/bootstrap/app.php';
```

### 5.4 Database & Environment

1. Import SQL via phpMyAdmin
2. Edit .env di `diskumindag_core`:
   - DB Credentials
   - `APP_URL=https://domain-anda.go.id` (Wajib setup benar agar Livewire berjalan)

### 5.5 Symlink Storage

Jalankan script `symlink_generator.php` sekali saja via browser.

---

## FASE 6: MAINTENANCE

- **Update kode:** Edit lokal → Upload file spesifik
- **Update tampilan:** Edit lokal → `npm run build` → Upload folder `public/build` & `resources/views`
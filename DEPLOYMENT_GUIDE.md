# Panduan Master Deployment ke Shared Hosting Terbatas

Panduan ini mencakup semua kendala dan solusi untuk deploy Laravel ke shared hosting tanpa akses terminal (seperti CWP, cPanel dengan fitur terbatas).

---

## Checklist Pre-Deployment (Di Laptop)

### 1. Build Assets
```bash
npm run build
```

### 2. Fix Database Config
Edit `config/database.php`, ubah collation default:
```php
'collation' => env('DB_COLLATION', 'utf8mb4_general_ci'),
```

### 3. Export Database
Gunakan HeidiSQL/phpMyAdmin dengan opsi:
- Tables: `DROP` ☑️ dan `CREATE` ☑️
- Data: `Delete + Insert`

### 4. Fix File SQL
Jalankan Find & Replace di file SQL:

| Find | Replace With |
|------|--------------|
| `utf8mb4_0900_ai_ci` | `utf8mb4_general_ci` |
| `varchar(255)` | `varchar(191)` |
| ` json ` | ` longtext ` |

### 5. Buat File ZIP
Buat 2 file ZIP terpisah:
- `deploy_app.zip`: folder `app`, `bootstrap`, `config`, `database`, `public`, `resources`, `routes`, `storage`, + file root (`artisan`, `composer.json`, dll)
- `deploy_vendor.zip`: folder `vendor` saja

---

## Langkah Upload ke Hosting

### 1. Struktur Folder
```
/home/username/
├── public_html/          <- Isi folder public Laravel
└── dinas_core/           <- Folder Laravel (tanpa public)
```

### 2. Upload & Extract
1. Upload kedua ZIP ke folder `dinas_core`
2. Extract keduanya
3. Pindahkan **isi** folder `public` ke `public_html`

### 3. Edit index.php (di public_html)
```php
<?php
use Illuminate\Http\Request;
define('LARAVEL_START', microtime(true));

if (file_exists($maintenance = __DIR__.'/../dinas_core/storage/framework/maintenance.php')) {
    require $maintenance;
}

require __DIR__.'/../dinas_core/vendor/autoload.php';

(require_once __DIR__.'/../dinas_core/bootstrap/app.php')
    ->handleRequest(Request::capture());
```

### 4. Buat File .env
Upload `.env.example` ke `dinas_core`, rename jadi `.env`, edit:
```env
APP_NAME=NamaAplikasi
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:xPjrB8R/Vq3uKzNcNVxO5RgTJs8pIk4lQz6YnWz/YQE=
APP_URL=https://domain-anda.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_DATABASE=nama_db
DB_USERNAME=user_db
DB_PASSWORD=pass_db
```

### 5. Import Database
- Buka phpMyAdmin
- Pilih database
- Import file SQL yang sudah di-fix

### 5.1 Jalankan SQL Tambahan (Performance Indexes)
Setelah import, jalankan query berikut di tab SQL phpMyAdmin:
```sql
ALTER TABLE `products` ADD INDEX `products_is_active_index` (`is_active`);
ALTER TABLE `products` ADD INDEX `products_product_category_id_index` (`product_category_id`);
```

---

## Script Helper (Buat di public_html, hapus setelah selesai)

### fix_permissions.php
```php
<?php
set_time_limit(300);
$basePath = '/home/username/dinas_core';

function fixPermissions($path) {
    if (!is_dir($path)) return 0;
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );
    $count = 0;
    foreach ($iterator as $item) {
        @chmod($item->getPathname(), $item->isDir() ? 0755 : 0644);
        $count++;
    }
    return $count;
}

foreach (['app','bootstrap','config','database','resources','routes','storage','vendor'] as $folder) {
    echo "Fixing $folder... ";
    echo fixPermissions($basePath.'/'.$folder) . " items<br>";
}

@chmod($basePath.'/storage', 0775);
@chmod($basePath.'/bootstrap/cache', 0775);
echo "<br>✅ Done!";
```

### fix_build.php
```php
<?php
$publicPath = '/home/username/dinas_core/public';
if (!is_dir($publicPath)) mkdir($publicPath, 0755, true);

$source = '/home/username/public_html/build';
$dest = '/home/username/dinas_core/public/build';

if (!is_dir($dest)) {
    symlink($source, $dest);
    echo "✅ Build folder linked!";
}
```

### create_assets.php
```php
<?php
set_time_limit(300);
$source = '/home/username/public_html/storage';
$dest = '/home/username/public_html/assets';

function copyDir($src, $dst) {
    $dir = opendir($src);
    @mkdir($dst, 0755, true);
    while (($file = readdir($dir))) {
        if ($file != '.' && $file != '..') {
            is_dir($src.'/'.$file) 
                ? copyDir($src.'/'.$file, $dst.'/'.$file) 
                : copy($src.'/'.$file, $dst.'/'.$file);
        }
    }
    closedir($dir);
}

if (!is_dir($dest)) mkdir($dest, 0755, true);
copyDir($source, $dest);
echo "✅ Assets folder created!";
```

### copy_storage.php
```php
<?php
set_time_limit(300);
$source = '/home/username/dinas_core/storage/app/public';
$dest = '/home/username/public_html/storage';

if (is_link($dest)) unlink($dest);

function copyDir($src, $dst) {
    $dir = opendir($src);
    @mkdir($dst, 0755, true);
    while (($file = readdir($dir))) {
        if ($file != '.' && $file != '..') {
            is_dir($src.'/'.$file) 
                ? copyDir($src.'/'.$file, $dst.'/'.$file) 
                : copy($src.'/'.$file, $dst.'/'.$file);
        }
    }
    closedir($dir);
}

if (!is_dir($dest)) mkdir($dest, 0755, true);
copyDir($source, $dest);
echo "✅ Storage files copied!";
```

---

## Urutan Eksekusi Script

1. Upload semua file
2. Import database
3. Akses `fix_permissions.php`
4. Akses `fix_build.php`
5. Akses `copy_storage.php`
6. Akses `create_assets.php`
7. Test website
8. **HAPUS semua file .php helper!**

---

## Troubleshooting

| Error | Solusi |
|-------|--------|
| `Unknown collation: utf8mb4_0900_ai_ci` | Replace di file SQL dengan `utf8mb4_general_ci` |
| `Key was too long (767 bytes)` | Replace `varchar(255)` dengan `varchar(191)` |
| `Unknown column type: json` | Replace ` json ` dengan ` longtext ` |
| `Permission denied` | Jalankan `fix_permissions.php` |
| `Vite manifest not found` | Jalankan `fix_build.php` |
| Gambar tidak tampil | Jalankan `copy_storage.php` dan `create_assets.php` |
| Error 500 tanpa detail | Set `APP_DEBUG=true` di `.env` sementara |

---

## Tips Untuk Deployment Berikutnya

1. **Gunakan hosting yang lebih baik** jika memungkinkan (dengan SSH access)
2. **Simpan file SQL yang sudah di-fix** sebagai template
3. **Buat script deployment otomatis** yang menjalankan semua fix sekaligus
4. **Backup database hosting** sebelum update

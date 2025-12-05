# Rencana Warna Web Dinas (Public Homepage)

## Filosofi Desain
Warna yang dipilih mencerminkan identitas instansi pemerintah yang **Profesional**, **Terpercaya**, dan **Melayani**.

## Palet Warna

### 1. Primary (Warna Utama)
- **Nama**: `dinas-primary`
- **Warna**: **Deep Royal Blue** (`#1e3a8a` / Tailwind `blue-900`)
- **Penggunaan**: Navbar, Footer, Tombol Utama, Judul Bagian.
- **Makna**: Kepercayaan, Stabilitas, Otoritas.

### 2. Secondary (Warna Aksen)
- **Nama**: `dinas-secondary`
- **Warna**: **Golden Amber** (`#d97706` / Tailwind `amber-600`)
- **Penggunaan**: Highlight angka statistik, Badge, Hover state, Ikon penting.
- **Makna**: Kesejahteraan, Kemakmuran, Energi.

### 3. Background (Latar Belakang)
- **Light Mode**: `slate-50` (Putih tulang yang bersih)
- **Dark Mode**: `slate-900` (Biru malam yang elegan)

### 4. Typography (Teks)
- **Headings**: `slate-900` (Dark) / `white` (Light)
- **Body**: `slate-600` (Dark) / `slate-300` (Light)

## Implementasi Teknis
1.  Update `tailwind.config.js` untuk menambahkan custom colors.
2.  Refactor `welcome.blade.php` dan `public.blade.php` untuk menggunakan class `bg-dinas-primary`, `text-dinas-secondary`, dll.

# Rencana Standarisasi Tombol (Public Homepage)

## Filosofi Desain
Tombol harus konsisten dalam hal bentuk, ukuran, dan interaksi untuk memberikan pengalaman pengguna yang intuitif.

## Spesifikasi Style

### 1. Bentuk (Shape)
- **Rounded**: `rounded-full` (Memberikan kesan modern, ramah, dan dinamis).

### 2. Ukuran (Size)
- **Small (Navbar/Mobile)**: `px-5 py-2.5 text-sm`
- **Medium (Default)**: `px-6 py-3 text-base`
- **Large (Hero/CTA)**: `px-8 py-4 text-lg`

### 3. Varian Warna

#### A. Primary Button (Aksi Utama)
- **Background**: `bg-dinas-primary`
- **Text**: `text-white`
- **Hover**: `hover:bg-blue-800`
- **Focus**: `focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900`
- **Shadow**: `shadow-lg hover:shadow-xl`
- **Transition**: `transition-all transform hover:-translate-y-0.5`

#### B. Secondary Button (Aksi Alternatif / Light Background)
- **Background**: `bg-white`
- **Text**: `text-dinas-primary`
- **Hover**: `hover:bg-gray-50`
- **Border**: `border border-gray-200` (Opsional, jika di atas background putih)
- **Shadow**: `shadow-md hover:shadow-lg`

#### C. Outline/Ghost Button (Background Gelap)
- **Background**: `bg-transparent` (atau `bg-white/10` untuk glassmorphism)
- **Text**: `text-white`
- **Border**: `border-2 border-white/30`
- **Hover**: `hover:bg-white/10`

## Rencana Implementasi

### 1. Navbar (`layouts/public.blade.php`)
- **Login/Dashboard**: Gunakan **Primary Button (Small)**.

### 2. Hero Section (`welcome.blade.php`)
- **Layanan Kami**: Gunakan **Secondary Button (Large)** (Karena background hero biru gelap).
- **Berita Terkini**: Gunakan **Outline Button (Large)**.

### 3. News Section (`welcome.blade.php`)
- **Lihat Semua Berita**: Gunakan **Primary Button (Medium)**.

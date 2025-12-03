# Rencana Implementasi Fitur Profil Dinas

## Overview
Menambahkan fitur Profil Dinas untuk Super Admin dan Admin dengan kemampuan menginput data kantor dan upload logo menggunakan template TailAdmin yang sudah ada.

## Database Schema
- **File**: `database/migrations/2025_12_03_000001_create_profil_dinas_table.php`
- **Fields**: nama_dinas, sub_title, alamat_kantor, nomor_telepon, email, social media links, logo_tanpa_text, logo_dengan_text

## Core Files to Create
1. **Model**: `app/Models/ProfilDinas.php`
2. **Controller**: `app/Http/Controllers/Admin/ProfilDinasController.php`
3. **Views**:
   - `resources/views/admin/profil-dinas.blade.php` (display)
   - `resources/views/admin/profil-dinas-edit.blade.php` (form)
4. **Seeder**: `database/seeders/ProfilDinasPermissionSeeder.php`

## Routes to Add
- `GET admin/profil-dinas` - View profil (permission: profil-dinas.read)
- `GET admin/profil-dinas/edit` - Edit form (permission: profil-dinas.update)
- `PUT admin/profil-dinas` - Update profil (permission: profil-dinas.update)
- `POST admin/profil-dinas/upload-logo` - Upload logo (permission: profil-dinas.update)

## Implementation Steps
1. **Database Layer**: Create migration & model
2. **Permission Setup**: Add permissions & assign to roles
3. **Controller Logic**: Implement CRUD with file upload
4. **View Integration**: Use TailAdmin components
5. **Update Sidebar**: Fix menu link
6. **File Storage**: Setup upload directory & validation

## Key Features
- Form input menggunakan TailAdmin components
- File upload dengan preview (logo dengan/without text)
- Validasi data & file upload
- Permission-based access control
- Responsive design dengan TailAdmin styling

## File Dependencies
- Menggunakan layout `layouts.admin` yang sudah ada
- Mengikuti route pattern dari `routes/web.php`
- Menggunakan permission system dari Spatie package
- Mengintegrasikan dengan sidebar menu yang sudah ada

## Security & Validation
- All routes protected dengan authentication
- Permission-based access for Super Admin & Admin
- File upload validation (jpg, png, svg, max 2MB)
- XSS protection untuk text inputs
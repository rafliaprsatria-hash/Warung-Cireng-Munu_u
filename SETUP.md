# Warung Cireng Munu'u - Setup Instructions

## ✅ Fitur Lengkap
- ✨ Landing Page dengan demo menu
- 🛒 Menu Page dengan card produk
- 🔐 Admin Login System
- 📝 CRUD Admin Dashboard (Create, Read, Update, Delete)
- 💬 Integrasi WhatsApp untuk pemesanan
- 🖼️ Upload custom image link

## 🔧 Setup Database

### 1. Pastikan MySQL Running
Buka Terminal/CMD dan pastikan MySQL sudah jalan:
```bash
mysql -u root -p
```

### 2. Buat Database
Buat database baru:
```sql
CREATE DATABASE warung_cireng;
```

### 3. Configure .env
Edit file `.env` di root project:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=warung_cireng
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Install Dependencies
```bash
composer install
npm install
```

### 5. Generate APP_KEY
```bash
php artisan key:generate
```

### 6. Run Migrations
```bash
php artisan migrate
```

### 7. Seed Database (Create Admin User)
```bash
php artisan db:seed
```

### 8. Start Development Server
Terminal 1 - Run Laravel:
```bash
php artisan serve
```

Terminal 2 - Run Vite (untuk assets):
```bash
npm run dev
```

## 🔐 Login Credentials

**Email:** admin@example.com  
**Password:** password

## 📱 Cara Menggunakan

### 1. **Home Page** (/)
- Lihat landing page Warung Cireng
- Klik tombol "Lihat Menu" untuk pergi ke halaman menu

### 2. **Menu Page** (/menu)
- Lihat semua menu cireng dalam format card
- Setiap card menampilkan: Gambar, Nama, Deskripsi, Harga
- Klik "Pesan Sekarang" untuk langsung chat di WhatsApp

### 3. **Admin Dashboard** (/dashboard - Protected)
- **Login dulu** dengan email dan password di atas
- Lihat semua menu dalam bentuk card

#### ➕ Tambah Menu Baru:
Form hanya meminta 4 field:
- **Harga** (Rp) - Contoh: 12000
- **Link WhatsApp** - Contoh: https://wa.me/62812345678
- **Link Gambar** - URL ke gambar produk
- **Deskripsi** - Deskripsi lengkap menu

#### ✏️ Edit Menu:
- Klik tombol "Edit" pada card menu
- Modal akan terbuka dengan form edit
- Ubah data yang diperlukan dan simpan

#### 🗑️ Hapus Menu:
- Klik tombol "Hapus" pada card menu
- Akan minta konfirmasi sebelum menghapus

#### 💬 WhatsApp Button:
- Di Admin Dashboard, klik tombol "WhatsApp" untuk test link
- Di Menu Page, klik "Pesan Sekarang" untuk hubungi penjual

## 📊 Database Schema

### Table: cirengs
```
- id (Primary Key)
- nama_menu (string) - Nama menu
- harga (integer) - Harga dalam Rp
- deskripsi (text) - Deskripsi produk
- link_wa (string) - Link WhatsApp (https://wa.me/...)
- link_img (string) - URL gambar produk
- stok (integer) - Stok tersedia (optional)
- kategori (string) - Kategori menu (optional)
- timestamps - created_at, updated_at
```

### Table: users
```
- id (Primary Key)
- name (string) - Nama user
- email (string, unique) - Email
- password (string) - Password terenkripsi
- remember_token (optional)
- timestamps
```

## 🚀 Teknologi yang Digunakan

- **Framework**: Laravel 11
- **Database**: MySQL
- **Frontend**: Bootstrap 5.3, Poppins Font
- **Payment Gateway**: WhatsApp Integration
- **Authentication**: Laravel Auth

## 📝 File Penting

- `app/Http/Controllers/AuthController.php` - Login/Logout logic
- `app/Http/Controllers/CirengController.php` - CRUD menu
- `app/Models/Cireng.php` - Model menu
- `app/Models/User.php` - Model user
- `routes/web.php` - Route definitions
- `resources/views/login.blade.php` - Login page
- `resources/views/index.blade.php` - Admin dashboard
- `resources/views/menu.blade.php` - Menu page
- `resources/views/landing.blade.php` - Home page

## ⚠️ Notes

- Password untuk admin adalah **password** (bisa diubah di database)
- Semua field form baru (harga, link_wa, link_img, deskripsi) bersifat **required**
- Link WhatsApp harus format: `https://wa.me/62XXXXX` (dengan country code 62 untuk Indonesia)
- Link gambar harus URL valid (jpg, png, etc)

## 🐛 Troubleshooting

### Error: "Class 'AuthController' not found"
- Pastikan sudah run: `composer dump-autoload`

### Error: "SQLSTATE[42S02]: Table 'cirengs' doesn't exist"
- Jalankan: `php artisan migrate`

### Error: "419 Page Expired"
- Refresh page, CSRF token mungkin expired
- Atau clear cache: `php artisan cache:clear`

### Admin tidak bisa login
- Pastikan sudah jalankan: `php artisan db:seed`
- Cek database apakah user dengan email admin@example.com sudah ada

---

**Happy Coding! 🍴 Cireng Munu'u** 🔥

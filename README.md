# 📋 Sistem Manajemen Data Mahasiswa

**Nama:** [ISI NAMA LENGKAP ANDA]
**NIM:** [ISI NIM ANDA]
**Mata Kuliah:** Pengembangan Aplikasi Basis Data
**Ujian Akhir Semester - Proyek Aplikasi Database**

## 🎯 Deskripsi Proyek
Aplikasi web berbasis PHP dan MySQL untuk mengelola data mahasiswa dengan sistem autentikasi pengguna dan operasi CRUD (Create, Read, Update, Delete) yang lengkap.

## ✨ Fitur Utama
| Fitur | Keterangan |
|-------|------------|
| 🔐 **Sistem Login/Logout** | Multi-level user (admin & user) dengan session management |
| 👥 **Registrasi User** | Pendaftaran pengguna baru dengan validasi |
| 📝 **CRUD Mahasiswa** | Tambah, lihat, edit, hapus data mahasiswa |
| 🔍 **Pencarian Data** | Cari mahasiswa berdasarkan NIM atau nama |
| 📱 **Responsive Design** | Tampilan optimal di desktop dan mobile |
| 📊 **Dashboard Admin** | Interface admin dengan navigasi lengkap |
| 🛡️ **Keamanan** | Password hashing, SQL injection prevention |

## 🏗️ Arsitektur Teknologi
```
Frontend: HTML5, CSS3, JavaScript, Bootstrap 5
Backend:  PHP Native (Procedural)
Database: MySQL
Server:   XAMPP (Apache + MySQL + PHP)
Tools:    phpMyAdmin, Git, GitHub
```

## 📁 Struktur File Proyek
```
DATABASE-MAHASISWA/
│
├── 📄 index.php          # Halaman utama / dashboard
├── 📄 login.php          # Form login sistem
├── 📄 logout.php         # Proses logout & clear session
├── 📄 registrasi.php     # Form pendaftaran user baru
├── 📄 functions.php      # Kumpulan fungsi helper & koneksi DB
├── 📄 detail.php         # Detail informasi mahasiswa
├── 📄 tambah.php         # Form tambah data mahasiswa
├── 📄 ubah.php           # Form edit data mahasiswa
├── 📄 hapus.php          # Proses hapus data mahasiswa
├── 📄 pabd.sql           # Script SQL struktur database
│
├── 📂 ajax/              # Endpoint untuk request AJAX
├── 📂 img/               # File gambar (logo, icons, photos)
├── 📂 js/                # File JavaScript (custom scripts)
│
└── 📄 README.md          # Dokumentasi ini
```

## 🗃️ Struktur Database

### 📊 Tabel `users` (Pengguna)
```sql
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(100),
    email VARCHAR(100),
    level ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### 📊 Tabel `mahasiswa` (Data Mahasiswa)
```sql
CREATE TABLE mahasiswa (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nim VARCHAR(20) UNIQUE NOT NULL,
    nama VARCHAR(100) NOT NULL,
    jurusan VARCHAR(50),
    semester INT,
    jenis_kelamin ENUM('L', 'P'),
    alamat TEXT,
    email VARCHAR(100),
    telepon VARCHAR(15),
    foto VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

## 🚀 Panduan Instalasi Lengkap

### ✅ **Prasyarat Sistem**
1. **XAMPP** versi terbaru (Apache + MySQL + PHP)
2. **Web Browser** (Chrome, Firefox, Edge)
3. **Koneksi Internet** (untuk clone repository)

### 📥 **Langkah 1: Clone Repository**
```bash
git clone https://github.com/olansibermu/DATABASE-MAHASISWA.git
```
Atau download ZIP:
1. Klik tombol **"Code"** → **"Download ZIP"**
2. Extract file ZIP ke folder `htdocs`

### 📂 **Langkah 2: Simpan di XAMPP**
```
Pindahkan folder ke: C:\xampp\htdocs\DATABASE-MAHASISWA
```

### 🗄️ **Langkah 3: Setup Database**
1. **Buka XAMPP Control Panel**
   - Start **Apache**
   - Start **MySQL**

2. **Buka phpMyAdmin**
   - Akses: http://localhost/phpmyadmin

3. **Buat Database Baru**
   ```sql
   CREATE DATABASE db_mahasiswa;
   ```

4. **Import File SQL**
   - Pilih database `db_mahasiswa`
   - Klik tab **"Import"**
   - Pilih file: `DATABASE-MAHASISWA/pabd.sql`
   - Klik **"Go"**

### ⚙️ **Langkah 4: Konfigurasi (Jika Diperlukan)**
Edit file `functions.php` atau `config.php` jika ada:
```php
<?php
$host = "localhost";      // Server database
$user = "root";           // Username MySQL (default XAMPP)
$pass = "";               // Password (kosong untuk XAMPP)
$db   = "db_mahasiswa";   // Nama database
?>
```

### 🌐 **Langkah 5: Jalankan Aplikasi**
Buka browser dan akses:
```
http://localhost/DATABASE-MAHASISWA
```

## 👤 Akun Default untuk Testing

### 🛠️ **Administrator** (Full Access)
```
Username: admin
Password: admin123
```
**Hak Akses:** Semua fitur (CRUD, manajemen user, dll)

### 👥 **User Biasa** (Limited Access)
```
Username: user
Password: user123
```
**Hak Akses:** Hanya lihat data, tidak bisa edit/hapus

## 🔧 Cara Penggunaan Aplikasi

### 1. **Login Sistem**
- Akses http://localhost/DATABASE-MAHASISWA
- Masukkan username & password
- Klik tombol "Login"

### 2. **Dashboard Admin**
Setelah login sebagai admin, Anda dapat:
- ✅ **Lihat Data**: Tabel semua mahasiswa
- ➕ **Tambah Data**: Form input mahasiswa baru
- ✏️ **Edit Data**: Ubah data mahasiswa yang ada
- ❌ **Hapus Data**: Hapus data mahasiswa
- 👥 **Kelola User**: Fitur manajemen pengguna

### 3. **Operasi CRUD Mahasiswa**
| Aksi | File | Deskripsi |
|------|------|-----------|
| **Create** | `tambah.php` | Form input data mahasiswa baru |
| **Read** | `index.php` | Tampilkan semua data mahasiswa |
| **Update** | `ubah.php` | Form edit data mahasiswa |
| **Delete** | `hapus.php` | Proses hapus data (dengan konfirmasi) |

### 4. **Logout**
- Klik menu **"Logout"** di navbar
- Session akan dihapus
- Redirect ke halaman login

## 🐛 Troubleshooting & Solusi

### ❌ **Error: Database Connection Failed**
```php
// Penyebab: Kredensial database salah
// Solusi: Cek di functions.php
$conn = mysqli_connect("localhost", "root", "", "db_mahasiswa");
```

### ❌ **Error: Table 'users' doesn't exist**
```sql
// Penyebab: Database belum diimport
// Solusi: Import ulang pabd.sql di phpMyAdmin
```

### ❌ **Error: Cannot modify header information**
```php
// Penyebab: Ada output sebelum session_start()
// Solusi: Pastikan tidak ada spasi sebelum <?php
```

### ❌ **Halaman Blank Putih**
```php
// Penyebab: Error PHP tidak ditampilkan
// Solusi: Tambahkan di awal file:
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

## 📊 Screenshot Aplikasi
![Halaman Login](img/login-screenshot.png)
*Form login dengan validasi*

![Dashboard Admin](img/dashboard.png)
*Dashboard dengan tabel data mahasiswa*

![Form Tambah Data](img/tambah-data.png)
*Form input data mahasiswa baru*

## 📝 Alur Sistem (DFD Level 0)
```
     +---------------+
     |    ADMIN      |
     +-------+-------+
             |
             v
+---------------------------+
|  SISTEM DATA MAHASISWA    |
|                           |
|  Input: Data Mahasiswa    |
|  Output: Laporan, Info    |
+---------------------------+
             |
             v
     +---------------+
     |   DATABASE    |
     |   MySQL       |
     +---------------+
```

## 📄 Dokumentasi Laporan UAS
Laporan lengkap Ujian Akhir Semester tersedia dalam format PDF yang meliputi:
1. **Latar Belakang Masalah**
2. **Rancangan Database** (ERD, Normalisasi)
3. **Alur Sistem** (DFD Level 0)
4. **Implementasi Antarmuka**
5. **Implementasi Kode Program**
6. **Pengujian Sistem**
7. **Kesimpulan dan Saran**

## 👨‍💻 Informasi Developer
| | |
|---|---|
| **Nama** | [NAMA LENGKAP ANDA] |
| **NIM** | [NIM ANDA] |
| **Program Studi** | [NAMA PRODI] |
| **Universitas** | [NAMA UNIVERSITAS] |
| **Email** | [EMAIL ANDA] |
| **GitHub** | [olansibermu](https://github.com/olansibermu) |

## 📞 Kontak & Support
Untuk pertanyaan atau masalah terkait proyek ini:
- **GitHub Issues**: [Buat Issue Baru](https://github.com/olansibermu/DATABASE-MAHASISWA/issues)
- **Email**: [EMAIL ANDA]
- **Pembimbing**: [NAMA DOSEN PABD]

## 📜 Lisensi & Hak Cipta
Proyek ini dibuat sebagai bagian dari **Ujian Akhir Semester** mata kuliah **Pengembangan Aplikasi Basis Data**. 

**© [TAHUN] - [NAMA ANDA].** 
Dilarang memperbanyak, mendistribusikan, atau memodifikasi tanpa izin penulis.

---
**Dibuat dengan ❤️ untuk memenuhi tugas akademik.**

Berikut adalah contoh README yang rapi dan informatif untuk tugas Laravel kamu yang menampilkan biodata dalam bentuk dashboard dengan dua tab (lihat data dan form tambah):

---

# 📘 Aplikasi CRUD Biodata – Laravel + Vue

Aplikasi ini adalah proyek tugas yang dibuat menggunakan **Laravel 11** sebagai backend dan **Vue.js** untuk frontend. Fitur utamanya adalah menampilkan **data biodata seperti tampilan kartu LinkedIn**, serta form untuk **menambahkan data biodata** pada satu halaman dashboard.

---

## 🔧 Fitur Aplikasi

* 🧑‍💼 Menampilkan data biodata seperti kartu LinkedIn
* ➕ Form input biodata lengkap (nama, jurusan, foto, dsb)
* 🔁 Single Page dengan dua tab:

  * **Tab 1**: Menampilkan daftar biodata dalam bentuk **card**
  * **Tab 2**: Form registrasi biodata baru
* 🌐 Terhubung dengan API Laravel (resource controller)

---

## 🧩 Teknologi yang Digunakan

### Backend:

* Laravel 11
* RESTful API via `apiResource`
* SQLite/MySQL (bebas)

### Frontend:

* Vue.js (Vite / Vue 3)
* Axios untuk komunikasi dengan backend
* TailwindCSS (optional)

---

## 📁 Struktur Project

```
/laravel-backend
  └── routes/
      ├── web.php
      └── api.php
  └── app/
      └── Http/
          └── Controllers/
              └── Api/
                  └── BiodataController.php
  └── resources/
      └── views/
          └── dashboard.blade.php (jika pakai blade)

  bootstrap/
      └── app.php (pastikan `api.php` sudah diregister di sini)
```

---

## 🚀 Menjalankan Aplikasi

### 1. Clone Repository

```bash
git clone https://github.com/namakamu/biodata-dashboard.git
cd biodata-dashboard
```

### 2. Install Dependency Laravel

```bash
composer install
cp .env.example .env
php artisan key:generate
```

### 3. Tambahkan Route API di `bootstrap/app.php`

Tambahkan baris berikut:

```php
->withRouting(
    web: __DIR__.'/../routes/web.php',
    api: __DIR__.'/../routes/api.php', // ← tambahkan ini
    commands: __DIR__.'/../routes/console.php',
    health: '/up',
)
```

### 4. Jalankan Server

```bash
php artisan serve
```

---

## 📡 API Endpoint

| Method | URL                 | Keterangan          |
| ------ | ------------------- | ------------------- |
| GET    | `/api/biodata`      | Ambil semua biodata |
| POST   | `/api/biodata`      | Tambah biodata baru |
| PUT    | `/api/biodata/{id}` | Ubah data biodata   |
| DELETE | `/api/biodata/{id}` | Hapus biodata       |

---

## 📝 Catatan

* Jika `php artisan route:list` tidak menampilkan route dari `api.php`, pastikan `api.php` telah diregister di `bootstrap/app.php`.
* Frontend dapat dikembangkan menggunakan Vue dalam satu halaman dashboard dengan dua tab.
* Data ditampilkan dalam bentuk card seperti LinkedIn (menggunakan struktur div dan class yang menyerupai desain LinkedIn card).

---

## ✨ Preview (Tampilan)

**Tab Data:**

> Kartu biodata dengan gambar profil, nama, headline, dan instansi

**Tab Tambah:**

> Form biodata lengkap (nama, lokasi, headline, dll)

---

## 👤 Pembuat

* **Nama**: Vallery Pulungan
* **Universitas**: Universitas Brawijaya
* **Mata Kuliah**: Pengembangan Aplikasi Web

---


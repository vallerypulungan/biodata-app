Berikut adalah contoh README yang rapi dan informatif untuk tugas Laravel kamu yang menampilkan biodata dalam bentuk dashboard dengan dua tab (lihat data dan form tambah):

---

# 📘 Aplikasi  Biodata – Laravel + Vue

Aplikasi ini adalah proyek tugas yang dibuat menggunakan **Laravel 11** sebagai backend dan **Vue.js** untuk frontend. Fitur utamanya adalah menampilkan **data biodata seperti tampilan kartu LinkedIn**, serta form untuk **menambahkan data biodata** pada satu halaman dashboard.

---

## 🔧 Fitur Aplikasi

* 🧑‍💼 Menampilkan data biodata seperti kartu LinkedIn
* ➕ Form input biodata lengkap (nama, jurusan, foto, dsb)
* 🔁 Double Page dengan dua tab:

  * **Tab 1**: Menampilkan daftar biodata dalam bentuk **card**
  * **Tab 2**: Form registrasi biodata baru
* 🌐 Terhubung dengan API Laravel (resource controller)

---

## 🧩 Teknologi yang Digunakan

### Backend:

* Laravel 11
* RESTful API via `apiResource`
* MySQL 

### Frontend:

* Vue.js (Vite / Vue 3)
* Axios untuk komunikasi dengan backend

---

## 📡 API Endpoint

| Method | URL                 | Keterangan          |
| ------ | ------------------- | ------------------- |
| GET    | `/api/biodata`      | Ambil semua biodata |
| POST   | `/api/biodata`      | Tambah biodata baru |
| PUT    | `/api/biodata/{id}` | Ubah data biodata   |
| DELETE | `/api/biodata/{id}` | Hapus biodata       |


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


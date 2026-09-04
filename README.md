# 🏛️ Sistem Informasi Monitoring Data Kepegawaian (SIMPEG) - KPPBC TMP C Lhokseumawe

Sistem Informasi berbasis website yang dirancang untuk mengotomatisasi pemantauan hak-hak pegawai secara *real-time* di lingkungan KPPBC TMP C Lhokseumawe, menggantikan sistem manual berbasis *spreadsheet* sebelumnya.

## 📌 Latar Belakang Proyek

Sebelumnya, pemantauan hak-hak pegawai dilakukan secara manual menggunakan Microsoft Excel yang rentan terhadap ketidakakuratan data, duplikasi informasi, dan keterlambatan penyampaian informasi hak pegawai. Sistem ini dibangun untuk menghadirkan solusi digital yang fokus pada:

* Otomatisasi pemantauan dan pengelolaan estimasi waktu pemenuhan hak pegawai berikutnya.
* Pencegahan keterlambatan informasi kenaikan hak pegawai.
* Keamanan dan struktur data yang lebih terpusat.

## 👥 Aktor & Hak Akses (User Roles)

1. **Admin (Subbagian Umum Kepegawaian):** Memiliki hak akses penuh untuk *login*, mengelola data profil pegawai, memperbarui status tindak lanjut monitoring, melihat visualisasi laporan, dan mengekspor data.
2. **User (Pegawai Umum):** Dapat mengakses halaman utama (*Landing Page*) untuk melihat informasi atau memantau status perubahan hak yang akan terjadi dalam 30 hari ke depan tanpa perlu melakukan *login*.

## ✨ Fitur-Fitur Utama

* **Dashboard Intuitif:** Menampilkan statistik ringkas (total pegawai, status aktif/non-aktif) serta grafik kondisi kepegawaian terkini.
* **Manajemen Data Pegawai (CRUD):** Pengelolaan lengkap untuk menambah, melihat detail, memperbarui, dan menghapus data profil pegawai secara terstruktur.
* **Sistem Monitoring Hak Pegawai:** Klasifikasi otomatis data pemantauan menjadi tiga kategori (*Belum Ditindaklanjuti*, *Sudah Ditindaklanjuti*, dan *Tidak Ditindaklanjuti*) berdasarkan TMT berikutnya.
* **Kategori Pemantauan Spesifik:** Halaman khusus untuk memantau perkembangan **Grading**, **Kenaikan Pangkat**, dan **Kenaikan Gaji Berkala (KGB)**.
* **Laporan Visualisasi Data:** Penyajian data kepegawaian melalui grafik interaktif (distribusi jenis kelamin, rentang usia, pendidikan terakhir) lengkap dengan opsi unduh format PNG.
* **Ekspor Data:** Fitur untuk mengunduh rekapitulasi data pegawai ke dalam format file CSV.

## 🛠️ Tech Stack (Teknologi yang Digunakan)

* **Bahasa Pemrograman:** PHP, HTML, CSS, JavaScript
* **Framework Backend:** Laravel (Versi 8.2)
* **Database:** MySQL (Relational Database Management System)

## 🚀 Cara Menjalankan Proyek Secara Lokal

1. *Clone* repository ini:

   ```bash
   git clone https://github.com/atikapr/monitoring-kepegawaian-beacukai.git
   ```

2. Masuk ke direktori proyek:

   ```bash
   cd monitoring-kepegawaian-beacukai
   ```

3. Salin file `.env.example` menjadi `.env`:

   ```bash
   cp .env.example .env
   ```

4. Instal dependensi PHP menggunakan Composer:

   ```bash
   composer install
   ```

5. Buat application key Laravel:

   ```bash
   php artisan key:generate
   ```

6. Konfigurasikan koneksi database Anda di dalam file `.env`.

7. Jalankan migrasi database:

   ```bash
   php artisan migrate
   ```

8. Jalankan server lokal:

   ```bash
   php artisan serve
   ```

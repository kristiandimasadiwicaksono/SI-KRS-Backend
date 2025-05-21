# SI-KRS-Backend

Sistem Manajemen Kartu Rencana Studi (KRS) Online - Backend menggunakan CodeIgniter 4

## 📌 Cara Clone Repository

```bash
git clone https://github.com/kristiandimasadiwicaksono/SI-KRS-Backend.git
cd SI-KRS-Backend
```

## 🔧 Instalasi dan Konfigurasi

1. **Install Dependencies**
   ```bash
   composer install
   ```
2. **Salin file .env.example menjadi .env**
   ```bash
   cp env .env
   ```
3. **Edit file `.env` dan atur konfigurasi database**
   ```env
   database.default.hostname = localhost
   database.default.database = nama_database
   database.default.username = root
   database.default.password = 
   database.default.DBDriver = MySQL
   ```
4. **Jalankan migrasi database**
   ```bash
   php spark migrate
   ```
5. **Jalankan seeder (jika ada data default yang perlu diisi)**
   ```bash
   php spark db:seed NamaSeeder
   ```

## 🚀 Menjalankan Project

```bash
php spark serve
```
Secara default, server akan berjalan di `http://localhost:8080`.

## 📡 Menggunakan API di Postman

1. **Pastikan server berjalan** dengan perintah `php spark serve`
2. **Buka Postman**
3. **Buat request baru**
   - **Kelas:**
      - `GET` → `http://localhost:8080/kelas` / `http://localhost:8080/kelas/{id}`
      - `POST` → `http://localhost:8080/kelas`
      - `PUT` → `http://localhost:8080/kelas/{id}`
      - `DELETE` → `http://localhost:8080/kelas/{id}`
   - **Matkul:**
      - `GET` → `http://localhost:8080/matkul` / `http://localhost:8080/matkul/{id}`
      - `POST` → `http://localhost:8080/matkul`
      - `PUT` → `http://localhost:8080/matkul/{id}`
      - `DELETE` → `http://localhost:8080/matkul/{id}`
   - **Prodi:**
      - `GET` → `http://localhost:8080/prodi` / `http://localhost:8080/prodi/{id}`
      - `POST` → `http://localhost:8080/prodi`
      - `PUT` → `http://localhost:8080/prodi/{id}`
      - `DELETE` → `http://localhost:8080/prodi/{id}`
   - **Mahasiswa:**
      - `GET` → `http://localhost:8080/mahasiswa` / `http://localhost:8080/mahasiswa/{id}`
      - `POST` → `http://localhost:8080/mahasiswa`
      - `PUT` → `http://localhost:8080/mahasiswa/{id}`
      - `DELETE` → `http://localhost:8080/mahasiswa/{id}`
   - **KRS:**
      - `GET` → `http://localhost:8080/krs` / `http://localhost:8080/krs/{id}`
      - `POST` → `http://localhost:8080/krs`
      - `PUT` → `http://localhost:8080/krs/{id}`
      - `DELETE` → `http://localhost:8080/krs/{id}`
   - **User:**
      - `GET` → `http://localhost:8080/user` / `http://localhost:8080/user/{id}`
4. **Kirim request dan lihat response dari API**

---
💡 Pastikan database sudah dikonfigurasi dengan benar dan migrasi telah dijalankan. 🚀


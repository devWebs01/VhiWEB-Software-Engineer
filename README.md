# VhiWEB-Software-Engineer

Ini adalah REST API yang dibangun menggunakan Laravel 10 untuk manajemen data Pengguna (User) dan Vendor. Proyek ini dilengkapi dengan otentikasi berbasis token menggunakan Laravel Sanctum dan dokumentasi API interaktif yang dibuat secara otomatis menggunakan L5-Swagger.

## Fitur Utama

-   **Otentikasi Aman**: Proses registrasi, login, dan logout pengguna yang aman menggunakan Laravel Sanctum.
-   **Manajemen Pengguna (Users)**: Operasi CRUD (Create, Read, Update, Delete) penuh untuk data pengguna.
-   **Manajemen Vendor**: Operasi CRUD (Create, Read, Update, Delete) penuh untuk data vendor.
-   **Validasi Request**: Validasi data yang masuk untuk memastikan integritas dan keamanan data.
-   **Arsitektur Repository**: Memisahkan logika bisnis dari controller untuk kode yang lebih bersih dan terstruktur.
-   **Dokumentasi API**: Dokumentasi API yang jelas dan interaktif tersedia melalui Swagger UI.

## Persyaratan Sistem

Untuk menjalankan proyek ini, Anda memerlukan:

-   PHP >= 8.1
-   Composer
-   Database (contoh: MySQL, MariaDB, PostgreSQL)
-   Web Server (contoh: Nginx, Apache, atau server bawaan Laravel)

## Panduan Instalasi dan Setup

Berikut adalah langkah-langkah untuk menginstal dan menjalankan proyek ini di lingkungan lokal Anda.

1.  **Clone Repository**
    ```bash
    git clone https://github.com/your-username/VhiWEB-Software-Engineer.git
    cd VhiWEB-Software-Engineer
    ```

2.  **Install Dependensi**
    Gunakan Composer untuk menginstal semua dependensi PHP yang diperlukan.
    ```bash
    composer install
    ```

3.  **Konfigurasi Lingkungan (.env)**
    Salin file `.env.example` menjadi `.env`. File ini akan berisi semua konfigurasi spesifik untuk lingkungan Anda.
    ```bash
    # Untuk Windows
    copy .env.example .env
    # Untuk MacOS/Linux
    cp .env.example .env
    ```

4.  **Generate Application Key**
    Buat kunci enkripsi unik untuk aplikasi Anda.
    ```bash
    php artisan key:generate
    ```

5.  **Konfigurasi Database**
    Buka file `.env` dan sesuaikan pengaturan koneksi database Anda:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database_anda
    DB_USERNAME=user_database_anda
    DB_PASSWORD=password_database_anda
    ```

6.  **Jalankan Migrasi Database**
    Buat semua tabel yang diperlukan di database Anda dengan menjalankan migrasi.
    ```bash
    php artisan migrate
    ```

7.  **(Opsional) Jalankan Seeder**
    Jika Anda ingin mengisi database dengan data awal (dummy data), jalankan seeder.
    ```bash
    php artisan db:seed
    ```

8.  **Jalankan Server Pengembangan**
    Sekarang Anda dapat menjalankan server pengembangan lokal Laravel.
    ```bash
    php artisan serve
    ```
    Aplikasi Anda akan berjalan di `http://127.0.0.1:8000`.

## Dokumentasi & Pengujian API

Proyek ini menggunakan L5-Swagger untuk menghasilkan dokumentasi API secara otomatis. Anda dapat mengaksesnya melalui browser untuk melihat semua endpoint yang tersedia dan mengujinya secara langsung.

-   **URL Dokumentasi API**: [http://127.0.0.1:8000/api/documentation](http://127.0.0.1:8000/api/documentation)

### Cara Menggunakan API yang Dilindungi

Untuk mengakses *endpoint* yang memerlukan otentikasi, ikuti langkah-langkah berikut:

1.  Gunakan *endpoint* `/api/login` dengan `email` dan `password` Anda untuk mendapatkan *bearer token*.
2.  Salin *token* yang Anda terima dari respons login.
3.  Di halaman dokumentasi Swagger, klik tombol **Authorize**.
4.  Di jendela yang muncul, ketik `Bearer` diikuti dengan spasi dan *token* Anda (contoh: `Bearer 1|aBcDeFgHiJkLmNoPqRsTuVwXyZ`).
5.  Klik **Authorize** lagi. Sekarang Anda dapat menguji semua *endpoint* yang dilindungi.

## Daftar Endpoint API

Berikut adalah ringkasan dari semua *endpoint* yang tersedia.

### Otentikasi

| Method | URI               | Aksi                  | Middleware |
| :----- | :---------------- | :-------------------- | :--------- |
| `POST` | `/api/register`   | Registrasi pengguna baru | `guest`    |
| `POST` | `/api/login`      | Login pengguna        | `guest`    |
| `POST` | `/api/logout`     | Logout pengguna       | `auth:api` |
| `GET`  | `/api/user`       | Mendapatkan data pengguna | `auth:api` |

### Users

| Method   | URI               | Aksi                      | Middleware |
| :------- | :---------------- | :------------------------ | :--------- |
| `GET`    | `/api/users`      | Menampilkan semua pengguna  | `auth:api` |
| `POST`   | `/api/users`      | Membuat pengguna baru     | `auth:api` |
| `GET`    | `/api/users/{id}` | Menampilkan detail pengguna | `auth:api` |
| `PUT`    | `/api/users/{id}` | Memperbarui data pengguna   | `auth:api` |
| `DELETE` | `/api/users/{id}` | Menghapus pengguna        | `auth:api` |

### Vendors

| Method   | URI                 | Aksi                        | Middleware |
| :------- | :------------------ | :-------------------------- | :--------- |
| `GET`    | `/api/vendors`      | Menampilkan semua vendor    | `auth:api` |
| `POST`   | `/api/vendors`      | Membuat vendor baru       | `auth:api` |
| `GET`    | `/api/vendors/{id}` | Menampilkan detail vendor   | `auth:api` |
| `PUT`    | `/api/vendors/{id}` | Memperbarui data vendor     | `auth:api` |
| `DELETE` | `/api/vendors/{id}` | Menghapus vendor          | `auth:api` |

## Menjalankan Tes

Untuk memastikan semua fungsionalitas berjalan dengan baik, Anda dapat menjalankan rangkaian tes otomatis.
```bash
php artisan test
```
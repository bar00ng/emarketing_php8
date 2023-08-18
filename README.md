# Website E- Marketing

## Requirement PHP 8 ke atas

Untuk menjalankan proyek Laravel dengan lancar, pastikan sistem Anda memenuhi persyaratan berikut:

1. **PHP 8** atau versi lebih tinggi: Laravel memerlukan PHP 8.1.0 atau yang lebih baru. Pastikan Anda telah menginstal versi PHP yang sesuai pada sistem Anda.

2. **Composer**: Laravel menggunakan Composer untuk mengelola dependensi proyek. Pastikan Anda telah menginstal Composer dan dapat menjalankannya dari baris perintah.

3. **Web Server**: Anda memerlukan web server seperti Apache atau Nginx untuk menjalankan proyek Laravel. Jika Anda ingin menggunakan server pengembangan bawaan, Anda dapat menggunakan perintah `php artisan serve` untuk menjalankannya.

4. **Database**: Pastikan Anda telah menginstal dan mengkonfigurasi database yang didukung oleh Laravel, seperti MySQL, PostgreSQL, SQLite, atau SQL Server.

5. **Ekstensi PHP**: Beberapa ekstensi PHP diperlukan oleh Laravel untuk berfungsi dengan baik, seperti `mbstring`, `dom`, `json`, dan lainnya. Pastikan ekstensi yang dibutuhkan telah diaktifkan di file konfigurasi php.ini Anda.

## Step Instalasi pada Proyek Laravel

Berikut adalah langkah-langkah untuk menginstal dan menjalankan proyek Laravel:

1. **Clone Proyek dari Repositori**
   ```
   git clone https://url-repositori/proyek-laravel.git
   cd proyek-laravel
   ```

2.  **Install Dependensi**\
   Jalankan perintah berikut untuk menginstal semua dependensi yang diperlukan oleh proyek Laravel menggunakan Composer:
    ```
    composer install
    ```
    
4.  **Konfigurasi Environment**\
    Salin file .env.example menjadi .env:
    ```
    cp .env.example .env
    ```
    Kemudian, atur konfigurasi lingkungan, seperti pengaturan database, sesuai dengan lingkungan Anda.
    
5.  **Generate Kunci Aplikasi**\
    Setiap instalasi Laravel memerlukan kunci aplikasi yang unik. Jalankan perintah berikut untuk menghasilkan kunci aplikasi:
    ```
    php artisan key:generate
    ```
    
7.  **Migrasi Database**\
    Jalankan migrasi database untuk membuat tabel yang diperlukan oleh proyek:
    ```
    php artisan migrate
    ```

7.  **Database Seed**\
    Jalankan seeding database untuk mengenerate akun admin dan user:
    ```
    php artisan db:seed
    ```
    
8.  **Jalankan Server Pengembangan**\
    Untuk menjalankan server pengembangan bawaan Laravel, gunakan perintah:
    ```
    php artisan serve
    ```

## Fitur Aplikasi

Berikut adalah fitur yang ada di dalam aplikasi ini :
1.  **Authentication**\
    Sama seperti aplikasi pada umumnya autentikasi mejadi salah satu hal yang penting untuk memastikan keamanan pada aplikasi yang dibuat. Di bawah ini merupakan form untuk Login dan Register.

    ![Login Form](https://github.com/bar00ng/emarketing_php8/blob/main/public/app_screenshots/login_page.PNG?raw=true)

    ![Register Form](https://github.com/bar00ng/emarketing_php8/blob/main/public/app_screenshots/register_page.PNG?raw=true)

    Setelah proses login berhasil. Sistem akan mendeteksi level dari user yang login. Jika, user login sebagai admin maka akan ada proses redirect ke halaman dashboard admin. 
    
    ![Admin Dashboard](https://github.com/bar00ng/emarketing_php8/blob/main/public/app_screenshots/admin_dashboard.PNG?raw=true)

    Jika login sebagai user, di bawah ini merupakan landing page nya. Namun, untuk mengkases halaman landing page di bawah ini sebenarnya tidak diperlukan login.

    ![User Landing Page](https://github.com/bar00ng/emarketing_php8/blob/main/public/app_screenshots/landing_page.PNG?raw=true)

2.  **CRUD**\
    CRUD merupakan fitur paling mendasar pada sebuah aplikasi. Dalam aplikasi ini Admin bisa melakukan CRUD pada user dan data product/ barang.

    ![Display Barang](https://github.com/bar00ng/emarketing_php8/blob/main/public/app_screenshots/daftar_barang.PNG?raw=true)

    ![Form Barang](https://github.com/bar00ng/emarketing_php8/blob/main/public/app_screenshots/form_barang.PNG?raw=true)

    ![Display User](https://github.com/bar00ng/emarketing_php8/blob/main/public/app_screenshots/daftar_pengguna.PNG?raw=true)

    ![Form User](https://github.com/bar00ng/emarketing_php8/blob/main/public/app_screenshots/form_pengguna.PNG?raw=true)

    Selain itu, admin juga bisa mengaktif/non aktifkan suatu produk. Nantinya produk yang tidak aktif, tidak akan ditampilkan pada landing page User.

    ![Berhasil Active/NonActive](https://github.com/bar00ng/emarketing_php8/blob/main/public/app_screenshots/daftar_barang_2.PNG?raw=true)

    ![Result di Landing Page](https://github.com/bar00ng/emarketing_php8/blob/main/public/app_screenshots/landing_page_2.PNG?raw=true)

3.  **Search Product**\
    Pada landing page user, user mampu mencari product berdasarkan nama product nya

    ![Search](https://github.com/bar00ng/emarketing_php8/blob/main/public/app_screenshots/landing_page_3.PNG?raw=true)

4.  **Generate Report**\
    Admin mampu mengenerate report yang meliputi 2 hal: Daftar Barang dan Daftar Pengguna. Nanti nya report ini akan berupa file .pdf dengan nama yang autogenerate dan unique
    
    ![Output Report](https://github.com/bar00ng/emarketing_php8/blob/main/public/app_screenshots/output_report.PNG?raw=true)

## Default Account
Ada 2 default account dengan level autentikasi yang berbeda- beda: 
1.  **Admin**
    ```
    admin@gmail.com
    admin123
    ```

2.  **User**
    ```
    user@gmail.com
    user123
    ```
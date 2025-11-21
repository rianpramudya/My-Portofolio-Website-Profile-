# 👨‍💻 Website Portofolio Pribadi

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)

## 📖 Deskripsi

Selamat datang di repository **Website Portofolio Pribadi** saya. 
Aplikasi ini dibangun menggunakan framework **Laravel** dan didesain untuk menampilkan profil profesional, keahlian (*skills*), serta proyek-proyek yang telah saya kerjakan. Tujuannya adalah sebagai *personal branding* dan showcase kemampuan saya dalam pengembangan web.

Fitur utama meliputi halaman profil, daftar proyek dengan detail, kontak form, dan blog (opsional: sesuaikan dengan fitur kamu).

## 🚀 Fitur Utama

-   ✨ **Desain Responsif**: Tampilan optimal di Desktop, Tablet, dan Mobile.
-   👤 **About Me**: Bagian perkenalan diri dan latar belakang.
-   💼 **Projects Gallery**: Menampilkan daftar portofolio dengan filter kategori.
-   🛠 **Tech Stack Showcase**: Menampilkan keahlian teknis dengan ikon menarik.
-   📞 **Contact Form**: Form agar pengunjung bisa menghubungi langsung.

## 🛠️ Teknologi yang Digunakan

-   **Backend**: Laravel 11
-   **Frontend**: Blade Templating, Tailwind CSS / Bootstrap
-   **Database**: MySQL
-   **Lainnya**: Git, Composer

## ⚙️ Cara Install di Local (Instalasi)

Ikuti langkah-langkah ini untuk menjalankan project di komputer kamu:

1.  **Clone Repository**
    ```bash
    git clone [https://github.com/rianpramudya/My-Portofolio-Website-Profile-.git](https://github.com/rianpramudya/My-Portofolio-Website-Profile-.git)
    cd My-Portofolio-Website-Profile-
    ```

2.  **Install Dependencies**
    Pastikan kamu sudah menginstall Composer.
    ```bash
    composer install
    npm install
    ```

3.  **Setup Environment**
    Salin file konfigurasi `.env`:
    ```bash
    cp .env.example .env
    ```

4.  **Generate Key**
    ```bash
    php artisan key:generate
    ```

5.  **Setup Database**
    -   Buat database baru di MySQL (misal: `db_portofolio`).
    -   Buka file `.env` dan sesuaikan konfigurasi database:
        ```env
        DB_DATABASE=db_portofolio
        DB_USERNAME=root
        DB_PASSWORD=
        ```

6.  **Migrate Database**
    ```bash
    php artisan migrate
    ```

7.  **Jalankan Server**
    ```bash
    php artisan serve
    npm run dev
    ```
    Buka browser dan akses: `http://127.0.0.1:8000`

## 📬 Kontak

Jika ingin berdiskusi atau berkolaborasi, silakan hubungi saya melalui:

-   **LinkedIn**: [Rian Pramudya Amanda](www.linkedin.com/in/rian-pramudya-amanda-258742246)
-   **Email**: pramudyaamanda88@gmail.com
-   **Instagram**: [@pramudyarian_](https://www.instagram.com/pramudyarian_/)

---
*Dibuat dengan ❤️ oleh Rian Pramudya*
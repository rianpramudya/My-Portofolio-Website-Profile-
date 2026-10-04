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
-   **Database**: SQLite (lokal, tanpa XAMPP)
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

5.  **Setup Database SQLite (tanpa XAMPP)**
    Konfigurasi `.env`:
    ```env
    DB_CONNECTION=sqlite
    DB_DATABASE=database/portfolio.sqlite
    ```
    Untuk instalasi baru saja, buat file database jika belum tersedia:
    ```bash
    php -r "file_exists('database/portfolio.sqlite') || touch('database/portfolio.sqlite');"
    ```
    Pada workspace ini database sudah tersedia dan berisi data hasil migrasi MySQL.

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

## Menjalankan lokal tanpa XAMPP

Database aktif berada di `database/portfolio.sqlite`. Jalankan `php artisan serve`
untuk website; jalankan `npm run dev` di terminal terpisah saat mengembangkan tampilan.
XAMPP/MySQL tidak diperlukan oleh aplikasi ini. Terjemahan CV tetap menggunakan
layanan LibreTranslate yang dijalankan terpisah.

Data CMS, akun admin (termasuk hash password), sesi, cache, dan antrean telah
disalin dari MySQL dan dibandingkan per baris. Foto dan dokumen masih menggunakan
penyimpanan `storage/app/public` yang sama.

Cadangan data MySQL dan konfigurasi sebelum perpindahan berada di
`storage/app/private/database-backups/`. Folder cadangan berisi data privat dan
konfigurasi lokal; folder ini serta file SQLite tidak dimasukkan ke Git.
Database MySQL asal tetap tersedia.

Untuk backup SQLite, gunakan perintah berikut (salinan konsisten walaupun database aktif):

```bash
sqlite3 database/portfolio.sqlite ".backup 'database/portfolio-backup.sqlite'"
```

Untuk kembali ke MySQL, jalankan MySQL, pulihkan `.env.mysql` dari folder cadangan
ke `.env`, lalu jalankan `php artisan config:clear` dan restart server Laravel.
Perubahan data yang dibuat setelah perpindahan tetap berada di SQLite dan tidak
otomatis disalin kembali ke MySQL.

## CV dalam Bahasa Indonesia / English

Pada **Admin → CV Generator**, pilih bahasa sebelum membuat preview ATS atau
kreatif. Bahasa juga dapat dipilih pada formulir unduhan di halaman preview.
Pilihan **Bahasa asli input** memakai data CMS langsung tanpa layanan terjemahan.

Terjemahan isi CMS memakai [LibreTranslate](https://docs.libretranslate.com/api/operations/translate/)
dengan deteksi bahasa sumber otomatis. Label bagian CV diterjemahkan lokal.
Profil, jabatan, deskripsi, poin pengalaman/proyek, kategori keahlian, dan soft skills
diterjemahkan; nama orang, perusahaan, proyek, sertifikat, teknologi, kontak,
tautan, kredensial, dan periode yang dimasukkan dipertahankan. Bulan tanggal sertifikat
ditampilkan sesuai bahasa CV. Data CMS tidak ditimpa.

### Menjalankan layanan lokal

Pasang dan jalankan Docker terlebih dahulu, lalu dari folder proyek:

```bash
docker compose -f compose.libretranslate.yaml up -d
```

Konfigurasi memuat model bahasa `en` dan `id`, dan membatasi port ke komputer lokal.
Unduhan model saat startup pertama membutuhkan internet dan dapat memakan waktu.
Lihat [petunjuk instalasi resmi](https://docs.libretranslate.com/guides/installation/)
untuk opsi instalasi Python atau server lain.

Tambahkan ke `.env`:

```env
CV_TRANSLATION_URL=http://127.0.0.1:5000
CV_TRANSLATION_API_KEY=
```

Untuk server lain, isi alamat dasar layanan (tanpa `/translate`) dan API key jika
layanan tersebut memerlukannya. Server harus menyediakan model bahasa `id` dan `en`.
Alamat `127.0.0.1` berlaku saat PHP dijalankan langsung di host, seperti `php artisan serve`.
Jika PHP berada di container, sesuaikan alamat dengan jaringan container.

```bash
php artisan config:clear
curl http://127.0.0.1:5000/languages
```

Setelah layanan siap, pilih bahasa dan periksa preview sebelum mengunduh.
Terjemahan dikirim sebagai satu batch dan disimpan di cache selama 30 hari.
Perubahan teks CMS menghasilkan cache baru; preview dan PDF menggunakan cache yang sama.
Permintaan penerjemah dibatasi 20 detik. Jika layanan tidak tersedia atau responsnya
tidak lengkap, aplikasi kembali ke generator dengan pesan kesalahan.
Bahasa asli tetap dapat digunakan. Teks untuk diterjemahkan dikirim ke alamat
layanan yang dikonfigurasi.

### Pemeriksaan

```bash
php artisan test --filter='CvTranslationTest|CvPdfTest'
```

Tes menggunakan respons penerjemah dan renderer PDF simulasi, memeriksa kedua arah
terjemahan, kedua format, cache, data CMS tetap utuh, bahasa unduhan, foto inline,
validasi input, serta kegagalan layanan. Uji integrasi dengan penerjemah sebenarnya
memerlukan layanan LibreTranslate yang aktif.

## 📬 Kontak

Jika ingin berdiskusi atau berkolaborasi, silakan hubungi saya melalui:

-   **LinkedIn**: [Rian Pramudya Amanda](www.linkedin.com/in/rian-pramudya-amanda-258742246)
-   **Email**: pramudyaamanda88@gmail.com
-   **Instagram**: [@pramudyarian_](https://www.instagram.com/pramudyarian_/)

---
*Dibuat dengan ❤️ oleh Rian Pramudya*

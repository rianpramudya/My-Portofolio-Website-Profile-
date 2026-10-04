# Desain publik dan audit CMS

Halaman pengunjung memakai layout dan entry Vite tersendiri. Dashboard, autentikasi, route, model, migrasi, dan aset sumber admin tidak diubah oleh pekerjaan desain ini. Perubahan pengguna yang sudah ada tetap dipertahankan. Tidak ada dependency baru.

## Arah visual

Black/silver dengan komposisi editorial, garis presisi, tipografi sistem, dan aksen metalik selektif. Gambar CMS mempertahankan warna aslinya.

| Token | Warna |
| --- | --- |
| Obsidian | `#101113` |
| Charcoal | `#181a1d` |
| Graphite | `#23262b` |
| Silver | `#bfc2c8` |
| Platinum | `#e8e9ec` |
| Putih lembut | `#f7f7f8` |

## Audit konten

Proyek hanya memiliki halaman publik utama dan endpoint formulir kontak. Halaman profil akun memerlukan autentikasi; halaman tenant, berita, dan detail publik terpisah tidak tersedia.

| Data CMS | Jumlah saat pemeriksaan | Penempatan publik |
| --- | ---: | --- |
| Profil | 1 | Identitas, foto, headline, tentang, kontak, CV dan tautan sosial |
| Pengalaman | 3 | Riwayat menurut tipe, periode, deskripsi dan rincian |
| Proyek | 5 | Semua proyek, gambar, deskripsi, rincian dan tautan |
| Keahlian | 25 | Kelompok kategori dan tingkat keahlian |
| Layanan | 6 | Judul dan deskripsi |
| Sertifikasi | 3 | Penerbit, judul, tanggal, ID kredensial, deskripsi, dokumen dan tautan verifikasi |
| Pesan masuk dan akun | — | Tidak ditampilkan |

Penyebab sertifikasi hilang: controller publik belum mengambil model Certification dan template belum merendernya. Query tanggal terbaru dan section `#certifications` sekarang menggunakan data CMS asli. Skema sertifikasi tidak memiliki kolom kategori tersendiri maupun status draft/visibilitas; tidak ada kategori atau aturan publikasi buatan yang ditambahkan. Proyek sebelumnya dibatasi enam tanpa pagination; sekarang seluruh data ditampilkan.

Editor CMS saat ini menyimpan teks biasa. Output tetap di-escape; deskripsi mempertahankan baris. Tidak ada rendering HTML mentah baru. CSS prose menyediakan styling elemen teks terstruktur tanpa mengubah keamanan input.

## Verifikasi

- `npm run build` berhasil.
- `php artisan test`: 47 tes, 330 assertion lulus. Tes publik memeriksa seluruh jenis konten, lebih dari enam proyek, kondisi kosong, escaping, isolasi aset, validasi kontak, serta tambah/edit/hapus sertifikasi melalui endpoint CMS pada database pengujian.
- Chromium/Puppeteer memeriksa 390, 768, dan 1440 px dengan screenshot: konten aktual, kosong, teks sangat panjang dan gambar gagal. Tidak ada overflow horizontal atau gambar rusak yang dibiarkan terlihat.
- Menu mobile, Escape, navigasi anchor, detail sertifikasi dengan keyboard, focus dan reduced motion diperiksa. Tidak ada error JavaScript dalam pemeriksaan halaman aktual.
- Jumlah elemen aktual cocok dengan CMS: 5 proyek, 25 keahlian, 6 layanan, 3 sertifikasi. Ketiga tautan PDF mengembalikan HTTP 200 dan `application/pdf`.
- Konten produksi tidak diubah untuk pengujian. Fixture ekstrem dirender sementara; tes CRUD memakai database pengujian.
- Perbandingan hash terhadap kondisi awal membatasi perubahan file yang sudah ada pada controller publik, template home dan konfigurasi entry Vite. Berkas layout/CSS/JS publik dan tes ditambahkan terpisah.

Artefak screenshot dan laporan pemeriksaan lokal tersedia di `/private/tmp/public-ui-qa`; direktori sementara ini bukan aset deployment.

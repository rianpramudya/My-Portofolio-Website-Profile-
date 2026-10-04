# Pedoman desain website portfolio: "Chrome Noir"

Dokumen ini acuan utama perubahan tampilan. Bila ada arahan pengguna yang lebih baru, ikuti arahan itu. Gunakan skill `frontend-design` untuk perencanaan dan evaluasi.

## 1. Tujuan

Portfolio personal seorang profesional IT. Pengunjung harus merasa: "orang ini sangat hebat, detail, dan kreatif". Kesan itu dibangun dari kualitas karya (data CMS), presisi gerak, tipografi berani, dan interaksi cerdas yang bisa dimainkan, bukan dari klaim buatan.

Karakter: cyberpunk modern, black-silver, mewah, dingin, presisi, tetapi hidup dan sedikit nakal. Tidak kaku, tidak standar, bukan arcade neon.

## 2. Ruang lingkup dan batasan keras

- Perubahan hanya untuk halaman publik/pengunjung.
- Jangan ubah dashboard admin, autentikasi, CRUD, route, validasi, otorisasi, database, atau backend (kecuali query minimal agar konten publik berfungsi).
- Pertahankan unduhan CV, formulir kontak (validasi, old input, status kirim), dokumen sertifikasi, dan integrasi media/storage.
- Tombol **Dashboard** hanya tampil bila pengguna sudah login. Jangan tampilkan Admin/Login untuk tamu.
- Aset publik tidak boleh dimuat di layout admin/auth. Jangan ubah aset bersama demi kebutuhan publik.
- Pertahankan perubahan pengguna yang sudah ada. Kerjakan di branch baru, tanpa reset menyeluruh.

## 3. Sistem warna

Semua warna lewat token di `resources/css/public/tokens.css`, bukan nilai acak di komponen.

| Token | Nilai | Penggunaan |
| --- | --- | --- |
| `--void` | `#08090a` | Latar terdalam, preloader |
| `--obsidian` | `#101113` | Latar utama |
| `--charcoal` | `#181a1d` | Permukaan sekunder |
| `--graphite` | `#23262b` | Variasi kedalaman |
| `--edge` | `#383b41` | Border dan separator |
| `--muted` | `#a4a7af` | Keterangan pendukung |
| `--silver` | `#bfc2c8` | Teks sekunder, aksen metalik |
| `--platinum` | `#e8e9ec` | Heading, tombol utama |
| `--white` | `#f7f7f8` | Fokus dan penekanan |
| `--ice` | `#9fb4c7` | Satu-satunya aksen warna, maksimal ±5% permukaan |

Token tambahan yang boleh dibuat: gradasi chrome (`--chrome-grad`), highlight tepi atas 1px, noise grain halus, glow tepi terkendali.

Aturan: lapisan gelap membedakan section. Efek silver dipakai selektif (identitas, bingkai, hover). Dilarang neon warna-warni, gradient ungu-biru, blob/orb blur. Warna gambar CMS tidak boleh diubah, digelapkan, atau dimonokromkan.

## 4. Tipografi

- Boleh memasang font **self-hosted** (Fontsource/woff2, bukan CDN) dengan `font-display: swap` dan preload font kritis.
- Tiga peran: display berkarakter (pilih satu: Space Grotesk, Sora, Syne, atau Bricolage Grotesque), body bersih (Geist atau Manrope), mono kecil (Geist Mono atau JetBrains Mono) untuk metadata.
- Judul hero sangat besar: `clamp()` hingga sekitar 14vw, tracking rapat, kontras ukuran dramatis. Label kecil uppercase dengan tracking lebar.
- Teks isi 15-17 px, line-height 1.65-1.85, maksimal sekitar 80 karakter per baris.
- Satu `h1`, `h2` per section, hierarki benar. Teks panjang, email, dan ID kredensial wajib membungkus tanpa melebarkan halaman.
- Penanda indeks (01/07) dan label mono boleh dipakai bila dihitung dinamis dari data nyata dan memperjelas struktur.

## 5. Komposisi per section (semua isi dari CMS)

Setiap section punya layout dan karakter gerak yang berbeda. Dilarang pola "judul + grid 3 kartu seragam".

| Bagian | Komposisi dan gerak |
| --- | --- |
| Preloader | Boot sequence singkat (maks ±1,2 dtk), label UI generik lalu nama CMS. Bisa dilewati, sekali per sesi |
| Navbar | Floating, berubah saat scroll, hint Ctrl/Cmd+K, menu mobile fullscreen, Dashboard bersyarat login |
| Hero | Nama CMS raksasa, reveal per huruf (mask/clip-path), bereaksi halus pada kursor, foto asli dalam bingkai metalik, headline CMS, indikator scroll fungsional |
| Profil | Teks reveal per baris, kata kunci menyala saat melewati tengah viewport, CV dan sosial dengan hover magnetik |
| Pengalaman | Timeline vertikal sticky, garis tergambar mengikuti scroll, node aktif menyala |
| Proyek | Showcase sinematik: sticky stacking atau horizontal pin (desktop), parallax, tilt 3D tipis, specular highlight silver. Mobile vertikal tetap dramatis. Semua proyek tampil (pagination/load more bila banyak). Screenshot memakai `contain` |
| Keahlian | Kelompok kategori asli, indikator level terisi saat masuk viewport, marquee yang kecepatannya mengikuti kecepatan scroll |
| Layanan | Daftar besar editorial, item meluas saat hover/fokus (clip-path), bukan kartu seragam |
| Sertifikasi | Semua tampil, tata letak ringkas dan mewah, link verifikasi dan dokumen berfungsi |
| Kontak | CTA tipografi raksasa, tombol magnetik, form dengan garis fokus mengalir, validasi dan status kirim jelas |
| Footer | Identitas aktual, tahun, kembali ke atas bergaya, Dashboard hanya setelah login |

Container desktop maksimal 1240 px (`.shell`), kecuali elemen yang sengaja memecah grid (hero, marquee, showcase proyek). Ruang negatif lapang, grid tegas, satu fokus visual kuat per komposisi. Pilih satu bahasa sudut (tajam atau radius kecil) dan pakai konsisten.

## 6. Motion system (satu bahasa gerak, banyak ekspresi)

Kemewahan datang dari presisi. Semua animasi wajib memakai token di `resources/js/public/motion/tokens.js`:

- Easing: `expoOut`, `power3`, `cubic-bezier(.22,1,.36,1)`
- Durasi: fast 300 ms, base 600 ms, slow 1000 ms (reveal besar boleh sampai ±1000 ms)
- Stagger standar satu nilai. Tanpa bounce murahan.

Aturan teknis:
- Animasikan hanya `transform`, `opacity`, `clip-path`.
- Satu loop `requestAnimationFrame` (GSAP ticker), tanpa loop terpisah-pisah.
- Jeda animasi saat tab tidak aktif atau elemen di luar viewport (IntersectionObserver).
- Util reusable per modul: `revealLines`, `revealChars`, `magnetic`, `tilt`, `countUp`, `scrambleText`.
- Library (GSAP + ScrollTrigger, Lenis, atau Motion One bila lebih ringan) dimuat lewat dynamic import hanya dari `public.js`. Catat alasan pilihan di laporan.

## 7. Lapisan "fun" ala developer (opsional, tidak menghalangi konten)

1. **Command Palette** (Ctrl/Cmd+K): panel gelap bergaya terminal. Perintah dibangun dinamis dari data CMS (lompat ke proyek, section, unduh CV, salin email). Penuh keyboard, aria benar, Escape menutup, fokus kembali tepat.
2. **Decrypt/scramble text**: label, nama, dan judul "terdekripsi" saat masuk viewport atau hover. Teks asli tetap ada di DOM untuk screen reader (`aria-label`).
3. **Spotlight kursor**: cahaya silver lembut di atas grid halus, hanya pada `(hover: hover)`.
4. **Hover berkarakter**: tombol magnetik dengan text roll, garis tautan menggambar dari arah berlawanan, kartu tilt mengikuti kursor.
5. **Easter egg**: Konami code memicu glitch silver singkat, pesan sambutan di console dengan nama CMS, klik logo 5 kali memicu animasi tersembunyi. Aman, singkat, tidak merusak layout.
6. **Microcopy cerdas**: label UI, tooltip, 404, dan pesan data kosong boleh bernada ringan khas developer. Hanya untuk teks antarmuka.
7. **Tombol "kurangi gerak"** kecil, tersimpan di `localStorage`, selain menghormati `prefers-reduced-motion`.

Anjuran: kualitas lebih penting daripada jumlah. Bila terlalu ramai, pertahankan yang paling kuat (Command Palette, decrypt text, tilt proyek).

## 8. Konten CMS dan keamanan

- Semua informasi substantif dari CMS. Dilarang hardcode nama, headline, statistik, testimoni, klaim, atau gambar pengganti. Label antarmuka dan microcopy boleh di template.
- Tampilkan seluruh jenis konten publik. Jangan hilangkan sertifikasi atau batasi proyek diam-diam tanpa navigasi yang sesuai.
- Jangan tampilkan akun, pesan masuk, kredensial, atau data internal. Hormati status publikasi/visibilitas bila ada.
- Sertifikasi tidak punya kolom kategori; jangan buat kategori hardcoded atau ubah schema.
- Data kosong menghasilkan pesan jujur, bukan isi pengganti.
- Teks CMS adalah teks biasa: gunakan escaping Blade dan pertahankan baris. Dilarang `{!! !!}`.
- Gunakan URL media/storage yang sudah ada. Uji perubahan data di lingkungan pengujian.

## 9. Aksesibilitas dan batas keamanan gerak

- Tanpa JavaScript, semua konten tetap terbaca (progressive enhancement). Jangan sembunyikan konten lewat CSS sebelum JS siap.
- `prefers-reduced-motion` atau tombol kurangi gerak mematikan: smooth scroll, parallax, scramble, spotlight, glitch, preloader, tilt, marquee otomatis. Konten langsung tampil.
- Tidak ada kedipan lebih dari 3 kali per detik (efek glitch khususnya).
- Tidak ada animasi yang menyembunyikan tombol penting, form, atau tautan.
- Efek berat (spotlight, tilt, marquee, custom cursor) dimatikan di perangkat sentuh dan otomatis diturunkan bila FPS rendah.
- Kontras WCAG AA (4.5:1 teks normal, 3:1 teks besar), focus ring bergaya tema dan jelas, skip link tetap ada.
- Menu mobile: `aria-expanded`, `aria-controls`, Escape menutup, fokus kembali tepat.
- Kontrol penting tersedia tanpa hover, target sentuh minimal 44x44 px, input punya label dan hubungan dengan pesan error.
- Gambar punya alt relevan (alt kosong untuk dekorasi murni).

## 10. Media dan performa

- Dimensi/aspect-ratio tetap untuk mencegah layout shift. Lazy loading di bawah fold, gambar hero diprioritaskan.
- Fallback elegan untuk gambar kosong atau gagal, tanpa ikon rusak.
- Target Lighthouse mobile Performance >= 85, CLS mendekati 0, LCP baik.
- Tanpa overflow horizontal di 390, 768, 1440, dan 1920 px. Susun ulang di mobile, bukan sekadar mengecilkan.
- Dependency baru boleh bila manfaatnya jelas; catat alasan dan ukurannya.

## 11. Anti tampilan generik

Dilarang: hero tengah standar dengan dua tombol, kartu seragam 3 kolom dengan ikon Lucide, emoji sebagai ikon, glassmorphism di semua tempat, glow di semua elemen, radius dan shadow seragam, copy klise ("Passionate developer", "Seamless", "Revolutionize"), animasi fade-up seragam di semua section. Setiap keputusan visual harus punya alasan yang cocok dengan portfolio, isi CMS, dan tujuan pengunjung.

## 12. Isolasi implementasi

| File | Tanggung jawab |
| --- | --- |
| `resources/views/layouts/public.blade.php` | Struktur dan navigasi publik |
| `resources/views/home.blade.php` | Komposisi konten CMS publik |
| `resources/css/public.css` | Entry yang meng-import `public/tokens.css`, `base.css`, `components.css`, `sections.css` |
| `resources/js/public.js` | Entry; dynamic import modul fitur |
| `resources/js/public/motion/` | Token gerak dan util animasi |
| `resources/js/public/features/` | Command palette, preloader, cursor, easter egg, dll. (satu modul per fitur) |
| `app/Http/Controllers/PortfolioController.php` | Pengambilan data publik |
| `vite.config.js` | Entry publik dan admin tetap terpisah |

## 13. Proses dan verifikasi

1. Audit file, data CMS, route, dan aset terkait. Tulis brief maksimal 15 baris (konsep, signature, font, struktur, motion, dependency).
2. Kerjakan bertahap: (a) tokens, font, motion system, navbar, hero; (b) profil, pengalaman, proyek, keahlian; (c) layanan, sertifikasi, kontak, footer; (d) Command Palette, preloader, easter egg, polish.
3. Setiap tahap: `npm run build`, lalu commit. Catat progres di `docs/public-ui.md`.
4. Akhir: `php artisan test --filter=PublicPortfolioTest` dan tes terkait; screenshot nyata (Playwright) di 390/768/1440 px; uji data kosong, judul panjang, gambar gagal; uji keyboard, menu mobile, form, CV, dokumen, Dashboard guest vs login; uji dengan JS mati dan reduced-motion.
5. `git diff --stat`: tidak ada file admin/auth/backend yang berubah.
6. Laporkan hanya yang benar-benar diperiksa, beserta keterbatasannya.
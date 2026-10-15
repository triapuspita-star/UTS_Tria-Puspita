# Dokumentasi Pengujian

## Identitas

- Nama: Tria Puspita
- NIM: 25012
- Kelas: 25M11

## Deskripsi Aplikasi
Aplikasi pemesanan Kantin Cantik dengan fitur daftar menu, pencarian, keranjang cantik, dan perhitungan diskon 5rb.

## Dokumentasi Pengujian

### Hasil Pengujian U01 - U05

| ID | Langkah dan Input | Hasil yang Diharapkan | Hasil Aktual | Status | Bukti |
|---|---|---|---|---|---|
| U01 | Buka halaman menu | Minimal 5 menu tampil | 5 menu tampil | Lulus | [Screenshot](dokumentasi/pengujian/U01-daftar-menu.png) |
| U02a | Cari "Nasi Goreng" | Menu yang sesuai tampil | Nasi Goreng tampil | Lulus | [Screenshot](dokumentasi/pengujian/U02a-pencarian-ditemukan.png) |
| U02b | Cari "Pizza" | Pesan tidak ditemukan | Pesan tidak ditemukan tampil | Lulus | [Screenshot](dokumentasi/pengujian/U02b-pencarian-kosong.png) |
| U03 | Kirim jumlah kosong / 0 / negatif / pecahan / >10 | Ditolak | Pesan kesalahan tampil, keranjang tetap | Lulus | [Screenshot](dokumentasi/pengujian/U03-kosong.png) |
| U04 | Edit kode menu jadi XX99 via Inspect | Ditolak, kode salah | Pesan U04 kode salah tampil | Lulus | [Screenshot](dokumentasi/pengujian/U04-kode-salah.png) |
| U05a | Tambah menu sama 4 lalu 6 | Digabung jadi 10 | x10 berhasil | Lulus | [Screenshot](dokumentasi/pengujian/U05-yang-digabung.png) |
| U05b | Tambah 1 lagi saat sudah 10 | Ditolak, tetap 10 | Permintaan ditolak, tetap x10 | Lulus | [Screenshot](dokumentasi/pengujian/U05-permintaan-ditolak.png) |
| U08b | Subtotal Rp50.000 | Diskon Rp5.000, total Rp45.000 | Sesuai harapan | Lulus | [Screenshot](dokumentasi/pengujian/U08b-diskon-perbaikan.png) |

### Catatan Perbaikan
- U03: validasi jumlah diperbaiki agar menolak kosong, 0, negatif, pecahan, dan lebih dari 10.
- U04: validasi kode menu diperbaiki agar menolak kode yang tidak terdaftar.
- U05: kondisi diperbaiki dari `>=20` menjadi `(sudah_ada + tambah) > 10` agar jumlah tetap 10 saat ditolak. Uji 4+6=10 berhasil, tambah 1 ditolak.
- U08b: kondisi diskon diperbaiki agar berlaku ketika subtotal >= Rp50.000.
- Pengujian ulang berhasil.

## Cara Menjalankan
1. Clone repo
2. Jalankan di XAMPP: `http://localhost/uts-web1-25012049/index.php`

## Link Dokumen Lengkap
Lihat file lengkap di: [dokumentasi/Dokumentasi-Pengujian.md](dokumentasi/Dokumentasi-Pengujian.md)

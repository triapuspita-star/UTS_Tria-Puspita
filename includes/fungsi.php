<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function e($teks): string
{
    return htmlspecialchars(
        (string) $teks,
        ENT_QUOTES,
        'UTF-8'
    );
}

function rupiah($angka): string
{
    return 'Rp' . number_format(
        (float) $angka,
        0,
        ',',
        '.'
    );
}

function kategori_menu(array $menu): array
{
    $kategori = [];

    foreach ($menu as $item) {
        $kategori[] = $item['kategori'];
    }

    return array_values(array_unique($kategori));
}

function hitung_subtotal_item(
    int $harga,
    int $jumlah
): int {
    return $harga * $jumlah;
}

function ringkasan_pesanan(array $keranjang): array
{
    global $daftarMenu;

    $subtotal = 0;

    foreach ($keranjang as $kode => $jumlah) {
        if (
            isset($daftarMenu[$kode]) &&
            is_int($jumlah) &&
            $jumlah > 0
        ) {
            $subtotal += hitung_subtotal_item(
                $daftarMenu[$kode]['harga'],
                $jumlah
            );
        }
    }

    $diskon = $subtotal >= 50000
        ? (int) round($subtotal * 0.10)
        : 0;

    return [
        'subtotal' => $subtotal,
        'diskon' => $diskon,
        'total' => $subtotal - $diskon
    ];
}

function jumlah_item(array $keranjang): int
{
    return array_sum($keranjang);
}

function set_flash(string $pesan): void
{
    $_SESSION['flash'] = $pesan;
}

function ambil_flash(): ?string
{
    if (!isset($_SESSION['flash'])) {
        return null;
    }

    $pesan = $_SESSION['flash'];
    unset($_SESSION['flash']);

    return $pesan;
}
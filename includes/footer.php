<?php
$judulHalaman = $judulHalaman ?? 'Pemesanan Kantin Kampus';
$pesanFlash = ambil_flash();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($judulHalaman) ?></title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header class="header">
    <div class="container">
        <h1>Kantin Kampus</h1>
        <p>Aplikasi Pemesanan Makanan dan Minuman</p>

        <nav>
            <a href="index.php">Daftar Menu</a>
            <a href="keranjang.php">Keranjang</a>
        </nav>
    </div>
</header>

<main class="container">
    <?php if ($pesanFlash !== null): ?>
        <div class="alert">
            <?= e($pesanFlash) ?>
        </div>
    <?php 
endif; ?>
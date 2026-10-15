<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/../data/menu.php';
require_once __DIR__ . '/fungsi.php';
$jml_keranjang = isset($_SESSION['keranjang']) ? count($_SESSION['keranjang']) : 0;
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Kantin Kampus - UTS Tria Puspita</title>
<link rel="stylesheet" href="assets/style.css"></head><body>
<div class="navbar">
  <a href="index.php">🍔 Kantin 25012049</a>
  <div style="display:flex;gap:15px;align-items:center">
    <a href="index.php">Menu</a>
    <a href="keranjang.php" style="background:var(--dark);color:white;padding:8px 14px;border-radius:20px">🛒 Keranjang (<?=$jml_keranjang?>)</a>
  </div>
</div>
<div class="container">
<?php
if(isset($_SESSION['flash_sukses'])){ echo "<div class='flash flash-sukses'>".$_SESSION['flash_sukses']."</div>"; unset($_SESSION['flash_sukses']); }
if(isset($_SESSION['flash_error'])){ echo "<div class='flash flash-error'>".$_SESSION['flash_error']."</div>"; unset($_SESSION['flash_error']); }
?>
<?php
session_start();
require 'data/menu.php';
require 'includes/fungsi.php';

$kode = $_POST['kode'] ?? '';
$jumlah = $_POST['jumlah'] ?? '';
$aksi = $_POST['aksi'] ?? '';

if($aksi=='tambah'){
  // U03a - Kosong
  if($jumlah==='' || $jumlah===null){
    $_SESSION['flash_error']="U03a Jumlah tidak boleh kosong";
    header("Location: index.php"); exit;
  }
  // U03d - Harus angka & U03 pecahan harus bilangan bulat
  if(!is_numeric($jumlah) || strpos((string)$jumlah, '.')!==false && floor($jumlah)!= $jumlah){
    // cek pecahan khusus
    if(is_numeric($jumlah) && floor($jumlah) != $jumlah){
      $_SESSION['flash_error']="U03d Jumlah harus bilangan bulat (tidak boleh 0.5)";
      header("Location: index.php"); exit;
    }
    // === U04 - Kode tidak ada ===
if(!isset($menu[$kode])){
    $_SESSION['flash_error']="U04 Kode menu tidak ditemukan";
    header("Location: index.php"); exit;
}

// === U05 - Keranjang Penuh ===
if(!isset($_SESSION['keranjang'])) $_SESSION['keranjang'] = [];
$total_qty = 0;
foreach($_SESSION['keranjang'] as $it){
    $total_qty += $it['jumlah'];
}
if(count($_SESSION['keranjang']) >= 10 || ($total_qty + $jumlah) >20){
    $_SESSION['flash_error']="U05 Keranjang penuh! Maksimal 5 jenis atau 20 item";
    header("Location: index.php"); exit;
}

if(!is_numeric($jumlah)){
    $_SESSION['flash_error']="U03 Jumlah harus angka";
    header("Location: index.php"); exit;
}
  }
  $jumlah = (int)$jumlah;

  // U03b - Nol & Negatif
  if($jumlah<=0){
    if($jumlah==0) $_SESSION['flash_error']="U03b Jumlah tidak boleh 0";
    else $_SESSION['flash_error']="U03b Jumlah tidak boleh negatif";
    header("Location: index.php"); exit;
  }
  // U03c - Lebih dari 10
  if($jumlah>10){
    $_SESSION['flash_error']="U03c Maksimal 10 per item";
    header("Location: index.php"); exit;
  }
  // U04 - Kode tidak ada
  if(!cariMenu($kode,$menus)){
    $_SESSION['flash_error']="U04 Kode $kode tidak ditemukan";
    header("Location: index.php"); exit;
  }
  // U05 - Maksimal 10 akumulasi
  $sudah = $_SESSION['keranjang'][$kode] ?? 0;
  if($sudah + $jumlah > 10){
    $_SESSION['flash_error']="U05a Maksimal 10, sudah ada $sudah, coba tambah ".(10-$sudah)." lagi";
    header("Location: index.php"); exit;
  }
  if(count($_SESSION['keranjang'] ?? [])>=5 && !isset($_SESSION['keranjang'][$kode])){
    $_SESSION['flash_error']="U05b Keranjang penuh maksimal 5 jenis menu";
    header("Location: index.php"); exit;
  }
  $_SESSION['keranjang'][$kode] = $sudah + $jumlah;
  $_SESSION['flash_sukses']="Berhasil tambah $kode x $jumlah";
  header("Location: keranjang.php"); exit;
}

if($aksi=='hapus'){
  unset($_SESSION['keranjang'][$kode]);
  $_SESSION['flash_sukses']="Item $kode dihapus";
  header("Location: keranjang.php"); exit;
}

if($aksi=='kosongkan'){
  $_SESSION['keranjang']=[];
  $_SESSION['flash_sukses']="Keranjang dikosongkan";
  header("Location: keranjang.php"); exit;
}

header("Location: index.php"); exit;
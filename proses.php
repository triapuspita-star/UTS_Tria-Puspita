<?php
session_start();
require 'data/menu.php';
require 'includes/fungsi.php';
$kode = $_POST['kode'] ?? '';
$jumlah = $_POST['jumlah'] ?? '';
$aksi = $_POST['aksi'] ?? '';

if($aksi=='tambah'){
  if($jumlah==='' || !is_numeric($jumlah)){ $_SESSION['flash_error']="U03a Jumlah wajib diisi"; header("Location: index.php"); exit; }
  if($jumlah<=0){ $_SESSION['flash_error']="U03b Jumlah harus >0"; header("Location: index.php"); exit; }
  if($jumlah>10){ $_SESSION['flash_error']="U03c Maksimal 10"; header("Location: index.php"); exit; }
  if(!cariMenu($kode,$menus)){ $_SESSION['flash_error']="Kode tidak valid"; header("Location: index.php"); exit; }
  $_SESSION['keranjang'][$kode] = ($_SESSION['keranjang'][$kode] ?? 0) + $jumlah;
  if(count($_SESSION['keranjang'])>5){ $_SESSION['flash_error']="Keranjang max 5 jenis"; unset($_SESSION['keranjang'][$kode]); header("Location: keranjang.php"); exit; }
  $_SESSION['flash_sukses']="Berhasil tambah $kode x $jumlah";
  header("Location: keranjang.php"); exit;
}
if($aksi=='hapus'){
  unset($_SESSION['keranjang'][$kode]);
  header("Location: keranjang.php"); exit;
}
if($aksi=='checkout'){
  $total = hitungTotal($_SESSION['keranjang']??[], $menus);
  if($total['total']>=50000){ $diskon = 5000; } else { $diskon = 0; }
  $_SESSION['last_checkout'] = $total;
  $_SESSION['keranjang']=[];
  $_SESSION['flash_sukses']="Checkout OK Total:".$total['total']." Diskon:$diskon";
  header("Location: keranjang.php"); exit;
}
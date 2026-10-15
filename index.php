<?php
session_start();
require 'data/menu.php';
require 'includes/fungsi.php';
$filter = $_GET['kategori'] ?? ($_COOKIE['kategori_favorit'] ?? 'Semua');
$q = $_GET['q'] ?? '';
if(isset($_GET['kategori']) && in_array($_GET['kategori'], ['Makanan','Minuman','Snack','Semua'])){ setcookie('kategori_favorit',$_GET['kategori'],time()+86400*30,"/"); }
$hasil=[];
foreach($menus as $m){
 if($filter!='Semua' && $m['kategori']!=$filter) continue;
 if($q!='' && stripos($m['nama'],$q)===false) continue;
 $hasil[]=$m;
}
$jml_keranjang = isset($_SESSION['keranjang']) ? array_sum($_SESSION['keranjang']) : 0;
?>
<!DOCTYPE html><html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Kantin Cantik - Tria 25012049</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
*{font-family:'Poppins',sans-serif;box-sizing:border-box}body{margin:0;background:#fff8f3;color:#222}
.nav{background:#fff;padding:14px 24px;display:flex;justify-content:space-between;align-items:center;box-shadow:0 2px 15px rgba(0,0,0,.08);position:sticky;top:0}
.nav b{font-size:18px}.nav a{text-decoration:none;color:#222;font-weight:600;margin-left:15px}
.badge{background:#ff6b35;color:#fff;padding:6px 12px;border-radius:20px}
.container{max-width:1050px;margin:0 auto;padding:20px}
.hero{background:linear-gradient(135deg,#ff6b35,#ff9a62);color:white;padding:28px;border-radius:20px;margin-bottom:20px}
.hero h1{margin:0 0 5px;font-size:26px}
.search{display:flex;gap:10px;background:white;padding:14px;border-radius:14px;box-shadow:0 4px 15px rgba(0,0,0,.05);margin-bottom:22px}
.search input,.search select{flex:1;padding:10px 14px;border:1px solid #eee;border-radius:10px;outline:none}
.btn{border:none;padding:10px 16px;border-radius:10px;cursor:pointer;font-weight:600}
.btn-orange{background:#ff6b35;color:white}.empty{background:white;border-radius:18px;padding:40px;text-align:center;box-shadow:0 6px 20px rgba(0,0,0,.06)}
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:18px}
.card{background:white;border-radius:18px;padding:18px;box-shadow:0 6px 20px rgba(0,0,0,.06);border:1px solid #fff0e5}
.kode{background:#fff0e5;color:#ff6b35;padding:4px 10px;border-radius:20px;font-size:11px;font-weight:700}
.harga{font-size:22px;font-weight:700;margin:8px 0}
.form{display:flex;gap:8px;margin-top:12px}.form input{width:65px;text-align:center;border:1px solid #eee;border-radius:10px;padding:8px}
.flash{padding:12px;border-radius:10px;margin-bottom:12px}.ok{background:#e8f8e8;color:#2b7a2b}.err{background:#ffe8e8;color:#a33}
</style></head><body>
<div class="nav"><b>🍔 KANTIN TRIA 25012049</b><div><a href="index.php">Menu</a><a href="keranjang.php" class="badge">🛒 <?= $jml_keranjang ?> item</a></div></div>
<div class="container">
<div class="hero"><h1>Mau makan apa hari ini? 😋</h1><div>Pilih menu favoritmu, diskon 5rb jika belanja ≥ 50rb</div></div>
<?php if(isset($_SESSION['flash_sukses'])){ echo "<div class='flash ok'>".$_SESSION['flash_sukses']."</div>"; unset($_SESSION['flash_sukses']); }
if(isset($_SESSION['flash_error'])){ echo "<div class='flash err'>".$_SESSION['flash_error']."</div>"; unset($_SESSION['flash_error']); } ?>
<form method="GET" class="search"><input name="q" value="<?=htmlspecialchars($q)?>" placeholder="Cari: Nasi Goreng, Kopi Susu..."><select name="kategori"><option <?= $filter=='Semua'?'selected':'' ?>>Semua</option><option <?= $filter=='Makanan'?'selected':'' ?>>Makanan</option><option <?= $filter=='Minuman'?'selected':'' ?>>Minuman</option><option <?= $filter=='Snack'?'selected':'' ?>>Snack</option></select><button class="btn btn-orange">Cari</button><a href="index.php" class="btn" style="background:#eee">Reset</a></form>

<?php if(empty($hasil)){ ?>
<div class="empty"><h2 style="margin:0">😕 Menu tidak ditemukan</h2><p style="color:#888">Tidak ada hasil untuk "<b><?=htmlspecialchars($q)?></b>" kategori "<?=htmlspecialchars($filter)?>"</p><a href="index.php" class="btn btn-orange">Lihat Semua Menu</a></div>
<?php } else { ?>
<div class="grid">
<?php foreach($hasil as $m){ ?>
<div class="card"><span class="kode"><?=$m['kode']?></span> <small style="color:#888"><?=$m['kategori']?></small><div style="font-weight:600;margin:6px 0 0;font-size:17px"><?=$m['nama']?></div><div class="harga">Rp <?=number_format($m['harga'],0,',','.')?></div><form method="POST" action="proses.php" class="form"><input type="hidden" name="kode" value="<?=$m['kode']?>"><input type="number" name="jumlah" value="1" min="1" max="10"><button class="btn btn-orange" name="aksi" value="tambah">+ Keranjang</button></form></div>
<?php } ?></div>
<?php } ?>
</div></body></html>
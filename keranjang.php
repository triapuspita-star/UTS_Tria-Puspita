<?php
session_start();
require_once 'data/menu.php';
require_once 'includes/fungsi.php';
$keranjang = $_SESSION['keranjang'] ?? [];
$total = hitungTotal($keranjang, $menus);
$grand = $total['total'];
$diskon = $grand >= 50000 ? 5000 : 0;
$bayar = $grand - $diskon;
$jml_item = array_sum($keranjang);
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Keranjang - Kantin Tria</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
*{font-family:'Poppins',sans-serif;box-sizing:border-box}
body{margin:0;background:#fff8f3;color:#222}
.nav{background:#fff;padding:14px 24px;display:flex;justify-content:space-between;align-items:center;box-shadow:0 2px 15px rgba(0,0,0,.08);position:sticky;top:0}
.nav a{text-decoration:none;color:#222;font-weight:600}
.badge{background:#ff6b35;color:#fff;padding:6px 12px;border-radius:20px}
.container{max-width:800px;margin:0 auto;padding:20px}
.card{background:white;border-radius:18px;padding:20px;box-shadow:0 6px 20px rgba(0,0,0,.06);margin-bottom:15px}
.btn{border:none;padding:10px 16px;border-radius:10px;cursor:pointer;font-weight:600}
.btn-orange{background:#ff6b35;color:white}
.btn-dark{background:#2d2d2d;color:white}
.btn-light{background:#eee;color:#333}
.flash{padding:12px;border-radius:10px;margin-bottom:15px}
.ok{background:#e8f8e8;color:#2b7a2b} .err{background:#ffe8e8;color:#a33}
.total-box{background:#2d2d2d;color:white;padding:22px;border-radius:16px;margin-top:20px}
.total-box b{color:#ff9a62}
.item{display:flex;justify-content:space-between;align-items:center;padding:12px 0;border-bottom:1px solid #f0f0f0}
</style></head><body>
<div class="nav"><a href="index.php"><b>🍔 KANTIN TRIA 25012049</b></a><div><a href="index.php">Menu</a> <span class="badge">🛒 <?= $jml_item ?> item</span></div></div>
<div class="container">
<h1>Keranjang Belanja</h1>
<?php if(isset($_SESSION['flash_sukses'])){ echo "<div class='flash ok'>".$_SESSION['flash_sukses']."</div>"; unset($_SESSION['flash_sukses']); }
if(isset($_SESSION['flash_error'])){ echo "<div class='flash err'>".$_SESSION['flash_error']."</div>"; unset($_SESSION['flash_error']); } ?>

<div class="card">
<?php if(empty($keranjang)){ echo "<p>Keranjang masih kosong, yuk tambah menu dulu!</p><a href='index.php' class='btn btn-orange'>Ke Menu</a>"; } else {
 foreach($keranjang as $kode=>$jml){ $m=cariMenu($kode,$menus); if(!$m) continue; ?>
 <div class="item">
  <div><b><?=$m['nama']?></b><br><small><?=$m['kode']?> | Rp<?=number_format($m['harga'])?> x <?=$jml?></small></div>
  <div style="text-align:right">
   <div>Rp<?=number_format($m['harga']*$jml)?></div>
   <form method="POST" action="proses.php"><input type="hidden" name="kode" value="<?=$kode?>"><button name="aksi" value="hapus" class="btn btn-light" style="margin-top:5px;padding:5px 10px;font-size:12px">Hapus</button></form>
  </div>
 </div>
<?php } } ?>
</div>

<?php if(!empty($keranjang)){ ?>
<div class="total-box">
<div style="display:flex;justify-content:space-between;margin-bottom:8px"><span>Total</span><span>Rp<?=number_format($grand)?></span></div>
<div style="display:flex;justify-content:space-between;margin-bottom:8px"><span>Diskon <?= $grand>=50000?'5rb (≥50rb)':'0 (belanja ≥50rb dapat 5rb)' ?></span><span>Rp<?=number_format($diskon)?></span></div>
<hr style="border-color:#444">
<div style="display:flex;justify-content:space-between;font-size:20px;font-weight:700"><span>Bayar</span><span><b>Rp<?=number_format($bayar)?></b></span></div>
<form method="POST" action="proses.php" style="margin-top:18px"><button name="aksi" value="checkout" class="btn btn-orange" style="width:100%;padding:14px;font-size:16px">Checkout Sekarang</button></form>
</div>
<?php } ?>
<a href="index.php" style="display:inline-block;margin-top:20px;text-decoration:none">← Lanjut Belanja</a>
</div></body></html>
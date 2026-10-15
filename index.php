<?php require 'includes/header.php'; 
$filter = $_GET['kategori'] ?? ($_COOKIE['kategori_favorit'] ?? 'Semua');
$q = $_GET['q'] ?? '';
$hasil=[];
foreach($menus as $m){
 if($filter!='Semua' && $m['kategori']!=$filter) continue;
 if($q!='' && stripos($m['nama'],$q)===false) continue;
 $hasil[]=$m;
}
if(isset($_GET['kategori']) && in_array($_GET['kategori'],$kategoris)){ setcookie('kategori_favorit',$_GET['kategori'],time()+86400*30,"/"); }
?>
<h1 style="margin:10px 0 5px">Mau makan apa hari ini? 😋</h1>
<p style="color:#888;margin-top:0">Pilih menu favoritmu, diskon 5rb jika belanja ≥ 50rb</p>

<form method="GET" class="search-box">
<input name="q" value="<?=htmlspecialchars($q)?>" placeholder="Cari Nasi Goreng, Kopi...">
<select name="kategori"><?php foreach($kategoris as $k) echo "<option ".($filter==$k?'selected':'').">$k</option>";?></select>
<button class="btn btn-primary" type="submit">Cari</button>
<a href="index.php" class="btn" style="background:#eee">Reset</a>
</form>

<div class="menu-grid">
<?php foreach($hasil as $m){ ?>
<div class="menu-card">
<span class="kode"><?=$m['kode']?></span> <span class="meta"><?=$m['kategori']?></span>
<h3 style="margin:10px 0 5px"><?=$m['nama']?></h3>
<div class="harga">Rp<?=number_format($m['harga'],0,',','.')?></div>
<form method="POST" action="proses.php" class="form-tambah">
<input type="hidden" name="kode" value="<?=$m['kode']?>">
<input type="number" name="jumlah" value="1" min="1" max="10">
<button class="btn btn-primary" name="aksi" value="tambah">+ Keranjang</button>
</form>
</div>
<?php } ?>
</div>
<?php require 'includes/footer.php'; ?>
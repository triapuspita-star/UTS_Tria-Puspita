<?php
if (!function_exists('cariMenu')) {
 function cariMenu($kode,$menus){ foreach($menus as $m){ if($m['kode']==$kode) return $m; } return null; }
}
if (!function_exists('hitungTotal')) {
 function hitungTotal($keranjang,$menus){ $total=0; foreach($keranjang as $kode=>$jml){ $m=cariMenu($kode,$menus); if($m) $total+=$m['harga']*$jml; } return ['total'=>$total]; }
}
?>
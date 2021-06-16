<?php 
session_start();
include "lib/koneksi.php";
$id_produk=$_GET["id"];
$konek->query("UPDATE TB_PRODUK set stok_produk = stok_produk+$jumlah WHERE id_produk='$id_produk'");
unset($_SESSION["keranjang"][$id_produk]);

echo "<script>('produk dihapus dari keranjang')</script>";
echo "<script>location='keranjang.php'</script>";
?>
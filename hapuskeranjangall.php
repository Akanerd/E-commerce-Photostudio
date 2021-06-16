<?php 
session_start();
$id_produk=$_GET["id"];
unset($_SESSION["keranjang"]);
echo "<script>('semua produk dihapus dari keranjang')</script>";
echo "<script>location='keranjang.php'</script>";
?>
<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "db_project");
// if(!isset($_SESSION["pelanggan"])){
//     echo "<script>alert('login dulu');</script>";
//     echo "<script>location='login.php';</script>";
// }

if (empty($_SESSION["keranjang"])  or !isset($_SESSION["keranjang"])) {
    echo "<script>alert ('keranjang kosong')</script>";
    echo "<script>location='index.php'</script>";
}
if (!isset($_SESSION["username"])) {
    echo "<script> alert('Anda harus login dulu !')</script>";
    echo "<script>location='login.php'</script>";
    exit;
}
$level = $_SESSION["level"];
if ($level != "member") {
    echo "Anda tidak punya akses pada halaman pembeli";
    exit;
}
$id_customer = $_SESSION["id_user"];
$username = $_SESSION["username"];
$nama = $_SESSION["nama"];
$email = $_SESSION["email"];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Boostrap css -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- CSS Sheet -->
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/fontawesome.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="css/fontawesome.min.css"> -->

    <!-- font google -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    <link rel="shortcut icon" href="./img/logotab.png">
    <!--Judul web  -->
    <title>Checkout</title>
</head>

<body>
    <!-- Header -->
    <header>
        <!-- Header atas -->
        <div id="header-atas"></div>
        <!--  -->
        <div id="main-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="header-logo">
                            <a href="#" class="logo">
                                <img src="./img/nav.png" alt="">
                            </a>
                        </div>
                    </div>
                    <!--  -->

                    <!-- Account acces login,logout,cart -->
                    <div class="col-md-5 clearfix">
                        <div class="header-ctn">
                            <!-- cart -->
                            <div>
                                <a href="keranjang.php">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Your Cart</span>
                                </a>
                            </div>
                            <div>
                                <a href="checkout.php">
                                    <i class="fa fa-box"></i>
                                    <span>Checkout</span>
                                </a>
                            </div>
                            <div>
                                <a href="riwayat.php">
                                    <i class="fa fa-history"></i>
                                    <span>History</span>
                                </a>
                            </div>
                            <div>
                                <a href="logout.php">
                                    <i class="fa fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav id="navigation" class="navbar navbar-expand-md sticky-top">
        <div class="container">
            <div class="row">
                <div id="navbarCollapse" class="collapse navbar-collapse">
                    <ul class="nav main-nav">
                        <li class="nav-item">
                        <h4 class="mt-3 mb-1"><span class="icon"><i class="fa fa-box" aria-hidden="true"></i></span> Your Checkout</h4><br>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
        <div id="section">
            <div class="container mt-5">
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>Product</th>
                                <th>Berat</th>
                                <th>Harga</th>
                                <th>Jumlah Unit</th>
                                <th>Diskon</th>
                                <th>Potongan Biaya</th>
                                <th>Subharga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php $totalbelanja = 0 ?>
                            <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) : ?>
                                <!--menampilkkan produk yang diperulangkan berdasarkan id produk-->
                                <?php
                                $ambil = $koneksi->query("select * from tb_produk 
                                          where id_produk=$id_produk");
                                $pecah = $ambil->fetch_assoc();
                                $diskon = $pecah["diskon"];
                                $hargaproduk = $pecah["harga_produk"];
                                             $potongan = (($hargaproduk * $diskon) / 100);
                                             $subharga = ($pecah["harga_produk"] * $jumlah)-$potongan;
                                ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $pecah["nama_produk"]; ?></td>
                                    <td><?php echo $pecah["berat_produk"]; ?> Gram</td>
                                    <td><?php
                                        $harga = number_format($pecah['harga_produk'], 2, ",", ".");
                                        echo "Rp " . $harga;
                                        ?></td>
                                    <td><?php echo $jumlah; ?></td>
                                    <td><?php if($pecah['diskon']=="0"){
                                        echo"<script>Diskon anda tidak ada</script>";
                                    }else{
                                        echo "$diskon";
                                    }
                                        ?> %</td>
                                    <td><?php $potonganbiaya = number_format($potongan, 2, ",", ".");
                                        echo "Rp " . $potonganbiaya;  ?></td>
                                    <td>Rp <?php echo number_format($subharga); ?></td>
                                </tr>
                                <?php $i++; ?>
                                <?php $totalbelanja += $subharga ?>
                            <?php endforeach ?>

                        </tbody>
                        <tfoot>
                            <th class="text-right" colspan="7"> Total belanja</th>
                            <th> <?php
                                    $Totalharga = number_format($totalbelanja, 2, ",", ".");
                                    echo "Rp " . $Totalharga;
                                    ?></th>
                            <tr>
                                <th colspan="8" class="text-right"> <?php
                                   if (($totalbelanja >= 7500000 )) {
                                    $discount = (($totalbelanja * 25) / 100);
                                    $total_bayar = ($totalbelanja - $discount);
                                    echo " Discount 25% Total Bayar : Rp. $total_bayar,-</p>";
                                } else if (($totalbelanja >= 5500000 )) {
                                    $discount = (($totalbelanja * 15) / 100);
                                    $total_bayar = ($totalbelanja - $discount);
                                    echo "<p> Discount 15% Total Bayar : Rp. $total_bayar,-</p>";
                                } else {
                                    $total_bayar = $totalbelanja;
                                    echo "<br> Anda Tidak Mendapatkan Discount";
                                } ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <form method="post">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nama Pelanggan</label>
                                <input class="form-control mr-3" type="text" readonly value="<?php echo $nama ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email Pelanggan</label>
                                <input class="form-control" type="text" readonly value="<?php echo $email ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="">Pilih Ongkos kirim</label>
                            <select class="form-control" name="id_ongkir" required>
                                <?php
                                $ambil = $koneksi->query("select * from tb_ongkir");
                                while ($perongkir = $ambil->fetch_assoc()) {
                                ?>
                                    <option required value="<?php echo $perongkir["id_ongkir"] ?>">
                                        <?php echo $perongkir['jenis_ongkir'] ?> Rp .
                                        <?php echo number_format($perongkir['tarif']) ?>
                                        </>
                                    <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
        </div>
        <div class="container pb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label >Alamat Lengkap</label>
                        <textarea name="alamat_pengiriman" class="form-control">
                    </textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <button class="btn btn-primary" name="checkout"><i class="fa fa-paper-plane"></i> checkout</button>
                </div>
            </div>
        </div>
        </div>
        </form>
        <?php
        if (isset($_POST["checkout"])) {
            $id_pelanggan = $id_customer;
            $id_ongkir    = $_POST["id_ongkir"];
            $tanggal_pembelian = date("Y-m-d");
            $alamat_pengiriman = $_POST['alamat_pengiriman'];

            $ambil = $koneksi->query("SELECT * from tb_ongkir where id_ongkir ='$id_ongkir'");
            $arrayongkir = $ambil->fetch_assoc();
            $nama_kota = $arrayongkir['jenis_ongkir'];
            $tarif     = $arrayongkir['tarif'];

            $total_pembelian = $total_bayar + $tarif;

            //1 menyompan data ke tabel pembelian
            $koneksi->query("insert into tb_pembelian (id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian,jenis_ongkir,tarif,alamat_pengiriman) 
                    values ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$nama_kota','$tarif','$alamat_pengiriman')");
            //mendapatkan id pembelian barusan terjadi
            $id_pembelian_barusan = $koneksi->insert_id;

            foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) {
                $ambil = $koneksi->query("SELECT * FROM tb_produk WHERE id_produk='$id_produk'");
                $perproduk = $ambil->fetch_assoc();
                $nama      = $perproduk['nama_produk'];
                $harga     = $perproduk['harga_produk'];
                $subberat  = $perproduk['berat_produk'];
                $berat     = $perproduk['berat_produk'] * $jumlah;
                $subharga  = $perproduk['harga_produk'] * $jumlah;
                $koneksi->query("UPDATE tb_produk set stok_produk = stok_produk - $jumlah WHERE id_produk='$id_produk'");
                $koneksi->query("INSERT INTO tb_pembelian_produk (id_pembelian,id_produk,nama,harga,berat,subberat,subharga,jumlah)
                          VALUES ('$id_pembelian_barusan','$id_produk','$nama','$harga','$berat',
                          '$subberat','$subharga','$jumlah') ");
               
            }

            //mengkosongkan keranjang belanja
            unset($_SESSION["keranjang"]);

            //tampilan dialihkan ke halaman nota,nota dari pembelian barusan
            echo "<script>alert('pembelian sukses');</script>";
            echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
        } else if (!empty($_POST["id_ongkir"])) {
            echo "<script>alert('lokasi kosong');</script>";
            echo "<script>location='checkout.php'</script>";
        }
        ?>
        <!-- <pre><?php print_r($_SESSION["keranjang"]) ?></pre> -->
        <?php include "inc/footer.php"?>
</body>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</html>
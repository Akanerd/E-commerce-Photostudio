<?php
session_start();
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
$koneksi = new mysqli("localhost", "root", "", "db_project");
$id_customer = $_SESSION["id_user"];
// $username = $_SESSION["username"];
// $nama = $_SESSION["nama"];
// $email = $_SESSION["email"];
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
    <title>Nota Pembelian</title>
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
                            <a href="index.php" class="logo">
                                <img src="./img/nav.png" alt="">
                            </a>
                        </div>
                    </div>
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
                                <a href="logout.php" onClick="return confirm ('Are you sure to logout ?')">
                                    <i class="fa fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <nav id="navigation" class="navbar navbar-expand-md sticky-top">
        <div class="container">
            <div class="row">
                <div id="navbarCollapse" class="collapse navbar-collapse">
                    <ul class="nav main-nav">
                        <li class="nav-item">
                            <h4 class="mt-3 mb-1"><span class="icon"><i class="fa fa-plus" aria-hidden="true"></i></span> Purchase Details</h4><br>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <?php $ambil = $koneksi->query("select * from tb_pembelian join tb_user 
                            on tb_pembelian.id_pelanggan=tb_user.id_user
                            where tb_pembelian.id_pembelian ='$_GET[id]'");
                $detail = $ambil->fetch_assoc(); ?>
                <h3>Pembelian</h3>
                <strong>No. Pembelian <?php echo $detail['id_pembelian']; ?></strong><br>
                Tanggal : <?php echo $detail['tanggal_pembelian']; ?><br>
                Total : Rp. <?php echo number_format($detail['total_pembelian']) ?>
            </div>
            <div class="col-md-4">
                <h3>Pelanggan</h3>
                <strong><?php echo $detail['nama_user']; ?></strong><br>
                <p>
                    <?php echo $detail['username']; ?><br>
                    <?php echo $detail['email']; ?>
                </p>
            </div>
            <div class="col-md-4">
                <h3>Pengiriman</h3>
                <strong><?php echo $detail['jenis_ongkir'] ?></strong>
                <p>
                    Ongkos Kirim : Rp. <?php echo number_format($detail['tarif']); ?>
                </p>
            </div>
        </div>
    </div>
    <!-- <div id=section>
            <div class="container">
                <div class="row">
                    <a href="index.php"><button type="button" class="btn btn-outline-primary" style="margin-right : 10px; margin-left: 800px;">add Product</button></a>
                    <a href=""><button type="button" class="btn btn-outline-secondary" style="margin-right: 10px;">empty cart</button></a>
                    <a href="index.php"><button type="button" class="btn btn-outline-secondary" style="">Home</button></a>
                </div>
            </div>
        </div> -->
    <?php
    //mendapatkan id pelanggan yang dibeli
    $idpelangganyangbeli = $detail["id_pelanggan"];

    //mendapatkan id pelanggan yang login

    if ($idpelangganyangbeli != $id_customer) {
        echo "<script>alert('data anda tidak valid dengan pengguna')</script>";
        echo "<script>location='riwayat.php'</script>";
    }

    //
    ?>
    </div>
    <hr>
    <div id="section">
        <div class="container">
            <div class="row">
                <h4> <span class="icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span> Your Cart</h4>
                <br><br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Produk</th>
                            <th>Harga Produk</th>
                            <th>Berat</th>
                            <th>Jumlah</th>
                            <th>Subberat</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nomor = 1; ?>
                        <?php $ambil = $koneksi->query("SELECT * FROM tb_pembelian_produk WHERE id_pembelian ='$_GET[id]'"); ?>
                        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $nomor; ?></td>
                                <td><?php echo $pecah['nama']; ?></td>
                                <td><?php
                                    $harga = number_format($pecah['harga'], 2, ",", ".");
                                    echo "Rp " . $harga;
                                    ?></td>
                                <td><?php echo $pecah['berat']; ?> Gram</td>
                                <td><?php echo $pecah['jumlah']; ?></td>
                                <td><?php echo $pecah['subberat']; ?> Gram</td>
                                <td><?php
                                    $subharga = number_format($pecah['subharga'], 2, ",", ".");
                                    echo "Rp " . $subharga;
                                    ?></td>
                            </tr>
                            <?php $nomor++; ?>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="container pb-5">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <p>Silahkan Melakukan Pembayaran <?php $subtotal = number_format($detail['total_pembelian'], 2, ",", ".");
                                                                    echo "Rp " . $subtotal; ?></p>
                                <strong>BANK BNI 137-001088</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <?php include "inc/footer.php"?>
</body>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</html>
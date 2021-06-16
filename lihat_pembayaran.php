<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "db_project");
// if(!isset($_SESSION["pelanggan"])){
//     echo "<script>alert('login dulu');</script>";
//     echo "<script>location='login.php';</script>";
// }
// if (empty($_SESSION["keranjang"])  or !isset($_SESSION["keranjang"])) {
//     echo "<script>alert ('keranjang kosong')</script>";
//     echo "<script>location='index.php'</script>";
// }
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
$id_pembelian = $_GET['id'];
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
    <title>Lihat Pembayaran</title>
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
                        <h4 class="mt-3 mb-1"><span class="icon"><i class="fa fa-desktop" aria-hidden="true"></i></span> See Your Payments</h4><br>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <br><br>
        <div id="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-striped ">
                            <tbody>
                                <?php $ambil = $koneksi->query("select * from tb_pembayaran join tb_pembelian on tb_pembayaran.id_pembelian =tb_pembelian.id_pembelian where tb_pembelian.id_pembelian ='$id_pembelian'"); ?>
                                <?php $pecah = $ambil->fetch_assoc(); ?>
                                <tr>
                                    <th>Nama</th>
                                    <td><?php echo $pecah['nama'] ?></td>
                                </tr>
                                <tr>
                                    <th>Bank</th>
                                    <td><?php echo $pecah['bank'] ?></td>
                                </tr>
                                <tr>
                                    <th>Jumlah</th>
                                    <td><?php echo number_format($pecah['jumlah']) ?></td>
                                </tr>
                                <tr>
                                    <th>Resi</th>
                                    <td><?php echo ($pecah['resi_pengiriman']) ?></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td><?php echo ($pecah['status_pembelian']) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <img src="img/<?php echo $pecah['bukti'] ?>" alt="" width="500px" height="500px" class="img-fluid">
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
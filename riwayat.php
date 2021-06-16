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
    <title>History</title>
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
                        <h4 class="mt-3 mb-1"><span class="icon"><i class="fa fa-credit-card" aria-hidden="true"></i></span> Payment & Receipt Product History</h4><br>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
    <br><br>
        <div id="section">
            <div class="container">
                <div class="row">
                    <h4> <span class="icon"><i class="fa fa-file" aria-hidden="true"></i></span> Your Info Payment</h4>
                    <br><br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $nomor=1;
                            //mendapatkan id_pelanggan
                            $id_customer;
                            $ambil = $koneksi->query("select * from tb_pembelian where id_pelanggan = '$id_customer'");
                            while($pecah = $ambil->fetch_assoc()){
                            ?>
                            <tr>
                                <td><?php echo $nomor?></td>
                                <td><?php echo $pecah['tanggal_pembelian']?></td>
                                <td>
                                    <?php echo $pecah['status_pembelian']?>
                                    <br>
                                    <?php if (!empty($pecah['resi_pengiriman'])):?>
                                        Resi : <?php echo $pecah['resi_pengiriman'];?>
                                        <?php endif?>
                                </td>
                                <td>Rp .<?php echo number_format($pecah['total_pembelian'])?></td>
                                <td>
                                    <a href="nota.php?id=<?php echo $pecah['id_pembelian'];?>" class="btn btn-info">Nota</a>
                                    <?php if($pecah['status_pembelian']=="pending"):?>
                                    <a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"];?>" class="btn btn-success">Input Pembayaran</a>
                                    <?php else:?>
                                    <a href="lihat_pembayaran.php?id=<?php echo $pecah["id_pembelian"];?>"" class="btn btn-warning">
                                    Lihat Pembayaran</a>
                                    <?php endif?>
                                </td>
                            </tr>
                            <?php $nomor++;?>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php include "inc/footer.php"?>
</body>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>
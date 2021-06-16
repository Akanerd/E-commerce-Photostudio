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
$id_customer = $_SESSION["id_user"];
$username = $_SESSION["username"];
$nama = $_SESSION["nama"];
$email = $_SESSION["email"];
?>
<pre><?php print_r($id_customer)?></pre>
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
    <title>Cart</title>
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
                    <div class="col-md-9">
                        <div class="header-logo">
                            <a href="#" class="logo">
                                <img src="./img/nav.png" alt="">
                            </a>
                        </div>
                    </div>
                    <!--  -->

                    <!-- Account acces login,logout,cart -->
                    <div class="col-md-3 clearfix">
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

        <div class="container">
            <div class="row">
                <div class="section">
                    <h1>My Checkout</h1>
                </div>
            </div>
        </div>
        <div id=section>
            <div class="container">
                <div class="row">
                    <a href="index.php"><button type="button" class="btn btn-outline-primary" style="margin-right : 10px; margin-left: 800px;">add Product</button></a>
                    <a href=""><button type="button" class="btn btn-outline-secondary" style="margin-right: 10px;">empty cart</button></a>
                    <a href="index.php"><button type="button" class="btn btn-outline-secondary" style="">Home</button></a>
                </div>
            </div>
        </div>
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
                                <td><?php echo $pecah['status_pembelian']?></td>
                                <td>Rp .<?php echo number_format($pecah['total_pembelian'])?></td>
                                <td>
                                    <a href="nota.php?id=<?php echo $pecah['id_pembelian']?>" class="btn btn-info">Nota</a>
                                    <a href="" class="btn btn-success">Pembayaran</a>
                                </td>
                            </tr>
                            <?php $nomor++;?>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</body>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>
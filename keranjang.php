<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "db_project");

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
                        <h4 class="mt-3 mb-1"><span class="icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span> Shopping list</h4><br>
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
                <div class="col-md-12">  
                    <a href="index.php"><button type="button" class="btn btn-outline-primary" style=" margin-left: 720px;"><i class="fa fa-plus"></i> Add Product</button></a>
                    <a href="hapuskeranjangall.php"><button type="button" class="btn btn-danger" style=><i class="fa fa-trash"></i> Empty Cart</button></a>
                    <a href="index.php"><button type="button" class="btn btn-outline-secondary" style=><i class="fa fa-home"></i> Home</button></a>
                    <br><br>
                </div>
                <table class="table table-bordered mt-1">
                    <thead>
                        <tr>
                            <th>NO.</th>
                            <th>Product</th>
                            <th>Harga</th>
                            <th>Diskon</th>
                            <th>Potongan Biaya</th>
                            <th>Jumlah Unit</th>
                            <th>Subharga</th>
                            <th>Aksi</th>
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
                            $pecah  = $ambil->fetch_assoc();
                            $diskon = $pecah["diskon"];
                            $hargaproduk = $pecah["harga_produk"];
                            $potongan = (($hargaproduk * $diskon) / 100);
                            $subharga = ($pecah["harga_produk"] * $jumlah) - $potongan;
                            ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $pecah["nama_produk"]; ?></td>
                                <td><?php
                                    $harga = number_format($pecah['harga_produk'], 2, ",", ".");
                                    echo "Rp " . $harga;
                                    ?></td>
                                <td><?php if ($pecah['diskon'] == "0") {
                                        echo "<p>Diskon anda tidak ada</p>";
                                    }
                                    else if ($pecah['diskon'] == "") {
                                        echo "<p>Diskon Belum Diset Oleh Admin</p>";
                                    } else {
                                        echo "$diskon %";
                                    }
                                    ?></td>
                                <td><?php $potonganbiaya = number_format($potongan, 2, ",", ".");
                                    echo "Rp " . $potonganbiaya;  ?></td>
                                <td><?php echo $jumlah; ?></td>
                                <td>Rp <?php echo number_format($subharga); ?></td>
                                <td><a href="hapuskeranjang.php?id=<?php echo $id_produk ?>"><button type="button" class="btn btn-danger btn-sm "><span><i class="fa fa-trash" aria-hidden="true"></i></span> Hapus</button></a></td>
                            </tr>
                            <?php $totalbelanja += $subharga ?>
                            <?php $i++; ?>

                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <th class="text-right" colspan="6"> Total belanja</th>
                        <th> <?php
                                $Totalharga = number_format($totalbelanja, 2, ",", ".");
                                echo "Rp " . $Totalharga;
                                ?></th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="container pb-5 mt-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="btn btn-warning">
                                    <p><i class="fa fa-bullhorn"></i> <strong>Diskon 25%</strong> Untuk Total Pembelanjaan Lebih dari <strong>Rp 7.500.000,00-</strong> <br>
                <i class="fa fa-bullhorn"></i> <strong>Diskon 15%</strong> Untuk Untuk Total Pembelanjaan Lebih Dari <strong>Rp 5.500.000,00-</strong></p>
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
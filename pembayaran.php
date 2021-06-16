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
// if(!isset($_SESSION["pelanggan"])){
//     echo "<script>alert('login dulu');</script>";
//     echo "<script>location='login.php';</script>";
// }
if (empty($_SESSION["nama"])  or !isset($_SESSION["nama"])) {
    echo "<script>alert ('silahkan login')</script>";
    echo "<script>location='login.php'</script>";
}
$id_customer = $_SESSION["id_user"];
$username = $_SESSION["username"];
$nama = $_SESSION["nama"];
$email = $_SESSION["email"];
?>
<!-- <pre><?php print_r($id_customer) ?></pre> -->
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
    <title>Kirim Pembayaran</title>
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
                            <h4 class="mt-3 mb-1"><span class="icon"><i class="fa fa-credit-card" aria-hidden="true"></i></span> Your Bill Product</h4><br>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    </header>
    <div id="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    //mendapatkan id dari url
                    $idpem = $_GET["id"];
                    $ambil = $koneksi->query("SELECT * FROM tb_pembelian where id_pembelian='$idpem'");
                    $detpem   = $ambil->fetch_assoc();

                    //mendapatkan id_pelanggan yang beli
                    $id_pelanggan_beli = $detpem["id_pelanggan"];
                    $id_pelanggan_login = $_SESSION["id_user"];
                    if ($id_pelanggan_login != $id_pelanggan_beli) {
                        echo "<script>alert('anda harus login terlebih dahulu')</script>";
                        echo "<script>location='riwayat.php'</script>";
                        exit();
                    }
                    ?>
                    <br>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="alert alert-info">Total tagihan Anda <strong>Rp. <?php echo number_format($detpem["total_pembelian"]) ?></strong></div>
                        <div class="form-group">
                            <label>Nama Penyetor</label>
                            <input type="text" class="form-control" name="nama">
                        </div>
                        <div class="form-group">
                            <label>Bank</label>
                            <select name="bank" class="form-control">
                                <option value="BNI">BANK BNI</option>
                                <option value="BRI">BANK BRI</option>
                                <option value="MANDIRI">BANK MANDIRI</option>
                                <option value="BCA">BANK BCA</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Biaya Yang Dikenakan</label>
                            <?php $hargasemua = number_format($detpem["total_pembelian"]); ?>
                            <input type="number" class="form-control" name="jumlah" value="<?php echo htmlspecialchars($detpem["total_pembelian"]); ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label>Bukti Pembayaran</label>
                            <input type="file" class="form-control" name="bukti">
                            <p class="text-danger">foto bukti harus jpg/png/jpeg maksimal 10MB</p>
                        </div>
                        <button class="btn btn-primary" name="kirim"><i class="fa fa-paper-plane"></i> Send</button>
                        <?php
                        if (isset($_POST["kirim"])) {

                            $namabukti   = $_FILES["bukti"]["name"];
                            $lokasibukti = $_FILES["bukti"]["tmp_name"];
                            $namafiks     = date("YmHis") . $namabukti;
                            move_uploaded_file($lokasibukti, "img/$namafiks");

                            $nama    = $_POST["nama"];
                            $bank    = $_POST["bank"];
                            $jumlah  = $_POST["jumlah"];
                            $tanggal = date("Y-m-d");

                            //simpan pembayaran
                            $koneksi->query("INSERT INTO `tb_pembayaran`( `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) 
                    VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks')");

                            //update data pembelian
                            $koneksi->query("UPDATE tb_pembelian SET status_pembelian ='Sudah kirim pembayaran'
                                    where id_pembelian='$idpem'");
                            echo "<script>alert('Terima kasih telah mengirim bukti pembayaran')</script>";
                            echo "<script>location='riwayat.php'</script>";
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include "inc/footer.php" ?>
</body>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</html>
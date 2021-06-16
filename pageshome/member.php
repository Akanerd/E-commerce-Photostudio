<?php
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
$id_member = $_GET['id'];
?>

<div class="container">
    <div class="row pt-4">
        <div class="col-md-12">
            <h2 style="font-family: aluria regular; font-weight: normal; font-size: 30px;" class=" text-center pt-3 pb-4">Profile Member</h2>
        </div>
    </div>
</div>
</div>
<hr>
<div id="section">
    <div class="container">
        <?php $ambil = $koneksi->query("select * from tb_user where id_user ='$id_member'"); ?>
        <?php $pecah = $ambil->fetch_assoc(); ?>
        <div class="row pt-4 ">
            <div class="col-md-6 text-center">
                <h3 class="text-center">Profile Picture</h3>
                <img src="img/<?php echo $pecah['avatar'] ?>" width="250px" height="250px" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h3>Detail Profile</h3>
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama Member</label>
                        <input type="text" name="nama" value="<?php echo $pecah['nama_user'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email Member</label>
                        <input type="email" name="email" value="<?php echo $pecah['email'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>username Member</label>
                        <input type="text" name="username" value="<?php echo $pecah['username'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Password Member</label>
                        <input type="password" name="password" value="<?php echo $pecah['password'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Avatar Member</label>
                        <input type="file" name="bukti" value="<?php echo $pecah['avatar'] ?>" class="form-control">
                    </div>
                    <?php ?>
                    <button class="btn btn-success" name="save">Proses</button>
                </form>
                <?php
                if (isset($_POST['save'])) {
                    $namabukti   = $_FILES["bukti"]["name"];
                    $lokasibukti = $_FILES["bukti"]["tmp_name"];
                    $namafiks     = date("YmHis") . $namabukti;
                    move_uploaded_file($lokasibukti, "img/$namafiks");

                    $nama = $_POST['nama'];
                    $username = $_POST['username'];
                    $pass = $_POST['password'];
                    $email = $_POST['email'];

                    //update data pembelian
                    $koneksi->query("UPDATE `tb_user` SET nama_user='$nama',email='$email',username='$username',`password`='$pass',`avatar`='$namafiks' WHERE id_user ='$id_member'");
                    echo "<script>alert('Terima kasih telah mengupdate data informasi')</script>";
                    echo "<script>location='index.php'</script>";
                }
                ?>
            </div>


        </div>
    </div>
</div>
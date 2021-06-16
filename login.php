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
    <!-- font google -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    <!-- <link rel="stylesheet" href="css/fontawesome.min.css"> -->
    <link rel="shortcut icon" href="./img/logotab.png">
    <!--Judul web  -->
    <title>PhotoStudio</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 form-container">
                <div class="col-lg-8 col-md-12 col-sm-9 col-xs-12 form-box text-center">
                    <div class="logo mt-3 mb-3">
                        <img src="./img/ok.png" alt="">
                    </div>
                    <div class="heading mb-5 " style="font-family: aluria regular; font-weight: lighter; font-size: 30px;">
                        <h4>Login into your account</h4>
                    </div>
                    <?php
                    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
                    function input($data)
                    {
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }
                    //Cek apakah ada kiriman form dari method post
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {

                        session_start();
                        include "lib/koneksi.php";
                        $username = input($_POST["username"]);
                        $p = input(($_POST["password"]));

                        $sql = "select * from tb_user where username='" . $username . "' and password='" . $p . "' limit 1";
                        $hasil = mysqli_query($konek, $sql);
                        $jumlah = mysqli_num_rows($hasil);

                        if ($jumlah > 0) {
                            $row = mysqli_fetch_assoc($hasil);
                            $_SESSION["id_user"] = $row["id_user"];
                            $_SESSION["username"] = $row["username"];
                            $_SESSION["nama"] = $row["nama_user"];
                            $_SESSION["email"] = $row["email"];
                            $_SESSION["level"] = $row["level"];


                            if ($_SESSION["level"] = $row["level"] == "admin") {
                                header("Location:admin/index.php");
                            } else if ($_SESSION["level"] = $row["level"] == "member") {
                                header("Location:index.php");
                                if(isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"]))
                                {
                                    echo"<script>location='checkout.php';<?script>";
                                }
                                else
                                {
                                    echo"<script>location='riwayat.php';<?script>"; 
                                }
                            }
                           else if ($_SESSION["level"] = $row["level"] == "Terblokir") {
                                $namaakun = $row['nama_user'];
                                echo "<div class='alert alert-danger'>
                                Akun Atas Nama <strong>$namaakun</strong> Telah Kami Blokir Silahkan Hubungi Email Kami
                                PhotoStudio@gmail.com. 
                              </div>";
                            }
                        } else {
                            echo "<div class='alert alert-danger'>
				<strong>Error!</strong> Username dan password salah. 
			  </div>";
                        }
                    }

                    ?>
                    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                        <div class="form-input">
                            <span><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" name="username" placeholder="Masukkan Username" required>
                        </div>
                        <div class="form-input">
                            <span><i class="fa fa-lock" aria-hidden="true"></i></span>
                            <input type="password" name="password" placeholder="Masukkan Password" required>
                        </div>
                        <div class="row mb-5">
                            <div class="col-6 d-flex">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="cb1">
                                    <label for="cb1" class="custom-control-label">Remember Me</label>
                                </div>
                            </div>
                        </div>
                        <div class="submit">
                            <button type="submit" class="btn" value="LOGIN">Login</button>
                        </div><br>


                        <div>Don't Have an Account?
                            <a href="register.php" class="register-link">register here</a><br>
                        </div>
                        <div>Back to 
                        <a href="Home.php" class="register-link">Guest Pages</a>
                        </div>                       
                    </form>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 d-md-block image-container">

            </div>
        </div>
    </div>
</body>
<!-- Boostrap Script -->
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</html>
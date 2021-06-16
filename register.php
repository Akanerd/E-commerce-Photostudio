<?php 
include "lib/koneksi.php"
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Boostrap css -->
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/> 
        <!-- CSS Sheet -->
        <link type="text/css" rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"><link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <!-- font google -->
          <!-- <link rel="stylesheet" href="css/fontawesome.min.css"> -->
          <link rel="shortcut icon" href="./img/logotab.png">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
        <!--Judul web  -->
        <title>PhotoStudio</title>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 form-container">
                    <div class="col-lg-8 col-md-12 col-sm-9 col-xs-12 form-box text-center">
                        <div class="logo mt-3 mb-3">
                            <img src="ok.png"  alt="">
                        </div>
                        <div class="heading mb-5 " style="font-family: aluria regular; font-weight: lighter; font-size: 30px;">
                            <h4>Register your account</h4>
                        </div>
                        <form method="POST">
                        <div class="form-input">
                                <span><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                <input type="text" name="email" placeholder="email" required>
                            </div>
                            <div class="form-input">
                                <span><i class="fa fa-user" aria-hidden="true"></i></span>
                                <input type="text" name="nama" placeholder="name" required>
                            </div>
                            <div class="form-input">
                                <span><i class="fa fa-user" aria-hidden="true"></i></span>
                                <input type="text" name="username" placeholder="username" required>
                            </div>
                            <div class="form-input">
                                <span><i class="fa fa-lock" aria-hidden="true"></i></span>
                                <input type="password" name="password" placeholder="password" required>
                            </div>
                            <div class="row mb-5">
                                <div class="col-6 d-flex">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="cb1">
                                        <label for="cb1" class="custom-control-label" style="font-size: 10px;">I Aggre with The terms</label>
                                    </div>
                                </div>
                            </div>
                            <div class="submit">
                                <button type="submit" name="register" class="btn" style="font-family: Montserrat; font-size: normal; font-weight: bold;">Register</button>
                            </div><br>
                            <div>Back to Login Page?
                                <a href="login.php" class="register-link">login here</a>
                            </div>
                        </form>
                        <?php
                        if(isset($_POST["register"])){
                            $nama     = $_POST["nama"];
                            $username = $_POST["username"];
                            $password = $_POST["password"];
                            $email    = $_POST["email"];

                            //mengambil query
                            $ambil = $konek->query("select * from tb_user where username ='$username'");
                            $cek   = $ambil->num_rows;
                            if($cek == 1){
                                echo"<script>alert('Pendaftaran gagal karena username telah digunakan');</script>";
                                echo"<script>location='register.php';</script>";
                                exit;
                            }
                            else{
                                //query insert ke tabel
                                $konek->query("INSERT INTO `tb_user`(`nama_user`, `email`, `username`, `password`, `level`) VALUES 
                                ('$nama','$email','$username','$password','member')");
                                 echo"<script>alert('Pendaftaran sukses, silahkan login');</script>";
                                 echo"<script>location='login.php';</script>";
                                 exit;
                            }
                        }
                        ?>
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
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
         <!-- <div class="col-md-6">
           <div class="box">
             <div class="searchbar-container">
               <form method="get" name="cari" action="index.php">
                 <span class="icon" name="cari" type="submit" ><i class="fa fa-search" aria-hidden="true" ></i></span>
                 <button name="cari" type="submit" class="button-cari icon">
                   <i class="fa fa-search"></i>
                 </button>
                 <input type="text" id="search" name="judul" placeholder="Search">
               </form>
             </div>
           </div>
         </div> -->
         <!-- Search -->
         <!-- <div class="nav-search hidden-sm hidden-xs">
           <form method="get" name="cari" action="index.php">
             <input type="text" name="judul" class="form-control" placeholder="Cari judul buku">
             <button name="cari" type="submit" class="search-button">
               <i class="icon icon_search"></i>
             </button>
           </form>
         </div> -->
         <!-- Account acces login,logout,cart -->
         <div class="col-md-3 clearfix">
           <div class="header-ctn">
             <!-- cart -->
             <div>
               <a href="login.php">
                 <i class="fa fa-sign-in-alt"></i>
                 <span>Login</span>
               </a>
             </div>
             <!-- <div>
               <a href="checkout.php">
                 <i class="fa fa-box"></i>
                 <span>checkout</span>
               </a>
             </div>
             <div>
               <a href="riwayat.php">
                 <i class="fa fa-history"></i>
                 <span>History</span>
               </a>
             </div> -->
             <div>
               <a href="register.php" onClick="return confirm ('Are you sure to register account ?')">
                 <i class="fa fa-user"></i>
                 <span>Register</span>
               </a>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>

   <!--  -->
   <!--  -->
   <!-- <nav id="navigation" class="sticky-top">
     <div class="container">
       <div class="row">
         <ul class="main-nav ">
           <li class="active"><a href="./index.html">Home</a></li>
           <li><a href="#">ON sale</a></li>
           <li><a href="./onsale2.html">Studio Services</a></li>
           <li><a href="./about.html">About</a></li>
         </ul>
       </div>
     </div>
   </nav> -->
   <nav id="navigation" class="navbar navbar-expand-md sticky-top">
     <div class="container">
       <div class="row">
         <div id="navbarCollapse" class="collapse navbar-collapse">
           <ul class="nav main-nav">
             <li class="nav-item">
               <a href="Home.php" class="nav-link">Home</a>
             </li>
             <li class="nav-item dropdown">
               <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Categories</a>
               <div class="dropdown-menu">
                 <div class="row">
                   <?php
                    $kat = "SELECT id_kategori FROM tb_kategori";
                    $result = mysqli_query($konek, $kat);
                    $i = 0;
                    while (mysqli_fetch_assoc($result)) {
                      $sql[$i] = "SELECT id_kategori, judul_kategori FROM tb_kategori ORDER BY judul_kategori LIMIT $i, 4";
                      $hasil = mysqli_query($konek, $sql[$i]);
                      if ($i % 4 == 0) {
                    ?>
                       <div class="col-md-3 megamenu-item">
                         <ul class="menu-list">
                           <?php while ($row = mysqli_fetch_assoc($hasil)) { ?>
                             <li><a href="?p=buku&id_kat=<?php echo $row['id_kategori']; ?>&halaman=1"><?php echo $row['judul_kategori']; ?></a></li>
                           <?php } ?>
                         </ul>
                       </div>
                   <?php }
                      $i++;
                    } ?>
                 </div>
               </div>
             </li>
             <li class="nav-item">
               <a href="?p=buku&halaman=1">Collection</a>
             </li>
             <li class="nav-item">
               <a href="?p=about">About Us</a>
             </li>
           </ul>
         </div>
       </div>
     </div>
   </nav>
   <!--  -->
 </header>
<!-- Our Website Content Goes Here -->
<?php 
      $produk=mysqli_query($konek, "SELECT id_produk FROM tb_produk");
      $admin=mysqli_query($konek, "SELECT id_user FROM tb_user where level='admin'");
      $member=mysqli_query($konek, "SELECT id_user FROM tb_user where level in('member','Terblokir')");
      $kategori=mysqli_query($konek, "SELECT id_kategori FROM tb_kategori");
      $merk=mysqli_query($konek, "SELECT id_merk FROM tb_merk");
?>
<header class="simple-normal">
     <div class="top-bar">
          <div class="logo">
               <a href="index.php" title=""><i class="fa fa-bullseye"></i> PhotoStudio</a>
          </div>
          <div class="menu-options"><span class="menu-action"><i></i></span></div>
          <div class="top-bar-quick-sec">
               <a href="#" data-toggle="modal" data-target=".logout"><span class="full-screen-btn"><i class="fa fa-sign-out"></i></span></a>
               <span id="toolFullScreen" class="full-screen-btn"><i class="fa fa-arrows-alt fa-spin"></i></span>
          </div>
     </div><!-- Top Bar -->
     <div class="side-menu-sec" id="header-scroll">
         <br>
          <div class="side-menus">
               <span>MENU UTAMA</span>
               <nav>
                    <ul class="parent-menu">
                         <li class="<?php if(!isset($_GET['p'])) echo 'active'; ?>">
                              <!--badge red <i class="badge red-bg">HOT</i>-->
                              <a title="Halaman Utama" href="index.php"><i class="ti-desktop"></i><span>Dashboard</span></a>
                         </li>
                         <li class="menu-item-has-children <?php if(isset($_GET['p'])) if($_GET['p']=='produk'||$_GET['p']=='data'||$_GET['p']=='kategori') echo 'active'; ?>">
                              <a title="Area administrasi produk"><i class="ti-book"></i><span>Product Area</span></a>
                              <ul <?php if(isset($_GET['p'])) if($_GET['p']=='produk'||$_GET['p']=='data'||$_GET['p']=='kategori') { ?> style="display: block;" <?php } ?>>
                                   <li><a href="?p=data">Data Produk <i class="badge red-bg"><?php echo mysqli_num_rows($produk); ?></i></a></li>
                                   <li><a href="?p=kategori">Kategori Produk <i class="badge blue-bg"><?php echo mysqli_num_rows($kategori); ?></i></a></li>
                                   <li><a href="?p=merk">Merk Produk <i class="badge green-bg"><?php echo mysqli_num_rows($merk); ?></i></a></li>
                              </ul>
                        </li>
                        <li class="menu-item-has-children <?php if(isset($_GET['p'])) if($_GET['p']=='admin'||$_GET['p']=='pembeli') echo 'active'; ?>">
                              <a title="Area administrasi produk"><i class="fa fa-user"></i><span>Detail Admin & Customer</span></a>
                              <ul <?php if(isset($_GET['p'])) if($_GET['p']=='admin'||$_GET['p']=='pembeli') { ?> style="display: block;" <?php } ?>>
                                   <li><a href="?p=admin">Data Admin <i class="badge red-bg"><?php echo mysqli_num_rows($admin); ?></i></a></li>
                                   <li><a href="?p=pembeli">Data Pembeli <i class="badge blue-bg"><?php echo mysqli_num_rows($member); ?></i></a></li>
                              </ul>
                        </li>
                        <li class="<?php if(isset($_GET['p'])) if($_GET['p']=='customer') echo 'active'; ?>">
                              <a title="Pantau Pembeli" href="?p=customer"><i class="fa fa-shopping-cart"></i><span>Purchase</span></a>
                        </li>
                        <!-- <li class="<?php if(isset($_GET['p'])) if($_GET['p']=='user') echo 'active'; ?>">
                              <a title="Detail User" href="?p=user"><i class="fa fa-user"></i><span>Detail Admin & Customer</span></a>
                        </li> -->
                        <li class="<?php if(isset($_GET['p'])) if($_GET['p']=='laporan') echo 'active'; ?>">
                              <a title="Pantau Laporan Pembelian" href="?p=laporan"><i class="fa fa-bar-chart"></i><span>Purchase History</span></a>
                        </li>
                        <li class="<?php if(isset($_GET['p'])) if($_GET['p']=='slider') echo 'active'; ?>">
                              <a title="Setting Slider" href="?p=slider"><i class="ti-layout-slider"></i><span>Setting Slider Web</span></a>
                        </li>
                        <li class="<?php if(isset($_GET['p'])) if($_GET['p']=='comment') echo 'active'; ?>">
                              <a title="Pantau Komentar" href="?p=comment"><i class="ti-comments"></i><span>Comments Monitor</span></a>
                        </li>
                        <li class="">
                              <a title="Keluar dari Halaman Admin" href="#logout" data-toggle="modal" data-target=".logout"><i class="ti-export"></i><span>Log Out</span></a>
                        </li>
                    </ul>
               </nav>
                <span class="footer-line">&copy; 2020 Photostudio </span>
          </div>
     </div>
</header>
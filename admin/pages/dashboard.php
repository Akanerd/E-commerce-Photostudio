<?php
    if(!defined('MyConst')){
            die('Akses langsung tidak diperbolehkan');
        }
    // $admin=mysqli_query($konek, "SELECT nama FROM tb_user where level='admin'");    
    $produk=mysqli_query($konek, "SELECT id_produk FROM tb_produk");
    $kategori=mysqli_query($konek, "SELECT id_kategori FROM tb_kategori");
    $komentar=mysqli_query($konek, "SELECT id_komentar FROM tb_komentar WHERE hapus=0");
    $slide=mysqli_query($konek, "SELECT id_slide FROM tb_slide");
    $stok_produk=mysqli_query($konek, "SELECT SUM(stok_produk) FROM tb_produk");
    $stok = mysqli_fetch_row($stok_produk);
?>
<div class="panel-content">
        <div class="main-title-sec">
            <div class="row">
                <div class="col-md-12">
                    <?php
                        if(isset($_GET['a'])){
                            $alert=$_GET['a'];
                            if($alert=='sukses_login'){
                    ?>
                    <div role="alert" class="alert color green-bg fade in alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <strong>Berhasil login!</strong> selamat, Anda berhasil login sebagai administrator PhotoStudio.
                    </div>
                    <?php } } ?>
                </div>
                <div class="col-md-3 column">
                    <div class="heading-profile">
                        <h2>Dashboard</h2>
                        <span>Selamat datang, Admin PhotoStudio</span>
                    </div>
                </div>
                
            </div>
        </div><!-- Heading Sec -->
        <ul class="breadcrumbs">
            <li><a href="#" title="">Beranda</a></li>
            <li><a href="index.php" title="">Dashboard</a></li>
        </ul>
        <div class="main-content-area">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <div class="quick-report-widget">
                            <span>Produk</span>
                            <h4>
                                <?php echo mysqli_num_rows($produk); ?>
                            </h4>
                            <i class="fa fa-book red-bg"></i>
                            <h5>Total Stok Produk : <?php echo $stok[0]; ?></h5>
                        </div>
                    </div><!-- Widget -->
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <div class="quick-report-widget">
                            <span>Kategori</span>
                            <h4>
                                <?php echo mysqli_num_rows($kategori); ?>
                            </h4>
                            <i class="fa fa-tags skyblue-bg"></i>
                            <h5>Total Kategori : <?php echo mysqli_num_rows($kategori); ?></h5>
                        </div>
                    </div><!-- Widget -->
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <div class="quick-report-widget">
                            <span>Komentar</span>
                            <h4>
                                <?php echo mysqli_num_rows($komentar); ?>
                            </h4>
                            <i class="fa fa-comments green-bg"></i>
                            <h5>Total Komentar : <?php echo mysqli_num_rows($komentar); ?></h5>
                        </div>
                    </div><!-- Widget -->
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <div class="quick-report-widget">
                            <span>Slider</span>
                            <h4 class="number">
                                <?php echo mysqli_num_rows($slide); ?>
                            </h4>
                            <i class="fa fa-area-chart blue-bg"></i>
                            <h5>Total Slider pada Halaman Web : <?php echo mysqli_num_rows($slide); ?></h5>
                        </div>
                    </div><!-- Widget -->
                </div>
            </div>
        </div>
    </div><!-- Panel Content -->
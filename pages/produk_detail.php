<?php
$id_buku = $_GET['id_produk'];
$queryProduct = "SELECT produk.*, kat.*,merk.* FROM tb_produk produk INNER JOIN tb_kategori kat ON produk.id_kategori=kat.id_kategori join tb_merk merk on produk.id_merk = merk.id_merk
WHERE produk.id_produk=$id_buku";
$rsProduct = mysqli_query($konek, $queryProduct);
$row = mysqli_fetch_assoc($rsProduct);
$queryKomentar = "SELECT * FROM tb_komentar WHERE id_produk=$id_buku ORDER BY id_komentar DESC";
$rsKomentar = mysqli_query($konek, $queryKomentar);
?>
<!-- Breadcrumbs -->
<div class="container mt-2">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb align-items-center">
    <li class="breadcrumb-item"> <a href="index.php">Beranda</a></li>
    <li class="breadcrumb-item"><a href="?p=buku&halaman=1">Produk</a></li>
    <li class="breadcrumb-item active" >  <?php echo $row['nama_produk']; ?></li>
  </ol>
</nav>
</div>
<!-- Single Product -->
<section class="section-wrap single-product ">
    <div class="container relative mb-5">
        <div class="row">
            <?php
            if (isset($_GET['a'])) {
                $alert = $_GET['a'];
                if ($alert == 'komentar_sukses') {
            ?>
                    <div class="col-sm-12 col-xs-12">
                        <div class="alert alert-success fade in alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <strong>Sukses!</strong> Komentar Anda telah ditambahkan
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="col-sm-12 col-xs-12">
                        <div class="alert alert-danger fade in alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <strong>Gagal!</strong> Komentar Anda gagal ditambahkan
                        </div>
                    </div>
            <?php }
            } ?>

            <div class="col-sm-6 col-xs-12 mb-60">

                <div class="flickity  mfp-hover" id="gallery-main">

                    <div class="gallery-cell">
                        <a href="img/book/<?php echo $row['cover_produk']; ?>" class="lightbox-img">
                            <img src="img/book/<?php echo $row['cover_produk']; ?>" class="img-fluid" />
                        </a>
                    </div>

                </div> <!-- end gallery main -->

            </div> <!-- end col img slider -->

            <div class="col-sm-6 col-xs-12">
                <h1 class="mt-5 mb-4"><?php echo $row['nama_produk']; ?></h1>
                <div class="product_meta">
                    <table class="table table-hover table-responsive">
                        <tbody>
                            <tr>
                                <td width="5px"><i class="fa fa-file"></i></td>
                                <td>Garansi</td>
                                <td style="padding-left:150px"><?php echo $row['garansi_produk']; ?></span></td>
                            </tr>
                            <tr>
                                <td width="5px"><i class="fa fa-money"></i></td>
                                <td><span>Harga</td>
                                <td style="padding-left:150px"> <?php
                                                                $harga = number_format($row['harga_produk'], 2, ",", ".");
                                                                echo "Rp " . $harga;
                                                                ?></span></td>
                            </tr>
                            <tr>
                                <td width="5px"><i class="fa fa-trademark"></i></td>
                                <td><span>Merk</td>
                                <td style="padding-left:150px"><a href="?p=buku&id_merk=<?php echo $row['id_merk'] ?>&halaman=1" target="_blank">
                                        <?php echo $row['judul_merk']; ?></a></span></td>
                            </tr>
                            <tr>
                                <td width="5px"><i class="fa fa-user"></i></td>
                                <td><span>Rating</td>
                                <td style="padding-left:150px"> <?php
                                                                $x = $row['rating_produk'];
                                                                $j = 5 - $x;
                                                                for ($i = 0; $i < $x; $i++) {
                                                                ?>
                                        <span class="fa fa-star"></span>
                                    <?php }
                                                                for ($i = 0; $i < $j; $i++) { ?>
                                        <h4 class="fa fa-star" span>
                                        <?php } ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td width="5px"><span class="fa fa-box"></span></td>
                                <td><span ">Berat</td>
                            <td style=" padding-left:150px"><?php echo $row['berat_produk']; ?>Gr</span></td>
                            </tr>
                            <tr>
                                <td width="5px"><span class="icon_folder-open"></span></td>
                                <td><span>Stok</td>
                                <td style="padding-left:150px"><?php echo $row['stok_produk']; ?></span></td>
                            </tr>
                            <tr>
                                <td width="5px"><span class="icon_tags"></span></td>
                                <td><span>Kategori</td>
                                <td style="padding-left:150px"><a href="?p=buku&id_kat=<?php echo $row['id_kategori'] ?>&halaman=1" target="_blank">
                                        <?php echo $row['judul_kategori']; ?></a></span></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-10">
                            <form method="post">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="jumlah_stok" max="<?php echo $row["stok_produk"] ?>">
                                        <div class="input-group-btn">
                                            <button class="btn btn-dark" name="beli">Beli</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php if(isset($_POST["beli"])){
                            $jumlah   = $_POST["jumlah_stok"];
                              
                            if (isset($_SESSION['keranjang'][$id_buku])) {
                                $_SESSION['keranjang'][$id_buku] += 1;
                            }
                            else{
                                $_SESSION["keranjang"][$id_buku] = $jumlah;
                            }

                            echo "<script>alert('Produk Telah Masuk Keranjang')</script>";
                            echo "<script>location='keranjang.php'</script>";
                        }
                            ?>
                        </div>
                    </div>
                    <!-- tabs -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tabs tabs-bb">
                                <nav>
                                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#tab-description" role="tab" aria-controls="nav-home" aria-selected="true">Deskripsi</a>
                                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#tab-info" role="tab" aria-controls="nav-profile" aria-selected="false">Kirim Komentar</a>
                                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#tab-reviews" role="tab" aria-controls="nav-contact" aria-selected="false">Komentar</a>
                                    </div>
                                </nav>
                                <!-- tab content -->
                                <div class="tab-content">

                                    <div class="tab-pane fade show active" id="tab-description">
                                        <p align="justify">
                                            <?php echo htmlspecialchars_decode(stripcslashes($row['deskripsi_produk'])); ?>
                                        </p>
                                    </div>

                                    <div class="tab-pane fade" id="tab-info">
                                        <div class="col-md-12">
                                            <form action="lib/proses.php" name="komentar" method="post">
                                                <input name="id_produk" type="hidden" value="<?php echo $_GET['id_produk']; ?>">
                                                <div class="form-group mt-3">
                                                    <label for="nama">Nama Lengkap</label>
                                                    <input class="form-control" name="nama" id="nama" type="text" placeholder="Masukkan nama lengkap Anda" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="isi">Isi Komentar</label>
                                                    <textarea rows="3" cols="54" name="isi" id="isi"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-dark" name="komentar">Kirim Komentar</button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="tab-pane  fade" id="tab-reviews">

                                        <div class="reviews">
                                            <ul class="reviews-list">
                                                <?php if (mysqli_num_rows($rsKomentar) == 0) { ?>
                                                    <div class="review-body">
                                                        <div class="review-content">
                                                            <h5 class="text-center mt-5">Belum ada komentar pada buku ini</h5>
                                                        </div>
                                                    </div>
                                                    <?php
                                                } else {
                                                    while ($row = mysqli_fetch_assoc($rsKomentar)) {
                                                    ?>
                                                        <li>
                                                            <div class="review-body">
                                                                <div class="review-content">
                                                                    <p class="review-author"><strong><?php echo $row['nama']; ?></strong><small> - <?php echo $row['tgl']; ?></small></p>
                                                                    <p align="justify">
                                                                        <?php
                                                                        if ($row['hapus'] == 0)
                                                                            echo $row['isi_komentar'];
                                                                        else
                                                                            echo "<i>Komentar telah dihapus oleh Admin</i>";
                                                                        ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <br>
                                                        <hr><br>
                                                <?php }
                                                } ?>
                                            </ul>
                                        </div> <!--  end reviews -->
                                    </div>

                                </div> <!-- end tab content -->

                            </div>
                        </div> <!-- end tabs -->
                    </div> <!-- end row -->
                </div>

            </div> <!-- end col product description -->
        </div> <!-- end row -->



    </div> <!-- end container -->
</section> <!-- end single product -->
<br><br><br>
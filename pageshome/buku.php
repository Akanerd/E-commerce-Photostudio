<!-- Breadcrumbs -->
<div class="container mt-2">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb align-items-center">
    <li class="breadcrumb-item"> <a href="Home.php">Beranda</a></li>
    <li class="breadcrumb-item">  <a href="?p=buku&halaman=1">Produk</a></li>
    <li class="breadcrumb-item active" > Collection</li>
  </ol>
</nav>
</div>


<!-- Catalogue -->
<section class="section-wrap mb-5 catalogue " style="padding-bottom: 45px ;">
  <div class="container relative">
    <div class="row">

      <div class="col-md-9 catalogue-col right mb-50">



        <div class="row row-10">
          <?php
          $bukuAll = "SELECT id_produk FROM tb_produk";
          $rsBukuAll = mysqli_query($konek, $bukuAll);
          $halaman = 6;
          $page = isset($_GET["halaman"]) ? (int) $_GET["halaman"] : 1;
          $mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;
          if (isset($_GET['id_kat'])) {
            $id_kat = $_GET['id_kat'];
            $result = mysqli_query($konek, "SELECT * FROM tb_produk WHERE id_kategori=$id_kat");
          }
          else if (isset($_GET['id_merk'])) {
            $id_merk = $_GET['id_merk'];
            $result = mysqli_query($konek, "SELECT * FROM tb_produk WHERE id_merk=$id_merk");
          } else
            $result = mysqli_query($konek, "SELECT * FROM tb_produk");
          $total = mysqli_num_rows($result);
          $pages = ceil($total / $halaman);
          if (isset($_GET['id_kat'])) {
            $buku = "SELECT * FROM tb_produk WHERE id_kategori=$id_kat ORDER BY id_produk DESC LIMIT $mulai, $halaman";
          }
          else if (isset($_GET['id_merk'])) {
            $buku = "SELECT * FROM tb_produk WHERE id_merk=$id_merk ORDER BY id_produk DESC LIMIT $mulai, $halaman";
          }  else
            $buku = "SELECT * FROM tb_produk ORDER BY id_produk DESC LIMIT $mulai, $halaman";
          $rs = mysqli_query($konek, $buku);
          $no = $mulai + 1;
          $data = mysqli_num_rows($rs);
          if ($data == 0) {
          ?>
            <div class="col-md-12 col-xs-12">
              <div class="mt-5 text-center">
                <h1>Maaf, data produk kategori terkait masih kosong!</h1>
              </div>
            </div>
            <?php
          } else {
            while ($row = mysqli_fetch_assoc($rs)) {
            ?>
              <div class="col-md-4 col-xs-12">
                <div class="product-item">
                  <div class="card" style="width: 15rem;">
                    <div class="inner-product">
                      <img src="img/book/<?php echo $row['cover_produk']; ?>" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body text-center">
                      <p class="product-category"></p>
                      <h3 class="product-name"><a href="#"><?php echo $row['nama_produk']; ?></a></h3>
                      <h4 class="product-price"><?php
                                                $harga = number_format($row['harga_produk'], 2, ",", ".");
                                                echo "Rp " . $harga;
                                                ?></h4>
                      <div class="product-rating">
                        <?php
                        $x = $row['rating_produk'];
                        $j = 5 - $x;
                        for ($i = 0; $i < $x; $i++) {
                        ?>
                          <i class="fa fa-star"></i>
                        <?php }
                        for ($i = 0; $i < $j; $i++) { ?>
                          <i class="fa fa-star"></i>
                        <?php } ?>
                      </div>
                      <div class="product-btns">
                        <!-- <button class="add-to-wishlist"><a href="beli.php?id=<?php echo $row['id_produk']; ?>"><i class="fa fa-shopping-cart"></i></a><span class="tooltipp">add to wishlist</span></button> -->
                        <button class="quick-view"><i class="fa fa-eye" data-target="#produkoke<?php echo $row['id_produk']; ?>" data-toggle="modal"></i><span class="tooltipp">quick view</span></button>
                        <button class="quick-view"><a href="?p=produk_detail&id_produk=<?php echo $row['id_produk']; ?>"><i class="fa fa-comments"></i><span class="tooltipp">Comment</span></a></button>
                      </div>
                      <div class="modal fade" id="produkoke<?php echo $row['id_produk']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Detail Product</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-6">
                                  <img src="img/book/<?php echo $row['cover_produk']; ?>" width="350px" height="390px" alt="">
                                </div>
                                <div class="col-md-6">
                                  <table class="table table-borderless">
                                    <tr>
                                      <th>Product Name</th>
                                      <td><?php echo $row['nama_produk']; ?></td>
                                    </tr>
                                    <tr>
                                      <th>Berat</th>
                                      <td><?php echo $row['berat_produk']; ?> Gr</td>
                                    </tr>
                                    <tr>
                                      <th>warranty</th>
                                      <td><?php echo $row['garansi_produk']; ?></td>
                                    </tr>
                                    <tr>
                                      <th>Rating</th>
                                      <td>
                                        <?php
                                        $x = $row['rating_produk'];
                                        $j = 5 - $x;
                                        for ($i = 0; $i < $x; $i++) {
                                        ?>
                                          <i class="fa fa-star"></i>
                                        <?php }
                                        for ($i = 0; $i < $j; $i++) { ?>
                                          <i class="fa fa-star"></i>
                                        <?php } ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <th>Price</th>
                                      <td><?php echo number_format($row['harga_produk']); ?></td>
                                    </tr>
                                  </table>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          <?php }
          } ?>
        </div> <!-- end row -->
        <div class="clear"></div>

        <!-- Pagination -->



      </div> <!-- end col -->

      <!-- Sidebar -->
      <aside class="col-md-3 sidebar left-sidebar">

        <!-- Categories -->
        <div class="widget categories">
          <h3 class="widget-title uppercase">Kategori</h3>
          <ul class="list-no-dividers">
            <li class="<?php if (!isset($_GET['id_kat'])) echo "active-cat" ?>">
              <a href="?p=buku&halaman=1">Semua Kategori <?php echo "(" . mysqli_num_rows($rsBukuAll) . ")" ?></a>
            </li>
            <?php
            $sideKat = "SELECT * FROM tb_kategori";
            $rsSideKat = mysqli_query($konek, $sideKat);
            while ($row = mysqli_fetch_assoc($rsSideKat)) {
              if (isset($_GET['id_kat'])) {
                $id_kat = $_GET['id_kat'];
                $active = "active-cat";
              } else $active = "";
              $sideKatPer = "SELECT id_produk FROM tb_produk WHERE id_kategori=" . $row['id_kategori'];
              $rsSideKatPer = mysqli_query($konek, $sideKatPer);
            ?>
              <li class="<?php if ($row['id_kategori'] == $id_kat) echo $active ?>">
                <a href="?p=buku&id_kat=<?php echo $row['id_kategori'] ?>&halaman=1"><?php echo $row['judul_kategori'] . " (" . mysqli_num_rows($rsSideKatPer) . ")"; ?></a>
              </li>
            <?php } ?>
          </ul>
        </div>
        <!-- Merk -->
        <div class="widget categories">
          <h3 class="mt-5">Merk</h3>
          <ul class="list-no-dividers">
            <li class="<?php if (!isset($_GET['id_merk'])) echo "active-cat" ?>">
              <a href="?p=buku&halaman=1">Semua Merk <?php echo "(" . mysqli_num_rows($rsBukuAll) . ")" ?></a>
            </li>
            <?php
            $sideKat = "SELECT * FROM tb_merk";
            $rsSideKat = mysqli_query($konek, $sideKat);
            while ($row = mysqli_fetch_assoc($rsSideKat)) {
              if (isset($_GET['id_merk'])) {
                $id_kat = $_GET['id_merk'];
                $active = "active-cat";
              } else $active = "";
              $sideKatPer = "SELECT id_produk FROM tb_produk WHERE id_merk=" . $row['id_merk'];
              $rsSideKatPer = mysqli_query($konek, $sideKatPer);
            ?>
              <li class="<?php if ($row['id_merk'] == $id_kat) echo $active ?>">
                <a href="?p=buku&id_merk=<?php echo $row['id_merk'] ?>&halaman=1"><?php echo $row['judul_merk'] . " (" . mysqli_num_rows($rsSideKatPer) . ")"; ?></a>
              </li>
            <?php } ?>
          </ul>
        </div>
        <!-- Bestsellers -->
        <div class="widget bestsellers">
          <div class="products-widget">
            <h3 class="mt-5">Best Sellers</h3>
            <?php
            $best = "SELECT * FROM tb_produk WHERE best_produk='1' ORDER BY id_produk DESC LIMIT 2";
            $rsBest = mysqli_query($konek, $best);
            while ($row = mysqli_fetch_assoc($rsBest)) {
            ?>
              <ul class="product-list-widget">
                <li class="clearfix">
                  <a href="?p=produk_detail&id_produk=<?php echo $row['id_produk']; ?>">
                    <img src="img/book/<?php echo $row['cover_produk']; ?>" alt="">
                    <span class="product-title"><?php echo $row['nama_produk']; ?></span>
                  </a>
                  <span class="price">
                    <span>
                      <?php
                      $harga = number_format($row['harga_produk'], 2, ",", ".");
                      echo "Rp " . $harga;
                      ?>
                    </span>
                  </span>
                </li>
              </ul>
              <br>
            <?php } ?>
          </div>
        </div>
      </aside> <!-- end sidebar -->

    </div> <!-- end row -->
  </div> <!-- end container -->
  <div id="section">
  <div class="container">
    <div class="row">
      <div class="col-md-12" style="padding-right: 280px;">
        <?php
        if ($data != 0) {
        ?>
          <div>
            <nav >
              <?php if (isset($_GET['id_kat'])) {
                if ($page == 1) echo "";
                else { ?>
                  <a class="text-center" href="?p=buku&id_kat=<?php echo $_GET['id_kat']; ?>&halaman=1"><i class="fa fa-angle-double-left"></i></a>
                  <a class="text-center" href="?p=buku&id_kat=<?php echo $_GET['id_kat']; ?>&halaman=<?php echo $_GET['halaman'] - 1; ?>"><i class="fa fa-angle-left"></i></a>
                <?php }
              } else {
                if ($page == 1) echo "";
                else { ?>
                  <a class="text-center" href="?p=buku&halaman=1"><i class="fa fa-angle-double-left"></i></a>
                  <a  class="text-center"href="?p=buku&halaman=<?php echo $_GET['halaman'] - 1; ?>"><i class="fa fa-angle-left"></i></a>
                <?php
                }
              }
              if (isset($_GET['id_kat'])) {
                for ($i = 1; $i <= $pages; $i++) {
                ?>
                  <a class="text-center" href="?p=buku&id_kat=<?php echo $_GET['id_kat']; ?>&halaman=<?php echo $i; ?>" class="<?php if ($i == $page) echo 'page-numbers current'; ?>"><?php echo $i; ?></a>
                <?php }
              } else {
                for ($i = 1; $i <= $pages; $i++) {
                ?>
                  <a href="?p=buku&halaman=<?php echo $i; ?>" class="<?php if ($i == $page) echo 'page-numbers current'; ?>"><?php echo $i; ?></a>
              <?php }
              } ?>

              <?php if (isset($_GET['id_kat'])) {
                if ($page == $pages) echo "";
                else { ?>
                  <a href="?p=buku&id_kat=<?php echo $_GET['id_kat']; ?>&halaman=<?php echo $_GET['halaman'] + 1; ?>"><i class="fa fa-angle-right"></i></a>
                  <a href="?p=buku&id_kat=<?php echo $_GET['id_kat']; ?>&halaman=<?php echo $pages; ?>"><i class="fa fa-angle-double-right"></i></a>
                <?php }
              } else {
                if ($page == $pages) echo "";
                else { ?>
                  <a href="?p=buku&halaman=<?php echo $_GET['halaman'] + 1; ?>"><i class="fa fa-angle-right"></i></a>
                  <a href="?p=buku&halaman=<?php echo $pages; ?>"><i class="fa fa-angle-double-right"></i></a>
              <?php }
              } ?>
            </nav>
          </div>
      </div>
    </div>
  <?php } ?>
  </div>
  </div>
</section> <!-- end catalogue -->
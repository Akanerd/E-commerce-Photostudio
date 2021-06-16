<?php

if (!isset($_GET['cari'])) {
  include "inchome/slider.php";
  $new  = "SELECT produk.*, kat.*,merk.* FROM tb_produk produk INNER JOIN tb_kategori kat ON produk.id_kategori=kat.id_kategori join tb_merk merk on produk.id_merk = merk.id_merk ORDER BY produk.id_produk DESC LIMIT 4";
  $best = "SELECT * FROM tb_produk WHERE best_produk='1' ORDER BY id_produk DESC LIMIT 4";
  $rsNew = mysqli_query($konek, $new);
  $rsBest = mysqli_query($konek, $best);
  //

?>
   <div class="container h-100">
     <div class="row h-100 justify-content-center align-items-center">
       <ol class="btn btn-dark mb-2 border">
         <li class="text-center"><a href="register.php" style="color: white;">Enjoy Our service,Discount and Many mores with become a Member by Registering Here!!</a></li>
         </ol>
     </div>
   </div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-title">
          <h3 class="title">New release products </h3>
          <div class="section-nav">
            <ul class="section-tab-nav tab-nav">
              <!-- <li class="active"><a data-toggle="tab" href="#tab1">Photos</a></li>
                                        <li><a data-toggle="tab" href="#camera">Cameras</a></li>
                                        <li><a data-toggle="tab" href="#tab1">Accessories</a></li> -->
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--  -->
  <div class="container">
    <div class="row">
      <?php while ($row = mysqli_fetch_assoc($rsNew)) { ?>
        <div class="col-md-3">
          <div class="card" style="width: 15rem;">
            <div class="inner-product">
              <img src="img/book/<?php echo $row['cover_produk']; ?>"class="card-img-top" alt="...">
            </div>
            <div class="card-body text-center">
              <p class="product-category"><?php echo $row['judul_kategori']; ?></p>
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
                <!-- <button class="add-to-wishlist"><a href="login.php"><i class="fa fa-shopping-cart"></i></a><span class="tooltipp">add to wishlist</span></button> -->
                <button class="quick-view"><i class="fa fa-eye" data-target="#produknew<?php echo $row['id_produk']; ?>" data-toggle="modal"></i><span class="tooltipp">quick view</span></button>
                <button class="quick-view"><a href="?p=produk_detail&id_produk=<?php echo $row['id_produk']; ?>"><i class="fa fa-comments"></i><span class="tooltipp">Comment</span></a></button>
              </div>
              <div class="modal fade" id="produknew<?php echo $row['id_produk']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                          <img src="img/book/<?php echo $row['cover_produk']; ?>" class="img-fluid" alt="">
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
                              <th>Diskon</th>
                              <td><?php if($row['diskon']=="0"){
                                      echo"Diskon Belum ada"; 
                              }else if ($row['diskon']==""){
                                echo"Diskon Belum Diset Oleh ADMIN"; 
                              }else{
                                $disc =$row['diskon'];
                                echo "$disc %";
                              }
                              ?></td>
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
      <?php } ?>
    </div>
  </div>
  <div id="hot-deal" class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">
        <div class="col-md-12">
          <div class="hot-deal">


          </div>
        </div>
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!--  -->
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-title">
          <h5 class="title">Best Recommended Products</h5>
          <div class="section-nav">
            <ul class="section-tab-nav tab-nav">
              <!-- <li class="active"><a data-toggle="tab" href="#tab1">Photos</a></li>
                                        <li><a data-toggle="tab" href="#camera">Cameras</a></li>
                                        <li><a data-toggle="tab" href="#tab1">Accessories</a></li> -->
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--  -->
  <div class="container">
    <div class="row">
      <?php while ($row = mysqli_fetch_assoc($rsBest)) { ?>
        <div class="col-md-3">
          <div class="card" style="width: 15rem;">
            <div class="inner-product">
              <img src="img/book/<?php echo $row['cover_produk']; ?>" class="card-img-top" alt="...">
            </div>
            <div class="card-body text-center">
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
                <!-- <button class="add-to-wishlist"><a href="login.php"><i class="fa fa-shopping-cart"></i></a><span class="tooltipp">add to wishlist</span></button> -->
                <button class="quick-view"><i class="fa fa-eye" data-target="#produkbest<?php echo $row['id_produk']; ?>" data-toggle="modal"></i><span class="tooltipp">quick view</span></button>
                <button class="quick-view"><a href="?p=produk_detail&id_produk=<?php echo $row['id_produk']; ?>"><i class="fa fa-comments"></i><span class="tooltipp">Comment</span></a></button>
              </div>
              <div class="modal fade" id="produkbest<?php echo $row['id_produk']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <th>Diskon</th>
                              <td><?php if($row['diskon']=="0"){
                                      echo"Diskon Belum ada"; 
                              }else if ($row['diskon']==""){
                                echo"Diskon Belum Diset Oleh ADMIN"; 
                              }else{
                                $disc =$row['diskon'];
                                echo "$disc %";
                              }
                              ?></td>
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
      <?php } ?>
    </div>
  </div>
<?php } else {
  $key = $_GET['judul'];
  $queryCari = "SELECT produk.*, kat.* FROM tb_produk produk INNER JOIN tb_kategori kat ON produk.id_kategori=kat.id_kategori WHERE nama_produk like '%$key%' ORDER BY id_produk DESC";
  $rsCari = mysqli_query($konek, $queryCari);
?>
  <!-- <br><br><br> -->
  <!--  -->

  <!--  -->
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-title">
          <h5 class="title mt-5">Hasil Pencarian</h5>
          <div class="section-nav">
            <ul class="section-tab-nav tab-nav">
              <!-- <li class="active"><a data-toggle="tab" href="#tab1">Photos</a></li>
                                        <li><a data-toggle="tab" href="#camera">Cameras</a></li>
                                        <li><a data-toggle="tab" href="#tab1">Accessories</a></li> -->
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--  -->
  <div class="container">
    <div class="row">
      <?php while ($row = mysqli_fetch_assoc($rsCari)) { ?>
        <div class="col-md-3">
          <div class="card" style="width: 15rem;">
            <div class="inner-product">
              <img src="img/book/<?php echo $row['cover_produk']; ?>" class="card-img-top" alt="...">
            </div>
            <div class="card-body text-center">
              <p class="product-category"><?php echo $row['judul_kategori']; ?></p>
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
                <button class="quick-view"><i class="fa fa-eye" data-target="#produk1" data-toggle="modal"></i><span class="tooltipp">quick view</span></button>
                <button class="quick-view"><a href="?p=produk_detail&id_produk=<?php echo $row['id_produk']; ?>"><i class="fa fa-comments"></i><span class="tooltipp">Comment</span></a></button>
              </div>
              <div class="modal fade" id="produk1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                          <img src="./img/product05.png" width="350px" height="390px" alt="">
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
      <?php } ?>
    </div>
  </div>
<?php } ?>
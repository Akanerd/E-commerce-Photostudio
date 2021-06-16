<?php
    if(!defined('MyConst')){
        die('Akses langsung tidak diperbolehkan');
    }
    $produk = mysqli_query($konek, "SELECT produk.*, kat.*,merk.* FROM tb_produk produk INNER JOIN tb_kategori kat ON produk.id_kategori=kat.id_kategori join tb_merk merk on produk.id_merk = merk.id_merk ORDER BY produk.id_produk DESC");
    $kategori = mysqli_query($konek, "SELECT * FROM tb_kategori");
    $merk = mysqli_query($konek, "SELECT * FROM tb_merk");
?>
<div class="panel-content">
          <div class="main-title-sec">
               <div class="row">
                   <div class="col-md-12 column">
                       <?php
                        if(isset($_GET['a'])){
                            $alert=$_GET['a'];
                            if($alert=='insert_sukses'){
                        ?>
                        <div role="alert" class="alert color green-bg fade in alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <strong>Insert Sukses!</strong> Penambahan data Produk baru berhasil.
                        </div>
                        <?php } else if($alert=='insert_gagal'){ ?>
                        <div role="alert" class="alert color red-bg fade in alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <strong>Insert Gagal!</strong> Penambahan data Produk baru gagal.
                        </div>
                        <?php } else if($alert=='upload_gagal'){ ?>
                        <div role="alert" class="alert color red-bg fade in alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <strong>Gagal!</strong> Upload cover Produk gagal.
                        </div>
                        <?php } else if($alert=='update_sukses'){ ?>
                        <div role="alert" class="alert color green-bg fade in alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <strong>Update Sukses!</strong> Pembaharuan data Produk berhasil.
                        </div>
                        <?php } else if($alert=='update_gagal'){ ?>
                        <div role="alert" class="alert color red-bg fade in alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <strong>Update Gagal!</strong> Pembaharuan data Produk gagal.
                        </div>
                        <?php } else if($alert=='hapus_sukses'){ ?>
                        <div role="alert" class="alert color blue-bg fade in alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <strong>Hapus Sukses!</strong> Data Produk berhasil dihapus.
                        </div>
                        <?php } else if($alert=='hapus_gagal'){ ?>
                        <div role="alert" class="alert color red-bg fade in alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <strong>Update Gagal!</strong> Pembaharuan data Produk gagal.
                        </div>
                        <?php } } ?>
                    </div>
                    <div class="col-md-3 column">
                         <div class="heading-profile">
                              <h2>Data Produk</h2>
                         </div>
                    </div>
               </div>
          </div><!-- Heading Sec -->
           
          <div class="main-content-area">
              <div class="row">
                  <div class="streaming-table">
                    <a href="#" data-toggle="modal" data-target=".tambah" class="icon-btn pulse-grow"><i class="fa fa-plus-square blue-bg"></i> Tambah Data Produk</a>
                  </div>
              </div>
               <div class="row">
                    <div class="col-md-12">
                         <div class="streaming-table">
                                   <span id="found" class="label label-info"></span>
                                   <table id="buku" class='table table-responsive table-responsive table-striped table-hover'>
                                     <thead>
                                        <tr>
                                          <th>No</th>
                                          <th>Nama</th>
                                          <th>Garansi</th>
                                          <th>Berat</th>
                                          <th>Harga</th>
                                          <th>Kategori</th>
                                          <th>Merk</th>
                                          <th>Deskripsi</th>
                                          <th>Stok</th>
                                          <th>Diskon</th>
                                          <th>Cover</th>
                                          <th width="500">Rating</th>
                                          <th>Operasi</th>
                                        </tr>
                                     </thead>
                                     <tbody>
                                        <?php
                                            $no = 1; 
                                            while($row=mysqli_fetch_assoc($produk)){ 
                                        ?>
                                         <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $row['nama_produk']; ?></td>
                                            <td><?php echo $row['garansi_produk']; ?></td>
                                            <td><?php echo $row['berat_produk']; ?> Gr</td>
                                            <td>
                                                <?php
                                                    $harga = number_format($row['harga_produk'], 2, ",", ".");
                                                    echo $harga;
                                                ?>
                                            </td>
                                            <td><?php echo $row['judul_kategori']; ?></td>
                                            <td><?php echo $row['judul_merk']; ?></td>
                                            <td>
                                                <?php 
                                                    $text = $row['deskripsi_produk']; 
                                                    $strip = strip_tags(htmlspecialchars_decode(stripcslashes($text)), '<a>');
                                                    echo substr($strip, 0, 30);
                                                    if(strlen(trim($row['deskripsi_produk']))>30) echo " [...]"; 
                                                ?>
                                            </td>
                                            <td><?php echo $row['stok_produk']; ?></td>
                                            <td><?php echo $row['diskon']; ?> %</td>
                                            <td>
                                                <a data-fancybox="gallery" href="../img/book/<?php echo $row['cover_produk']; ?>">
                                                    <img src="../img/book/<?php echo $row['cover_produk']; ?>" class="img-thumbnail img-responsive" alt="img" style="width:50px;">
                                                </a>
                                            </td>
                                            <td>
                                                <?php 
                                                    $x = $row['rating_produk'];
                                                    $j = 5-$x;
                                                    for ($i=0; $i<$x ; $i++) {
                                                ?>
                                                <i class="fa fa-star" style="color:#f39c12;"></i>
                                                <?php } for ($i=0; $i<$j ; $i++) { ?>
                                                <i class="fa fa-star-o" style="color:#f39c12;"></i>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <form action="lib/proses.php" method="post">
                                                <input type="hidden" name="id" value="<?php echo $row['id_produk']; ?>">
                                                <?php if($row['best_produk']==1) {?>
                                                    <button type="submit" name="hapus_best" title="Hapus sebagai best seller" class="c-btn small blue-bg buzz"><i class="fa fa-star"></i></button>
                                                <?php } else { ?>
                                                    <button type="submit" name="tambah_best" title="Tambah sebagai best seller" class="c-btn small buzz"><i class="fa fa-star-o"></i></button>
                                                <?php } ?>
                                                </form>
                                                <a href="" data-toggle="modal" data-target=".edit" data-id='<?php echo $row['id_produk']; ?>' data-nama='<?php echo $row['nama_produk']; ?>' 
                                                data-garansi='<?php echo $row['garansi_produk']; ?>' data-berat='<?php echo $row['berat_produk']; ?>' data-harga='<?php echo $row['harga_produk']; ?>'
                                                data-kategori='<?php echo $row['id_kategori']; ?>' data-merk='<?php echo $row['id_merk']; ?>' data-deskripsi='<?php echo $row['deskripsi_produk']; ?>' 
                                                data-stok='<?php echo $row['stok_produk']; ?>' data-diskon='<?php echo $row['diskon']; ?>' data-rating='<?php echo $row['rating_produk']; ?>' class="c-btn small green-bg buzz edit_button"><i class="fa fa-pencil-square"></i></a>

                                                <a href="" data-toggle="modal" data-target=".hapus" data-id='<?php echo $row['id_produk']; ?>' data-nama='<?php echo $row['nama_produk']; ?>' 
                                                data-berat='<?php echo $row['berat_produk']; ?>' data-diskon='<?php echo $row['diskon']; ?>' data-garansi='<?php echo $row['garansi_produk']; ?>' class="c-btn small red-bg buzz delete_button"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                         <?php $no++; } ?>
                                     </tbody>
                                   </table>
                                </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div><!-- Panel Content -->
     <div class="modal fade tambah" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Data produk</h4>
            </div>
            <div class="modal-body">
                <form action="lib/proses.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="form-group">
                            <label for="nama">Nama Produk</label>
                            <input type="text" placeholder="Masukkan Nama Produk" id="nama" name="nama" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="garansi">Garansi Produk</label>
                            <input type="text" placeholder="Masukkan Garansi Produk" id="garansi" name="garansi" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="berat">Berat Produk</label>
                            <input type="number" placeholder="Masukkan Berat Produk" id="berat" name="berat" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" placeholder="Masukkan Harga Produk" id="harga" name="harga" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" id="kategori" class="form-control">
                                <?php while($row=mysqli_fetch_assoc($kategori)){ ?>
                                    <option value="<?php echo $row['id_kategori']; ?>"><?php echo $row['judul_kategori']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="merk">Merk</label>
                            <select name="merk" id="merk" class="form-control">
                                <?php while($row=mysqli_fetch_assoc($merk)){ ?>
                                    <option value="<?php echo $row['id_merk']; ?>"><?php echo $row['judul_merk']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi Produk</label>
                            <textarea name="deskripsi" id="deskripsi" rows="5" cols="20" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input type="number" placeholder="Masukkan Jumlah Stok" id="stok" name="stok" min="1" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="diskon">Diskon <small>(silahkan set nominal 0-100)</small></label>
                            <input type="number" placeholder="Set Diskon Barang" id="diskon" name="diskon" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="cover">Cover</label>
                            <input type="file" id="cover" name="cover" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="rating">Rating</label>
                            <select name="rating" id="rating" class="form-control" style="font-family:'FontAwesome', Arial; color:#f39c12;">
                                <option value="0">
                                    &#xf006;&#xf006;&#xf006;&#xf006;&#xf006;
                                </option>
                                <option value="1">
                                    &#xf005;&#xf006;&#xf006;&#xf006;&#xf006;
                                </option>
                                <option value="2">
                                    &#xf005;&#xf005;&#xf006;&#xf006;&#xf006;
                                </option>
                                <option value="3">
                                    &#xf005;&#xf005;&#xf005;&#xf006;&#xf006;
                                </option>
                                <option value="4">
                                    &#xf005;&#xf005;&#xf005;&#xf005;&#xf006;
                                </option>
                                <option value="5">
                                    &#xf005;&#xf005;&#xf005;&#xf005;&#xf005;
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-4 col-md-offset-4">
                        <button type="submit" class="c-btn large blue-bg" name="tambah">Tambah</button>
                        <button type="button" class="c-btn large red-bg" data-dismiss="modal">Batal</button>
                </div>
            </div>
            </form>            
            </div>
        </div>
    </div>

    <div class="modal fade edit" tabindex="-2" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Data Produk</h4>
            </div>
            <div class="modal-body">
                <form action="lib/proses.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="form-group">
                            <label for="id">ID Produk</label>
                            <input type="text" id="id" name="id" class="form-control edit_id" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Produk</label>
                            <input type="text" placeholder="Masukkan Nama Produk" id="nama" name="nama" class="form-control edit_nama" required>
                        </div>
                        <div class="form-group">
                            <label for="garansi">Garansi Produk</label>
                            <input type="text" placeholder="Masukkan Garanasi Produk" id="garansi" name="garansi" class="form-control edit_garansi" required>
                        </div>
                        <div class="form-group">
                            <label for="berat">Berat Produk</label>
                            <input type="number" placeholder="Masukkan Berat Produk" id="berat" name="berat" class="form-control edit_berat" required>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" placeholder="Masukkan Harga Produk" id="harga" name="harga" class="form-control edit_harga" required>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" id="kategori" class="form-control">
                                <?php 
                                    $kat=mysqli_query($konek, "SELECT * FROM tb_kategori");
                                    while($data=mysqli_fetch_assoc($kat)){ ?>
                                    <option value="<?php echo $data['id_kategori']; ?>" id="<?php echo $data['id_kategori']; ?>"><?php echo $data['judul_kategori']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="merk">Merk</label>
                            <select name="merk" id="merk" class="form-control">
                                <?php 
                                    $kat=mysqli_query($konek, "SELECT * FROM tb_merk");
                                    while($data=mysqli_fetch_assoc($kat)){ ?>
                                    <option value="<?php echo $data['id_merk']; ?>" id="<?php echo $data['id_merk']; ?>"><?php echo $data['judul_merk']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="5" cols="20" class="form-control edit_deskripsi"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input type="number" placeholder="Masukkan Jumlah Stok " id="stok" name="stok" min="1" class="form-control edit_stok" required>
                        </div>
                        <div class="form-group">
                            <label for="diskon">Diskon <small>(silahkan set nominal 0-100)</small></label>
                            <input type="number" placeholder="Set Diskon Barang " id="diskon" name="diskon" class="form-control edit_diskon" required>
                        </div>
                        <div class="form-group">
                            <label for="cover">Ganti Cover <small>(Biarkan kosong jika tidak ingin cover berganti)</small></label>
                            <input type="file" id="cover" name="cover" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="rating">Rating</label>
                            <select name="rating" id="rating_edit" class="form-control" style="font-family:'FontAwesome', Arial; color:#f39c12;">
                                <option value="0" id="nol">
                                    &#xf006;&#xf006;&#xf006;&#xf006;&#xf006;
                                </option>
                                <option value="1" id="satu">
                                    &#xf005;&#xf006;&#xf006;&#xf006;&#xf006;
                                </option>
                                <option value="2" id="dua">
                                    &#xf005;&#xf005;&#xf006;&#xf006;&#xf006;
                                </option>
                                <option value="3" id="tiga">
                                    &#xf005;&#xf005;&#xf005;&#xf006;&#xf006;
                                </option>
                                <option value="4" id="empat">
                                    &#xf005;&#xf005;&#xf005;&#xf005;&#xf006;
                                </option>
                                <option value="5" id="lima">
                                    &#xf005;&#xf005;&#xf005;&#xf005;&#xf005;
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-4 col-md-offset-4">
                        <button type="submit" class="c-btn large blue-bg" name="update">Update</button>
                        <button type="button" class="c-btn large red-bg" data-dismiss="modal">Batal</button>
                </div>
            </div>
            </form>            
            </div>
        </div>
    </div>

    <div class="modal fade hapus" tabindex="-3" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Hapus Data Produk</h4>
            </div>
            <div class="modal-body">
                <form action="lib/proses.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="form-group">
                            <label for="id">ID Produk</label>
                            <input type="text" id="id" name="id" class="form-control hapus_id" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Nama">Nama Produk</label>
                            <input type="text" placeholder="Masukkan Nama Produk" id="judul" name="judul" class="form-control hapus_nama" readonly>
                        </div>
                        <div class="form-group">
                            <label for="garansi">Garansi Produk</label>
                            <input type="text" placeholder="Masukkan Garansi Produk" id="garansi" name="garansi" class="form-control hapus_garansi" readonly>
                        </div>
                        <div class="form-group">
                            <label for="berat">Berat Produk</label>
                            <input type="number" placeholder="Masukkan Berat Produk" id="berat" name="berat" class="form-control hapus_berat" readonly>
                        </div>
                        <p>Apakah Anda yakin akan menghapus Produk dengan data di atas?</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-4 col-md-offset-4">
                        <button type="submit" class="c-btn large blue-bg" name="hapus">Hapus</button>
                        <button type="button" class="c-btn large red-bg" data-dismiss="modal">Batal</button>
                </div>
            </div>
            </form>            
            </div>
        </div>
    </div>
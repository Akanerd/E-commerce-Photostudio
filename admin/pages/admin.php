<?php
if (!defined('MyConst')) {
    die('Akses langsung tidak diperbolehkan');
}
$enum = mysqli_query($konek, "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'tb_user' AND COLUMN_NAME = 'level'");
$produk = mysqli_query($konek, "SELECT * From tb_user where level ='admin'");
$kategori = mysqli_query($konek, "SELECT * FROM tb_kategori");
?>
<div class="panel-content">
    <div class="main-title-sec">
        <div class="row">
            <div class="col-md-12 column">
                <?php
                if (isset($_GET['a'])) {
                    $alert = $_GET['a'];
                    if ($alert == 'insert_sukses') {
                ?>
                        <div role="alert" class="alert color green-bg fade in alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <strong>Insert Sukses!</strong> Penambahan data Produk baru berhasil.
                        </div>
                    <?php } else if ($alert == 'insert_gagal') { ?>
                        <div role="alert" class="alert color red-bg fade in alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <strong>Insert Gagal!</strong> Penambahan data Produk baru gagal.
                        </div>
                    <?php } else if ($alert == 'upload_gagal') { ?>
                        <div role="alert" class="alert color red-bg fade in alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <strong>Gagal!</strong> Upload cover Produk gagal.
                        </div>
                    <?php } else if ($alert == 'update_sukses') { ?>
                        <div role="alert" class="alert color green-bg fade in alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <strong>Update Sukses!</strong> Pembaharuan data Produk berhasil.
                        </div>
                    <?php } else if ($alert == 'update_gagal') { ?>
                        <div role="alert" class="alert color red-bg fade in alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <strong>Update Gagal!</strong> Pembaharuan data Produk gagal.
                        </div>
                    <?php } else if ($alert == 'hapus_sukses') { ?>
                        <div role="alert" class="alert color blue-bg fade in alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <strong>Hapus Sukses!</strong> Data Produk berhasil dihapus.
                        </div>
                    <?php } else if ($alert == 'hapus_gagal') { ?>
                        <div role="alert" class="alert color red-bg fade in alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <strong>Update Gagal!</strong> Pembaharuan data Produk gagal.
                        </div>
                <?php }
                } ?>
            </div>
            <div class="col-md-3 column">
                <div class="heading-profile">
                    <h2>Data Admin</h2>
                </div>
            </div>
        </div>
    </div><!-- Heading Sec -->

    <div class="main-content-area">
        <div class="row">
            <div class="streaming-table">
                <a href="#" data-toggle="modal" data-target=".tambah" class="icon-btn pulse-grow"><i class="fa fa-plus-square blue-bg"></i> Tambah Data Admin</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="streaming-table">
                    <span id="found" class="label label-info"></span>
                    <table id="detail" class='table table-responsive table-responsive table-striped table-hover'>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Email User</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Hak Akses</th>
                                <th>Avatar Cover</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($produk)) {
                            ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $row['nama_user']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['password']; ?></td>
                                    <td><?php echo $row['level']; ?></td>
                                    <td>
                                        <a data-fancybox="gallery" href="../img/<?php echo $row['avatar']; ?>">
                                            <img src="../img/<?php echo $row['avatar']; ?>" class="img-thumbnail img-responsive" alt="Avatar kosong" style="width:50px;">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="" data-toggle="modal" data-target=".edit" data-id='<?php echo $row['id_user']; ?>' data-nama='<?php echo $row['nama_user']; ?>' data-email='<?php echo $row['email']; ?>' data-username='<?php echo $row['username']; ?>' data-password='<?php echo $row['password']; ?>' data-level='<?php echo $row['level']; ?>' class="c-btn small green-bg buzz edit_button"><i class="fa fa-pencil-square"></i></a>

                                        <a href="" data-toggle="modal" data-target=".hapus" data-id='<?php echo $row['id_user']; ?>' data-nama='<?php echo $row['nama_user']; ?>' data-email='<?php echo $row['email']; ?>' data-username='<?php echo $row['username']; ?>' data-password='<?php echo $row['password']; ?>' data-level='<?php echo $row['level']; ?>' class="c-btn small red-bg buzz delete_button"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php $no++;
                            } ?>
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
                <h4 class="modal-title">Tambah Data User Admin</h4>
            </div>
            <div class="modal-body">
                <form action="lib/proses.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="nama">Detail Nama</label>
                                <input type="text" placeholder="Masukkan Nama" id="nama" name="nama" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email User</label>
                                <input type="email" placeholder="Masukkan Email User" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" placeholder="Masukkan Username" id="username" name="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" placeholder="Masukkan Password User" id="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="level">Hak Akses</label>
                                <select name="level" id="level" class="form-control">
                                    <?php $row = mysqli_fetch_array($enum);
                                    $enumList = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE']) - 6))));
                                    foreach ($enumList as $value)
                                        echo "<option value=\"$value\">$value</option>";
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cover">Avatar Cover</label>
                                <input type="file" id="cover" name="cover" class="form-control" required>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-4 col-md-offset-4">
                    <button type="submit" class="c-btn large blue-bg" name="tambah_user">Tambah</button>
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
                <h4 class="modal-title">Edit Data User Admin</h4>
            </div>
            <div class="modal-body">
                <form action="lib/proses.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="id">ID User</label>
                                <input type="text" id="id" name="id" class="form-control edit_id" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama User</label>
                                <input type="text" placeholder="Masukkan Nama Detail Anda" id="nama" name="nama" class="form-control edit_nama" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email User</label>
                                <input type="email" placeholder="Masukkan Email Anda" id="email" name="email" class="form-control edit_email" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" placeholder="Masukkan Username Anda" id="username" name="username" class="form-control edit_username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" placeholder="Masukkan Password Anda" id="password" name="password" class="form-control edit_password" required>
                            </div>
                            <div class="form-group">
                                <label for="level">Hak Akses</label>
                                <select name="level" id="level" class="form-control">
                                    <?php $row = mysqli_fetch_array($enum);
                                    $enumList = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE']) - 6))));
                                    foreach ($enumList as $value)
                                        echo "<option value=\"$value\">$value</option>";
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cover">Ganti Cover <small>(Biarkan kosong jika tidak ingin cover berganti)</small></label>
                                <input type="file" id="cover" name="cover" class="form-control">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-4 col-md-offset-4">
                    <button type="submit" class="c-btn large blue-bg" name="update_user">Update</button>
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
                <h4 class="modal-title">Hapus Data User Admin</h4>
            </div>
            <div class="modal-body">
                <form action="lib/proses.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="id">ID User</label>
                                <input type="text" id="id" name="id" class="form-control hapus_id" readonly>
                            </div>
                            <div class="form-group">
                                <label for="Nama">Nama User</label>
                                <input type="text" placeholder="Masukkan Nama User" id="nama" name="nama" class="form-control hapus_nama" readonly>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" placeholder="Masukkan Username Anda" id="username" name="username" class="form-control hapus_username" readonly>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" placeholder="Masukkan Password Anda" id="password" name="password" class="form-control hapus_password" readonly>
                            </div>
                            <p>Apakah Anda yakin akan menghapus User dengan data di atas?</p>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-4 col-md-offset-4">
                    <button type="submit" class="c-btn large blue-bg" name="hapus_user">Hapus</button>
                    <button type="button" class="c-btn large red-bg" data-dismiss="modal">Batal</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
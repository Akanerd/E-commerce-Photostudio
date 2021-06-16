<?php
if (!defined('MyConst')) {
    die('Akses langsung tidak diperbolehkan');
}
$produk = mysqli_query($konek, "SELECT * From tb_pembelian join tb_user on tb_pembelian.id_pelanggan = tb_user.id_user");
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
            <div class="col-md-5 column">
                <div class="heading-profile">
                    <h2>Data Pemesanan Customer</h2>
                </div>
            </div>
        </div>
    </div><!-- Heading Sec -->

    <div class="main-content-area">
        <div class="row">
            <div class="streaming-table">
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
                                <th>Nama Pelanggan</th>
                                <th>Tanggal Pembelian</th>
                                <th>Status Pembelian</th>
                                <th>Total</th>
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
                                    <td><?php echo $row['tanggal_pembelian']; ?></td>
                                    <td><?php echo $row['status_pembelian']; ?></td>
                                    <td><?php echo $row['total_pembelian']; ?></td>
                                    <td>
                                        <a class="<?php if (isset($_GET['p'])) if ($_GET['p'] == 'detail') echo 'active'; ?>c-btn small blue-bg buzz edit_button" title="Detail Pemesananan" href="?p=detail&id=<?php echo $row['id_pembelian']; ?>"><i class="fa fa-info"></i></a>

                                        <?php if (($row['status_pembelian']!=="pending")):?>
                                        <a class="<?php if (isset($_GET['p'])) if ($_GET['p'] == 'pembayaran') echo 'active'; ?> c-btn small green-bg buzz edit_button" title="Pembayaran" href="?p=pembayaran&id=<?php echo $row['id_pembelian']; ?>"><i class="fa fa-credit-card"></i></a>
                                        <?php endif ?>
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

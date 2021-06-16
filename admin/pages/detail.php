<?php
if (!defined('MyConst')) {
    die('Akses langsung tidak diperbolehkan');
}
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
                    <h2>Detail Pembelian Customer</h2>
                </div>
            </div>
        </div>
    </div><!-- Heading Sec -->

    <div class="main-content-area">
        <div class="row">
            <div class="streaming-table">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <?php $ambil = $konek->query("select * from tb_pembelian join tb_user 
                            on tb_pembelian.id_pelanggan=tb_user.id_user
                            where tb_pembelian.id_pembelian ='$_GET[id]'");
                            $detail = $ambil->fetch_assoc(); ?>
                            <h3>Pembelian</h3>
                            <strong>No. Pembelian <?php echo $detail['id_pembelian']; ?></strong><br>
                            Tanggal : <?php echo $detail['tanggal_pembelian']; ?><br>
                            Total : Rp. <?php echo number_format($detail['total_pembelian']) ?>
                        </div>
                        <div class="col-md-4">
                            <h3>Pelanggan</h3>
                            <strong><?php echo $detail['nama_user']; ?></strong><br>
                            <p>
                                Nama User : <?php echo $detail['username']; ?><br>
                                Email User: <?php echo $detail['email']; ?>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <h3>Pengiriman</h3>
                            <strong><?php echo $detail['jenis_ongkir'] ?></strong>
                            <p>
                                Ongkos Kirim : Rp. <?php echo number_format($detail['tarif']); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="streaming-table">
                    <span id="found" class="label label-info"></span>
                    <table id="buku" class='table table-responsive table-responsive table-striped table-hover'>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Produk</th>
                                <th>Harga Produk</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $nomor = 1; ?>
                            <?php $ambil = $konek->query("select * from tb_pembelian_produk join tb_produk 
                                      on tb_pembelian_produk.id_produk=tb_produk.id_produk 
                                      where tb_pembelian_produk.id_pembelian ='$_GET[id]'"); ?>
                            <?php while ($pecah = $ambil->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td><?php echo $pecah['nama_produk']; ?></td>
                                    <td><?php echo number_format($pecah['harga_produk']); ?></td>
                                    <td><?php echo $pecah['jumlah']; ?></td>
                                    <td><?php echo number_format($pecah['harga_produk'] * $pecah['jumlah']) ?></td>
                                </tr>
                                <?php $nomor++; ?>
                            <?php } ?>
                        </tbody>
                    </table>              
                </div>
                <a class="<?php if (isset($_GET['p'])) if ($_GET['p'] == 'customer') echo 'active'; ?> mt-5 c-btn large red-bg buzz edit_button" title="Pembayaran" href="?p=customer" title="Proses Pesananan">kembali</a>
            </div>
        </div>
    </div>
</div>
</div>
</div><!-- Panel Content -->
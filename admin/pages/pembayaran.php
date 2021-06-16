<?php
if (!defined('MyConst')) {
    die('Akses langsung tidak diperbolehkan');
}
$id_pembelian = $_GET['id'];
?>
<div class="panel-content">
    <div class="main-title-sec">
        <div class="row">
            <div class="col-md-12 column">
            </div>
            <?php $ambil = $konek->query("select * from tb_pembayaran join tb_pembelian on tb_pembayaran.id_pembelian =tb_pembelian.id_pembelian where tb_pembelian.id_pembelian ='$id_pembelian'"); ?>
            <?php $pecah = $ambil->fetch_assoc(); ?>

            <?php
            if (isset($_POST['proses'])) {
                $resi   = $_POST["resi"];
                $status = $_POST["status"];
                $konek->query("update tb_pembelian set resi_pengiriman = '$resi',status_pembelian ='$status' where id_pembelian = '$id_pembelian'");
                echo "<div class='alert alert-success'>
                    <strong>Data Pesanan Telah Diupdate!</strong> 
                  </div>";
            }
            ?>
            <div class="col-md-5 column">
                <div class="heading-profile">
                    <h2>Data Pembayaran Customer</h2>
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
            <div class="col-md-6">
                <div class="streaming-table">
                    <span id="found" class="label label-info"></span>
                    <table class="table table-responsive table-responsive table-striped table-hover">
                        <tbody>
                            <tr>
                                <th>Nama</th>
                                <td><?php echo $pecah['nama'] ?></td>
                            </tr>
                            <tr>
                                <th>Bank</th>
                                <td><?php echo $pecah['bank'] ?></td>
                            </tr>
                            <tr>
                                <th>Jumlah</th>
                                <td>Rp <?php echo number_format($pecah['jumlah']) ?></td>
                            </tr>
                            <tr>
                                <th>Resi</th>
                                <td><?php echo ($pecah['resi_pengiriman']) ?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><?php echo ($pecah['status_pembelian']) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <img src="../img/<?php echo $pecah['bukti'] ?>" alt="" width="500px" height="500px" class="img-responsive">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="post">
                    <?php $ambil = $konek->query("select * from tb_pembelian where id_pembelian ='$id_pembelian'"); ?>
                    <?php $row = $ambil->fetch_assoc(); ?>
                    <div class="form-group">
                        <label>No. Resi Pengiriman</label>
                        <input type="text" name="resi" value="<?php echo $row['resi_pengiriman'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option selected="selected">Pilih Status</option>
                            <option value="lunas">Lunas</option>
                            <option value="barang dikirim">Barang Dikirim</option>
                            <option value="batal">Batal</option>
                        </select>
                    </div>
                    <?php ?>
                    <button class="c-btn large blue-bg buzz edit_button" title="Proses Pesananan" name="proses">Proses</button>
                    <a class="<?php if (isset($_GET['p'])) if ($_GET['p'] == 'customer') echo 'active'; ?> c-btn large red-bg buzz edit_button" title="Pembayaran" href="?p=customer" title="Proses Pesananan">kembali</a>
                    <!-- <button class="btn btn-primary" name="proses">Proses</button> -->
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div><!-- Panel Content -->
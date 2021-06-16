<?php
if (!defined('MyConst')) {
    die('Akses langsung tidak diperbolehkan');
}
$semuadata = array();
$tgl_mulai  = "-";
$tgl_selesai = "-";
if (isset($_POST["kirim"])) {
    $tgl_mulai  = $_POST["tglm"];
    $tgl_selesai = $_POST["tgls"];
    $ambil      = $konek->query("SELECT * from tb_pembelian pl left join tb_user pm on pm.id_user = pl.id_pelanggan where tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
    while ($pecah = $ambil->fetch_assoc()) {
        $semuadata[] = $pecah;
    }
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
                    <h2>Data Riwayat Pembelian Customer</h2>
                    <br>
                    <small>Laporan Pembelian dari <?php echo $tgl_mulai ?> hingga <?php echo $tgl_selesai ?></small>
                </div>
            </div>
        </div>
        <br>
    </div><!-- Heading Sec -->
    <div class="container">
        <div class="row">
            
        </div>
    </div>
    <div class="main-content-area pt-5">
            <div class="row">
            <form method="POST">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Tanggal Mulai</label>
                    <input type="date" class="form-control" name="tglm" >
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Tanggal Selesai</label>
                    <input type="date" class="form-control" name="tgls" >
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>&nbsp;</label>
                   <button class="btn btn-primary" style="margin-top: 25px;" name="kirim"><i class="fa fa-desktop"></i> Lihat Riwayat Laporan</button>
                </div>
            </div>
            </form>
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
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total =0; 
                            foreach ($semuadata as $key => $value):
                                $total += $value['total_pembelian'];
                            ?>
                                <tr>
                                    <td><?php echo $key+1; ?></td>
                                    <td><?php echo $value['nama_user']; ?></td>
                                    <td><?php echo $value['tanggal_pembelian']; ?></td>
                                    <td><?php echo $value['status_pembelian']; ?></td>
                                    <td><?php
                                        $harga = number_format($value['total_pembelian'], 2, ",", ".");
                                        echo "Rp " . $harga;
                                        ?></td>
                                </tr>
                                <?php endforeach?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">Total</th>
                                <th><?php $oke = number_format($total);
                                        echo "Rp " . $oke;?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div><!-- Panel Content -->
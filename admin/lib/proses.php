<?php
include "koneksi.php";
include "CRUD.php";
if (isset($_POST['tambah'])) {
    $nama       = mysqli_real_escape_string($konek, $_POST['nama']);
    $garansi    = mysqli_real_escape_string($konek, $_POST['garansi']);
    $berat      = mysqli_real_escape_string($konek, $_POST['berat']);
    $harga      = $_POST['harga'];
    $kategori   = $_POST['kategori'];
    $merk       = $_POST['merk'];
    $deskripsi   = htmlspecialchars(mysqli_real_escape_string($konek, $_POST['deskripsi']));
    $stok       = $_POST['stok'];
    $diskon    =$_POST['diskon'];
    $rating     = $_POST['rating'];
    $cover      = $_FILES["cover"]["name"];
    $tmp_cover  = $_FILES["cover"]["tmp_name"];
    $target     = "../../img/book/";
    $upload = upload_img($tmp_cover, $cover, $target);
    $form_data = array(
        'nama_produk'    => $nama,
        'garansi_produk' => $garansi,
        'berat_produk'   => $berat,
        'harga_produk'   => $harga,
        'diskon'           => $diskon,
        'id_kategori'      => $kategori,
        'id_merk'      => $merk,
        'deskripsi_produk' => $deskripsi,
        'stok_produk'      => $stok,
        'cover_produk'     => $cover,
        'rating_produk'    => $rating,
        'best_produk'      => 0
    );
    if ($upload == true) {
        $query = insert('tb_produk', $form_data);
        $hasil = mysqli_query($konek, $query);
        if ($hasil)
            header('location: ../index.php?p=data&a=insert_sukses');
        else
            header('location: ../index.php?p=data&a=insert_gagal');
    } else header("location: ../index.php?p=data&a=upload_gagal");
}

// dbRowUpdate('my_table', $form_data, "WHERE id = '$id'");
// dbRowUpdate('my_table', $form_data, "WHERE id = '$id'");
if (isset($_POST['update'])) {
    $id        =$_POST['id'];
    $nama      =mysqli_real_escape_string($konek, $_POST['nama']);
    $garansi   =mysqli_real_escape_string($konek, $_POST['garansi']);
    $berat     =mysqli_real_escape_string($konek, $_POST['berat']);
    $harga     =$_POST['harga'];
    $diskon    =$_POST['diskon'];
    $kategori  =$_POST['kategori'];
    $merk      =$_POST['merk'];
    $deskripsi =htmlspecialchars(mysqli_real_escape_string($konek, $_POST['deskripsi']));
    $stok      =$_POST['stok'];
    $rating    =$_POST['rating'];
    if(empty($_FILES['cover']['name'])){
        $form_data = array(
            'nama_produk'      => $nama,
            'garansi_produk'   => $garansi,
            'berat_produk'     => $berat,
            'harga_produk'     => $harga,
            'diskon'           => $diskon,
            'id_merk'          => $merk,
            'id_kategori'      => $kategori,
            'deskripsi_produk' => $deskripsi,
            'stok_produk'      => $stok,
            'rating_produk'    => $rating
        );
    } else {
        $cover     = $_FILES["cover"]["name"];
        $tmp_cover = $_FILES["cover"]["tmp_name"];
        $target    = "../../img/book/";
        $upload    = upload_img($tmp_cover, $cover, $target);
        $form_data = array(
            'nama_produk'      => $nama,
            'garansi_produk'   => $garansi,
            'berat_produk'     => $berat,
            'harga_produk'     => $harga,
            // 'halaman' => $halaman,
            'diskon'           => $diskon,
            'id_kategori'      => $kategori,
            'id_merk'          => $merk,
            'deskripsi_produk' => $deskripsi,
            'stok_produk'      => $stok,
            'cover_produk'     => $cover,
            'rating_produk'    => $rating
        );
        if ($upload==true) {
            $get_cover    = mysqli_query($konek, "SELECT cover_produk FROM tb_produk WHERE id_produk=$id");
            $row          = mysqli_fetch_assoc($get_cover);
            $cover_url    = "../../img/book/{$row['cover']}";
            unlink($cover_url);
        } else header("location: ../index.php?p=data&a=upload_gagal");
    }
    $query = update('tb_produk', $form_data, "WHERE id_produk=$id");
    $hasil = mysqli_query($konek, $query);
    if ($hasil)
        header('location: ../index.php?p=data&a=update_sukses');
    else
        header('location: ../index.php?p=data&a=update_gagal');        
}

if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $cover = mysqli_query($konek, "SELECT cover_produk FROM tb_produk WHERE id_produk=$id");
    $row = mysqli_fetch_assoc($cover);
    $url_cover = "../../img/book/{$row['cover_produk']}";
    $hapus_gambar = unlink($url_cover);
    $query1 = delete('tb_produk', "WHERE id_produk=$id");
    // $query2 = delete('tb_komentar', "WHERE id_buku=$id");
    $hasil1 = mysqli_query($konek, $query1);
    // $hasil2 = mysqli_query($konek, $query2);
    if ($hasil1 && $hapus_gambar) {
        header('location: ../index.php?p=data&a=hapus_sukses');
    } else
        header('location: ../index.php?p=data&a=hapus_gagal');
}

if (isset($_POST['tambah_user'])) {
    $nama       = mysqli_real_escape_string($konek, $_POST['nama']);
    $email      = mysqli_real_escape_string($konek, $_POST['email']);
    $username   = mysqli_real_escape_string($konek, $_POST['username']);
    $password   = $_POST['password'];
    $level      = $_POST['level'];
    $cover      = $_FILES["cover"]["name"];
    $tmp_cover  = $_FILES["cover"]["tmp_name"];
    $target     = "../../img/";
    $upload = upload_img($tmp_cover, $cover, $target);
    $form_data = array(
        'nama_user'      => $nama,
        'email'          => $email,
        'username'       => $username,
        'password'       => $password,
        'level'          => $level,
        'avatar'         => $cover,
    );
    if ($upload == true) {
        $query = insert('tb_user', $form_data);
        $hasil = mysqli_query($konek, $query);
        if ($hasil)
            header('location: ../index.php?p=user&a=insert_sukses');
        else
            header('location: ../index.php?p=user&a=insert_gagal');
    } else header("location: ../index.php?p=user&a=upload_gagal");
}

// dbRowUpdate('my_table', $form_data, "WHERE id = '$id'");
// dbRowUpdate('my_table', $form_data, "WHERE id = '$id'");
if (isset($_POST['update_user'])) {
    $id        =$_POST['id'];
    $nama       = mysqli_real_escape_string($konek, $_POST['nama']);
    $email      = mysqli_real_escape_string($konek, $_POST['email']);
    $username   = mysqli_real_escape_string($konek, $_POST['username']);
    $password   = $_POST['password'];
    $level      = $_POST['level'];
    if(empty($_FILES['cover']['name'])){
        $form_data = array(
            'nama_user'      => $nama,
            'email'          => $email,
            'username'       => $username,
            'password'       => $password,
            'level'          => $level,
        );
    } else {
        $cover     = $_FILES["cover"]["name"];
        $tmp_cover = $_FILES["cover"]["tmp_name"];
        $target    = "../../img/";
        $upload    = upload_img($tmp_cover, $cover, $target);
        $form_data = array(
            'nama_user'      => $nama,
            'email'          => $email,
            'username'       => $username,
            'password'       => $password,
            'level'          => $level,
            'avatar'         => $cover,
        );
        if ($upload==true) {
            $get_cover    = mysqli_query($konek, "SELECT avatar FROM tb_user WHERE id_user=$id");
            $row          = mysqli_fetch_assoc($get_cover);
            $cover_url    = "../../img/{$row['avatar']}";
            unlink($cover_url);
        } else header("location: ../index.php?p=user&a=upload_gagal");
    }
    $query = update('tb_user', $form_data, "WHERE id_user=$id");
    $hasil = mysqli_query($konek, $query);
    if ($hasil)
        header('location: ../index.php?p=user&a=update_sukses');
    else
        header('location: ../index.php?p=user&a=update_gagal');        
}
if (isset($_POST['hapus_user'])) {
    $id = $_POST['id'];
    $cover = mysqli_query($konek, "SELECT avatar FROM tb_user WHERE id_user=$id");
    $row = mysqli_fetch_assoc($cover);
    $url_cover = "../../img/{$row['avatar']}";
    $hapus_gambar = unlink($url_cover);
    $query1 = delete('tb_user', "WHERE id_user=$id");
    // $query2 = delete('tb_komentar', "WHERE id_buku=$id");
    $hasil1 = mysqli_query($konek, $query1);
    // $hasil2 = mysqli_query($konek, $query2);
    if ($hasil1 && $hapus_gambar) {
        header('location: ../index.php?p=user&a=hapus_sukses');
    } else
        header('location: ../index.php?p=user&a=hapus_gagal');
}

if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $cover = mysqli_query($konek, "SELECT cover_produk FROM tb_produk WHERE id_produk=$id");
    $row = mysqli_fetch_assoc($cover);
    $url_cover = "../../img/book/{$row['cover_produk']}";
    $hapus_gambar = unlink($url_cover);
    $query1 = delete('tb_produk', "WHERE id_produk=$id");
    // $query2 = delete('tb_komentar', "WHERE id_buku=$id");
    $hasil1 = mysqli_query($konek, $query1);
    // $hasil2 = mysqli_query($konek, $query2);
    if ($hasil1 && $hapus_gambar) {
        header('location: ../index.php?p=data&a=hapus_sukses');
    } else
        header('location: ../index.php?p=data&a=hapus_gagal');
}

if (isset($_POST['hapus_best'])) {
    $id = $_POST['id'];
    $form_data = array(
        'best_produk' => 0
    );
    $query = update('tb_produk', $form_data, "WHERE id_produk=$id");
    $hasil = mysqli_query($konek, $query);
    if ($hasil)
        header('location: ../index.php?p=data&a=hapus_best_sukses');
    else
        header('location: ../index.php?p=data&a=hapus_best_gagal');
}

if (isset($_POST['tambah_best'])) {
    $id = $_POST['id'];
    $form_data = array(
        'best_produk' => 1
    );
    $query = update('tb_produk', $form_data, "WHERE id_produk=$id");
    $hasil = mysqli_query($konek, $query);
    if ($hasil)
        header('location: ../index.php?p=data&a=tambah_best_sukses');
    else
        header('location: ../index.php?p=data&a=tambah_best_gagal');
}

if (isset($_POST['tambah_kat'])) {
    $kategori = mysqli_real_escape_string($konek, $_POST['kategori']);
    $form_data = array(
        'judul_kategori' => $kategori
    );
    $query = insert('tb_kategori', $form_data);
    $hasil = mysqli_query($konek, $query);
    if ($hasil)
        header('location: ../index.php?p=kategori&a=insert_sukses');
    else
        header('location: ../index.php?p=kategori&a=insert_gagal');
}

if (isset($_POST['update_kat'])) {
    $id = $_POST['id'];
    $kategori = mysqli_real_escape_string($konek, $_POST['kategori']);
    $form_data = array(
        'judul_kategori' => $kategori
    );
    $query = update('tb_kategori', $form_data, "WHERE id_kategori=$id");
    $hasil = mysqli_query($konek, $query);
    if ($hasil)
        header('location: ../index.php?p=kategori&a=update_sukses');
    else
        header('location: ../index.php?p=kategori&a=update_gagal');
}

if (isset($_POST['hapus_kat'])) {
    $id = $_POST['id'];
    $cover = mysqli_query($konek, "SELECT cover FROM tb_produk WHERE id_kategori=$id");
    while ($row = mysqli_fetch_assoc($cover)) {
        $url_cover = "../../img/book/{$row['cover']}";
        $hapus_gambar = unlink($url_cover);
    }
    $query1 = delete('tb_produk', "WHERE id_kategori=$id");
    $query2 = delete('tb_kategori', "WHERE id_kategori=$id");
    $hasil1 = mysqli_query($konek, $query1);
    $hasil2 = mysqli_query($konek, $query2);
    if ($hasil1 && $hasil2) {
        header('location: ../index.php?p=kategori&a=hapus_sukses');
    } else
        header('location: ../index.php?p=kategori&a=hapus_gagal');
}
if (isset($_POST['tambah_merk'])) {
    $kategori = mysqli_real_escape_string($konek, $_POST['merk']);
    $form_data = array(
        'judul_merk' => $kategori
    );
    $query = insert('tb_merk', $form_data);
    $hasil = mysqli_query($konek, $query);
    if ($hasil)
        header('location: ../index.php?p=merk&a=insert_sukses');
    else
        header('location: ../index.php?p=merk&a=insert_gagal');
}

if (isset($_POST['update_merk'])) {
    $id = $_POST['id'];
    $kategori = mysqli_real_escape_string($konek, $_POST['merk']);
    $form_data = array(
        'judul_merk' => $kategori
    );
    $query = update('tb_merk', $form_data, "WHERE id_merk=$id");
    $hasil = mysqli_query($konek, $query);
    if ($hasil)
        header('location: ../index.php?p=merk&a=update_sukses');
    else
        header('location: ../index.php?p=merk&a=update_gagal');
}

if (isset($_POST['hapus_merk'])) {
    $id = $_POST['id'];
    $cover = mysqli_query($konek, "SELECT cover FROM tb_produk WHERE id_merk=$id");
    while ($row = mysqli_fetch_assoc($cover)) {
        $url_cover = "../../img/book/{$row['cover']}";
        $hapus_gambar = unlink($url_cover);
    }
    // $query1 = delete('tb_produk', "WHERE id_merk=$id");
    $query2 = delete('tb_merk', "WHERE id_merk=$id");
    // $hasil1 = mysqli_query($konek, $query1);
    $hasil2 = mysqli_query($konek, $query2);
    if ($hasil2) {
        header('location: ../index.php?p=merk&a=hapus_sukses');
    } else
        header('location: ../index.php?p=merk&a=hapus_gagal');
}
if (isset($_POST['tambah_slider'])) {
    $get_gambar = mysqli_query($konek, "SELECT id_slide FROM tb_slide");
    $get_urutan = mysqli_num_rows($get_gambar);
    $judul = mysqli_real_escape_string($konek, $_POST['judul']);
    $keterangan = mysqli_real_escape_string($konek, $_POST['keterangan']);
    $gambar = $_FILES["gambar"]["name"];
    $tmp_gambar = $_FILES["gambar"]["tmp_name"];
    $target = "../../img/slider/";
    $upload = upload_img($tmp_gambar, $gambar, $target);
    $form_data = array(
        'judul_slide' => $judul,
        'keterangan' => $keterangan,
        'gambar' => $gambar,
        'urutan' => $get_urutan + 1
    );
    if ($upload == true) {
        $query = insert('tb_slide', $form_data);
        $hasil = mysqli_query($konek, $query);
        if ($hasil)
            header('location: ../index.php?p=slider&a=insert_sukses');
        else
            header('location: ../index.php?p=slider&a=insert_gagal');
    } else
        echo "Gagal upload";
    // header("location: ../index.php?p=slider&a=upload_gagal");
}

if (isset($_POST['hapus_slider'])) {
    $id = $_POST['id'];
    $gambar = mysqli_query($konek, "SELECT gambar FROM tb_slide WHERE id_slide=$id");
    $row = mysqli_fetch_assoc($gambar);
    $url_gambar = "../../img/slider/{$row['gambar']}";
    $hapus_gambar = unlink($url_gambar);
    $query = delete('tb_slide', "WHERE id_slide=$id");
    $hasil = mysqli_query($konek, $query);
    if ($hasil && $hapus_gambar) {
        header('location: ../index.php?p=slider&a=hapus_sukses');
    } else
        header('location: ../index.php?p=slider&a=hapus_gagal');
}

if (isset($_POST['update_slider'])) {
    $id = $_POST['id'];
    $judul = mysqli_real_escape_string($konek, $_POST['judul']);
    $keterangan = mysqli_real_escape_string($konek, $_POST['keterangan']);
    $urutan = $_POST['urutan'];
    $form_data = array(
        'judul_slide' => $judul,
        'keterangan' => $keterangan,
        'urutan' => $urutan
    );
    $query = update('tb_slide', $form_data, "WHERE id_slide=$id");
    $hasil = mysqli_query($konek, $query);
    if ($hasil)
        header('location: ../index.php?p=slider&a=update_sukses');
    else
        header('location: ../index.php?p=slider&a=update_gagal');
}

if (isset($_POST['restore_comment'])) {
    $id = $_POST['id'];
    $form_data = array(
        'hapus' => 0
    );
    $query = update('tb_komentar', $form_data, "WHERE id_komentar=$id");
    $hasil = mysqli_query($konek, $query);
    if ($hasil)
        header('location: ../index.php?p=comment&a=restore_sukses');
    else
        header('location: ../index.php?p=comment&a=restore_gagal');
}

if (isset($_POST['delete_comment'])) {
    $id = $_POST['id'];
    $form_data = array(
        'hapus' => 1
    );
    $query = update('tb_komentar', $form_data, "WHERE id_komentar=$id");
    $hasil = mysqli_query($konek, $query);
    if ($hasil)
        header('location: ../index.php?p=comment&a=hapus_sukses');
    else
        header('location: ../index.php?p=comment&a=hapus_gagal');
}

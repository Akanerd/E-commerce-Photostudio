<?php 
// mengaktifkan session pada php
session_start();
 
// menghubungkan php dengan koneksi database
include "lib/koneksi.php";
 
// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];
 
 
// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($konek,"select * from tb_user where username='$username' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
 
// cek apakah username dan password di temukan pada database
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);
 
	// cek jika user login sebagai admin
	if($data['level']=="admin"){
 
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";
		// alihkan ke halaman dashboard admin
		header("location:admin/index.php");
 
	// cek jika user login sebagai pegawai
	}else if($data['level']=="member"){

		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "member";
		// alihkan ke halaman dashboard pegawai
		header("location:index.php");
 
	}else if($data['level']=="Terblokir"){

		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "Terblokir";
		// alihkan ke halaman dashboard pegawai
		header("location:login.php?pesan=gagal");
 
	// cek jika user login sebagai pengurus
	}else{
		// alihkan ke halaman login kembali
		header("location:login.php?pesan=gagal");
	}	
}else{
	header("location:login.php?pesan=gagal");
}
 
?>
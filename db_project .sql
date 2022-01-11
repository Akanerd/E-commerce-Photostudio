-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2020 at 11:18 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(15) NOT NULL,
  `judul_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `judul_kategori`) VALUES
(1, 'Camera'),
(3, 'Lensa'),
(4, 'Photo Model'),
(5, 'Studio Service');

-- --------------------------------------------------------

--
-- Table structure for table `tb_komentar`
--

CREATE TABLE `tb_komentar` (
  `id_komentar` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama` varchar(125) NOT NULL,
  `isi_komentar` text NOT NULL,
  `hapus` int(11) NOT NULL,
  `tgl` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_komentar`
--

INSERT INTO `tb_komentar` (`id_komentar`, `id_produk`, `nama`, `isi_komentar`, `hapus`, `tgl`) VALUES
(1, 17, 'asd', 'asd', 0, '2020-05-19 07:17:21'),
(2, 17, 'dd', 'dd', 0, '2020-05-28 19:09:09'),
(3, 22, 'asd', 'dasd', 0, '2020-06-12 13:00:06');

-- --------------------------------------------------------

--
-- Table structure for table `tb_merk`
--

CREATE TABLE `tb_merk` (
  `id_merk` int(11) NOT NULL,
  `judul_merk` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_merk`
--

INSERT INTO `tb_merk` (`id_merk`, `judul_merk`) VALUES
(1, 'Sony'),
(2, 'Canon'),
(3, 'Samsung'),
(4, 'Fujifilm'),
(6, 'Olympus'),
(7, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ongkir`
--

CREATE TABLE `tb_ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `jenis_ongkir` varchar(25) DEFAULT NULL,
  `tarif` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_ongkir`
--

INSERT INTO `tb_ongkir` (`id_ongkir`, `jenis_ongkir`, `tarif`) VALUES
(1, 'JNE - Regular', 15000),
(2, 'JNE - Express', 20000),
(3, 'Si Cepat - Regular', 13500),
(4, 'Si Cepat - Express', 19000),
(5, 'JawaPos - Regular', 16000),
(6, 'JawaPos - Express', 22000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(2, 3, 'aku', '123', 124123, '2020-06-14', '202006181316Carts.png'),
(3, 3, 'aku', '123', 999999999, '2020-06-14', '202006181333Architectur web Studio.png'),
(4, 0, '', '', 0, '2020-06-15', '202006153258'),
(5, 0, '', '', 0, '2020-06-15', '202006153258'),
(6, 0, '', '', 0, '2020-06-15', '202006153258'),
(7, 0, '', '', 0, '2020-06-15', '202006153258'),
(8, 0, '', '', 0, '2020-06-15', '202006153258'),
(9, 0, '', '', 0, '2020-06-15', '202006153258'),
(10, 0, '', '', 0, '2020-06-15', '202006153258'),
(11, 0, 'aku', 'aku', 42094241, '2020-06-15', '202006153314Architectur web Studio copy.jpg'),
(12, 0, 'aku', 'aku', 42094241, '2020-06-15', '202006153314Architectur web Studio copy.jpg'),
(13, 0, 'aku', 'aku', 42094241, '2020-06-15', '202006153314Architectur web Studio copy.jpg'),
(14, 0, 'aku', 'aku', 42094241, '2020-06-15', '202006153314Architectur web Studio copy.jpg'),
(15, 0, 'aku', 'aku', 42094241, '2020-06-15', '202006153314Architectur web Studio copy.jpg'),
(16, 0, 'aku', 'aku', 42094241, '2020-06-15', '202006153314Architectur web Studio copy.jpg'),
(17, 0, 'aku', 'aku', 42094241, '2020-06-15', '202006153314Architectur web Studio copy.jpg'),
(18, 1, 'aku', 'aku', 2147483647, '2020-06-15', '202006153505about.png'),
(19, 2, 'aku', 'aku', 2147483647, '2020-06-15', '202006153505about.png'),
(20, 3, 'aku', 'aku', 2147483647, '2020-06-15', '202006153505about.png'),
(21, 4, 'aku', 'aku', 2147483647, '2020-06-15', '202006153505about.png'),
(22, 5, 'aku', 'aku', 2147483647, '2020-06-15', '202006153505about.png'),
(23, 6, 'aku', 'aku', 2147483647, '2020-06-15', '202006153505about.png'),
(24, 9, 'aku', 'aku', 2147483647, '2020-06-15', '202006153505about.png'),
(25, 8, 'asd', 'asdad', 1124102984, '2020-06-15', '202006153652Carts.png'),
(26, 10, 'asd', 'asdad', 1124102984, '2020-06-15', '202006153652Carts.png'),
(27, 0, 'asd', 'asd', 141241241, '2020-06-15', '202006155142Carts.png'),
(28, 0, 'asd', 'asd', 141241241, '2020-06-15', '202006155142Carts.png'),
(29, 0, 'asd', 'asd', 141241241, '2020-06-15', '202006155142Carts.png'),
(30, 0, 'asd', 'asd', 141241241, '2020-06-15', '202006155142Carts.png'),
(31, 11, 'ok', 'ok', 1665000, '2020-06-18', '202006120425676a05b2a6695e36410882611e5f449c.jpg'),
(32, 15, 'wq', 'asd', 465000, '2020-06-21', '2020061358421.jpg'),
(33, 16, 'pembeli2', 'asd', 3415000, '2020-06-21', '202006151311887521.jpg'),
(34, 24, 'asd', 'asd', 1662000, '2020-06-29', '202006144336299002562042201.jpg'),
(35, 23, 'riin', 'BCA', 60000, '2020-07-06', '202007171736'),
(36, 26, 'riin', 'MANDIRI', 30000, '2020-07-07', '2020071501091454246202105.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembelian`
--

CREATE TABLE `tb_pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `tanggal_pembelian` varchar(20) NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `jenis_ongkir` varchar(125) NOT NULL,
  `tarif` int(11) NOT NULL,
  `alamat_pengiriman` varchar(125) NOT NULL,
  `status_pembelian` varchar(125) DEFAULT 'pending',
  `resi_pengiriman` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pembelian`
--

INSERT INTO `tb_pembelian` (`id_pembelian`, `id_pelanggan`, `id_ongkir`, `tanggal_pembelian`, `total_pembelian`, `jenis_ongkir`, `tarif`, `alamat_pengiriman`, `status_pembelian`, `resi_pengiriman`) VALUES
(1, 2, 1, '2020', 4515000, 'JNE - Regular', 15000, '                    oke', 'lunas', 'N78624S22'),
(2, 2, 1, '2020', 15000, 'JNE - Regular', 15000, '                    oke', 'lunas', 'N78624S45'),
(3, 2, 6, '2020', 4522000, 'JawaPos - Express', 22000, '                    asd', 'barang dikirim', 'N78624SOD'),
(4, 2, 1, '2020', 4515000, 'JNE - Regular', 15000, '                    asd', 'barang dikirim', 'N78624SOD'),
(5, 2, 1, '2020', 4515000, 'JNE - Regular', 15000, '                    yoaso', 'Sudah kirim pembayaran', NULL),
(6, 2, 1, '2020', 10015000, 'JNE - Regular', 15000, '                    sdss', 'barang dikirim', 'N78624SOD'),
(7, 3, 3, '2020', 3413500, 'Si Cepat - Regular', 13500, '                    okee', 'pending', NULL),
(8, 4, 1, '2020', 4515000, 'JNE - Regular', 15000, '                    asdasd', 'Sudah kirim pembayaran', NULL),
(9, 2, 4, '2020-08-20', 4619000, 'Si Cepat - Express', 19000, '                    sadasd', 'Sudah kirim pembayaran', NULL),
(10, 4, 1, '2020-02-10', 3415000, 'JNE - Regular', 15000, '                    dsdsd', 'Sudah kirim pembayaran', NULL),
(11, 4, 1, '2020-08-31', 1665000, 'JNE - Regular', 15000, '                    asdasd', 'Sudah kirim pembayaran', NULL),
(12, 4, 1, '2020-02-19', 4515000, 'JNE - Regular', 15000, 'asd', 'pending', NULL),
(13, 4, 1, '2020-10-12', 1215000, 'JNE - Regular', 15000, 'asdasd', 'pending', NULL),
(14, 4, 1, '2020-02-20', 3415000, 'JNE - Regular', 15000, '                    dsfdsfsdf', 'pending', NULL),
(15, 2, 1, '2020-03-19', 465000, 'JNE - Regular', 15000, '                    as', 'Sudah kirim pembayaran', NULL),
(16, 5, 1, '2020-05-07', 3415000, 'JNE - Regular', 15000, '                    mmm', 'Sudah kirim pembayaran', NULL),
(17, 2, 4, '2020-07-07', 6431500, 'Si Cepat - Express', 19000, 'asd', 'pending', NULL),
(18, 2, 1, '2020-06-13', 465000, 'JNE - Regular', 15000, 'asdw', 'pending', NULL),
(19, 2, 4, '2020-09-10', 6654250, 'Si Cepat - Express', 19000, 'ddd', 'pending', NULL),
(20, 2, 1, '2020-08-14', 7400250, 'JNE - Regular', 15000, '                    sddfasd', 'pending', NULL),
(21, 6, 4, '2020-01-15', 5641750, 'Si Cepat - Express', 19000, '                    oke', 'pending', NULL),
(22, 6, 1, '2020-09-18', 762000, 'JNE - Regular', 15000, '            asd        ', 'pending', NULL),
(23, 6, 1, '2020-06-28', 60000, 'JNE - Regular', 15000, '                    gg', 'Sudah kirim pembayaran', NULL),
(24, 6, 1, '2020-06-29', 1662000, 'JNE - Regular', 15000, '                    asd', 'barang dikirim', '235sdfarafwef'),
(25, 6, 1, '2020-07-05', 4310250, 'JNE - Regular', 15000, 'aku                    ', 'pending', NULL),
(26, 7, 1, '2020-07-07', 30000, 'JNE - Regular', 15000, 'jkhkhk                    ', 'Sudah kirim pembayaran', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembelian_produk`
--

CREATE TABLE `tb_pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `harga` varchar(25) NOT NULL,
  `berat` int(11) NOT NULL,
  `subberat` int(11) NOT NULL,
  `subharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pembelian_produk`
--

INSERT INTO `tb_pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`, `nama`, `harga`, `berat`, `subberat`, `subharga`) VALUES
(1, 1, 21, 1, '0', '4500000', 2500, 2500, 4500000),
(2, 3, 21, 1, '0', '4500000', 2500, 2500, 4500000),
(3, 4, 21, 1, '0', '4500000', 2500, 2500, 4500000),
(4, 5, 21, 1, 'Studio Service PhotoBooth', '4500000', 2500, 2500, 4500000),
(5, 6, 21, 1, 'Studio Service PhotoBooth', '4500000', 2500, 2500, 4500000),
(6, 6, 20, 1, 'Camera Canon E9827', '3400000', 150, 150, 3400000),
(7, 6, 22, 1, 'Lensa Camera DSLR2', '1200000', 2000000, 2000000, 1200000),
(8, 6, 23, 2, 'Tripod Studio ', '450000', 200, 100, 900000),
(9, 7, 20, 1, 'Camera Canon E9827', '3400000', 150, 150, 3400000),
(10, 8, 21, 1, 'Studio Service PhotoBooth', '4500000', 2500, 2500, 4500000),
(11, 9, 22, 1, 'Lensa Camera DSLR2', '1200000', 2000000, 2000000, 1200000),
(12, 9, 20, 1, 'Camera Canon E9827', '3400000', 150, 150, 3400000),
(13, 10, 20, 1, 'Camera Canon E9827', '3400000', 150, 150, 3400000),
(14, 11, 22, 1, 'Lensa Camera DSLR2', '1200000', 2000000, 2000000, 1200000),
(15, 11, 23, 1, 'Tripod Studio ', '450000', 100, 100, 450000),
(16, 12, 21, 1, 'Studio Service PhotoBooth', '4500000', 2500, 2500, 4500000),
(17, 13, 22, 1, 'Lensa Camera DSLR2', '1200000', 2000000, 2000000, 1200000),
(18, 14, 20, 1, 'Camera Canon E9827', '3400000', 150, 150, 3400000),
(19, 15, 23, 1, 'Tripod Studio ', '450000', 100, 100, 450000),
(20, 16, 20, 1, 'Camera Canon E9827', '3400000', 150, 150, 3400000),
(21, 17, 22, 3, 'Lensa Camera DSLR2', '1200000', 6000000, 2000000, 3600000),
(22, 17, 21, 1, 'Studio Service PhotoBooth', '4500000', 2500, 2500, 4500000),
(23, 17, 23, 1, 'Tripod Studio ', '450000', 100, 100, 450000),
(24, 18, 23, 1, 'Tripod Studio ', '450000', 100, 100, 450000),
(25, 19, 23, 2, 'Tripod Studio ', '450000', 200, 100, 900000),
(26, 19, 22, 1, 'Lensa Camera DSLR2', '1200000', 2000000, 2000000, 1200000),
(27, 19, 20, 1, 'Camera Canon E9827', '3400000', 150, 150, 3400000),
(28, 19, 18, 1, 'Lensa Camera DSLR', '3500000', 2565, 2565, 3500000),
(29, 20, 22, 1, 'Lensa Camera DSLR2', '1200000', 2000000, 2000000, 1200000),
(30, 20, 23, 2, 'Tripod Studio ', '450000', 200, 100, 900000),
(31, 20, 21, 1, 'Studio Service PhotoBooth', '4500000', 2500, 2500, 4500000),
(32, 20, 20, 1, 'Camera Canon E9827', '3400000', 150, 150, 3400000),
(33, 21, 22, 6, 'Lensa Camera DSLR2', '1200000', 12000000, 2000000, 7200000),
(34, 21, 23, 1, 'Tripod Studio ', '450000', 100, 100, 450000),
(35, 22, 23, 2, 'Tripod Studio ', '450000', 200, 100, 900000),
(36, 23, 24, 3, 'Wallpaper IOS', '15000', 3000, 1000, 45000),
(37, 24, 23, 4, 'Tripod Studio ', '450000', 400, 100, 1800000),
(38, 25, 23, 3, 'Tripod Studio ', '450000', 300, 100, 1350000),
(39, 25, 24, 2, 'Wallpaper IOS', '15000', 2000, 1000, 30000),
(40, 25, 21, 1, 'Studio Service PhotoBooth', '4500000', 2500, 2500, 4500000),
(41, 26, 24, 1, 'Wallpaper IOS', '15000', 1000, 1000, 15000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(125) NOT NULL,
  `garansi_produk` varchar(125) NOT NULL,
  `berat_produk` int(11) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `id_kategori` int(15) NOT NULL,
  `id_merk` int(11) DEFAULT NULL,
  `deskripsi_produk` text NOT NULL,
  `stok_produk` int(15) NOT NULL,
  `diskon` int(11) DEFAULT NULL,
  `cover_produk` varchar(100) NOT NULL,
  `rating_produk` int(1) NOT NULL,
  `best_produk` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `nama_produk`, `garansi_produk`, `berat_produk`, `harga_produk`, `id_kategori`, `id_merk`, `deskripsi_produk`, `stok_produk`, `diskon`, `cover_produk`, `rating_produk`, `best_produk`) VALUES
(17, 'Camera Canon', '5 tahun', 2500, 2400000, 1, 2, '', 2, 37, 'product02.png', 5, '1'),
(18, 'Lensa Camera DSLR', '6 Tahun', 2565, 3500000, 3, 2, '&lt;p&gt;Lensa DSLR di rancang khusus untuk kamera DSLR Canon dan anda dapat memilih jenis atau tipe sesuai kebutuhan fotografer.&lt;/p&gt;\r\n&lt;p&gt;Lensa DSLR Canon juga bisa di gunakan atau dipasangkan ke kamera Mirrorless dengan bantuan adapter lens sesuai tipe kamera dan lensa yang akan di pasangkan.&lt;/p&gt;', 4, 15, 'lensa2.jpeg', 4, '0'),
(19, 'Camera Sony', '4 Tahun', 3450, 3450000, 1, 1, '&lt;p&gt;Canon Sony 1100DC merupakan kamera DSLR inovatif yang dapat membawa Anda ke dunia fotografi. Selain fitur-fitur yang banyak, kualitas gambar yang baik, canggih, otomatis serta teknologi yang sudah mengikuti perkembangan zaman memberikan kepuasan yang berlebih dalam fotografi Anda.&lt;/p&gt;', 4, 32, 'product05.png', 4, '0'),
(20, 'Camera Canon E9827', '2 Hari', 150, 3400000, 4, 2, '&lt;p&gt;Canon Sony 1100DC merupakan kamera DSLR inovatif yang dapat membawa Anda ke dunia fotografi. Selain fitur-fitur yang banyak, kualitas gambar yang baik, canggih, otomatis serta teknologi yang sudah mengikuti perkembangan zaman memberikan kepuasan yang berlebih dalam fotografi Anda.&lt;/p&gt;', 2, 13, 'WhatsApp Image 2020-05-01 at 11.50.12 (7).jpeg', 4, '0'),
(21, 'Studio Service PhotoBooth', '3 Minggu', 2500, 4500000, 5, 7, '', 2, 4, 'paket.png', 4, '0'),
(22, 'Lensa Camera DSLR2', '3 Bulan', 2000000, 1200000, 1, 1, '', 6, 12, 'lensa.jpeg', 3, '0'),
(23, 'Tripod Studio ', '1 Hari', 100, 450000, 3, 7, '', 5, 34, 'tipod.jpeg', 4, '1'),
(24, 'Wallpaper IOS', '1 hari', 1000, 15000, 1, 7, '&lt;p&gt;gambat bagus&lt;/p&gt;', 22, 5, '15017.jpg', 4, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_slide`
--

CREATE TABLE `tb_slide` (
  `id_slide` int(11) NOT NULL,
  `judul_slide` varchar(30) NOT NULL,
  `keterangan` text NOT NULL,
  `gambar` text NOT NULL,
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_slide`
--

INSERT INTO `tb_slide` (`id_slide`, `judul_slide`, `keterangan`, `gambar`, `urutan`) VALUES
(1, 'haikyuu', 'asd', '521111.jpg', 1),
(2, 'haikyuu', 'sad', '1299497.png', 2),
(3, 'pem', 'asd', '[KORIGENGI-Alfi] Nakano Miku.jpg', 3),
(4, 'haikyuu', 'dasd', 'Yesterday.wo.Utatte.full.2828198 (1).jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(30) NOT NULL,
  `email` varchar(25) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `level` enum('admin','member','Terblokir') NOT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `email`, `username`, `password`, `level`, `avatar`) VALUES
(1, 'Admin PhotoStudio', 'admin@gmail.com', 'admin', 'admin', 'admin', '02.png'),
(3, 'kageyama tobio', 'kageyama@gmail.com', 'kageyama', 'kage', 'member', NULL),
(4, 'aku', 'aku@gmail.com', 'aku', 'aku', 'Terblokir', NULL),
(5, '12', 'oki@gmail.com', '12', '12', 'member', NULL),
(6, 'pembeli2', 'beli2@gmail.com', 'pembeli2', 'beli2', 'member', '42610397_p0_master1200.jpg'),
(7, 'riin', 'riin@gmail.com', 'riin', 'riin', 'member', '202007140143maxresdefault.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_komentar`
--
ALTER TABLE `tb_komentar`
  ADD PRIMARY KEY (`id_komentar`);

--
-- Indexes for table `tb_merk`
--
ALTER TABLE `tb_merk`
  ADD PRIMARY KEY (`id_merk`);

--
-- Indexes for table `tb_ongkir`
--
ALTER TABLE `tb_ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `tb_pembelian_produk`
--
ALTER TABLE `tb_pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `tb_slide`
--
ALTER TABLE `tb_slide`
  ADD PRIMARY KEY (`id_slide`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_komentar`
--
ALTER TABLE `tb_komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_merk`
--
ALTER TABLE `tb_merk`
  MODIFY `id_merk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_ongkir`
--
ALTER TABLE `tb_ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `tb_pembelian_produk`
--
ALTER TABLE `tb_pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `tb_slide`
--
ALTER TABLE `tb_slide`
  MODIFY `id_slide` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

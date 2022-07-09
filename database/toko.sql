-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2021 at 12:47 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko`
--

-- --------------------------------------------------------

--
-- Table structure for table `ekspedisi`
--

CREATE TABLE `ekspedisi` (
  `id_ekspedisi` varchar(25) NOT NULL,
  `nama_ekspedisi` varchar(25) NOT NULL,
  `jenis_ekspedisi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ekspedisi`
--

INSERT INTO `ekspedisi` (`id_ekspedisi`, `nama_ekspedisi`, `jenis_ekspedisi`) VALUES
('jne-reguler', 'JNE', 'Reguler'),
('jnt-express-reguler', 'J&T Express', 'Reguler'),
('sicepat-reguler', 'SiCepat', 'Reguler');

-- --------------------------------------------------------

--
-- Table structure for table `item_pesanan`
--

CREATE TABLE `item_pesanan` (
  `id` int(8) NOT NULL,
  `order_id` varchar(20) NOT NULL,
  `id_produk` varchar(8) NOT NULL,
  `quantity` int(5) NOT NULL,
  `sub_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_pesanan`
--

INSERT INTO `item_pesanan` (`id`, `order_id`, `id_produk`, `quantity`, `sub_total`) VALUES
(1, '595311102', 'PD-26282', 1, 21000),
(2, '1302359759', 'PD-67658', 1, 39900),
(3, '1404454118', 'PD-67658', 1, 39900),
(4, '1404454118', 'PD-12345', 1, 999000),
(5, '715069975', 'PD-80379', 1, 30000),
(6, '2059858358', 'PD-09685', 1, 35000),
(7, '1958612381', 'PD-64928', 1, 20000),
(8, '21729983', 'PD-07218', 1, 30000),
(10, '1538316747', 'PD-12345', 1, 999000),
(12, '2111717534', 'PD-57630', 1, 150000),
(13, '103521188', 'PD-58302', 1, 5000),
(14, '103521188', 'PD-02379', 1, 21000),
(15, '251826540', 'PD-26282', 2, 42000),
(16, '443243134', 'PD-36958', 1, 2800000),
(17, '1851746825', 'PD-42985', 3, 210000),
(18, '1901448535', 'PD-42985', 3, 210000),
(19, '1342889428', 'PD-26282', 1, 21000),
(20, '1052438180', 'PD-26282', 1, 21000),
(21, '286868454', 'PD-02379', 1, 21000),
(22, '1724875001', 'PD-68527', 1, 35000),
(23, '1746263711', 'PD-68527', 1, 35000),
(24, '1488765580', 'PD-68527', 1, 35000);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`, `url`) VALUES
(1, 'Alat Tulis', 'alat-tulis'),
(2, 'Tinta', 'tinta'),
(3, 'Komputer & Otomatisasi Kantor', 'komputer-otomatisasi-kantor'),
(4, 'Berkas', 'berkas'),
(5, 'Furnitur', 'furnitur');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notif` int(11) NOT NULL,
  `id_user` varchar(8) NOT NULL,
  `role` int(1) NOT NULL,
  `order_id` varchar(20) NOT NULL,
  `created` text NOT NULL,
  `read` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id_notif`, `id_user`, `role`, `order_id`, `created`, `read`) VALUES
(13, 'P-45731', 1, '1538316747', '2021-06-02 23:23', 1),
(22, 'P-45731', 1, '21729983', '2021-06-12 09:38:00', 1),
(24, 'P-45731', 2, '1538316747', '2021-06-02 23:23', 1),
(25, 'P-45731', 2, '21729983', '2021-06-12 09:38:00', 1),
(30, 'P-45731', 1, '2111717534', '2021-06-03 16:13:17', 1),
(31, 'P-45731', 2, '2111717534', '2021-06-03 16:13:17', 1),
(32, 'P-45731', 1, '251826540', '2021-06-09 16:14:06', 0),
(33, 'P-45731', 2, '251826540', '2021-06-09 16:14:06', 1),
(34, 'P-45731', 1, '443243134', '2021-06-12 09:38:00', 0),
(35, 'P-45731', 2, '443243134', '2021-06-12 09:38:00', 1),
(36, 'P-45731', 1, '1851746825', '2021-06-12 11:25', 1),
(37, 'P-45731', 2, '1851746825', '2021-06-12 11:25', 1),
(38, 'P-45731', 1, '1901448535', '2021-06-12 13:31', 0),
(39, 'P-45731', 2, '1901448535', '2021-06-12 13:31', 0),
(40, 'P-06258', 1, '1342889428', '2021-06-12 14:04', 0),
(41, 'P-06258', 2, '1342889428', '2021-06-12 14:04', 1),
(42, 'P-06258', 1, '1052438180', '2021-06-12 14:15', 0),
(43, 'P-06258', 2, '1052438180', '2021-06-12 14:15', 0),
(44, 'P-06258', 1, '286868454', '2021-06-12 14:19', 0),
(45, 'P-06258', 2, '286868454', '2021-06-12 14:19', 1),
(46, 'P-12735', 1, '1724875001', '2021-06-12 15:44', 0),
(48, 'P-12735', 1, '1746263711', '2021-06-12 15:50', 0),
(50, 'P-12735', 1, '1488765580', '2021-06-12 15:58', 0),
(51, 'P-12735', 2, '1488765580', '2021-06-12 15:58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id_pengiriman` varchar(8) NOT NULL,
  `order_id` varchar(20) NOT NULL,
  `no_resi` varchar(15) NOT NULL,
  `tgl_dikirim` datetime NOT NULL,
  `tgl_diterima` datetime DEFAULT NULL,
  `Pengirim` varchar(9) NOT NULL DEFAULT 'LUM Store',
  `Penerima` varchar(30) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengiriman`
--

INSERT INTO `pengiriman` (`id_pengiriman`, `order_id`, `no_resi`, `tgl_dikirim`, `tgl_diterima`, `Pengirim`, `Penerima`, `status`) VALUES
('SH-01437', '1052438180', 'jne456', '2021-06-12 02:15:47', NULL, 'LUM Store', 'isha', 0),
('SH-05392', '1851746825', 'JN8622783826', '2021-06-12 11:25:06', NULL, 'LUM Store', 'Maulana Aprizqy Sumaryanto', 1),
('SH-08527', '1901448535', 'JN0812318236', '2021-06-12 01:31:06', NULL, 'LUM Store', 'Maulana Aprizqy Sumaryanto', 0),
('SH-24781', '1404454118', 'JN94242342932', '2021-05-30 02:03:12', '2021-05-30 14:03:31', 'LUM Store', 'Maulana Aprizqy Sumaryanto', 1),
('SH-27846', '443243134', 'JT123435442', '2021-06-03 09:19:24', '2021-06-12 09:38:00', 'LUM Store', 'Maulana Aprizqy Sumaryanto', 1),
('SH-30569', '1342889428', 'jne1234', '2021-06-12 02:04:42', NULL, 'LUM Store', 'isha', 0),
('SH-76290', '1488765580', 'Sicepat27817690', '2021-06-12 03:58:46', NULL, 'LUM Store', 'abyan', 0),
('SH-78129', '715069975', 'JT8664547687', '2021-05-26 17:35:50', '2021-06-03 16:09:25', 'LUM Store', 'Maulana Aprizqy Sumaryanto', 1),
('SH-80465', '2111717534', 'JT0123456789', '2021-05-25 02:47:43', '2021-06-03 16:13:17', 'LUM Store', 'Maulana Aprizqy Sumaryanto', 1),
('SH-82415', '595311102', 'SC0989829282', '2021-05-30 11:44:26', '2021-05-30 13:01:09', 'LUM Store', 'Maulana Aprizqy Sumaryanto', 1),
('SH-93028', '286868454', 'jne09993', '2021-06-12 02:19:49', NULL, 'LUM Store', 'isha', 0);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` varchar(8) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `merek` varchar(50) NOT NULL,
  `gambar` text NOT NULL DEFAULT '600x600.png',
  `kategori_id` int(11) NOT NULL,
  `stok` int(5) NOT NULL,
  `harga` float NOT NULL,
  `sku` varchar(25) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `arsip` int(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL,
  `date_updated` datetime DEFAULT NULL,
  `url_produk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `merek`, `gambar`, `kategori_id`, `stok`, `harga`, `sku`, `deskripsi`, `arsip`, `date_created`, `date_updated`, `url_produk`) VALUES
('PD-02379', 'Kertas Double Folio Garis Sidu 100 Lembar', 'SIDU', 'index.jpeg', 4, 48, 21000, 'krtsfloSD', 'Kertas Double Folio Garis Sidu 100 Lembar\r\n\r\nHarga diatas harga perpak isi 100 lembar\r\nKertas bergaris ukuran folio\r\n\r\n', 0, '2021-05-29 02:05:36', '2021-05-29 02:05:36', 'kertas-double-folio-garis-sidu-100-lembar'),
('PD-07218', 'Buku Tulis Sinar Dunia SIDU Ukuran A5 isi 38 Lembar', 'SIDU', 'index_(2).jpeg', 1, 98, 30000, 'SD-bt', 'buku tulis sinar dunia, kualitas kertas tebal tidak tipis\r\nharga diatas harga perpak\r\nmerk : sidu\r\nisi : 38 lbr\r\n', 0, '2021-05-29 02:25:25', '2021-05-29 02:25:25', 'buku-tulis-sinar-dunia-sidu-ukuran-a5-isi-38-lembar'),
('PD-08789', 'Ink Refill Bottle for Canon Dell HP Printer Ink Cartridges 100ml', 'INK JET', 'ink-refill-bottle-for-canon-dell-hp-printer-ink-cartridges-100ml-or-tinta-printer-magenta-28.JPG', 2, 10, 19900, 'INKCTRGDS', 'Tinta isi ulang untuk ink jet dan cartridges printer seperti printer Canon, Dell & HP. Dapat juga digunakan untuk printer merk lain. Hadir dengan beberapa warna seperti hitam, kuning, magenta dan biru.', 0, '2021-05-10 00:00:00', '2021-05-30 11:43:32', 'ink-refill-bottle-for-canon-dell-hp-printer-ink-cartridges-100ml'),
('PD-09654', 'Keyboard Genius Smart KB-101', 'Genius', 'keyboard_Genius1.jpeg', 3, 0, 96000, 'GSKB-101', 'System requirements:\r\nWindows 7, 8, 8.1, 10 or later\r\nMac OS X 10.8 or later\r\nUSB port', 0, '2021-05-08 00:00:00', '2021-05-09 00:00:00', 'keyboard-genius-smart-kb-101'),
('PD-09685', 'Pensil Faber Castell 2B', 'Faber-Castell', 'index_(6).jpeg', 1, 98, 35000, 'FC-9000', 'PENSIL 2B FABER CASTELL / CASTELL 9000 - 100% ORIGINAL\r\n(Pensil untuk semua ujian, dan menulis)\r\n\r\nMerek : Faber Castell\r\nPer Box : 12 Pcs\r\n\r\nKeunggulan:\r\n-Pensil dengan kualitas terbaik\r\n-Untuk menulis dan komputer\r\n-Sistem SV Bonding membuat pensil tida', 0, '2021-05-29 02:51:59', '2021-05-29 02:51:59', 'pensil-faber-castell-2b'),
('PD-12345', 'Kursi Kantor Informa Zach Hitam', 'Informa', 'kursi_kantor_informa.jpg', 5, 1, 999000, 'INFZACH', 'Tuas hidrolik mengatur tinggi dudukan, Penopang lengan, \r\nMaterial fabric, foam, metal, plywood, \r\nDimensi produk 63 x 62 x 95-105 cm.', 0, '2021-05-12 05:24:51', '2021-05-18 09:12:14', 'kursi-kantor-informa-zach-hitam'),
('PD-26107', 'Meja Organizer DRONJONS', 'IKEA', 'dronjons.jpg', 5, 10, 189000, 'DRONJONS', 'This compact storage, keeps stationery and desk accessories organised and the metal mesh makes it easy to find everything. Perfect in damp areas like bathrooms too, for make-up and everyday essentials.', 0, '2021-05-29 12:57:39', '2021-05-29 12:57:39', 'meja-organizer-dronjons'),
('PD-26282', 'Gel Pen Joyko JK-100 Black 0.5 mm 1 Box', 'Joyko', 'joyko_j-100.jpeg', 1, 7, 21000, 'JYKJ-100', 'Gel Pen Joyko JK-100 Black 0.5 mm 1 Box 12 Pcs', 0, '2021-05-12 05:05:49', '2021-05-26 12:41:00', 'gel-pen-joyko-jk-100-black-0.5-mm-1-box'),
('PD-36958', 'Meja Kantor MALM', 'IKEA', 'malm.jpg', 5, 9, 2800000, 'MALM', 'A clean design that’s just as beautiful on all sides – place it freestanding in the room or against a wall with cables neatly hidden inside. Use with other MALM products in the series for a unified look.', 0, '2021-05-29 01:07:31', '2021-05-29 01:07:31', 'meja-kantor-malm'),
('PD-37401', 'Meja Kantor BRUSALI', 'IKEA', 'brusali.jpg', 5, 10, 999000, 'BRUSALI', 'You can collect cables and extension leads on the shelf under the table top so they’re hidden but still close at hand.\r\n\r\nYou can fit a computer in the cabinet, since the shelves are adjustable.', 0, '2021-05-29 01:06:02', '2021-05-29 01:06:02', 'meja-kantor-brusali'),
('PD-42985', 'Spidol Whiteboard Snowman', 'Snowman', 'index_(7).jpeg', 1, 93, 70000, 'SNM-spl', 'SPIDOL WHITEBOARD SNOWMAN \r\n - BISA DIHAPUS\r\n -100% ORIGINAL\r\n\r\nREADY STOCK\r\nWARNA:\r\n- HITAM\r\n- BIRU\r\n- MERAH\r\n\r\nHarga diatas adalah harga  untuk 1 pack isi 12 pcs', 0, '2021-05-29 02:59:02', '2021-05-30 12:55:56', 'spidol-whiteboard-snowman'),
('PD-43213', 'Penghapus Faber-Castell 1 Pack', 'Faber-Castell', 'penghapus-faber-castell1.jpg', 1, 0, 15000, 'PFBCSTL-5', 'Faber Castell Penghapus Pensil, penghapus yang mudah digunakan dan tahan lama. Penghapus ini dirancang untuk mendapatkan hasil penghapusan terbaik tanpa merusak daerah yang dihapus dengan bersih.', 0, '2021-05-17 12:59:44', '2021-05-18 08:27:23', 'penghapus-faber-castell-1-pack'),
('PD-43782', 'Unit Laci Beroda HELMER', 'IKEA', 'helmer.jpg', 5, 10, 699000, 'HELMER', 'Slot for label on each drawer so you can easily keep things organised and find what you are looking for.\r\n\r\nDrawer stops prevent the drawer from being pulled out too far.\r\n\r\nEasy to move where it is needed thanks to castors.', 0, '2021-05-29 01:01:01', '2021-05-29 01:01:01', 'unit-laci-beroda-helmer'),
('PD-48369', 'Headset JBL MDR 450 AP', 'JBL', 'Headset_JBL_MDR_450_AP_Headphone_JBL.jpg', 3, 10, 90000, 'JBL-450', 'HEADSET/HEADPHONE JBL MDR-450 AP\r\n\r\nStereo Headphones,\r\nBass booster provides an acoustically-tight seal for superior sound isolation, deep bass sound and tight bass response,\r\nDirect sound delivering earpad with soft cushion, Swivels for flat and easy po', 0, '2021-05-29 03:22:50', '2021-05-30 12:55:50', 'headset-jbl-mdr-450-ap'),
('PD-54261', 'Kursi Kantor MILLBERGET', 'IKEA', 'millberget.jpg', 5, 10, 1600000, 'MILLBERGET', 'This desk chair has adjustable tilt tension that allows you to adjust the resistance to suit your movements and weight.\r\n\r\nYour back gets support and extra relief from the built-in lumbar support.\r\n\r\nYou sit comfortably since the chair is adjustable in he', 0, '2021-05-29 12:53:16', '2021-05-29 12:54:15', 'kursi-kantor-millberget'),
('PD-57630', 'Logitech M90 1000DPI Wired USB Optical Mouse for PC Notebook TV Box', 'Logitech', 'logitech-m90-1000dpi-wired-usb-optical-mouse-for-pc-notebook-tv-box---black-1571996325233.jpg', 3, 9, 150000, 'LTCH-ms', 'With power indicator :\r\nLase engine and uses super ratchet wheel to view wen smoothly;\r\nUnique and comfortable design with accurate rolling;\r\nFashionable and to be the desktop super cool \"Beetle Coupe\";\r\nErgonomic design to provide best support to your ha', 0, '2021-05-29 03:09:22', '2021-05-30 12:55:18', 'logitech-m90-1000dpi-wired-usb-optical-mouse-for-pc-notebook-tv-box'),
('PD-58302', 'Kenko Paper Clip Warna Warni', 'kenko', 'index_(1).jpeg', 4, 95, 5000, 'knk-pc ', 'Kenko Paper Clip Warna Warni No. 3100\r\n- PVC Coating\r\n- Bright Color\r\n- 100 Pcs\r\n\r\n*harga perkotak', 0, '2021-05-29 02:12:06', '2021-06-03 08:34:10', 'kenko-paper-clip-warna-warni'),
('PD-63297', 'Rak Buku Minimalis Kriya Jepara', 'Kriya Jepara', 'Rak-buku-kriya-jepara.jpg', 5, 10, 1700000, 'RKBK-KJ', 'Rak buku pajangan ini memiliki tingkat 5 dengan empat ruang. dengan desain yang elegan minimalis yang memanjang vertikal sehingga sangat menghemat ruangan. bisa menjadikan ruangan tetap terasa lega dan luas. buku dan barang- barang anda akan mudah tertata', 0, '2021-05-29 12:34:06', '2021-05-29 12:34:06', 'rak-buku-minimalis-kriya-jepara'),
('PD-64928', 'Penggaris Butterfly 30 cm', 'Butterfly', 'e8820714516a96b29de0a74564766777.jpeg', 1, 98, 20000, 'BTF-prs30', 'Penggaris Butterfly 30 cm \r\n\r\nHarga diatas harga perpack\r\nPenggaris mika plastik berkualitas 30cm\r\nReady warna putih\r\nHarat atc dus mudah patah', 0, '2021-05-29 02:45:57', '2021-05-29 02:45:57', 'penggaris-butterfly-30-cm'),
('PD-67658', 'Kertas A4 Copy Paper 70gsm', 'Copy Paper', 'Kertas_A4_70gsm7.jpeg', 4, 4, 39900, 'CPA4-70', 'Keputihan kertas ini sangat banyak diminati oleh perkantoran perkantoran di indonesia.', 0, '2021-05-09 00:00:00', '2021-05-15 11:22:19', 'kertas-a4-copy-paper-70gsm'),
('PD-68527', 'Bantex Lever Arch File Ordner Plastic PP A4 5cm ', 'Bantex', 'Bantex.jpeg', 4, 96, 35000, 'BTX', 'Bantex Lever Arch File Ordner Plastic PP A4 5cm\r\n\r\nOrdner / LAF Bantex PP terdiri dari 25 pilihan warna, dilengkapi dengan mekanik pengunci rado dan diperkuat dengan lapisan ganda pada bagian bawah ordner untuk menghindari goresan pada meja/kabinet. Pengu', 0, '2021-05-29 12:29:05', '2021-05-29 12:29:05', 'bantex-lever-arch-file-ordner-plastic-pp-a4-5cm-'),
('PD-70819', 'Meja Kantor MICKE', 'IKEA', 'micke.jpg', 5, 10, 1800000, 'MICKE', 'A clean and simple look that fits just about anywhere. You can combine it with other desks or drawer units in the MICKE series to extend your work space. The clever design at the back hides messy cables.', 0, '2021-05-29 12:49:44', '2021-05-29 12:49:44', 'meja-kantor-micke'),
('PD-76804', 'BUKU GAMBAR SIDU A4', 'SIDU', 'index_(3).jpeg', 1, 99, 20000, 'SD-bgA4', 'Buku Gambar Sinar Dunia A4\r\n\r\nHarga untuk 1 pack isi 5 buku.\r\n1 buku isi 10 lembar.', 0, '2021-05-29 02:30:19', '2021-05-29 02:30:19', 'buku-gambar-sidu-a4'),
('PD-78213', 'Kertas Origami', 'SIDU', 'index_(4).jpeg', 4, 99, 12000, 'SD-ko', 'KERTAS ORIGAMI\r\nMerk Sinar Dunia\r\nUkuran 12cm x 12cm\r\nIsi 100 lembar, terdiri dari 10 warna Merah-Jingga-Kuning-Hijau Tua-Hijau Muda-Biru Tua-Biru Muda-Pink-Hitam-Coklat\r\n\r\nDigunakan untuk:\r\n- Belajar Berhitung\r\n- Mengelompokan warna\r\n- Belajar melipat\r\n-', 0, '2021-05-29 02:34:55', '2021-05-29 02:34:55', 'kertas-origami'),
('PD-80379', 'BUSINESS FILE A4 ', 'Microtop', 'b5a636bafd131f0095f6e2b6aa7d036f.jpeg', 4, 98, 30000, 'BFA4', 'Map dengan acco plastik untuk menyimpan dokumen\r\nUkuran : A4\r\n\r\nHarga untuk 1 lusin', 0, '2021-05-29 01:25:42', '2021-05-29 01:27:38', 'business-file-a4-'),
('PD-86253', 'Kursi Kantor RENBERGET', 'IKEA', 'renberget.jpg', 5, 99, 1200000, 'RENBERGET', 'Comfy and lightweight so it’s easy to move about. The castors have a brake mechanism that keeps the chair in place when you stand up, and releases when you sit down – keeping you and your bottom from harm.', 0, '2021-05-29 12:55:33', '2021-05-29 12:55:33', 'kursi-kantor-renberget'),
('PD-94327', 'Loose Leaf Kertas File A5 ', 'Big BOSS', '64031820_e3cabe66-5276-44b0-ac26-02c84ed0645f_2048_2048.jpg', 4, 44, 5500, 'LL-A5', 'Loose Leaf / Kertas Binder File A5 50 Lembar\r\nKertas Bergaris dengan Bahan Berkualitas\r\n\r\nUkuran : 20 Ring A5\r\nIsi : 50 Lembar\r\n\r\n', 0, '2021-05-29 01:51:36', '2021-06-12 01:20:52', 'loose-leaf-kertas-file-a5-');

-- --------------------------------------------------------

--
-- Table structure for table `role_id`
--

CREATE TABLE `role_id` (
  `id` int(1) NOT NULL,
  `role` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_id`
--

INSERT INTO `role_id` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Pimpinan'),
(3, 'Pembeli');

-- --------------------------------------------------------

--
-- Table structure for table `temp_cart`
--

CREATE TABLE `temp_cart` (
  `cart_row` varchar(8) NOT NULL,
  `id_pembeli` varchar(8) NOT NULL,
  `id_produk` varchar(8) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `quantity` int(5) NOT NULL,
  `harga` float NOT NULL,
  `gambar` text NOT NULL,
  `url_produk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `order_id` varchar(20) NOT NULL,
  `id_pembeli` varchar(8) NOT NULL,
  `id_ekspedisi` varchar(25) NOT NULL,
  `catatan` text DEFAULT NULL,
  `grand_total` float NOT NULL,
  `payment_type` varchar(15) NOT NULL,
  `transaction_time` datetime NOT NULL,
  `settlement_time` datetime DEFAULT NULL,
  `bank` varchar(15) NOT NULL,
  `va_number` varchar(25) NOT NULL,
  `pdf_url` text NOT NULL,
  `status_code` varchar(3) NOT NULL,
  `status` enum('Belum Bayar','Dikemas','Dikirim','Selesai','Dibatalkan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`order_id`, `id_pembeli`, `id_ekspedisi`, `catatan`, `grand_total`, `payment_type`, `transaction_time`, `settlement_time`, `bank`, `va_number`, `pdf_url`, `status_code`, `status`) VALUES
('103521188', 'P-45731', 'sicepat-reguler', '', 26000, 'bank_transfer', '2021-06-03 21:15:23', NULL, 'bca', '11897866549', 'https://app.sandbox.midtrans.com/snap/v1/transactions/f8cc441a-8549-4202-9dd1-6daffbd148c5/pdf', '202', 'Dibatalkan'),
('1052438180', 'P-06258', 'jnt-express-reguler', '', 21000, 'bank_transfer', '2021-06-12 14:14:49', '2021-06-12 14:15:04', 'bca', '11897951315', 'https://app.sandbox.midtrans.com/snap/v1/transactions/324ecad6-6fac-4404-a062-7daddacae9f8/pdf', '200', 'Dikirim'),
('1302359759', 'P-45731', 'jne-reguler', '-', 39900, 'bank_transfer', '2021-05-28 21:21:57', NULL, 'bca', '2147483647', 'https://app.sandbox.midtrans.com/snap/v1/transactions/22c48824-35bc-496f-8cdf-4c4154993584/pdf', '202', 'Dibatalkan'),
('1342889428', 'P-06258', 'jne-reguler', 'jangan lupa di berikan bubble wrap', 21000, 'bank_transfer', '2021-06-12 13:59:19', '2021-06-12 14:01:45', 'bca', '11897464903', 'https://app.sandbox.midtrans.com/snap/v1/transactions/054e2ed8-f4fb-45c5-9949-cd3af5f6480d/pdf', '200', 'Selesai'),
('1404454118', 'P-45731', 'jne-reguler', '-', 1038900, 'bank_transfer', '2021-05-29 00:17:33', '2021-05-29 00:23:17', 'bca', '2147483647', 'https://app.sandbox.midtrans.com/snap/v1/transactions/97c62e8e-76d3-4259-853d-200330a99d40/pdf', '200', 'Selesai'),
('1488765580', 'P-12735', 'sicepat-reguler', 'Jangan Lupa kasih buble warp', 35000, 'bank_transfer', '2021-06-12 15:54:09', '2021-06-12 15:55:21', 'bca', '11897962365', 'https://app.sandbox.midtrans.com/snap/v1/transactions/5ea81d93-3f33-4bc9-bf92-15595a1a5005/pdf', '200', 'Selesai'),
('1851746825', 'P-45731', 'jne-reguler', '', 210000, 'bank_transfer', '2021-06-12 11:20:55', '2021-06-12 11:22:39', 'bca', '11897635054', 'https://app.sandbox.midtrans.com/snap/v1/transactions/38205367-4e95-4359-aa98-cd67f51b1d96/pdf', '200', 'Selesai'),
('1901448535', 'P-45731', 'jne-reguler', '', 210000, 'bank_transfer', '2021-06-12 13:28:43', '2021-06-12 13:29:33', 'bca', '11897355905', 'https://app.sandbox.midtrans.com/snap/v1/transactions/fe4acccd-2ed4-450f-8610-212354625dfe/pdf', '200', 'Dikirim'),
('1958612381', 'P-45731', 'sicepat-reguler', '', 20000, 'bank_transfer', '2021-05-30 12:11:32', NULL, 'bni', '9881189731675385', 'https://app.sandbox.midtrans.com/snap/v1/transactions/5ce99ba7-c449-4365-a11e-e2f449619a08/pdf', '202', 'Dibatalkan'),
('21729983', 'P-45731', 'jne-reguler', '', 30000, 'bank_transfer', '2021-06-08 12:33:51', '2021-06-09 09:48:13', 'bri', '118970681277523233', 'https://app.sandbox.midtrans.com/snap/v1/transactions/c58bc073-aacd-49df-86e1-d16c7ff84d51/pdf', '202', 'Dibatalkan'),
('251826540', 'P-45731', 'jne-reguler', '', 42000, 'bank_transfer', '2021-06-03 21:15:58', '2021-06-03 21:16:13', 'bca', '11897738807', 'https://app.sandbox.midtrans.com/snap/v1/transactions/ef6cccb1-fefa-45ff-9688-d8eb8dcb3bda/pdf', '202', 'Dibatalkan'),
('286868454', 'P-06258', 'jne-reguler', '', 21000, 'bank_transfer', '2021-06-12 14:19:14', '2021-06-12 14:19:20', 'bca', '11897684981', 'https://app.sandbox.midtrans.com/snap/v1/transactions/3df01064-fdf3-456a-bd90-85e11e0c46c9/pdf', '200', 'Selesai'),
('443243134', 'P-45731', 'jnt-express-reguler', '', 2800000, 'bank_transfer', '2021-06-03 21:18:10', '2021-06-03 21:18:34', 'bri', '118972733599538586', 'https://app.sandbox.midtrans.com/snap/v1/transactions/2c4833d4-c1bf-476e-9b78-748f9d2dbdfc/pdf', '200', 'Selesai'),
('595311102', 'P-45731', 'sicepat-reguler', '-', 21000, 'bank_transfer', '2021-05-28 21:20:06', '2021-05-28 22:22:36', 'bca', '2147483647', 'https://app.sandbox.midtrans.com/snap/v1/transactions/a548bbd3-2150-470d-aa1d-d08846170234/pdf', '200', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id_ulasan` int(11) NOT NULL,
  `order_id` varchar(20) NOT NULL,
  `id_produk` varchar(8) NOT NULL,
  `id_user` varchar(8) NOT NULL,
  `bintang` float NOT NULL,
  `komentar` varchar(255) NOT NULL,
  `date_posted` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id_ulasan`, `order_id`, `id_produk`, `id_user`, `bintang`, `komentar`, `date_posted`) VALUES
(7, '595311102', 'PD-26282', 'P-45731', 5, 'Produk Sangat bagus', '2021-05-30'),
(13, '1404454118', 'PD-67658', 'P-45731', 5, 'nice', '2021-05-30'),
(14, '1404454118', 'PD-12345', 'P-45731', 4, 'good', '2021-05-30'),
(18, '443243134', 'PD-36958', 'P-45731', 5, 'Produk sangat baik!', '2021-06-12'),
(19, '286868454', 'PD-02379', 'P-06258', 5, 'barangnya bagus', '2021-06-12'),
(20, '1851746825', 'PD-42985', 'P-45731', 5, 'sangat baique!', '2021-06-12'),
(21, '1488765580', 'PD-68527', 'P-12735', 5, 'barang sangat ok', '2021-06-12');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(8) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(50) NOT NULL,
  `kode_pos` varchar(5) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(50) NOT NULL,
  `foto` text NOT NULL DEFAULT 'default-user-avatar.png',
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `no_telp`, `alamat`, `kota`, `kode_pos`, `email`, `password`, `foto`, `role_id`) VALUES
('A-34784', 'Admin', '', 'Jl. Gotong royong No.11A', '', '', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'default-user-avatar.png', 1),
('P-06258', 'isha', '012345', 'Jl. Gotong royong No.11A', 'Bekasi', '17134', 'isha@gmail.com', '6ad14ba9986e3615423dfca256d04e3f', 'default-user-avatar.png', 3),
('P-12735', 'abyan', '091234567', 'jl melati', 'jakrta', '10890', 'abyan123@gmail.com', '9b5d31695afafd9219c0c022257ae4dd', 'default-user-avatar.png', 3),
('P-45731', 'Maulana Aprizqy Sumaryanto', '081383794949', 'Jl. Gotong royong No.11A', 'Bekasi', '17415', 'user@gmail.com', '6ad14ba9986e3615423dfca256d04e3f', 'default-user-avatar6.png', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ekspedisi`
--
ALTER TABLE `ekspedisi`
  ADD PRIMARY KEY (`id_ekspedisi`);

--
-- Indexes for table `item_pesanan`
--
ALTER TABLE `item_pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pesanan` (`order_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `url` (`url`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notif`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url_produk` (`url_produk`);

--
-- Indexes for table `role_id`
--
ALTER TABLE `role_id`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_cart`
--
ALTER TABLE `temp_cart`
  ADD PRIMARY KEY (`cart_row`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id_ulasan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item_pesanan`
--
ALTER TABLE `item_pesanan`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `role_id`
--
ALTER TABLE `role_id`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id_ulasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

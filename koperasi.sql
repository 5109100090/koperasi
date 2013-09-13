-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2013 at 05:22 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `koperasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE IF NOT EXISTS `anggota` (
  `ID_ANGGOTA` int(6) NOT NULL AUTO_INCREMENT,
  `NAMA_ANGGOTA` varchar(100) DEFAULT NULL,
  `ALAMAT_ANGGOTA` varchar(150) DEFAULT NULL,
  `TELPON_ANGOTA` varchar(16) DEFAULT NULL,
  `STATUS_LIST_CICILAN_ANGGOTA` decimal(1,0) DEFAULT NULL,
  `TOTAL_SIMPANAN` double DEFAULT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`ID_ANGGOTA`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`ID_ANGGOTA`, `NAMA_ANGGOTA`, `ALAMAT_ANGGOTA`, `TELPON_ANGOTA`, `STATUS_LIST_CICILAN_ANGGOTA`, `TOTAL_SIMPANAN`, `username`, `password`) VALUES
(2, 'jono', 'jl darmawangsa', '0319873', 1, 250263, 'test', '46f94c8de14fb36680850768ff1b7f2a'),
(3, 'JOHN', 'perumdos', '031983473', 1, 1668100, 'john', '46f94c8de14fb36680850768ff1b7f2a'),
(5, 'ucok', 'jl perumdos', '03187384', 1, 216000, 'ucok', '2fc4bfee344471c68b724856b9b6f13d'),
(6, 'rizky', 'perumdos', '03193892', 1, 1003333.3333333, '123', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `ID_BARANG` int(6) NOT NULL AUTO_INCREMENT,
  `NAMA_BARANG` varchar(100) DEFAULT NULL,
  `HARGA_BARANG` decimal(10,0) DEFAULT NULL,
  `STOK_BARANG` decimal(3,0) DEFAULT NULL,
  PRIMARY KEY (`ID_BARANG`),
  UNIQUE KEY `BARANG_PK` (`ID_BARANG`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`ID_BARANG`, `NAMA_BARANG`, `HARGA_BARANG`, `STOK_BARANG`) VALUES
(1, 'meja belajar', 90000, 7),
(2, 'baju', 1000, 7),
(0, 'null', 0, 0),
(6, 'kulkas 2 pintu', 5000000, 17),
(7, 'TV 21', 1000000, 19),
(8, 'HP', 4000000, 32),
(9, 'laptop', 10000000, 7),
(10, 'radio', 500000, 77),
(11, 'flasdisk', 100000, 74);

-- --------------------------------------------------------

--
-- Table structure for table `catatan_pembayaran_kredit`
--

CREATE TABLE IF NOT EXISTS `catatan_pembayaran_kredit` (
  `ID_CATATAN_DETAIL` int(6) NOT NULL AUTO_INCREMENT,
  `ID_KREDIT` int(6) DEFAULT NULL,
  `NOMINAL_CICILAN` decimal(10,0) DEFAULT NULL,
  `TANGGAL_PEMBAYARAN_CICILAN` date DEFAULT NULL,
  PRIMARY KEY (`ID_CATATAN_DETAIL`),
  KEY `CATATAN_DETAIL_PEMBAYARAN_PER_CICILAN_FK` (`ID_KREDIT`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `catatan_pembayaran_kredit`
--

INSERT INTO `catatan_pembayaran_kredit` (`ID_CATATAN_DETAIL`, `ID_KREDIT`, `NOMINAL_CICILAN`, `TANGGAL_PEMBAYARAN_CICILAN`) VALUES
(1, 1, 150, '2011-01-13'),
(2, 1, 180, '2011-01-13'),
(3, 6, 140000, '2011-01-14'),
(4, 7, 50000, '2011-01-14'),
(5, 8, 15000, '2011-01-14');

-- --------------------------------------------------------

--
-- Table structure for table `kredit`
--

CREATE TABLE IF NOT EXISTS `kredit` (
  `ID_KREDIT` int(6) NOT NULL AUTO_INCREMENT,
  `ID_BARANG1` int(6) DEFAULT NULL,
  `ID_BARANG2` int(11) NOT NULL,
  `ID_BARANG3` int(11) NOT NULL,
  `ID_ANGGOTA` char(6) NOT NULL,
  `ID_PEGAWAI` char(6) NOT NULL,
  `LAMA_CICILAN` decimal(2,0) DEFAULT NULL,
  `MULAI_CICILAN` date DEFAULT NULL,
  `total_kredit` double NOT NULL,
  `sisa_kredit` double NOT NULL,
  `kredit_per_bulan` double NOT NULL,
  PRIMARY KEY (`ID_KREDIT`),
  KEY `DETAIL_CICILAN_FK` (`ID_ANGGOTA`),
  KEY `BARANG_YANG_DICICILL_FK` (`ID_BARANG1`),
  KEY `PEGAWAI_YANG_MELAYANI_CICILAN_FK` (`ID_PEGAWAI`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `kredit`
--

INSERT INTO `kredit` (`ID_KREDIT`, `ID_BARANG1`, `ID_BARANG2`, `ID_BARANG3`, `ID_ANGGOTA`, `ID_PEGAWAI`, `LAMA_CICILAN`, `MULAI_CICILAN`, `total_kredit`, `sisa_kredit`, `kredit_per_bulan`) VALUES
(1, 2, 0, 0, '2', '1', 6, '2011-01-12', 700, 233.33333333332, 116.66666666667),
(7, 10, 11, 0, '3', '1', 10, '2011-01-14', 420000, 378000, 42000),
(6, 11, 0, 0, '5', '1', 10, '2011-01-14', 140000, 126000, 14000),
(8, 11, 0, 0, '6', '2', 6, '2011-01-14', 70000, 58333.333333333, 11666.666666667);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `ID_PEGAWAI` int(6) NOT NULL AUTO_INCREMENT,
  `NAMA_PEGAWAI` varchar(100) DEFAULT NULL,
  `ALAMAT_PEGAWAI` varchar(150) DEFAULT NULL,
  `TELPON_PEGAWAI` decimal(11,0) DEFAULT NULL,
  `STATUS_PEGAWAI` int(2) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`ID_PEGAWAI`),
  UNIQUE KEY `PEGAWAI_PK` (`ID_PEGAWAI`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`ID_PEGAWAI`, `NAMA_PEGAWAI`, `ALAMAT_PEGAWAI`, `TELPON_PEGAWAI`, `STATUS_PEGAWAI`, `username`, `password`) VALUES
(1, 'muhammad', 'at the bottom of bikin', 239047298, 2, 'spondbob', '46f94c8de14fb36680850768ff1b7f2a'),
(2, 'eduardo', 'surabaya', 3187434, 2, 'pegawai1', '46f94c8de14fb36680850768ff1b7f2a'),
(3, 'septianto', 'keputih utara', 3198743, 2, 'pegawai2', '46f94c8de14fb36680850768ff1b7f2a');

-- --------------------------------------------------------

--
-- Table structure for table `penarikan`
--

CREATE TABLE IF NOT EXISTS `penarikan` (
  `ID_PENARIKAN` int(6) NOT NULL AUTO_INCREMENT,
  `ID_PEGAWAI` char(6) NOT NULL,
  `ID_ANGGOTA` char(6) NOT NULL,
  `NOMINAL_PENARIKAN` decimal(14,0) DEFAULT NULL,
  `TANGGAL_PENARIKAN` date DEFAULT NULL,
  PRIMARY KEY (`ID_PENARIKAN`),
  UNIQUE KEY `PENARIKAN_PK` (`ID_PENARIKAN`),
  KEY `DETAIL_PENARIKAN_FK` (`ID_ANGGOTA`),
  KEY `PEGAWAI_YANG_MELAYANI_PENARIKAN_FK` (`ID_PEGAWAI`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `penarikan`
--

INSERT INTO `penarikan` (`ID_PENARIKAN`, `ID_PEGAWAI`, `ID_ANGGOTA`, `NOMINAL_PENARIKAN`, `TANGGAL_PENARIKAN`) VALUES
(1, '1', '2', 500, '2011-01-09'),
(2, '1', '2', 250, '2011-01-09'),
(3, '1', '3', 300, '2011-01-09');

-- --------------------------------------------------------

--
-- Table structure for table `simpanan`
--

CREATE TABLE IF NOT EXISTS `simpanan` (
  `ID_SIMPANAN` int(6) NOT NULL AUTO_INCREMENT,
  `ID_ANGGOTA` char(6) NOT NULL,
  `ID_PEGAWAI` char(6) NOT NULL,
  `NOMINAL_SIMPANAN` int(100) DEFAULT NULL,
  `TANGGAL_SIMPANAN` date DEFAULT NULL,
  PRIMARY KEY (`ID_SIMPANAN`),
  UNIQUE KEY `SIMPANAN_PK` (`ID_SIMPANAN`),
  KEY `DETAIL_SIMPANAN_FK` (`ID_ANGGOTA`),
  KEY `PEGAWAI_YANG_MELAYANI_SIMPANAN_FK` (`ID_PEGAWAI`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `simpanan`
--

INSERT INTO `simpanan` (`ID_SIMPANAN`, `ID_ANGGOTA`, `ID_PEGAWAI`, `NOMINAL_SIMPANAN`, `TANGGAL_SIMPANAN`) VALUES
(1, '2', '1', 200, '2011-01-09'),
(2, '2', '1', 500, '2011-01-09'),
(3, '2', '1', 7000, '2011-02-09'),
(4, '3', '1', 150, '2011-01-09'),
(5, '2', '1', 75, '2011-01-09'),
(6, '2', '1', 97000, '2011-01-09'),
(7, '3', '1', 100, '2010-01-12'),
(8, '5', '1', 100000, '2011-01-14'),
(9, '5', '1', 10000, '2011-01-14'),
(14, '3', '1', 1900000, '2011-01-14'),
(13, '2', '1', 250000, '2011-01-14'),
(15, '6', '2', 10000, '2011-01-14'),
(16, '6', '2', 1000000, '2011-01-14');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

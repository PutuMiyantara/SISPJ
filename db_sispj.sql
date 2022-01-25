-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_sispj
CREATE DATABASE IF NOT EXISTS `db_sispj` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_sispj`;

-- Dumping structure for table db_sispj.tb_belanja
CREATE TABLE IF NOT EXISTS `tb_belanja` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_kode_belanja_sub5` bigint(20) DEFAULT NULL,
  `nama_belanja` bigint(20) DEFAULT NULL,
  `uraian` bigint(20) DEFAULT NULL,
  `koefisien` varchar(100) DEFAULT NULL,
  `satuan` int(11) DEFAULT NULL,
  `harga` bigint(20) DEFAULT NULL COMMENT 'Rupiah',
  `ppn` bigint(20) DEFAULT NULL COMMENT 'Rupiah',
  `jumlah` bigint(20) DEFAULT NULL COMMENT 'Rupiah',
  `updated` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `RelasiKodeBelanja` (`id_kode_belanja_sub5`),
  CONSTRAINT `RelasiKodeBelanja` FOREIGN KEY (`id_kode_belanja_sub5`) REFERENCES `tb_kode_belanja_sub5` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='daftar belanja dan rinciannya';

-- Data exporting was unselected.

-- Dumping structure for table db_sispj.tb_bendahara
CREATE TABLE IF NOT EXISTS `tb_bendahara` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nip_bendahara` varchar(255) DEFAULT NULL,
  `nama_bendahara` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_sispj.tb_kode_belanja_sub1
CREATE TABLE IF NOT EXISTS `tb_kode_belanja_sub1` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kode_belanja_sub1` varchar(50) DEFAULT NULL,
  `nama_rekening` varchar(50) DEFAULT NULL,
  `jumlah_anggaran` bigint(20) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `id_rekening_dasar` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `RelasiRekeningDasar` (`id_rekening_dasar`),
  CONSTRAINT `RelasiRekeningDasar` FOREIGN KEY (`id_rekening_dasar`) REFERENCES `tb_rekening_dasar` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='untuk mencatat kode belanja sub utama';

-- Data exporting was unselected.

-- Dumping structure for table db_sispj.tb_kode_belanja_sub2
CREATE TABLE IF NOT EXISTS `tb_kode_belanja_sub2` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kode_belanja_sub2` varchar(50) DEFAULT NULL,
  `nama_rekening` varchar(50) DEFAULT NULL,
  `jumlah_anggaran` bigint(20) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `id_kode_belanja_sub1` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `RelasiSub1` (`id_kode_belanja_sub1`),
  CONSTRAINT `RelasiSub1` FOREIGN KEY (`id_kode_belanja_sub1`) REFERENCES `tb_kode_belanja_sub1` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='untuk mencatat kode belanja sub kedua';

-- Data exporting was unselected.

-- Dumping structure for table db_sispj.tb_kode_belanja_sub3
CREATE TABLE IF NOT EXISTS `tb_kode_belanja_sub3` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kode_belanja_sub3` varchar(50) DEFAULT NULL,
  `nama_rekening` varchar(50) DEFAULT NULL,
  `jumlah_anggaran` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `id_kode_belanja_sub2` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `RelasiSub2` (`id_kode_belanja_sub2`),
  CONSTRAINT `RelasiSub2` FOREIGN KEY (`id_kode_belanja_sub2`) REFERENCES `tb_kode_belanja_sub2` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='untuk mencatat kode belanja sub ketiga';

-- Data exporting was unselected.

-- Dumping structure for table db_sispj.tb_kode_belanja_sub4
CREATE TABLE IF NOT EXISTS `tb_kode_belanja_sub4` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kode_belanja_sub4` varchar(50) DEFAULT NULL,
  `nama_rekening` varchar(50) DEFAULT NULL,
  `jumlah_anggaran` bigint(20) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `id_kode_belanja_sub3` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `RelasiKodeSub3` (`id_kode_belanja_sub3`),
  CONSTRAINT `RelasiKodeSub3` FOREIGN KEY (`id_kode_belanja_sub3`) REFERENCES `tb_kode_belanja_sub3` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='untuk mencatat kode belanja sub keempat';

-- Data exporting was unselected.

-- Dumping structure for table db_sispj.tb_kode_belanja_sub5
CREATE TABLE IF NOT EXISTS `tb_kode_belanja_sub5` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kode_belanja_sub5` varchar(50) DEFAULT NULL,
  `nama_rekening` varchar(50) DEFAULT NULL,
  `jumlah_anggaran` bigint(20) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `id_kode_belanja_sub4` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `RelasiKodeSub4` (`id_kode_belanja_sub4`),
  CONSTRAINT `RelasiKodeSub4` FOREIGN KEY (`id_kode_belanja_sub4`) REFERENCES `tb_kode_belanja_sub4` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='untuk mencatat kode belanja sub 5';

-- Data exporting was unselected.

-- Dumping structure for table db_sispj.tb_kode_bidang
CREATE TABLE IF NOT EXISTS `tb_kode_bidang` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kode_rek_bidang` varchar(50) DEFAULT NULL,
  `nama_rek_bidang` varchar(255) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='utuk mencatat kode bidang pada nomor rekenig';

-- Data exporting was unselected.

-- Dumping structure for table db_sispj.tb_kode_dinas
CREATE TABLE IF NOT EXISTS `tb_kode_dinas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kode_rek_dinas` varchar(255) DEFAULT NULL,
  `nama_rek_dinas` varchar(255) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COMMENT='utuk mencatat kode dinas pada rekenig';

-- Data exporting was unselected.

-- Dumping structure for table db_sispj.tb_kode_kegiatan
CREATE TABLE IF NOT EXISTS `tb_kode_kegiatan` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kode_rek_kegiatan` varchar(50) DEFAULT NULL,
  `nama_rek_kegiatan` varchar(255) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='untuk mencatat kode kegiatan pada nomor rekening';

-- Data exporting was unselected.

-- Dumping structure for table db_sispj.tb_kode_program
CREATE TABLE IF NOT EXISTS `tb_kode_program` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kode_rek_program` varchar(50) DEFAULT NULL,
  `nama_rek_program` varchar(255) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='untuk mencatat kode program pada nomor rekening';

-- Data exporting was unselected.

-- Dumping structure for table db_sispj.tb_kode_unit
CREATE TABLE IF NOT EXISTS `tb_kode_unit` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kode_rek_unit` varchar(50) DEFAULT NULL,
  `nama_rek_unit` varchar(255) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='untuk mencatat kode unit(uptd) pada nomor rekening';

-- Data exporting was unselected.

-- Dumping structure for table db_sispj.tb_kode_urusan
CREATE TABLE IF NOT EXISTS `tb_kode_urusan` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kode_rek_urusan` varchar(50) DEFAULT NULL,
  `nama_rek_urusan` varchar(50) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='mencatat kode rekening untuk urusan';

-- Data exporting was unselected.

-- Dumping structure for table db_sispj.tb_kpa_ppk
CREATE TABLE IF NOT EXISTS `tb_kpa_ppk` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nip_kpa_ppk` varchar(255) DEFAULT NULL,
  `nama_kpa_ppk` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_sispj.tb_kuwitansi
CREATE TABLE IF NOT EXISTS `tb_kuwitansi` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_order` bigint(20) DEFAULT NULL COMMENT 'ada jika terdapat order yang berelasi',
  `nominal` double DEFAULT NULL,
  `uraian_belanja` varchar(50) DEFAULT NULL COMMENT 'bisa terisi otomatis jika terdapat relasi dari tb_order (berisi tentang uraian belanja',
  `bukti_transaksi` varchar(50) DEFAULT NULL,
  `jenis_barang` varchar(50) DEFAULT NULL,
  `status_spj` int(11) DEFAULT NULL COMMENT 'diterima/tidak',
  `penerima_uang` varchar(50) DEFAULT NULL,
  `keterangan_penerima` varchar(50) DEFAULT NULL COMMENT 'contoh jabatan dll',
  `bank` varchar(50) DEFAULT NULL,
  `npwp` varchar(50) DEFAULT NULL,
  `instansi_penerima` varchar(50) DEFAULT NULL COMMENT 'nama perusahaan',
  `jabatan_penerima` varchar(50) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `id_rekening_dasar` bigint(20) DEFAULT NULL COMMENT 'tidak terisi jika id_order terisi',
  `id_rekening_belanja` bigint(20) DEFAULT NULL COMMENT 'tidak terisi jika id_order sudah terisi',
  `tanggal_pesanan` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tb kuwitansi relasi dengna tb_order jika terjadi order, tb_kuwitansi relasi dengna tb_rekening_dasar dan tb_rekening belanja jika order dilakukan diluar sistem, karena kuwitansi bisa saja dilakukan jika tanpa order dari sistem';

-- Data exporting was unselected.

-- Dumping structure for table db_sispj.tb_order
CREATE TABLE IF NOT EXISTS `tb_order` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `no_pesanan` varchar(50) DEFAULT NULL,
  `tgl_pesanan` date DEFAULT NULL,
  `id_rekening_dasar` bigint(20) DEFAULT NULL,
  `id_rekening_belanja` bigint(20) DEFAULT NULL,
  `id_rekanan` bigint(20) DEFAULT NULL,
  `jenis_barang` varchar(50) DEFAULT NULL,
  `jumlah_barang` int(11) DEFAULT NULL,
  `jenis_satuan_barang` varchar(50) DEFAULT NULL,
  `uraian_pesanan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rekening_dasar` (`id_rekening_dasar`),
  KEY `rekening_belanja` (`id_rekening_belanja`),
  KEY `rekanan` (`id_rekanan`),
  CONSTRAINT `rekanan` FOREIGN KEY (`id_rekanan`) REFERENCES `tb_rekanan` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `rekening_belanja` FOREIGN KEY (`id_rekening_belanja`) REFERENCES `tb_rekening_belanja` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `rekening_dasar` FOREIGN KEY (`id_rekening_dasar`) REFERENCES `tb_rekening_dasar` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='hasil relasi tabel rekening dasar dan rekening belanja';

-- Data exporting was unselected.

-- Dumping structure for table db_sispj.tb_pptk
CREATE TABLE IF NOT EXISTS `tb_pptk` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nip_pptk` varchar(255) DEFAULT NULL,
  `nama_pptk` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_sispj.tb_rekanan
CREATE TABLE IF NOT EXISTS `tb_rekanan` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `instansi_rekanan` varchar(50) DEFAULT NULL,
  `alamat_rekanan` varchar(50) DEFAULT NULL,
  `no_telp_rekanan` varchar(50) DEFAULT NULL,
  `nama_rekanan` varchar(50) DEFAULT NULL,
  `bank_rekanan` varchar(50) DEFAULT NULL,
  `no_rekening_rekanan` varchar(50) DEFAULT NULL,
  `npwp` varchar(50) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_sispj.tb_rekening
CREATE TABLE IF NOT EXISTS `tb_rekening` (
  `id` bigint(20) DEFAULT NULL,
  `nama_rekening` bigint(20) DEFAULT NULL,
  `id_rekening_dasar` bigint(20) DEFAULT NULL,
  `id_rekening_belanja` bigint(20) DEFAULT NULL,
  `tahun_anggaran` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='menggabungkan rekening dasar dan rekening';

-- Data exporting was unselected.

-- Dumping structure for table db_sispj.tb_rekening_belanja
CREATE TABLE IF NOT EXISTS `tb_rekening_belanja` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nama_rekening_belanja` varchar(50) DEFAULT NULL,
  `id_kode_belanja_sub1` bigint(20) DEFAULT NULL,
  `id_kode_belanja_sub2` bigint(20) DEFAULT NULL,
  `id_kode_belanja_sub3` bigint(20) DEFAULT NULL,
  `id_kode_belanja_sub4` bigint(20) DEFAULT NULL,
  `id_kode_belanja_sub5` bigint(20) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kode_belanja_sub1` (`id_kode_belanja_sub1`),
  KEY `kode_belanja_sub2` (`id_kode_belanja_sub2`),
  KEY `kode_belanja_sub3` (`id_kode_belanja_sub3`),
  KEY `kode_belanja_sub4` (`id_kode_belanja_sub4`),
  KEY `kode_belanja_sub5` (`id_kode_belanja_sub5`),
  CONSTRAINT `kode_belanja_sub1` FOREIGN KEY (`id_kode_belanja_sub1`) REFERENCES `tb_kode_belanja_sub1` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `kode_belanja_sub2` FOREIGN KEY (`id_kode_belanja_sub2`) REFERENCES `tb_kode_belanja_sub2` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `kode_belanja_sub3` FOREIGN KEY (`id_kode_belanja_sub3`) REFERENCES `tb_kode_belanja_sub3` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `kode_belanja_sub4` FOREIGN KEY (`id_kode_belanja_sub4`) REFERENCES `tb_kode_belanja_sub4` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `kode_belanja_sub5` FOREIGN KEY (`id_kode_belanja_sub5`) REFERENCES `tb_kode_belanja_sub5` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabel hasil relasi kode belanja (untuk sementara tidak terpakai)';

-- Data exporting was unselected.

-- Dumping structure for table db_sispj.tb_rekening_dasar
CREATE TABLE IF NOT EXISTS `tb_rekening_dasar` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nama_rekening_dasar` varchar(255) DEFAULT NULL,
  `id_kode_dinas` bigint(20) DEFAULT NULL,
  `id_kode_urusan` bigint(20) DEFAULT NULL,
  `id_kode_bidang` bigint(20) DEFAULT NULL,
  `id_kode_program` bigint(20) DEFAULT NULL,
  `id_kode_kegiatan` bigint(20) DEFAULT NULL,
  `id_kode_unit` bigint(20) DEFAULT NULL,
  `keterangan_rekening_dasar` varchar(255) DEFAULT NULL,
  `tahun_anggaran` year(4) DEFAULT NULL,
  `jumlah_anggaran_rekening_dasar` bigint(20) DEFAULT NULL COMMENT 'jumlah anggaran yang didapat',
  `id_kpa_ppk` bigint(20) DEFAULT NULL,
  `id_pptk` bigint(20) DEFAULT NULL,
  `id_bendahara` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tahun_anggaran` (`tahun_anggaran`) USING BTREE,
  KEY `kode_bidang` (`id_kode_bidang`),
  KEY `kode_program` (`id_kode_program`),
  KEY `kode_kegiatan` (`id_kode_kegiatan`),
  KEY `kdoe_unit` (`id_kode_unit`),
  KEY `kode_dinas` (`id_kode_dinas`),
  KEY `kode_urusan` (`id_kode_urusan`),
  KEY `kpa_ppk` (`id_kpa_ppk`),
  KEY `pptk` (`id_pptk`),
  KEY `bendahara` (`id_bendahara`),
  CONSTRAINT `bendahara` FOREIGN KEY (`id_bendahara`) REFERENCES `tb_bendahara` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `kdoe_unit` FOREIGN KEY (`id_kode_unit`) REFERENCES `tb_kode_unit` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `kode_bidang` FOREIGN KEY (`id_kode_bidang`) REFERENCES `tb_kode_bidang` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `kode_dinas` FOREIGN KEY (`id_kode_dinas`) REFERENCES `tb_kode_dinas` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `kode_kegiatan` FOREIGN KEY (`id_kode_kegiatan`) REFERENCES `tb_kode_kegiatan` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `kode_program` FOREIGN KEY (`id_kode_program`) REFERENCES `tb_kode_program` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `kode_urusan` FOREIGN KEY (`id_kode_urusan`) REFERENCES `tb_kode_urusan` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `kpa_ppk` FOREIGN KEY (`id_kpa_ppk`) REFERENCES `tb_kpa_ppk` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `pptk` FOREIGN KEY (`id_pptk`) REFERENCES `tb_pptk` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='tabel hasil relasi dari tabel kode_dinas, kode_urusan, kode_bidang, kode_program, kode_kegiatan, kode_unit ';

-- Data exporting was unselected.

-- Dumping structure for table db_sispj.tb_user
CREATE TABLE IF NOT EXISTS `tb_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

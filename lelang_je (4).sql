-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Mar 2023 pada 05.43
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lelang_je`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga_awal` double(15,2) NOT NULL,
  `status` enum('New','Process','Sold') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `detail_barang`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `detail_barang` (
`id_barang` int(11)
,`nama_barang` varchar(100)
,`deskripsi` text
,`harga_awal` double(15,2)
,`gambar` varchar(100)
,`status` enum('New','Process','Sold')
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `detail_lelang`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `detail_lelang` (
`id_lelang` int(11)
,`id_barang` int(11)
,`tgl_mulai` date
,`tgl_akhir` date
,`nama_barang` varchar(100)
,`gambar` varchar(100)
,`deskripsi` text
,`harga_awal` double(15,2)
,`harga_akhir` double(15,2)
,`status` enum('open','closed','cancel','confirmed')
,`confirm_date` datetime
,`created_by` int(11)
,`penanggungjawab` varchar(100)
,`created_date` datetime
,`id_masyarakat` int(11)
,`pemenang` varchar(100)
,`email` varchar(100)
,`nik` char(16)
,`jk` enum('Perempuan','Laki-laki')
,`no_hp` varchar(15)
,`alamat` varchar(250)
,`allow_edit` varchar(1)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `detail_penawaran`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `detail_penawaran` (
`id_penawaran` int(11)
,`id_masyarakat` int(11)
,`nama_penawar` varchar(100)
,`email_penawar` varchar(100)
,`no_hp` varchar(15)
,`status_penawar` tinyint(1)
,`id_lelang` int(11)
,`status_lelang` enum('open','closed','cancel','confirmed')
,`tgl_penawaran` datetime
,`id_barang` int(11)
,`nama_barang` varchar(100)
,`deskripsi` text
,`gambar` varchar(100)
,`harga_awal` double(15,2)
,`harga_penawaran` double(15,2)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gambar`
--

CREATE TABLE `gambar` (
  `id_gambar` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `utama` tinyint(1) DEFAULT NULL,
  `nama_gambar` varchar(100) NOT NULL,
  `urutan` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Trigger `gambar`
--
DELIMITER $$
CREATE TRIGGER `update urutan` BEFORE INSERT ON `gambar` FOR EACH ROW set new.urutan = (select ifnull((max(g.urutan) + 1),0) from gambar g WHERE g.id_barang = new.id_barang)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `get_max_penawaran`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `get_max_penawaran` (
`id_lelang` int(11)
,`id_masyarakat` int(11)
,`harga_penawaran` double(15,2)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `lelang`
--

CREATE TABLE `lelang` (
  `id_lelang` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `harga_awal` double(15,2) NOT NULL,
  `status` enum('open','closed','cancel','confirmed') DEFAULT 'open',
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `id_masyarakat` int(11) DEFAULT NULL,
  `harga_akhir` double(15,2) DEFAULT NULL,
  `confirm_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Trigger `lelang`
--
DELIMITER $$
CREATE TRIGGER `insert harga awal` BEFORE INSERT ON `lelang` FOR EACH ROW set new.harga_awal = (select harga_awal from barang where id_barang = new.id_barang)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update barang` AFTER INSERT ON `lelang` FOR EACH ROW update barang
set status = 'Process'
WHERE id_barang = NEW.id_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `lelang_berlangsung`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `lelang_berlangsung` (
`id_lelang` int(11)
,`id_barang` int(11)
,`nama_barang` varchar(100)
,`gambar` varchar(100)
,`deskripsi` text
,`tgl_mulai` date
,`tgl_akhir` date
,`harga_awal` double(15,2)
,`total_penawaran` bigint(21)
,`harga_tertinggi` double(15,2)
,`Keterangan` varchar(20)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `masyarakat`
--

CREATE TABLE `masyarakat` (
  `id_masyarakat` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` char(16) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nik` char(16) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jk` enum('Perempuan','Laki-laki') DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `alamat` varchar(250) DEFAULT NULL,
  `tgl_join` datetime DEFAULT current_timestamp(),
  `status` tinyint(1) DEFAULT 1,
  `update_by` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `masyarakat`
--

INSERT INTO `masyarakat` (`id_masyarakat`, `email`, `username`, `password`, `nik`, `nama`, `jk`, `no_hp`, `alamat`, `tgl_join`, `status`, `update_by`, `update_date`) VALUES
(18, 'farhan@gmail.com', '', '$2y$10$gOYeEpLDuRpzTHybp9oMrev.NS4ZDVFFq9amYOHW.BhI.w3yYy/yu', '3214546372', 'farhannnnn', 'Laki-laki', '087653336', 'ciampea', '2023-03-07 17:30:25', 1, NULL, '2023-03-07 17:30:25');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `pemenang_lelang`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `pemenang_lelang` (
`id_lelang` int(11)
,`tgl_mulai` date
,`tgl_akhir` date
,`id_masyarakat` int(11)
,`pemenang` varchar(100)
,`nik` char(16)
,`jk` enum('Perempuan','Laki-laki')
,`email` varchar(100)
,`no_hp` varchar(15)
,`alamat` varchar(250)
,`id_barang` int(11)
,`nama_barang` varchar(100)
,`deskripsi` text
,`harga_awal` double(15,2)
,`harga_akhir` double(15,2)
,`status` varchar(11)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penawaran`
--

CREATE TABLE `penawaran` (
  `id_penawaran` int(11) NOT NULL,
  `id_masyarakat` int(11) NOT NULL,
  `id_lelang` int(11) NOT NULL,
  `tgl_penawaran` datetime DEFAULT current_timestamp(),
  `harga_penawaran` double(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_kontak` varchar(20) NOT NULL,
  `level` enum('Admin','Petugas','Masyarakat') DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `nip`, `nama`, `email`, `no_kontak`, `level`, `status`) VALUES
(34, 'Jasmin', '$2y$10$8Z5a1yjZQbE6/qC3eIJYGOMENApdqnsI6mV.gDsVdqTdYLnjGxwt2', '0897865', 'Jasmin', 'jasmin.halmar@gmail.com', '2345432', 'Petugas', 1),
(46, 'Abyi', '$2y$10$PIvUiPppSnf.pRrG4SJuyuBy.gxQXsgNc1Y4qGNhUwGVggPCFZYOa', '985467886', 'Abyi', 'abyi@gmail.com', '087543567875', 'Admin', 1);

-- --------------------------------------------------------

--
-- Struktur untuk view `detail_barang`
--
DROP TABLE IF EXISTS `detail_barang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detail_barang`  AS  select `b`.`id_barang` AS `id_barang`,`b`.`nama_barang` AS `nama_barang`,`b`.`deskripsi` AS `deskripsi`,`b`.`harga_awal` AS `harga_awal`,`g`.`gambar` AS `gambar`,`b`.`status` AS `status` from (`barang` `b` left join `gambar` `g` on(`b`.`id_barang` = `g`.`id_barang` and `g`.`utama` = 1)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `detail_lelang`
--
DROP TABLE IF EXISTS `detail_lelang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detail_lelang`  AS  select `a`.`id_lelang` AS `id_lelang`,`a`.`id_barang` AS `id_barang`,`a`.`tgl_mulai` AS `tgl_mulai`,`a`.`tgl_akhir` AS `tgl_akhir`,`b`.`nama_barang` AS `nama_barang`,`g`.`gambar` AS `gambar`,`b`.`deskripsi` AS `deskripsi`,`a`.`harga_awal` AS `harga_awal`,`a`.`harga_akhir` AS `harga_akhir`,`a`.`status` AS `status`,`a`.`confirm_date` AS `confirm_date`,`a`.`created_by` AS `created_by`,`c`.`nama` AS `penanggungjawab`,`a`.`created_date` AS `created_date`,`a`.`id_masyarakat` AS `id_masyarakat`,`d`.`nama` AS `pemenang`,`d`.`email` AS `email`,`d`.`nik` AS `nik`,`d`.`jk` AS `jk`,`d`.`no_hp` AS `no_hp`,`d`.`alamat` AS `alamat`,case when curdate() between `a`.`tgl_mulai` and `a`.`tgl_akhir` then '0' else '1' end AS `allow_edit` from ((((`lelang` `a` join `barang` `b` on(`a`.`id_barang` = `b`.`id_barang`)) left join `gambar` `g` on(`g`.`id_barang` = `b`.`id_barang` and `g`.`utama` = 1)) join `users` `c` on(`a`.`created_by` = `c`.`id_user`)) left join `masyarakat` `d` on(`a`.`id_masyarakat` = `d`.`id_masyarakat`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `detail_penawaran`
--
DROP TABLE IF EXISTS `detail_penawaran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detail_penawaran`  AS  select `a`.`id_penawaran` AS `id_penawaran`,`a`.`id_masyarakat` AS `id_masyarakat`,`m`.`nama` AS `nama_penawar`,`m`.`email` AS `email_penawar`,`m`.`no_hp` AS `no_hp`,`m`.`status` AS `status_penawar`,`a`.`id_lelang` AS `id_lelang`,`b`.`status` AS `status_lelang`,`a`.`tgl_penawaran` AS `tgl_penawaran`,`b`.`id_barang` AS `id_barang`,`c`.`nama_barang` AS `nama_barang`,`c`.`deskripsi` AS `deskripsi`,`d`.`gambar` AS `gambar`,`b`.`harga_awal` AS `harga_awal`,`a`.`harga_penawaran` AS `harga_penawaran` from ((((`penawaran` `a` join `lelang` `b` on(`a`.`id_lelang` = `b`.`id_lelang`)) join `barang` `c` on(`b`.`id_barang` = `c`.`id_barang`)) left join `gambar` `d` on(`c`.`id_barang` = `d`.`id_barang` and `d`.`utama` = 1)) join `masyarakat` `m` on(`a`.`id_masyarakat` = `m`.`id_masyarakat`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `get_max_penawaran`
--
DROP TABLE IF EXISTS `get_max_penawaran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `get_max_penawaran`  AS  select `p`.`id_lelang` AS `id_lelang`,`p`.`id_masyarakat` AS `id_masyarakat`,max(`p`.`harga_penawaran`) AS `harga_penawaran` from `penawaran` `p` group by `p`.`id_lelang`,`p`.`id_masyarakat` order by max(`p`.`harga_penawaran`) desc ;

-- --------------------------------------------------------

--
-- Struktur untuk view `lelang_berlangsung`
--
DROP TABLE IF EXISTS `lelang_berlangsung`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lelang_berlangsung`  AS  select `a`.`id_lelang` AS `id_lelang`,`a`.`id_barang` AS `id_barang`,`c`.`nama_barang` AS `nama_barang`,`d`.`gambar` AS `gambar`,`c`.`deskripsi` AS `deskripsi`,`a`.`tgl_mulai` AS `tgl_mulai`,`a`.`tgl_akhir` AS `tgl_akhir`,`a`.`harga_awal` AS `harga_awal`,ifnull(`b`.`total_penawaran`,0) AS `total_penawaran`,ifnull(`b`.`harga_tertinggi`,0) AS `harga_tertinggi`,case when to_days(`a`.`tgl_akhir`) - to_days(curdate()) = 0 then 'Hari Terakhir!' else concat(to_days(`a`.`tgl_akhir`) - to_days(curdate()),' hari tersisa') end AS `Keterangan` from (((`lelang` `a` left join (select `p`.`id_lelang` AS `id_lelang`,max(`p`.`harga_penawaran`) AS `harga_tertinggi`,count(`p`.`id_penawaran`) AS `total_penawaran` from `penawaran` `p` group by `p`.`id_lelang`) `b` on(`a`.`id_lelang` = `b`.`id_lelang`)) join `barang` `c` on(`a`.`id_barang` = `c`.`id_barang`)) left join `gambar` `d` on(`c`.`id_barang` = `d`.`id_barang` and `d`.`utama` = 1)) where `a`.`status` = 'open' and curdate() between `a`.`tgl_mulai` and `a`.`tgl_akhir` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `pemenang_lelang`
--
DROP TABLE IF EXISTS `pemenang_lelang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pemenang_lelang`  AS  select `a`.`id_lelang` AS `id_lelang`,`a`.`tgl_mulai` AS `tgl_mulai`,`a`.`tgl_akhir` AS `tgl_akhir`,`a`.`id_masyarakat` AS `id_masyarakat`,`b`.`nama` AS `pemenang`,`b`.`nik` AS `nik`,`b`.`jk` AS `jk`,`b`.`email` AS `email`,`b`.`no_hp` AS `no_hp`,`b`.`alamat` AS `alamat`,`a`.`id_barang` AS `id_barang`,`c`.`nama_barang` AS `nama_barang`,`c`.`deskripsi` AS `deskripsi`,`a`.`harga_awal` AS `harga_awal`,`a`.`harga_akhir` AS `harga_akhir`,case when `a`.`status` <> 'confirmed' then 'Unconfirmed' else 'Confirmed' end AS `status` from ((`lelang` `a` join `masyarakat` `b` on(`a`.`id_masyarakat` = `b`.`id_masyarakat`)) join `barang` `c` on(`a`.`id_barang` = `c`.`id_barang`)) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `gambar`
--
ALTER TABLE `gambar`
  ADD PRIMARY KEY (`id_gambar`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `lelang`
--
ALTER TABLE `lelang`
  ADD PRIMARY KEY (`id_lelang`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `id_masyarakat` (`id_masyarakat`);

--
-- Indeks untuk tabel `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD PRIMARY KEY (`id_masyarakat`),
  ADD KEY `update_by` (`update_by`);

--
-- Indeks untuk tabel `penawaran`
--
ALTER TABLE `penawaran`
  ADD PRIMARY KEY (`id_penawaran`),
  ADD KEY `id_masyarakat` (`id_masyarakat`),
  ADD KEY `id_lelang` (`id_lelang`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `gambar`
--
ALTER TABLE `gambar`
  MODIFY `id_gambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT untuk tabel `lelang`
--
ALTER TABLE `lelang`
  MODIFY `id_lelang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT untuk tabel `masyarakat`
--
ALTER TABLE `masyarakat`
  MODIFY `id_masyarakat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `penawaran`
--
ALTER TABLE `penawaran`
  MODIFY `id_penawaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `gambar`
--
ALTER TABLE `gambar`
  ADD CONSTRAINT `gambar_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Ketidakleluasaan untuk tabel `lelang`
--
ALTER TABLE `lelang`
  ADD CONSTRAINT `lelang_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `lelang_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `lelang_ibfk_3` FOREIGN KEY (`id_masyarakat`) REFERENCES `masyarakat` (`id_masyarakat`);

--
-- Ketidakleluasaan untuk tabel `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD CONSTRAINT `masyarakat_ibfk_1` FOREIGN KEY (`update_by`) REFERENCES `users` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `penawaran`
--
ALTER TABLE `penawaran`
  ADD CONSTRAINT `penawaran_ibfk_1` FOREIGN KEY (`id_masyarakat`) REFERENCES `masyarakat` (`id_masyarakat`),
  ADD CONSTRAINT `penawaran_ibfk_2` FOREIGN KEY (`id_lelang`) REFERENCES `lelang` (`id_lelang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

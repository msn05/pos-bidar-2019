-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Agu 2020 pada 20.49
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tarif_pos_palembang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jasa`
--

CREATE TABLE `jasa` (
  `id` int(11) NOT NULL,
  `kode_jasa` varchar(15) NOT NULL,
  `nama_jasa` varchar(40) NOT NULL,
  `tanggal_dibuat` date NOT NULL,
  `id_users` int(11) NOT NULL,
  `aktif` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jasa`
--

INSERT INTO `jasa` (`id`, `kode_jasa`, `nama_jasa`, `tanggal_dibuat`, `id_users`, `aktif`) VALUES
(17, 'a001', 'kilat', '2020-08-04', 1, 1),
(18, 'a002', 'khusus', '2020-08-21', 1, 1),
(19, 'a003', 'reguler', '2020-08-14', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ketentuan_jasa`
--

CREATE TABLE `ketentuan_jasa` (
  `id` int(11) NOT NULL,
  `kode_jasa` int(16) NOT NULL,
  `nama_ketentuan` varchar(40) NOT NULL,
  `id_tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ketentuan_jasa`
--

INSERT INTO `ketentuan_jasa` (`id`, `kode_jasa`, `nama_ketentuan`, `id_tarif`) VALUES
(5293, 18, 'barang', 3519),
(37369, 17, 'dokumen', 8562),
(37602, 18, 'dokumen', 26185),
(42433, 18, 'dokumen', 96431),
(90162, 17, 'dokumen', 42671),
(96869, 18, 'barang', 62189);

-- --------------------------------------------------------

--
-- Struktur dari tabel `keterangan_login`
--

CREATE TABLE `keterangan_login` (
  `id` int(11) NOT NULL,
  `nama_pengguna` varchar(30) NOT NULL,
  `level_pengguna` int(1) NOT NULL,
  `foto_pengguna` text NOT NULL,
  `no_telphone` varchar(16) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `keterangan_login`
--

INSERT INTO `keterangan_login` (`id`, `nama_pengguna`, `level_pengguna`, `foto_pengguna`, `no_telphone`, `tanggal_lahir`, `tempat_lahir`) VALUES
(1, 'rendra', 1, 'f.jpg', '12121', '2020-08-03', 'Lahat'),
(2475, 'nama', 2, 'sadsadas.jpg', '34535', '2020-08-06', 'Palembang'),
(8787, 'nenti', 4, 'nenti.png', '088724227632', '2020-08-18', 'Bandung'),
(9738, 'yolanda', 3, 'yolanda.png', '089819281928', '2020-08-13', 'Jakarta');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keterangan_tarif`
--

CREATE TABLE `keterangan_tarif` (
  `id_keterangan_tarif` int(11) NOT NULL,
  `id_tarif_keterangan` int(11) NOT NULL,
  `jarak` varchar(50) NOT NULL,
  `berat` int(11) NOT NULL,
  `total_tarif_nilai` int(11) NOT NULL,
  `kecepatan_kirim` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `keterangan_tarif`
--

INSERT INTO `keterangan_tarif` (`id_keterangan_tarif`, `id_tarif_keterangan`, `jarak`, `berat`, `total_tarif_nilai`, `kecepatan_kirim`) VALUES
(39, 42671, '1', 1, 11400, 2),
(40, 8562, '4', 1, 12200, 3),
(41, 62189, '1', 1, 11350, 2),
(42, 3519, '3', 3, 12888, 3),
(43, 96431, '1', 1, 9700, 2),
(44, 26185, '3', 3, 13300, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`id_level`, `nama_level`) VALUES
(1, 'Admin'),
(2, 'Kasir'),
(3, 'Keuangan'),
(4, 'Pimpinan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `kode_pemesanan` varchar(50) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `pembayaran_status` float NOT NULL,
  `id_penerima_pembayaran` int(11) NOT NULL,
  `tanggal_bayar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `kode_pemesanan`, `jumlah_bayar`, `pembayaran_status`, `id_penerima_pembayaran`, `tanggal_bayar`) VALUES
(7, 'POS-PJ-001', 11350, 1, 1, '2020-08-20 11:03:53'),
(8, 'POS-PJ-003', 11400, 1, 1, '2020-08-20 13:17:38'),
(9, 'POS-PJ-002', 9700, 1, 1, '2020-08-20 13:18:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL,
  `kode_pemesanan` varchar(20) NOT NULL,
  `id_pengirim` int(11) NOT NULL,
  `id_penerima` int(11) NOT NULL,
  `id_jasa` int(11) NOT NULL,
  `nama_barang_pelanggan` varchar(50) NOT NULL,
  `berat` float NOT NULL,
  `jarak` float NOT NULL,
  `biaya_tarif` int(11) NOT NULL,
  `tanggal_pemesanan` datetime(1) NOT NULL,
  `id_users_data` int(11) NOT NULL,
  `pengiriman_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `kode_pemesanan`, `id_pengirim`, `id_penerima`, `id_jasa`, `nama_barang_pelanggan`, `berat`, `jarak`, `biaya_tarif`, `tanggal_pemesanan`, `id_users_data`, `pengiriman_status`) VALUES
(40, 'POS-PJ-001', 6264954, 5241089, 42433, 'berkas wisuda', 0.4, 0.5, 11350, '2020-08-15 18:57:01.0', 1, 3),
(41, 'POS-PJ-002', 6017151, 105591, 42433, 'berkas wisuda yolanda', 0.9, 1, 9700, '2020-08-15 19:03:30.0', 1, 2),
(42, 'POS-PJ-003', 1637879, 7452393, 90162, 'dsffswdw', 1, 1, 11400, '2020-08-17 16:43:35.0', 1, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerima`
--

CREATE TABLE `penerima` (
  `id_penerima` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penerima`
--

INSERT INTO `penerima` (`id_penerima`, `nama`, `alamat`, `no_telp`) VALUES
(105591, 'nenti', 'jalan pagaralam', '0890375739853'),
(5241089, 'yolanda', 'jalan palembang', '0499349393'),
(7452393, 'fgdgfd', 'wrwfwefewfw', '463453');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengirim`
--

CREATE TABLE `pengirim` (
  `id_pengirim` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telphone` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengirim`
--

INSERT INTO `pengirim` (`id_pengirim`, `nama`, `alamat`, `no_telphone`) VALUES
(1637879, 'asdsad', 'asdadad', '2323232'),
(6017151, 'yola', 'jalan palembang', '890397439'),
(6264954, 'nenti', 'jalan pagarlam', '03930203939');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id_pengiriman_barang` int(11) NOT NULL,
  `id_pembayaran` int(50) NOT NULL,
  `tanggal_pengiriman` datetime DEFAULT NULL,
  `lock_pengiriman` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengiriman`
--

INSERT INTO `pengiriman` (`id_pengiriman_barang`, `id_pembayaran`, `tanggal_pengiriman`, `lock_pengiriman`) VALUES
(1, 7, '2020-08-20 13:16:58', 3),
(2, 8, '2020-08-20 13:23:20', 3),
(3, 9, '2020-08-20 13:27:55', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `perhitungan_tarif_jasa`
--

CREATE TABLE `perhitungan_tarif_jasa` (
  `id_perhitungan_tarif` int(11) NOT NULL,
  `perihal` text NOT NULL,
  `hal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `perhitungan_tarif_jasa`
--

INSERT INTO `perhitungan_tarif_jasa` (`id_perhitungan_tarif`, `perihal`, `hal`) VALUES
(1, 'harga normal', 'harga jual'),
(2, 'tax pajak', '+ harga pajak ( nilai pajak * harga jual / 100)'),
(3, 'administrasi', 'biaya admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tarif`
--

CREATE TABLE `tarif` (
  `id_perhitungan_tarif_jasa` int(11) NOT NULL,
  `nilai` int(20) NOT NULL,
  `id` int(11) NOT NULL,
  `id_ketentuan_jasa` int(11) NOT NULL,
  `group_keterangan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tarif`
--

INSERT INTO `tarif` (`id_perhitungan_tarif_jasa`, `nilai`, `id`, `id_ketentuan_jasa`, `group_keterangan`) VALUES
(1, 9000, 112, 90162, 42671),
(2, 1500, 113, 90162, 42671),
(3, 10, 114, 90162, 42671),
(1, 10000, 115, 37369, 8562),
(2, 1000, 116, 37369, 8562),
(3, 12, 117, 37369, 8562),
(1, 9500, 118, 96869, 62189),
(2, 900, 119, 96869, 62189),
(3, 10, 120, 96869, 62189),
(1, 9900, 121, 5293, 3519),
(2, 1800, 122, 5293, 3519),
(3, 12, 123, 5293, 3519),
(1, 8000, 124, 42433, 96431),
(2, 900, 125, 42433, 96431),
(3, 10, 126, 42433, 96431),
(1, 10000, 127, 37602, 26185),
(2, 1800, 128, 37602, 26185),
(3, 15, 129, 37602, 26185);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `kode_login` text NOT NULL,
  `password` text NOT NULL,
  `id_keterangan_data` int(11) NOT NULL,
  `aktif` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `kode_login`, `password`, `id_keterangan_data`, `aktif`) VALUES
(2, 'POS-1234', '$2y$10$scKPWPXFa8uI/8F16aj7k.RNE/ztk4UfI96tck9VdFnTvi8UUgg6q', 1, 1),
(277, 'POS-123', '$2y$10$T1wvo/KxRy80Yc/cxI1Xqul5Q6Vilo0wehYcIHJ3qSdS7JufRM3ai', 2475, 1),
(279, 'POS-222', '$2y$10$nQu0iVf0rfh5uDOzJoIAKeOU.V8Tz1uM4KYd4J/.HSndrhrgbqQrO', 9738, 1),
(280, 'POS-321', '$2y$10$1vVXoft7OWPeRG6iqFhea.ZM3KnheM10D.M90cqYmdODCRgmof4Ba', 8787, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jasa`
--
ALTER TABLE `jasa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `kode_jasa_2` (`kode_jasa`);

--
-- Indeks untuk tabel `ketentuan_jasa`
--
ALTER TABLE `ketentuan_jasa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_tarif` (`id_tarif`),
  ADD KEY `kode_jasa` (`kode_jasa`);

--
-- Indeks untuk tabel `keterangan_login`
--
ALTER TABLE `keterangan_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `level_pengguna` (`level_pengguna`);

--
-- Indeks untuk tabel `keterangan_tarif`
--
ALTER TABLE `keterangan_tarif`
  ADD PRIMARY KEY (`id_keterangan_tarif`),
  ADD KEY `id_tarif_keterangan` (`id_tarif_keterangan`);

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `kode_pemesanan` (`kode_pemesanan`),
  ADD KEY `id_penerima_pembayaran` (`id_penerima_pembayaran`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_pemesanan` (`kode_pemesanan`),
  ADD KEY `id_pengirim` (`id_pengirim`),
  ADD KEY `id_penerima` (`id_penerima`),
  ADD KEY `id_jasa` (`id_jasa`),
  ADD KEY `id_users_data` (`id_users_data`);

--
-- Indeks untuk tabel `penerima`
--
ALTER TABLE `penerima`
  ADD PRIMARY KEY (`id_penerima`),
  ADD UNIQUE KEY `no_telp` (`no_telp`);

--
-- Indeks untuk tabel `pengirim`
--
ALTER TABLE `pengirim`
  ADD PRIMARY KEY (`id_pengirim`),
  ADD UNIQUE KEY `no_telphone` (`no_telphone`);

--
-- Indeks untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id_pengiriman_barang`),
  ADD KEY `kode_pembayaran` (`id_pembayaran`);

--
-- Indeks untuk tabel `perhitungan_tarif_jasa`
--
ALTER TABLE `perhitungan_tarif_jasa`
  ADD PRIMARY KEY (`id_perhitungan_tarif`);

--
-- Indeks untuk tabel `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_perhitungan_tarif_jasa` (`id_perhitungan_tarif_jasa`),
  ADD KEY `group_keterangan` (`group_keterangan`),
  ADD KEY `id_ketentuan_jasa` (`id_ketentuan_jasa`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_keterangan_data` (`id_keterangan_data`),
  ADD KEY `id_keterangan_data_2` (`id_keterangan_data`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jasa`
--
ALTER TABLE `jasa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `ketentuan_jasa`
--
ALTER TABLE `ketentuan_jasa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96870;

--
-- AUTO_INCREMENT untuk tabel `keterangan_login`
--
ALTER TABLE `keterangan_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9739;

--
-- AUTO_INCREMENT untuk tabel `keterangan_tarif`
--
ALTER TABLE `keterangan_tarif`
  MODIFY `id_keterangan_tarif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `penerima`
--
ALTER TABLE `penerima`
  MODIFY `id_penerima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7452394;

--
-- AUTO_INCREMENT untuk tabel `pengirim`
--
ALTER TABLE `pengirim`
  MODIFY `id_pengirim` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6264955;

--
-- AUTO_INCREMENT untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id_pengiriman_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `perhitungan_tarif_jasa`
--
ALTER TABLE `perhitungan_tarif_jasa`
  MODIFY `id_perhitungan_tarif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tarif`
--
ALTER TABLE `tarif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jasa`
--
ALTER TABLE `jasa`
  ADD CONSTRAINT `jasa_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_keterangan_data`);

--
-- Ketidakleluasaan untuk tabel `ketentuan_jasa`
--
ALTER TABLE `ketentuan_jasa`
  ADD CONSTRAINT `ketentuan_jasa_ibfk_1` FOREIGN KEY (`kode_jasa`) REFERENCES `jasa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `keterangan_login`
--
ALTER TABLE `keterangan_login`
  ADD CONSTRAINT `keterangan_login_ibfk_1` FOREIGN KEY (`level_pengguna`) REFERENCES `level` (`id_level`);

--
-- Ketidakleluasaan untuk tabel `keterangan_tarif`
--
ALTER TABLE `keterangan_tarif`
  ADD CONSTRAINT `keterangan_tarif_ibfk_1` FOREIGN KEY (`id_tarif_keterangan`) REFERENCES `tarif` (`group_keterangan`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`kode_pemesanan`) REFERENCES `pemesanan` (`kode_pemesanan`) ON DELETE CASCADE,
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`id_penerima_pembayaran`) REFERENCES `keterangan_login` (`id`);

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_jasa`) REFERENCES `ketentuan_jasa` (`id`);

--
-- Ketidakleluasaan untuk tabel `penerima`
--
ALTER TABLE `penerima`
  ADD CONSTRAINT `penerima_ibfk_1` FOREIGN KEY (`id_penerima`) REFERENCES `pemesanan` (`id_penerima`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengirim`
--
ALTER TABLE `pengirim`
  ADD CONSTRAINT `pengirim_ibfk_1` FOREIGN KEY (`id_pengirim`) REFERENCES `pemesanan` (`id_pengirim`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD CONSTRAINT `pengiriman_ibfk_1` FOREIGN KEY (`id_pembayaran`) REFERENCES `pembayaran` (`id_pembayaran`);

--
-- Ketidakleluasaan untuk tabel `tarif`
--
ALTER TABLE `tarif`
  ADD CONSTRAINT `tarif_ibfk_1` FOREIGN KEY (`id_perhitungan_tarif_jasa`) REFERENCES `perhitungan_tarif_jasa` (`id_perhitungan_tarif`),
  ADD CONSTRAINT `tarif_ibfk_2` FOREIGN KEY (`id_ketentuan_jasa`) REFERENCES `ketentuan_jasa` (`id`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_keterangan_data`) REFERENCES `keterangan_login` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

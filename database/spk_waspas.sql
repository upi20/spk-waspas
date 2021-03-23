-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Waktu pembuatan: 23 Mar 2021 pada 09.33
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_waspas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id` int(11) NOT NULL,
  `id_kasus` int(11) NOT NULL,
  `alternatif_nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id`, `id_kasus`, `alternatif_nama`) VALUES
(1, 1, 'HP1'),
(2, 1, 'HP2'),
(3, 1, 'HP3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif_nilai`
--

CREATE TABLE `alternatif_nilai` (
  `id_kasus` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `alternatif_nilai`
--

INSERT INTO `alternatif_nilai` (`id_kasus`, `id_kriteria`, `id_alternatif`, `nilai`) VALUES
(1, 1, 1, 90.5),
(1, 1, 2, 80),
(1, 1, 3, 75),
(1, 2, 1, 88),
(1, 2, 2, 70),
(1, 2, 3, 90),
(1, 3, 1, 70),
(1, 3, 2, 80),
(1, 3, 3, 90),
(1, 4, 1, 70),
(1, 4, 2, 77),
(1, 4, 3, 80),
(1, 5, 1, 90),
(1, 5, 2, 80),
(1, 5, 3, 90);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kasus`
--

CREATE TABLE `kasus` (
  `id` int(11) NOT NULL,
  `kasus_nama` varchar(255) DEFAULT NULL,
  `dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `terakhir_diakses` timestamp NOT NULL DEFAULT current_timestamp(),
  `terakhir_diedit` timestamp NOT NULL DEFAULT current_timestamp(),
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kasus`
--

INSERT INTO `kasus` (`id`, `kasus_nama`, `dibuat`, `terakhir_diakses`, `terakhir_diedit`, `deskripsi`) VALUES
(1, 'Hp dengan daya serap terbaik', '2021-03-21 12:30:58', '2021-03-22 12:42:56', '2021-03-22 10:23:01', ''),
(2, 'Lurah terbaik', '2021-03-21 13:19:24', '2021-03-22 12:10:34', '2021-03-21 13:19:24', ''),
(3, 'Siswa Terbaik', '2021-03-21 13:19:24', '2021-03-22 12:14:57', '2021-03-21 13:19:24', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `id_kasus` int(11) NOT NULL,
  `kriteria_nama` varchar(50) NOT NULL,
  `kriteria_bobot` double NOT NULL,
  `kriteria` enum('const','benefit') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id`, `id_kasus`, `kriteria_nama`, `kriteria_bobot`, `kriteria`) VALUES
(1, 1, 'Harga', 0.45, 'const'),
(2, 1, 'Kamera', 0.25, 'benefit'),
(3, 1, 'Memori', 0.15, 'benefit'),
(4, 1, 'Berat', 0.1, 'const'),
(5, 1, 'Keunikan', 0.05, 'benefit');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alternatif_ibfk_1` (`id_kasus`);

--
-- Indeks untuk tabel `alternatif_nilai`
--
ALTER TABLE `alternatif_nilai`
  ADD KEY `alternatif_nilai_ibfk_1` (`id_kasus`),
  ADD KEY `alternatif_nilai_ibfk_2` (`id_alternatif`),
  ADD KEY `alternatif_nilai_ibfk_3` (`id_kriteria`);

--
-- Indeks untuk tabel `kasus`
--
ALTER TABLE `kasus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kasus_nama` (`kasus_nama`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kriteria_ibfk_1` (`id_kasus`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kasus`
--
ALTER TABLE `kasus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD CONSTRAINT `alternatif_ibfk_1` FOREIGN KEY (`id_kasus`) REFERENCES `kasus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `alternatif_nilai`
--
ALTER TABLE `alternatif_nilai`
  ADD CONSTRAINT `alternatif_nilai_ibfk_1` FOREIGN KEY (`id_kasus`) REFERENCES `kasus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alternatif_nilai_ibfk_2` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alternatif_nilai_ibfk_3` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD CONSTRAINT `kriteria_ibfk_1` FOREIGN KEY (`id_kasus`) REFERENCES `kasus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

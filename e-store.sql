SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `image` text NULL,
  `deskripsi` text NOT NULL,
  `harga` decimal(20, 2) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `alamat` varchar(90) NOT NULL,
  `tgl_lahir` date NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
CREATE TABLE `detail_penjualan` (
  `id_detail_penjualan` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` decimal(20, 2) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_petugas` int(11) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `alamat` varchar(90) NOT NULL,
  `tgl_lahir` date NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
ALTER TABLE `barang`
ADD PRIMARY KEY (`id_barang`);
ALTER TABLE `customer`
ADD PRIMARY KEY (`id_customer`);
ALTER TABLE `detail_penjualan`
ADD PRIMARY KEY (`id_detail_penjualan`),
  ADD KEY `id_penjualan` (`id_penjualan`, `id_barang`),
  ADD KEY `id_barang` (`id_barang`);
ALTER TABLE `penjualan`
ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `id_customer` (`id_customer`, `id_petugas`),
  ADD KEY `id_petugas` (`id_petugas`);
ALTER TABLE `petugas`
ADD PRIMARY KEY (`id_petugas`);
ALTER TABLE `barang`
MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `customer`
MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `detail_penjualan`
MODIFY `id_detail_penjualan` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `penjualan`
MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `petugas`
MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `detail_penjualan`
ADD CONSTRAINT `detail_penjualan_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `detail_penjualan_ibfk_2` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id_penjualan`);
ALTER TABLE `penjualan`
ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`),
  ADD CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`);

INSERT INTO barang VALUES
(NULL, "Fanta", NULL, "commodi nesciunt enim quae eligendi", 12000, 10), 
(NULL, "Sprite", NULL, "commodi nesciunt enim quae eligendi", 11000, 10), 
(NULL, "Coca-cola", NULL, "commodi nesciunt enim quae eligendi", 11000, 10);

INSERT INTO customer VALUES
(NULL, "wahyudi@gmail.com", "wahyudiok", MD5("wahyudi23"), "Malang", "1953-05-27"),
(NULL, "agus@gmail.com", "agusok", MD5("agus2345"), "Singosari", "1983-08-21"),
(NULL, "roqib@gmail.com", "roqibroqib", MD5("roqib23@"), "Blitar", "1988-09-13");

INSERT INTO petugas VALUES
(NULL, "aryanto@gmail.com", "aryanto", MD5("aryanto666"), "Pakis", "1943-05-27"),
(NULL, "yuli@gmail.com", "yuliii", MD5("yulilestari"), "Singosari", "1933-08-21"),
(NULL, "aman@gmail.com", "aman", MD5("aman"), "Sawojajar", "1952-09-13");


INSERT INTO penjualan VALUES (NULL, 1, NULL);

INSERT INTO detail_penjualan VALUES (NULL, 1, 1, 2, NULL);

/*Update total harga*/
UPDATE detail_penjualan 
INNER JOIN barang ON detail_penjualan.id_barang = barang.id_barang 
SET detail_penjualan.total = detail_penjualan.jumlah*barang.harga;

COMMIT;
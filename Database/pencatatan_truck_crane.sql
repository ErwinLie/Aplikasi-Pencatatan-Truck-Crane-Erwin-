/*
 Navicat Premium Data Transfer

 Source Server         : Local
 Source Server Type    : MySQL
 Source Server Version : 100422 (10.4.22-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : pencatatan_truck_crane

 Target Server Type    : MySQL
 Target Server Version : 100422 (10.4.22-MariaDB)
 File Encoding         : 65001

 Date: 13/08/2024 13:57:36
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_activity
-- ----------------------------
DROP TABLE IF EXISTS `tb_activity`;
CREATE TABLE `tb_activity`  (
  `id_activity` int NOT NULL AUTO_INCREMENT,
  `id_user` int NULL DEFAULT NULL,
  `activity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `timestamp` datetime NULL DEFAULT NULL,
  `delete_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_activity`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_activity
-- ----------------------------

-- ----------------------------
-- Table structure for tb_kategori
-- ----------------------------
DROP TABLE IF EXISTS `tb_kategori`;
CREATE TABLE `tb_kategori`  (
  `id_kategori` int NOT NULL AUTO_INCREMENT,
  `kategori` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `delete_at` datetime NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  `delete_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_kategori`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_kategori
-- ----------------------------
INSERT INTO `tb_kategori` VALUES (1, 'BBM', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tb_kategori` VALUES (2, 'Perbaikan', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tb_kategori` VALUES (3, 'Perawatan', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tb_kategori` VALUES (7, 'Pajak', NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for tb_pencatatan_pengeluaran_tc
-- ----------------------------
DROP TABLE IF EXISTS `tb_pencatatan_pengeluaran_tc`;
CREATE TABLE `tb_pencatatan_pengeluaran_tc`  (
  `id_pengeluaran_tc` int NOT NULL AUTO_INCREMENT,
  `id_supir` int NULL DEFAULT NULL,
  `id_truck_crane` int NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_kategori` int NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `delete_at` datetime NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  `delete_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_pengeluaran_tc`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_pencatatan_pengeluaran_tc
-- ----------------------------
INSERT INTO `tb_pencatatan_pengeluaran_tc` VALUES (12, 5, 5, '2024-08-07', 'Beli BBM', '500000', 1, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tb_pencatatan_pengeluaran_tc` VALUES (13, 6, 6, '2024-08-02', 'Pasang Lampu Tambahan', '1000000', 3, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tb_pencatatan_pengeluaran_tc` VALUES (14, 5, 5, '2024-08-08', 'isi bbm', '250000', 1, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tb_pencatatan_pengeluaran_tc` VALUES (15, 5, 6, '2024-08-06', 'Beli BBM', '500000', 1, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tb_pencatatan_pengeluaran_tc` VALUES (16, 5, 7, '2024-08-05', 'Beli BBM', '500000', 1, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tb_pencatatan_pengeluaran_tc` VALUES (17, 8, 8, '2024-08-08', 'Mengisi BBM', '200000', 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for tb_pencatatan_truck_crane
-- ----------------------------
DROP TABLE IF EXISTS `tb_pencatatan_truck_crane`;
CREATE TABLE `tb_pencatatan_truck_crane`  (
  `id_pencatatan` int NOT NULL AUTO_INCREMENT,
  `id_supir` int NULL DEFAULT NULL,
  `id_truck_crane` int NULL DEFAULT NULL,
  `no_invoice` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `pelanggan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pekerjaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `lokasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `total_jam` time NULL DEFAULT NULL,
  `harga` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` enum('Term','Lunas') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `delete_at` datetime NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  `delete_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_pencatatan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_pencatatan_truck_crane
-- ----------------------------
INSERT INTO `tb_pencatatan_truck_crane` VALUES (11, 5, 5, '0001', '2024-08-07', 'Budu', 'Angkat Genset', 'PH Ke Batam Center', '01:00:00', '700000', 'Lunas', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tb_pencatatan_truck_crane` VALUES (12, 5, 6, '0002', '2024-08-01', 'gini', 'Angkat Crane 2 Ton', 'Batu Aji ke Barelang', '02:00:00', '800000', 'Term', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tb_pencatatan_truck_crane` VALUES (13, 6, 6, '0003', '2024-08-08', 'abu', 'Pavling Blok', 'batu ampar ke bengkong', '02:00:00', '800000', 'Term', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tb_pencatatan_truck_crane` VALUES (14, 5, 5, '0004', '2024-08-05', 'Gany', 'Angkat Genset 25 KVA', 'tanjung uncang ke tiban', '01:00:00', '650000', 'Lunas', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tb_pencatatan_truck_crane` VALUES (15, 5, 6, '0001', '2024-08-05', 'abi', 'Amgkat Crane 2 Ton', 'batu ampar ke bengkong', '02:00:00', '500000', 'Lunas', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tb_pencatatan_truck_crane` VALUES (16, 5, 6, '0001', '2024-08-04', 'abu', 'Amgkat Crane 2 Ton', 'batu ampar ke bengkong', '02:00:00', '500000', 'Lunas', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tb_pencatatan_truck_crane` VALUES (17, 8, 8, '0010', '2024-08-08', 'Budi', 'Angkat Genset', 'PH Ke Batam Center', '02:00:00', '700000', 'Term', NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for tb_setting
-- ----------------------------
DROP TABLE IF EXISTS `tb_setting`;
CREATE TABLE `tb_setting`  (
  `id_setting` int NOT NULL AUTO_INCREMENT,
  `nama_web` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `logo_dashboard` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `logo_tab` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `logo_login` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `delete_at` datetime NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  `delete_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_setting`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_setting
-- ----------------------------
INSERT INTO `tb_setting` VALUES (1, 'CV Diesel Service', '19239561_614.jpg', 'logo cv ds transparan_4.png', 'logo with text_12.png', NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for tb_supir
-- ----------------------------
DROP TABLE IF EXISTS `tb_supir`;
CREATE TABLE `tb_supir`  (
  `id_supir` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_hp` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `delete_at` datetime NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  `delete_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_supir`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_supir
-- ----------------------------
INSERT INTO `tb_supir` VALUES (5, 'Adi', '0812345678', 'Tiban Indah ', '7756743759', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tb_supir` VALUES (6, 'Badur', '08843573483', 'Nongsa', '934737478', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tb_supir` VALUES (7, 'Adi', '0873458357', 'Tiban Indah 30', '73453973543', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tb_supir` VALUES (8, 'Ahmad', '983895', 'nagoya', '8345784375', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tb_supir` VALUES (9, 'Kanma', '0873458357', 'oke', '945785936', NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for tb_truck_crane
-- ----------------------------
DROP TABLE IF EXISTS `tb_truck_crane`;
CREATE TABLE `tb_truck_crane`  (
  `id_truck_crane` int NOT NULL AUTO_INCREMENT,
  `merk_truck` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tipe_truck` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `plat_truck` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tahun_truck` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `merk_crane` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tipe_crane` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kapasitas_crane` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `bobot_truck_crane` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `delete_at` datetime NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  `delete_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_truck_crane`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_truck_crane
-- ----------------------------
INSERT INTO `tb_truck_crane` VALUES (5, 'Nissan Diesel', 'CWA4', 'BP 9088 EY', '1995', 'PM', '25', '22 TON', '120000 KG', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tb_truck_crane` VALUES (6, 'Mitsubishi', 'FK', 'BP 9520 ZG', '1990', 'Cormach', '20000', '10 Ton', '9500KG', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tb_truck_crane` VALUES (7, 'Nissan Diese', 'CWA4', 'BP 9520 ZG', '2000', 'PM', '25', '22 TON', '9500KG', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tb_truck_crane` VALUES (8, 'Isuzu', 'NPR', 'BP 8914 ZE', '1998', 'Hiab', '070', '5 Ton', '8 Ton', NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for tb_user
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_level` enum('1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `delete_at` datetime NULL DEFAULT NULL,
  `create_by` datetime NULL DEFAULT NULL,
  `update_by` datetime NULL DEFAULT NULL,
  `delete_by` datetime NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_user
-- ----------------------------
INSERT INTO `tb_user` VALUES (1, 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 'user@gmail.com', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tb_user` VALUES (10, 'user', 'c4ca4238a0b923820dcc509a6f75849b', 'user@gmail.com', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;

-- -------------------------------------------------------------
-- TablePlus 4.6.4(414)
--
-- https://tableplus.com/
--
-- Database: da_shop_mobile1
-- Generation Time: 2022-05-15 21:09:27.5470
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `bao_hanh`;
CREATE TABLE `bao_hanh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hoa_don_id` int(10) unsigned DEFAULT NULL,
  `san_pham_id` int(10) unsigned DEFAULT NULL,
  `thoi_gian_bao_hanh` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ly_do_bao_hanh` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hoa_don_id` (`hoa_don_id`),
  KEY `san_pham_id` (`san_pham_id`),
  CONSTRAINT `bao_hanh_ibfk_1` FOREIGN KEY (`hoa_don_id`) REFERENCES `hoa_don` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bao_hanh_ibfk_2` FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `chi_tiet_hoa_don`;
CREATE TABLE `chi_tiet_hoa_don` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hoa_don_id` int(11) unsigned DEFAULT NULL,
  `san_pham_id` int(11) unsigned DEFAULT NULL,
  `sl_mua` int(11) DEFAULT NULL,
  `don_gia` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `__a` (`hoa_don_id`),
  KEY `__b` (`san_pham_id`),
  CONSTRAINT `__a` FOREIGN KEY (`hoa_don_id`) REFERENCES `hoa_don` (`id`),
  CONSTRAINT `__b` FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

DROP TABLE IF EXISTS `hinh_anh`;
CREATE TABLE `hinh_anh` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sp_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sp_id` (`sp_id`),
  CONSTRAINT `hinh_anh_ibfk_1` FOREIGN KEY (`sp_id`) REFERENCES `san_pham` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `hoa_don`;
CREATE TABLE `hoa_don` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `khach_hang_id` int(10) unsigned NOT NULL,
  `tong_tien` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hoa_don_khach_hang_id_foreign` (`khach_hang_id`),
  KEY `hoa_don_create_by_foreign` (`create_by`),
  CONSTRAINT `hoa_don_create_by_foreign` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`),
  CONSTRAINT `hoa_don_khach_hang_id_foreign` FOREIGN KEY (`khach_hang_id`) REFERENCES `khach_hang` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `khach_hang`;
CREATE TABLE `khach_hang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ten_kh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dia_chi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dien_thoai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loai_kh` int(11) NOT NULL DEFAULT 1,
  `trang_thai` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `loai_san_pham`;
CREATE TABLE `loai_san_pham` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten_loai` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `hinh_anh` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `nhan_vien`;
CREATE TABLE `nhan_vien` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `ho_ten` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ngay_sinh` date NOT NULL,
  `dien_thoai` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dia_chi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user_id`),
  CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

DROP TABLE IF EXISTS `nhap_kho`;
CREATE TABLE `nhap_kho` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `khach_hang_id` int(10) unsigned NOT NULL,
  `san_pham_id` int(10) unsigned NOT NULL,
  `sl_nhap` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nhap_kho_khach_hang_id_foreign` (`khach_hang_id`),
  KEY `nhap_kho_san_pham_id_foreign` (`san_pham_id`),
  CONSTRAINT `nhap_kho_khach_hang_id_foreign` FOREIGN KEY (`khach_hang_id`) REFERENCES `khach_hang` (`id`),
  CONSTRAINT `nhap_kho_san_pham_id_foreign` FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `san_pham`;
CREATE TABLE `san_pham` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `loai_id` int(10) unsigned NOT NULL,
  `ten_sp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_luong` int(11) DEFAULT 0,
  `gia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `sale` int(11) NOT NULL DEFAULT 0,
  `hinh_anh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sao` int(1) NOT NULL DEFAULT 0,
  `mo_ta` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thong_so` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `trang_thai` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cate_product` (`loai_id`),
  CONSTRAINT `cate_product` FOREIGN KEY (`loai_id`) REFERENCES `loai_san_pham` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `tin_tuc`;
CREATE TABLE `tin_tuc` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `tieu_de` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mo_ta` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `noi_dung` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ngay_dang` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `tin_tuc` (`user_id`),
  CONSTRAINT `tin_tuc` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chuc_vu` int(11) NOT NULL,
  `trang_thai` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `chi_tiet_hoa_don` (`id`, `hoa_don_id`, `san_pham_id`, `sl_mua`, `don_gia`) VALUES
(1, 1, 1, 1, '1500000'),
(17, 1, 1, 1, '15000000'),
(18, 1, 1, 1, '15000000');

INSERT INTO `hoa_don` (`id`, `khach_hang_id`, `tong_tien`, `create_by`, `created_at`, `updated_at`) VALUES
(1, 1, '1500000', NULL, NULL, NULL),
(17, 11, '15000000', NULL, '2020-06-14 01:55:28', '2020-06-14 01:55:28'),
(18, 12, '15000000', NULL, '2020-06-14 02:05:24', '2020-06-14 02:05:24');

INSERT INTO `khach_hang` (`id`, `ten_kh`, `dia_chi`, `email`, `dien_thoai`, `loai_kh`, `trang_thai`, `created_at`, `updated_at`) VALUES
(1, 'Nguyễn Xuân H', 'Trung Đô - TP.Vinh', 'xuanhanh.setdy@gmail.com', '0336022352', 1, 1, NULL, '2020-04-26 04:07:34'),
(2, 'Lê Thị T', 'Hoàng Mai', 't@gmail.com', '0327932713', 1, 1, '2020-04-19 01:41:30', '2020-04-19 01:41:30'),
(3, 'Nguyễn Văn T', 'Văn Sơn - ĐL - NA', 't@gmail.com', '0336022352', 1, 1, '2020-04-19 02:01:05', '2020-04-19 02:01:05'),
(5, 'Công ty vinfat', 'Minh Khai - TP.Vinh', 'vinfat@gmail.com', '013456789', 0, 1, NULL, NULL),
(6, 'Công ty Fgc', '55 - duy tân - tp.Vinh', 'fgc@gmail.com', '0123456789', 0, 1, NULL, NULL),
(7, 'Nguyễn Văn A', 'Hoàng mai', NULL, '0123456456', 1, 1, '2020-05-05 18:56:33', '2020-05-05 18:56:33'),
(8, 'Nguyễn Văn A', 'abc', 'A@gmail.com', '123456', 1, 1, NULL, NULL),
(9, 'Lê Thị T', 'Hoàng Mai - Nghệ An', 'test@gmail.com', '0336022352', 1, 1, '2020-06-13 09:58:37', '2020-06-13 09:58:37'),
(10, 'Công ty vinfat123', 'Minh Khai - TP.Vinh', 'test@gmail.com', '0327932713', 0, 1, '2020-06-13 09:59:54', '2020-06-13 09:59:54'),
(11, 'Nguyễn Xuân Hạnh', 'Nghệ An', 'xuanhanh.setdy@gmail.com', '0336022352', 1, 1, '2020-06-14 01:52:31', '2020-06-14 01:52:31'),
(12, 'Nguyễn Xuân Hạnh', 'Nghệ An', 'test@gmail.com', '0336022352', 1, 1, '2020-06-14 02:05:24', '2020-06-14 02:05:24');

INSERT INTO `loai_san_pham` (`id`, `ten_loai`, `hinh_anh`) VALUES
(1, 'Iphone', '6IStkuXj59jxeaNv.jpg'),
(2, 'Sam Sung', '0Hj4TW17OP2kHTV7.jpg'),
(3, 'Oppo', '3cW73RlwZmN8hshH.png'),
(4, 'Xiaomi', '1FI6YkmZ32ST88rV.jpg'),
(7, 'Realme', 'uSHuudsomvxMHa64.png'),
(8, 'Vivo', 'OUNijaNlGNYsSfKP.jpg');

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_04_10_153345_create_cham_congs_table', 1),
(5, '2020_04_10_153415_create_san_phams_table', 1),
(6, '2020_04_10_153442_create_khach_hangs_table', 1),
(7, '2020_04_10_153455_create_nhap_khos_table', 1),
(8, '2020_04_10_153526_create_hoa_dons_table', 1),
(9, '2020_04_10_153536_create_cthds_table', 1);

INSERT INTO `nhan_vien` (`id`, `user_id`, `ho_ten`, `ngay_sinh`, `dien_thoai`, `dia_chi`) VALUES
(1, 1, 'abc', '2020-06-29', '32', 'abc'),
(2, 1, 'abc', '2020-06-30', '0336022352', 'ádbjhsadsad');

INSERT INTO `nhap_kho` (`id`, `khach_hang_id`, `san_pham_id`, `sl_nhap`, `created_at`, `updated_at`) VALUES
(7, 5, 9, 100, '2020-06-13 09:31:46', '2020-06-13 09:31:46');

INSERT INTO `san_pham` (`id`, `loai_id`, `ten_sp`, `so_luong`, `gia`, `sale`, `hinh_anh`, `sao`, `mo_ta`, `thong_so`, `trang_thai`, `created_at`, `updated_at`) VALUES
(1, 1, 'Iphone 11', 100, '15000000', 2, 'vLejBhDVyEDVHqek.png', 4, '<p>THÔNG TIN CHƯƠNG TRÌNH</p>\r\n\r\n<p><strong>I. Hotsale</strong><br />\r\nHotsale: 0h 1/06 - 22h 14/06</p>\r\n\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>+Oppo A52:<br />\r\n			Giá : 5.990.000đ<br />\r\n			Màu: Trắng, Đen</td>\r\n			<td>+Oppo A92:<br />\r\n			Giá : 6.990.000đ<br />\r\n			Màu: Trắng, Đen</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><strong>II.Khuyến mãi.</strong></p>\r\n\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>+Oppo A52:<br />\r\n			- Giảm 300.000đ<br />\r\n			- Trả góp 0%</td>\r\n			<td>+Oppo A92:<br />\r\n			- Giảm 500.000đ<br />\r\n			- Trả góp 0%</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>- Trả góp 0% Oppo A52 | Oppo A92<br />\r\n+ FE CREDIT: Kỳ hạn 4 tháng, trả trước &gt; 10%<br />\r\n+ HD SAISON: Kỳ hạn 4 tháng, trả trước 30%<br />\r\n+ HOME CREDIT: Kỳ hạn 4 tháng, trả trước 40%</p>\r\n\r\n<p>Bộ bán hàng chuẩn:<br />\r\nOPPO A92 + OPPO A52: Cáp USB Type C, Củ Sạc 9V-2A, Tai nghe, Dụng cụ lấy SIM, Sách hướng dẫn, Miếng dán màn hình (Đã dán sẵn), Vỏ bảo vệ (Nhựa trong dẻo)</p>\r\n\r\n<p><strong>*Lưu ý:</strong><br />\r\n- Mỗi số ĐT mua được 2 sản phẩm.<br />\r\n- Mọi thông tin thắc mắc vui lòng comment bên dưới hoặc liên hệ tổng đài 18001060 (miễn phí). Xin cảm ơn !</p>', '7\";Ios 7;Chính 12 MP & Phụ 8 MP;16 MP;Snapdragon 665 8 nhân;6 GB;128 GB;MicroSD, hỗ trợ tối đa 256 GB;2 Nano SIM Hỗ trợ 4G;5000 mAh có sạc nhanh', 1, '2020-06-12 08:18:05', '2020-06-29 07:15:03'),
(2, 1, 'Iphone 5s', 100, '15000000', 2, '64VqQRYFZcpEf5BA.jpg', 4, '<p>THÔNG TIN CHƯƠNG TRÌNH</p>\r\n\r\n<p><strong>I. Hotsale</strong><br />\r\nHotsale: 0h 1/06 - 22h 14/06</p>\r\n\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>+Oppo A52:<br />\r\n			Giá : 5.990.000đ<br />\r\n			Màu: Trắng, Đen</td>\r\n			<td>+Oppo A92:<br />\r\n			Giá : 6.990.000đ<br />\r\n			Màu: Trắng, Đen</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><strong>II.Khuyến mãi.</strong></p>\r\n\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>+Oppo A52:<br />\r\n			- Giảm 300.000đ<br />\r\n			- Trả góp 0%</td>\r\n			<td>+Oppo A92:<br />\r\n			- Giảm 500.000đ<br />\r\n			- Trả góp 0%</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>- Trả góp 0% Oppo A52 | Oppo A92<br />\r\n+ FE CREDIT: Kỳ hạn 4 tháng, trả trước &gt; 10%<br />\r\n+ HD SAISON: Kỳ hạn 4 tháng, trả trước 30%<br />\r\n+ HOME CREDIT: Kỳ hạn 4 tháng, trả trước 40%</p>\r\n\r\n<p>Bộ bán hàng chuẩn:<br />\r\nOPPO A92 + OPPO A52: Cáp USB Type C, Củ Sạc 9V-2A, Tai nghe, Dụng cụ lấy SIM, Sách hướng dẫn, Miếng dán màn hình (Đã dán sẵn), Vỏ bảo vệ (Nhựa trong dẻo)</p>\r\n\r\n<p><strong>*Lưu ý:</strong><br />\r\n- Mỗi số ĐT mua được 2 sản phẩm.<br />\r\n- Mọi thông tin thắc mắc vui lòng comment bên dưới hoặc liên hệ tổng đài 18001060 (miễn phí). Xin cảm ơn !</p>', '5\";Ios 7;Chính 12 MP & Phụ 8 MP;16 MP;Snapdragon 665 8 nhân;6 GB;128 GB;MicroSD, hỗ trợ tối đa 256 GB;2 Nano SIM Hỗ trợ 4G;5000 mAh có sạc nhanh', 1, '2020-06-12 08:18:05', '2020-06-29 06:00:58'),
(3, 1, 'Iphone 6s', 100, '15000000', 2, 'ZkNng0IIUb1O4cxi.jpg', 4, '<p>THÔNG TIN CHƯƠNG TRÌNH</p>\r\n\r\n<p><strong>I. Hotsale</strong><br />\r\nHotsale: 0h 1/06 - 22h 14/06</p>\r\n\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>+Oppo A52:<br />\r\n			Giá : 5.990.000đ<br />\r\n			Màu: Trắng, Đen</td>\r\n			<td>+Oppo A92:<br />\r\n			Giá : 6.990.000đ<br />\r\n			Màu: Trắng, Đen</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><strong>II.Khuyến mãi.</strong></p>\r\n\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>+Oppo A52:<br />\r\n			- Giảm 300.000đ<br />\r\n			- Trả góp 0%</td>\r\n			<td>+Oppo A92:<br />\r\n			- Giảm 500.000đ<br />\r\n			- Trả góp 0%</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>- Trả góp 0% Oppo A52 | Oppo A92<br />\r\n+ FE CREDIT: Kỳ hạn 4 tháng, trả trước &gt; 10%<br />\r\n+ HD SAISON: Kỳ hạn 4 tháng, trả trước 30%<br />\r\n+ HOME CREDIT: Kỳ hạn 4 tháng, trả trước 40%</p>\r\n\r\n<p>Bộ bán hàng chuẩn:<br />\r\nOPPO A92 + OPPO A52: Cáp USB Type C, Củ Sạc 9V-2A, Tai nghe, Dụng cụ lấy SIM, Sách hướng dẫn, Miếng dán màn hình (Đã dán sẵn), Vỏ bảo vệ (Nhựa trong dẻo)</p>\r\n\r\n<p><strong>*Lưu ý:</strong><br />\r\n- Mỗi số ĐT mua được 2 sản phẩm.<br />\r\n- Mọi thông tin thắc mắc vui lòng comment bên dưới hoặc liên hệ tổng đài 18001060 (miễn phí). Xin cảm ơn !</p>', '6\";Ios 7;Chính 12 MP & Phụ 8 MP;16 MP;Snapdragon 665 8 nhân;6 GB;128 GB;MicroSD, hỗ trợ tối đa 256 GB;2 Nano SIM Hỗ trợ 4G;5000 mAh có sạc nhanh', 1, '2020-06-12 08:18:05', '2020-06-29 07:13:42'),
(9, 3, 'oppo A52', 100, '15000000', 2, 'Y9QBV7jiMehtPT1d.png', 4, '<p>THÔNG TIN CHƯƠNG TRÌNH</p>\r\n\r\n<p><strong>I. Hotsale</strong><br />\r\nHotsale: 0h 1/06 - 22h 14/06</p>\r\n\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>+Oppo A52:<br />\r\n			Giá : 5.990.000đ<br />\r\n			Màu: Trắng, Đen</td>\r\n			<td>+Oppo A92:<br />\r\n			Giá : 6.990.000đ<br />\r\n			Màu: Trắng, Đen</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><strong>II.Khuyến mãi.</strong></p>\r\n\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>+Oppo A52:<br />\r\n			- Giảm 300.000đ<br />\r\n			- Trả góp 0%</td>\r\n			<td>+Oppo A92:<br />\r\n			- Giảm 500.000đ<br />\r\n			- Trả góp 0%</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>- Trả góp 0% Oppo A52 | Oppo A92<br />\r\n+ FE CREDIT: Kỳ hạn 4 tháng, trả trước &gt; 10%<br />\r\n+ HD SAISON: Kỳ hạn 4 tháng, trả trước 30%<br />\r\n+ HOME CREDIT: Kỳ hạn 4 tháng, trả trước 40%</p>\r\n\r\n<p>Bộ bán hàng chuẩn:<br />\r\nOPPO A92 + OPPO A52: Cáp USB Type C, Củ Sạc 9V-2A, Tai nghe, Dụng cụ lấy SIM, Sách hướng dẫn, Miếng dán màn hình (Đã dán sẵn), Vỏ bảo vệ (Nhựa trong dẻo)</p>\r\n\r\n<p><strong>*Lưu ý:</strong><br />\r\n- Mỗi số ĐT mua được 2 sản phẩm.<br />\r\n- Mọi thông tin thắc mắc vui lòng comment bên dưới hoặc liên hệ tổng đài 18001060 (miễn phí). Xin cảm ơn !</p>', '4\";Ios 7;Chính 12 MP & Phụ 8 MP;16 MP;Snapdragon 665 8 nhân;6 GB;128 GB;MicroSD, hỗ trợ tối đa 256 GB;2 Nano SIM Hỗ trợ 4G;5000 mAh có sạc nhanh', 1, '2020-06-12 08:18:05', '2020-06-13 20:52:03');

INSERT INTO `tin_tuc` (`id`, `user_id`, `tieu_de`, `mo_ta`, `noi_dung`, `ngay_dang`) VALUES
(2, 1, 'Tin tức mới', 'sadasdas', '<p>ádasd</p>', '2020-06-29 15:39:33');

INSERT INTO `users` (`id`, `name`, `avatar`, `email`, `email_verified_at`, `password`, `chuc_vu`, `trang_thai`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, 'admin@gmail.com', NULL, '$2y$10$YnkzikoWCCfppIbQNHhCPePg4Bkc15UNU8allD8832HqJO617R3sC', 1, 1, NULL, NULL, '2020-06-14 02:24:58');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
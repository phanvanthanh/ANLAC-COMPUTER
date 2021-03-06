-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.30-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for nhadattv
CREATE DATABASE IF NOT EXISTS `nhadattv` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `nhadattv`;

-- Dumping structure for table nhadattv.admin_resource
CREATE TABLE IF NOT EXISTS `admin_resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ten_hien_thi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resource` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameter_value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `uri` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `show_menu` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `icon` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_resource_parent_foreign` (`parent_id`),
  CONSTRAINT `admin_resource_parent_foreign` FOREIGN KEY (`parent_id`) REFERENCES `admin_resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=634 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nhadattv.admin_resource: ~34 rows (approximately)
/*!40000 ALTER TABLE `admin_resource` DISABLE KEYS */;
INSERT INTO `admin_resource` (`id`, `ten_hien_thi`, `resource`, `method`, `action`, `parameter`, `parameter_value`, `parent_id`, `created_at`, `updated_at`, `uri`, `status`, `show_menu`, `order`, `icon`) VALUES
	(1, 'Root', 'Root', 'GET', '#', '#', '#', NULL, '2021-02-01 09:49:23', '2021-02-02 08:33:17', '#', 1, 1, 0, NULL),
	(601, '????ng nh???p', 'GET | App\\Http\\Controllers\\Auth\\LoginController@showLoginForm', 'GET', 'App\\Http\\Controllers\\Auth\\LoginController@showLoginForm', '', '', 1, '2021-02-01 09:49:23', '2021-02-02 08:33:01', 'login', 1, 2, 1000, '<i class="icon-login"></i>'),
	(602, 'N??t ????ng nh???p', 'POST | App\\Http\\Controllers\\Auth\\LoginController@login', 'POST', 'App\\Http\\Controllers\\Auth\\LoginController@login', '', '', 601, '2021-02-01 09:49:23', '2021-02-02 08:33:01', 'login', 1, 2, 1000, NULL),
	(603, '????ng xu???t', 'POST | App\\Http\\Controllers\\Auth\\LoginController@logout', 'POST', 'App\\Http\\Controllers\\Auth\\LoginController@logout', '', '', 1, '2021-02-01 09:49:23', '2021-02-02 08:33:01', 'logout', 1, 2, 1000, '<i class="icon-logout"></i>'),
	(604, '????ng k??', 'GET | App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm', 'GET', 'App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm', '', '', 1, '2021-02-01 09:49:23', '2021-02-02 08:33:01', 'register', 1, 2, 1000, '<i class="icon-user-following mx-0"></i>'),
	(605, 'N??t ????ng k??', 'POST | App\\Http\\Controllers\\Auth\\RegisterController@register', 'POST', 'App\\Http\\Controllers\\Auth\\RegisterController@register', '', '', 604, '2021-02-01 09:49:23', '2021-02-02 08:33:01', 'register', 1, 2, 1000, NULL),
	(606, 'Reset m???t kh???u', 'GET | App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm', 'GET', 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm', '', '', 1, '2021-02-01 09:49:23', '2021-02-02 08:33:01', 'password/reset', 1, 2, 1000, '<i class="icon-key mx-0"></i>'),
	(607, 'X??c th???c email', 'POST | App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail', 'POST', 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail', '', '', 606, '2021-02-01 09:49:23', '2021-02-02 08:33:01', 'password/email', 1, 2, 1000, NULL),
	(608, 'L???y token reset m???t kh???u', 'GET | App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm', 'GET', 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm', '', '', 606, '2021-02-01 09:49:23', '2021-02-02 08:33:01', 'password/reset/{token}', 1, 2, 1000, NULL),
	(609, 'Reset l???i m???t kh???u', 'POST | App\\Http\\Controllers\\Auth\\ResetPasswordController@reset', 'POST', 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset', '', '', 606, '2021-02-01 09:49:23', '2021-02-02 08:33:01', 'password/reset', 1, 2, 1000, NULL),
	(610, 'X??c nh???n l???i m???t kh???u', 'GET | App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm', 'GET', 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm', '', '', 606, '2021-02-01 09:49:23', '2021-02-02 08:33:01', 'password/confirm', 1, 2, 1000, NULL),
	(611, 'X??c nh???n l???i m???t kh???u l???n 2', 'POST | App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm', 'POST', 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm', '', '', 606, '2021-02-01 09:49:23', '2021-02-02 08:33:01', 'password/confirm', 1, 2, 1000, NULL),
	(612, 'Danh m???c qu???n huy???n', 'GET | App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyen', 'GET', 'App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyen', '', '', 1, '2021-02-01 09:49:23', '2021-02-02 09:00:59', 'dm-quan-huyen', 1, 1, 4, '<i class="menu-icon icon-location-pin"></i>'),
	(613, 'N??t import danh m???c qu???n huy???n', 'POST | App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyenAndImport', 'POST', 'App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyenAndImport', '', '', 612, '2021-02-01 09:49:23', '2021-02-02 08:33:01', 'dm-quan-huyen/import', 1, 2, 1000, NULL),
	(614, 'Danh m???c ph?????ng x??', 'GET | App\\Modules\\DmXaPhuong\\Controllers\\DmXaPhuongController@dmXaPhuong', 'GET', 'App\\Modules\\DmXaPhuong\\Controllers\\DmXaPhuongController@dmXaPhuong', '', '', 1, '2021-02-01 09:49:23', '2021-02-02 09:01:09', 'dm-xa-phuong', 1, 1, 5, '<i class="menu-icon icon-location-pin"></i>'),
	(615, 'N??t import danh m???c ph?????ng x??', 'POST | App\\Modules\\DmXaPhuong\\Controllers\\DmXaPhuongController@dmXaPhuongAndImport', 'POST', 'App\\Modules\\DmXaPhuong\\Controllers\\DmXaPhuongController@dmXaPhuongAndImport', '', '', 614, '2021-02-01 09:49:23', '2021-02-02 08:33:01', 'dm-xa-phuong/import', 1, 2, 1000, NULL),
	(616, 'Nh??m quy???n', 'GET | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyen', 'GET', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyen', '', '', 1, '2021-02-01 09:49:23', '2021-02-02 09:00:43', 'nhom-quyen', 1, 1, 2, '<i class="menu-icon icon-people"></i>'),
	(617, 'Ph??n quy???n', 'GET | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyen', 'GET', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyen', '', '', 1, '2021-02-01 09:49:23', '2021-02-02 09:00:51', 'phan-quyen', 1, 1, 3, '<i class="menu-icon icon-vector"></i>'),
	(618, 'Danh m???c ch???c n??ng', 'GET | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyen', 'GET', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyen', '', '', 1, '2021-02-01 09:49:23', '2021-02-02 09:00:08', 'tai-nguyen', 1, 1, 1, '<i class="menu-icon icon-list"></i>'),
	(619, 'Xem t???t c??? t??i nguy??n', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyenAll', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyenAll', '', '', 618, '2021-02-01 09:49:23', '2021-02-02 08:33:01', 'tai-nguyen-all', 1, 2, 1000, NULL),
	(620, 'Qu??t t??i nguy??n', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@quetTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@quetTaiNguyen', '', '', 618, '2021-02-01 09:49:23', '2021-02-02 08:33:01', 'quet-tai-nguyen', 1, 2, 1000, NULL),
	(621, 'Th??m m???t t??i nguy??n', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@themTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@themTaiNguyen', '', '', 618, '2021-02-01 09:49:23', '2021-02-02 08:33:01', 'them-tai-nguyen', 1, 2, 1000, NULL),
	(622, 'L???y th??ng tin m???t t??i nguy??n', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@layTaiNguyenTheoId', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@layTaiNguyenTheoId', '', '', 618, '2021-02-01 09:49:23', '2021-02-02 08:33:01', 'lay-tai-nguyen-theo-id', 1, 2, 1000, NULL),
	(623, 'S???a t??i nguy??n', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@capNhatTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@capNhatTaiNguyen', '', '', 618, '2021-02-01 09:49:23', '2021-02-02 08:33:01', 'cap-nhat-tai-nguyen', 1, 2, 1000, NULL),
	(624, 'X??a t??i nguy??n', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@xoaTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@xoaTaiNguyen', '', '', 618, '2021-02-01 09:49:23', '2021-02-02 08:33:01', 'xoa-tai-nguyen', 1, 2, 1000, NULL),
	(625, 'Trang ch???', 'GET | App\\Modules\\TrangChu\\Controllers\\TrangChuController@trangChu', 'GET', 'App\\Modules\\TrangChu\\Controllers\\TrangChuController@trangChu', '', '', 1, '2021-02-01 09:49:23', '2021-02-02 09:01:25', '/', 1, 2, 1000, '<i class="menu-icon icon-home"></i>'),
	(626, 'Xem danh s??ch quy???n', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@danhSachNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@danhSachNhomQuyen', '', '', 616, '2021-02-02 07:59:22', '2021-02-02 08:33:01', 'danh-sach-nhom-quyen', 1, 2, 1000, NULL),
	(627, 'Th??m nh??m quy???n', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@themNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@themNhomQuyen', '', '', 616, '2021-02-02 07:59:22', '2021-02-02 08:33:01', 'them-nhom-quyen', 1, 2, 1000, NULL),
	(628, 'L???y nh??m quy???n theo id', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@layNhomQuyenTheoId', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@layNhomQuyenTheoId', '', '', 616, '2021-02-02 07:59:22', '2021-02-02 08:33:01', 'lay-nhom-quyen-theo-id', 1, 2, 1000, NULL),
	(629, 'C???p nh???t nh??m quy???n', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@capNhatNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@capNhatNhomQuyen', '', '', 616, '2021-02-02 07:59:22', '2021-02-02 08:33:01', 'cap-nhat-nhom-quyen', 1, 2, 1000, NULL),
	(630, 'X??a nh??m quy???n', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@xoaNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@xoaNhomQuyen', '', '', 616, '2021-02-02 07:59:22', '2021-02-02 08:33:01', 'xoa-nhom-quyen', 1, 2, 1000, NULL),
	(631, 'Ph??n quy???n', 'POST | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenPost', 'POST', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenPost', '', '', 617, '2021-02-02 07:59:22', '2021-02-02 08:33:01', 'phan-quyen-post', 1, 2, 1000, NULL),
	(632, 'Danh s??ch nh??m quy???n (Ph??n quy???n)', 'POST | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachNhomQuyen', 'POST', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachNhomQuyen', '', '', 617, '2021-02-02 07:59:22', '2021-02-02 08:33:01', 'phan-quyen/danh-sach-nhom-quyen', 1, 2, 1000, NULL),
	(633, 'Danh s??ch quy???n theo nh??m quy???n (Ph??n quy???n)', 'POST | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachQuyenTheoNhomQuyenId', 'POST', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachQuyenTheoNhomQuyenId', '', '', 617, '2021-02-02 07:59:22', '2021-02-02 08:33:01', 'phan-quyen/danh-sach-quyen-theo-nhom-quyen-id', 1, 2, 1000, NULL);
/*!40000 ALTER TABLE `admin_resource` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 22, 2021 lúc 05:42 AM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `c1se10`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 2),
(4, '2021_10_15_071604_create_patients_table', 2),
(5, '2021_10_15_075322_add_delete_to_patients', 3),
(6, '2021_10_19_160403_create_vaccines_table', 4),
(7, '2021_10_19_161118_add_delete_to_vaccines', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `patients`
--

CREATE TABLE `patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cccd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_test` int(11) NOT NULL,
  `result` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `wait_at` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `patients`
--

INSERT INTO `patients` (`id`, `name`, `cccd`, `gender`, `birthday`, `phone`, `address`, `number_test`, `result`, `created_at`, `updated_at`, `deleted_at`, `wait_at`) VALUES
(1, 'Thái Bá Tuấn Anh', '187892950', 'male', '2000-02-26', '0123456789', 'Nghệ An', 1, NULL, NULL, '2021-10-18 08:03:17', '2021-10-18 08:03:17', '0'),
(2, 'Nguyễn Ngọc Thùy Minh', '187892950', 'female', '2000-01-27', '0123456789', 'Đà Nẵng', 1, NULL, NULL, '2021-10-18 08:04:32', '2021-10-18 08:04:32', '0'),
(29, 'Thái Bá Tuấn Anh', '187892950', 'male', '2000-02-26', '0123456789', 'Nghệ An', 1, NULL, NULL, '2021-10-18 08:06:37', '2021-10-18 08:06:37', '0'),
(30, 'Nguyễn Ngọc Thùy Minh', '187892950', 'female', '2000-01-27', '0123456789', 'Đà Nẵng', 1, NULL, NULL, '2021-10-18 08:07:04', '2021-10-18 08:07:04', '0'),
(31, 'Thái Bá Tuấn Anh', '187892950', 'male', '2000-02-26', '0123456789', 'Nghệ An', 1, NULL, NULL, '2021-10-18 08:07:51', '2021-10-18 08:07:51', '0'),
(32, 'Nguyễn Ngọc Thùy Minh', '187892950', 'female', '2000-01-27', '0123456789', 'Đà Nẵng', 1, '0', NULL, '2021-10-19 08:54:46', NULL, '1'),
(33, 'Thái Bá Tuấn Anh', '187892950', 'male', '2000-02-26', '0123456789', 'Nghệ An', 1, NULL, NULL, '2021-10-18 08:10:36', '2021-10-18 08:10:36', '0'),
(34, 'Nguyễn Ngọc Thùy Minh', '187892950', 'female', '2000-01-27', '0123456789', 'Đà Nẵng', 1, NULL, NULL, '2021-10-18 08:11:20', '2021-10-18 08:11:20', '0'),
(35, 'Thái Bá Tuấn Anh', '187892950', 'male', '2000-02-26', '0123456789', 'Nghệ An', 1, NULL, NULL, '2021-10-18 08:11:23', NULL, '1'),
(36, 'Nguyễn Ngọc Thùy Minh', '187892950', 'female', '2000-01-27', '0123456789', 'Đà Nẵng', 1, NULL, NULL, '2021-10-19 08:53:36', NULL, '1'),
(37, 'Thái Bá Tuấn Anh', '187892950', 'male', '2000-02-26', '0123456789', 'Nghệ An', 1, NULL, NULL, '2021-10-19 08:54:01', NULL, '1'),
(38, 'Nguyễn Ngọc Thùy Minh', '187892950', 'female', '2000-01-27', '0123456789', 'Đà Nẵng', 1, NULL, NULL, '2021-10-21 20:24:34', NULL, '1'),
(39, 'Thái Bá Tuấn Anh', '187892950', 'male', '2000-02-26', '0123456789', 'Nghệ An', 1, NULL, NULL, '2021-10-16 07:45:43', NULL, '0'),
(40, 'Nguyễn Ngọc Thùy Minh', '187892950', 'female', '2000-01-27', '0123456789', 'Đà Nẵng', 1, NULL, NULL, '2021-10-16 07:48:35', NULL, '0'),
(41, 'Thái Bá Tuấn Anh', '187892950', 'male', '2000-02-26', '0123456789', 'Nghệ An', 1, NULL, NULL, '2021-10-16 07:45:43', NULL, '0'),
(42, 'Nguyễn Ngọc Thùy Minh', '187892950', 'female', '2000-01-27', '0123456789', 'Đà Nẵng', 1, NULL, NULL, '2021-10-16 07:48:35', NULL, '0'),
(43, 'Thái Bá Tuấn Anh', '187892950', 'male', '2000-02-26', '0123456789', 'Nghệ An', 1, NULL, NULL, '2021-10-16 07:45:43', NULL, '0'),
(44, 'Nguyễn Ngọc Thùy Minh', '187892950', 'female', '2000-01-27', '0123456789', 'Đà Nẵng', 1, NULL, NULL, '2021-10-16 07:48:35', NULL, '0'),
(45, 'Thái Bá Tuấn Anh', '187892950', 'male', '2000-02-26', '0123456789', 'Nghệ An', 1, NULL, NULL, '2021-10-16 07:45:43', NULL, '0'),
(46, 'Nguyễn Ngọc Thùy Minh', '187892950', 'female', '2000-01-27', '0123456789', 'Đà Nẵng', 1, NULL, NULL, '2021-10-16 07:48:35', NULL, '0'),
(47, 'Thái Bá Tuấn Anh', '187892950', 'male', '2000-02-26', '0123456789', 'Nghệ An', 1, NULL, NULL, '2021-10-16 07:45:43', NULL, '0'),
(48, 'Nguyễn Ngọc Thùy Minh', '187892950', 'female', '2000-01-27', '0123456789', 'Đà Nẵng', 1, NULL, NULL, '2021-10-16 07:48:35', NULL, '0'),
(49, 'Thái Bá Tuấn Anh', '187892950', 'male', '2000-02-26', '0123456789', 'Nghệ An', 1, NULL, NULL, '2021-10-16 07:45:43', NULL, '0'),
(50, 'Nguyễn Ngọc Thùy Minh', '187892950', 'female', '2000-01-27', '0123456789', 'Đà Nẵng', 1, NULL, NULL, '2021-10-16 07:48:35', NULL, '0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Thái Bá Tuấn Anh', 'nhunguoixala10@gmail.com', NULL, '$2y$10$MOEvxRmoDTvBJUlgDfUR.uJpAtLbBYyI4oikOcfASkr2wsloBzK3O', NULL, '2021-10-13 02:36:59', '2021-10-13 02:36:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vaccines`
--

CREATE TABLE `vaccines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cccd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `phone` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_test` int(11) NOT NULL,
  `name_vaccine` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `vaccines`
--
ALTER TABLE `vaccines`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `vaccines`
--
ALTER TABLE `vaccines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

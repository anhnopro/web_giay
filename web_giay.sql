-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th10 27, 2024 lúc 05:33 AM
-- Phiên bản máy phục vụ: 8.0.30
-- Phiên bản PHP: 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `web_giay`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id_category` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id_category`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Nike', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Adidas', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Vans', 'categories/fXjaWr21Fmzxfu0xEjZRcsooo628zHUxNRtNtnE1.jpg', '0000-00-00 00:00:00', '2024-10-07 02:25:57'),
(4, 'Puma', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Balenciaga1', 'assets/images/sp4.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Đỗ Đức Anh', 'images/kmkV36AwDz8kyTjODpEjkvLUSL6lUdEyuCr9ePGQ.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Đỗ Đức Anh', 'images/RiBOnovP7SOyMtEuTjBFCKKAbXQ5xPXLc2G3jm0B.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Đỗ Đức Anh`345y43', 'categories/PXsQft9HbYpe1k2sl3u2s0c23zoeEOV0CqRYOKGU.jpg', '2024-10-07 02:26:47', '2024-10-07 02:26:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `colors`
--

CREATE TABLE `colors` (
  `id_color` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `hex_code` varchar(7) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `colors`
--

INSERT INTO `colors` (`id_color`, `name`, `hex_code`, `updated_at`, `created_at`) VALUES
(1, 'Vàng', '#FFFF00', '2024-10-01 03:57:55', '2024-10-01 03:57:55'),
(2, 'Đỏ', '#FF0000', '2024-10-01 03:58:36', '2024-10-01 03:58:36'),
(3, 'Tím', '', '2024-10-02 14:35:06', '2024-10-02 14:35:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `images_prd`
--

CREATE TABLE `images_prd` (
  `id_image` int NOT NULL,
  `path` varchar(255) NOT NULL,
  `id_variant` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id_order` int NOT NULL,
  `phone_number` int NOT NULL,
  `address` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `condition` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Đang xử lí',
  `invoice_type` tinyint(1) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id_order`, `phone_number`, `address`, `name`, `email`, `date`, `condition`, `invoice_type`, `updated_at`, `created_at`) VALUES
(1, 977103182, 'Hà Nội', 'Đức ANh', 'ducan20035t@gmail.com', '2024-11-07', 'Đang xử lí', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 977103182, 'Đường Mĩ Đình', 'Đỗ Đức Anh', 'ducanh2004ss@gmail.com', '2024-11-08', 'Đang xử lí', 0, '2024-11-08 09:08:30', '2024-11-08 09:08:30'),
(23, 977103182, 'Đường Mĩ Đình', 'Đỗ Đức Anh', 'ducanh2004ss@gmail.com', '2024-11-08', 'Đang xử lí', 0, '2024-11-08 09:09:30', '2024-11-08 09:09:30'),
(24, 977103182, 'Đường Mĩ Đình', 'Đỗ Đức Anh', 'ducanh2004ss@gmail.com', '2024-11-08', 'Đang xử lí', 0, '2024-11-08 09:10:43', '2024-11-08 09:10:43'),
(25, 977103182, 'Đường Mĩ Đình', 'Đỗ Đức Anh', 'ducanh2004ss@gmail.com', '2024-11-08', 'Đang xử lí', 0, '2024-11-08 09:10:59', '2024-11-08 09:10:59'),
(26, 977103182, 'Đường Mĩ Đình', 'Đỗ Đức Anh', 'ducanh2004ss@gmail.com', '2024-11-08', 'Đang xử lí', 0, '2024-11-08 09:11:27', '2024-11-08 09:11:27'),
(27, 977103182, 'Đường Mĩ Đình', 'Đỗ Đức Anh', 'ducanh2004ss@gmail.com', '2024-11-08', 'Đang xử lí', 0, '2024-11-08 09:16:01', '2024-11-08 09:16:01'),
(28, 977103182, 'Đường Mĩ Đình', 'Đỗ Đức Anh', 'ducanh2004ss@gmail.com', '2024-11-08', 'Đang xử lí', 0, '2024-11-08 09:18:31', '2024-11-08 09:18:31'),
(29, 977103182, 'Đường Mĩ Đình', 'Đỗ Đức Anh', 'ducanh2004ss@gmail.com', '2024-11-08', 'Đang xử lí', 0, '2024-11-08 09:26:00', '2024-11-08 09:26:00'),
(30, 977103182, 'Đường Mĩ Đình', 'Đỗ Đức Anh', 'ducanh2004ss@gmail.com', '2024-11-08', 'Đang xử lí', 0, '2024-11-08 09:30:40', '2024-11-08 09:30:40'),
(31, 977103182, 'Đường Mĩ Đình', 'Đỗ Đức Anh', 'ducanh2004ss@gmail.com', '2024-11-08', 'Đang xử lí', 0, '2024-11-08 09:34:59', '2024-11-08 09:34:59'),
(32, 977103182, 'Đường Mĩ Đình', 'Đỗ Đức Anh', 'ducanh2004ss@gmail.com', '2024-11-08', 'Đang xử lí', 0, '2024-11-08 09:42:03', '2024-11-08 09:42:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id_orderDetail` int NOT NULL,
  `name_product` varchar(255) NOT NULL,
  `total` int NOT NULL,
  `total_payment` int NOT NULL,
  `qty` int NOT NULL,
  `id_order` int NOT NULL,
  `id_product` int NOT NULL,
  `updated_at` timestamp NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id_orderDetail`, `name_product`, `total`, `total_payment`, `qty`, `id_order`, `id_product`, `updated_at`, `created_at`) VALUES
(1, 'dgr', 12456, 456, 245, 1, 12414, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'Đỗ Đức Anh', 30000000, 30000000, 3, 27, 12412, '2024-11-08 09:16:01', '2024-11-08 09:16:01'),
(22, 'Đỗ Đức Anh', 10000000, 10000000, 1, 28, 12412, '2024-11-08 09:18:31', '2024-11-08 09:18:31'),
(23, 'Đỗ Đức Anh', 40000000, 40000000, 4, 29, 12412, '2024-11-08 09:26:00', '2024-11-08 09:26:00'),
(24, 'Đỗ Đức Anh', 10000000, 10000000, 1, 30, 12412, '2024-11-08 09:30:40', '2024-11-08 09:30:40'),
(25, 'Đỗ Đức Anh', 30000000, 30000000, 3, 31, 12412, '2024-11-08 09:34:59', '2024-11-08 09:34:59'),
(26, 'Đỗ Đức Anh', 2, 4, 1, 32, 12413, '2024-11-08 09:42:03', '2024-11-08 09:42:03'),
(27, 'Đỗ Đức Anh', 2, 4, 1, 32, 12413, '2024-11-08 09:42:03', '2024-11-08 09:42:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id_product` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `describe` varchar(255) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `view` int DEFAULT NULL,
  `id_category` int DEFAULT NULL,
  `updated_at` date NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id_product`, `name`, `image`, `describe`, `status`, `view`, `id_category`, `updated_at`, `created_at`) VALUES
(12412, 'Đỗ Đức Anh', 'products/wGCn0p64ehgkas4KbmaeM1bsKIFwGi90Cu6l2gqL.jpg', 'dg', 1, 0, 1, '2024-10-07', '2024-10-02 07:26:49'),
(12413, 'Đỗ Đức Anh', 'products/QtLq5cSYADHnuDVk1D0ueyYhdqpInGPftQvXhVjX.jpg', 'dg', 1, 0, 1, '2024-10-14', '2024-10-02 07:29:08'),
(12414, 'Đỗ Đức Anh', 'images/sBJiBuKwp0B8THD9PR2aCS2hmShOT2C2xeo8VYP5.jpg', 'ss', 1, 0, 1, '2024-10-02', '2024-10-02 07:30:24'),
(12415, 'Đỗ Đức Anh', 'images/EdrP5b0qGsY8I6fMIKZBftGoXwq3atq3A2wsQpXv.jpg', 'sff', 1, 0, 2, '2024-10-02', '2024-10-02 07:33:12'),
(12416, 'Đỗ Đức Anh', '[\"images\\/Cq5MAtoPbzODN0FsonVSoknOPCJoPLTYtmCqXTaE.jpg\"]', '2424', 1, 0, 1, '2024-10-06', '2024-10-05 19:26:05'),
(12417, 'Đỗ Đức Anh', '[\"images\\/EV5RCJNrg5H7oHIKcF9dOLYc4SQWRZQR2mCgCiBc.jpg\"]', '2424', 1, 0, 1, '2024-10-06', '2024-10-05 19:26:40'),
(12418, 'Đỗ Đức Anh', 'images/Wcjocr927EPZI6dtCL3ynIEjhN2poDKtLBlmDGME.jpg', '2424', 1, 0, 1, '2024-10-06', '2024-10-05 19:27:30'),
(12419, 'Đỗ Đức Anh', 'images/GQ7L7SQx1cWDc2pVv1EOFOjrds9gWOE32YJ1dDar.jpg', 'đức anh', 1, 0, 2, '2024-10-06', '2024-10-06 08:41:10'),
(12420, 'Đỗ Đức Anh', 'images/fCq0RVws55V8mdAw6OWInxSUsvOjRqveIN1zrgNa.jpg', 'sdfg', 1, 0, 4, '2024-10-07', '2024-10-06 08:42:40'),
(12421, 'Đỗ Đức Anh', 'images/aRtuq6Prj8J90uvGpt5BlwjrNlV7weNjLieSvKyB.jpg', 'fbbbbbbbb', 1, 0, 2, '2024-11-06', '2024-11-06 09:10:38'),
(12422, 'Đỗ Đức Anh12345', 'images/zRcSBTJseyxV5Io1FDjrt9R3awIbBbLi5Cd5fH7k.jpg', '23456', 1, 0, 1, '2024-11-06', '2024-11-06 09:11:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_variants`
--

CREATE TABLE `product_variants` (
  `id_variant` int NOT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `sale_price` int DEFAULT NULL,
  `id_product` int NOT NULL,
  `id_color` int NOT NULL,
  `id_size` int NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `product_variants`
--

INSERT INTO `product_variants` (`id_variant`, `quantity`, `price`, `image`, `sale_price`, `id_product`, `id_color`, `id_size`, `updated_at`, `created_at`) VALUES
(29, 2, 10000000, 'variants/fjD2VsbojzSxR9sGIfS2MFKbMalZpHUHtx7TDaxh.jpg', 10000000, 12412, 2, 1, '2024-10-13 19:20:28', '2024-10-02 07:26:49'),
(30, 2, 10000000, 'images/FyeyagVtCSb9pkuD1kMfONqf23Hci818cS89qYBm.jpg', 8000000, 12412, 2, 2, '2024-10-13 19:20:43', '2024-10-02 07:26:49'),
(31, 1, 2, 'variants/kzXAuHr0LClI8tOLw1NDeMEIblyuzBfVayH9dYsJ.jpg', 22, 12413, 2, 1, '2024-10-16 19:45:12', '2024-10-02 07:29:08'),
(32, 1, 3, 'variants/jL2Ejrk4VvBlbTDMfBIlsTd69D6k90P3wWaOGIeQ.jpg', 22, 12413, 2, 2, '2024-10-16 19:45:12', '2024-10-02 07:29:08'),
(33, 1, 2, 'images/QmWy3XhOGuiXiklbKAkMjOLuL1nkZ2ZtvoVbVsGX.jpg', NULL, 12414, 2, 1, '2024-10-02 07:30:24', '2024-10-02 07:30:24'),
(34, 1, 2, 'images/vEdysXPqejEQ4UPwOA9KlwF2AJ4YHSlWv1UKx0Qv.jpg', NULL, 12414, 2, 2, '2024-10-02 07:30:24', '2024-10-02 07:30:24'),
(35, 2, 23, 'images/23JTsy2CDYEMNBL4BKF3UzGEVijHeXpc7jATuzE6.jpg', NULL, 12415, 1, 1, '2024-10-02 07:33:12', '2024-10-02 07:33:12'),
(36, 2, 23, 'images/zeCCzRWYpdWavEgirdUTyIZdCy7vNKqZ65h4JdvX.jpg', NULL, 12415, 1, 2, '2024-10-02 07:33:12', '2024-10-02 07:33:12'),
(37, 2, 2, 'images/jnPFqSjq5IqIc77XcAtYbBigMvA0enHH86E2YkCh.jpg', NULL, 12418, 3, 1, '2024-10-05 19:27:31', '2024-10-05 19:27:31'),
(38, 2, 2, 'images/qNzx0SfovKwrgGYaqNbKrrsiCz44zrX6eUYinhSq.jpg', NULL, 12418, 3, 2, '2024-10-05 19:27:31', '2024-10-05 19:27:31'),
(39, 2, 12, 'images/MnGSloOUocE16Kktvp0r49qp2phhNM6Q5nCzcgLk.jpg', NULL, 12419, 3, 1, '2024-10-06 08:41:10', '2024-10-06 08:41:10'),
(40, 2, 12, 'images/zpM4HllaACAmX3OqepBzdUXvOdz04MXL8zs25Lqs.jpg', NULL, 12419, 3, 2, '2024-10-06 08:41:10', '2024-10-06 08:41:10'),
(41, 12, 23, 'variants/J9Wx5RHWvrgWCmQEYiLrlfKrIxaxKpFkUXsX95Iz.jpg', 2, 12420, 2, 1, '2024-10-06 23:54:22', '2024-10-06 08:42:40'),
(42, 2, 23, 'images/El0h2PUQpcIdY1acSRLinlykilcgCNr0lbuH02PC.jpg', 23, 12420, 2, 2, '2024-10-06 23:41:33', '2024-10-06 08:42:40'),
(43, 1, 23, 'variants/F97TZRPByAbTpmJNbsCksUPFHKmcEEX6klYBiO8X.jpg', 3, 12420, 1, 1, '2024-10-06 23:53:56', '2024-10-06 08:42:40'),
(44, 1, 23, 'variants/XS28q8QwoTwfYmXr4ytbF6HB9v9HVTnI2c5m9CaY.jpg', 23, 12420, 1, 2, '2024-10-06 23:53:41', '2024-10-06 08:42:40'),
(45, 2, 2, 'images/oYEbgsyGHkPSX3SMmP2l8HUsYNBgKn0doUuJGph9.jpg', NULL, 12421, 2, 1, '2024-11-06 09:10:38', '2024-11-06 09:10:38'),
(46, 2, 2, 'images/kecgEoDS3ps94bkvXauu672Kv0ixh4bVspSX6lcN.jpg', NULL, 12421, 2, 2, '2024-11-06 09:10:38', '2024-11-06 09:10:38'),
(47, 1, 2, 'images/Sh5gGAag6rywU1esvFeaURswJdzr6MVh0RCsWmX2.jpg', NULL, 12422, 3, 1, '2024-11-06 09:11:28', '2024-11-06 09:11:28'),
(48, 22, 2, 'images/hYFAvArg70JKJnOO6IZ8M64AHWScQIHBOPb1KC0X.jpg', NULL, 12422, 3, 2, '2024-11-06 09:11:28', '2024-11-06 09:11:28'),
(49, 2, 22, 'images/V8O0wwK1wGbBJufo5vIFNQE7wL3HeUeQMD5CNwZY.jpg', NULL, 12422, 1, 1, '2024-11-06 09:11:28', '2024-11-06 09:11:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sizes`
--

CREATE TABLE `sizes` (
  `id_size` int NOT NULL,
  `size_value` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `sizes`
--

INSERT INTO `sizes` (`id_size`, `size_value`, `updated_at`, `created_at`) VALUES
(1, '38', '2024-10-01 03:58:52', '2024-10-01 03:58:52'),
(2, '39', '2024-10-01 03:59:06', '2024-10-01 03:59:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nick_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` int NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `full_name`, `nick_name`, `email`, `address`, `phone_number`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Đỗ Đức Anh', 'ducanh113', 'ducanh2004ss@gmail.com', 'Hà Nội', 977103182, NULL, '123456', 'user', NULL, NULL, NULL),
(2, 'Lường Thị Hồng Hạnh', 'Hạnh', 'hanh2146.com@gmail.com', 'Hà Nội', 936134153, NULL, '12345', 'admin', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vouchers`
--

CREATE TABLE `vouchers` (
  `id_voucher` bigint UNSIGNED NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_voucher` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `applicable_to` enum('private','public') COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_type` enum('percentage','fixed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_amount` decimal(10,0) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `start_date` date NOT NULL,
  `expiration_date` date NOT NULL,
  `usage_limit` int DEFAULT NULL,
  `usage_count` int NOT NULL DEFAULT '0',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vouchers`
--

INSERT INTO `vouchers` (`id_voucher`, `code`, `name_voucher`, `applicable_to`, `discount_type`, `discount_amount`, `description`, `start_date`, `expiration_date`, `usage_limit`, `usage_count`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ZX555C', 'Tri ân khách hàng', 'private', 'fixed', 10, 'Giảm giá vip', '2024-10-10', '2024-10-18', 10, 12, 'inactive', NULL, '2024-10-23 08:34:21'),
(3, '711894', 'Khuyến mãi', 'public', 'fixed', 123, NULL, '2024-10-16', '2024-10-23', 23, 0, 'active', '2024-10-08 08:03:32', '2024-10-08 08:03:32'),
(6, 'Z24356', '24', 'private', 'fixed', 113, NULL, '2024-10-01', '2024-10-23', NULL, 0, 'active', '2024-10-09 07:51:16', '2024-10-09 07:51:16'),
(16, 'ZXC111', 'Khuyến mãi', 'public', 'percentage', 2, NULL, '2024-10-02', '2024-10-26', NULL, 0, 'active', '2024-10-23 08:20:25', '2024-10-23 08:34:34'),
(17, 'ZXC222', 'Khuyến mãi', 'public', 'percentage', 10, NULL, '2024-10-03', '2024-11-23', NULL, 0, 'active', '2024-10-23 08:29:16', '2024-10-30 08:39:40');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Chỉ mục cho bảng `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id_color`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `images_prd`
--
ALTER TABLE `images_prd`
  ADD KEY `id_variant` (`id_variant`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id_orderDetail`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_product` (`id_product`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `category_id` (`id_category`);

--
-- Chỉ mục cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id_variant`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_color` (`id_color`),
  ADD KEY `id_size` (`id_size`);

--
-- Chỉ mục cho bảng `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id_size`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id_voucher`),
  ADD UNIQUE KEY `code` (`code`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `colors`
--
ALTER TABLE `colors`
  MODIFY `id_color` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id_orderDetail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12423;

--
-- AUTO_INCREMENT cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id_variant` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT cho bảng `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id_size` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id_voucher` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `images_prd`
--
ALTER TABLE `images_prd`
  ADD CONSTRAINT `id_variant` FOREIGN KEY (`id_variant`) REFERENCES `product_variants` (`id_variant`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`);

--
-- Các ràng buộc cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `id_color` FOREIGN KEY (`id_color`) REFERENCES `colors` (`id_color`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `id_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `id_size` FOREIGN KEY (`id_size`) REFERENCES `sizes` (`id_size`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2022 at 10:20 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lucky`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `slug`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Color', 'color', 'color', '2022-07-29 07:36:29', '2022-07-29 07:36:29'),
(2, 'Size', 'size', 'size', '2022-07-29 07:36:29', '2022-07-29 07:36:29'),
(3, 'Weight', 'weight', 'weight', '2022-07-29 07:36:29', '2022-07-29 07:36:29');

-- --------------------------------------------------------

--
-- Table structure for table `back_orders`
--

CREATE TABLE `back_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `backorders_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `back_orders`
--

INSERT INTO `back_orders` (`id`, `backorders_title`, `created_at`, `updated_at`) VALUES
(1, 'Do not allow', NULL, NULL),
(2, 'Allow, but notify customer', NULL, NULL),
(3, 'Allow', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bulks`
--

CREATE TABLE `bulks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `enable` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_quantity` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`, `cat_image`, `description`, `created_at`, `updated_at`) VALUES
(1, 'electronic', 'test.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus porro tenetur magni eius aliquid delectus impedit adipisci ducimus hic commodi ipsam, sit aut quibusdam et veniam nihil perferendis fuga dolor!', '2022-07-29 07:37:58', '2022-07-29 07:37:58'),
(2, 'accessories', 'test.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus porro tenetur magni eius aliquid delectus impedit adipisci ducimus hic commodi ipsam, sit aut quibusdam et veniam nihil perferendis fuga dolor!', '2022-07-29 07:37:58', '2022-07-29 07:37:58'),
(3, 'fashion', 'test.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus porro tenetur magni eius aliquid delectus impedit adipisci ducimus hic commodi ipsam, sit aut quibusdam et veniam nihil perferendis fuga dolor!', '2022-07-29 07:37:58', '2022-07-29 07:37:58'),
(4, 'cosmetics', 'test.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus porro tenetur magni eius aliquid delectus impedit adipisci ducimus hic commodi ipsam, sit aut quibusdam et veniam nihil perferendis fuga dolor!', '2022-07-29 07:37:59', '2022-07-29 07:37:59');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manage_stock` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock_quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `backorders` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `low_stock` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `solid_individually` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `product_id`, `sku`, `stock_status`, `manage_stock`, `stock_quantity`, `backorders`, `low_stock`, `solid_individually`, `created_at`, `updated_at`) VALUES
(1, 1, 'sf', 'In stock', '0', '0', NULL, 'instock', '0', '2022-07-29 07:44:03', '2022-07-30 07:47:00'),
(2, 2, 'sf', 'In stock', '0', '0', NULL, 'instock', '0', '2022-07-29 07:45:51', '2022-07-30 08:24:44');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(49, '2014_10_12_000000_create_users_table', 1),
(50, '2014_10_12_100000_create_password_resets_table', 1),
(51, '2019_08_19_000000_create_failed_jobs_table', 1),
(52, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(53, '2021_11_29_133033_create_products_table', 1),
(54, '2021_11_29_140934_create_categories_table', 1),
(55, '2021_11_29_141236_create_tags_table', 1),
(56, '2021_11_29_141602_create_attributes_table', 1),
(57, '2021_11_29_142136_create_terms_table', 1),
(58, '2021_11_29_142903_create_inventories_table', 1),
(59, '2021_11_29_143848_create_preparations_table', 1),
(60, '2021_11_29_150500_create_bulks_table', 1),
(61, '2022_04_01_151157_create_product_attributes_table', 1),
(62, '2022_04_02_175443_create_product_categories_table', 1),
(63, '2022_07_27_093124_create_stock_statuses_table', 1),
(64, '2022_07_29_051529_create_back_orders_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `preparations`
--

CREATE TABLE `preparations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `enable` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preparation_days` int(11) DEFAULT NULL,
  `extra_time` int(11) DEFAULT NULL,
  `availability_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `preparations`
--

INSERT INTO `preparations` (`id`, `product_id`, `enable`, `preparation_days`, `extra_time`, `availability_date`, `created_at`, `updated_at`) VALUES
(1, 1, '0', 1, 1, NULL, '2022-07-29 07:44:03', '2022-07-30 07:47:00'),
(2, 2, '0', 1, 1, NULL, '2022-07-29 07:45:51', '2022-07-30 08:24:44');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `regular_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `users_id`, `name`, `image`, `regular_price`, `sale_price`, `start_date`, `end_date`, `barcode`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'dadad', '62e3eb2b1e5c2_293600176_3184131255181309_6148192117147743661_n.jpg', '5000', '3000', NULL, NULL, '121212', 'sadasd', '2022-07-29 07:44:03', '2022-07-30 07:47:23'),
(2, 1, 'asasa', '62e3eb97739e4_293600176_3184131255181309_6148192117147743661_n.jpg', '5000', '3000', NULL, NULL, 'fdgdg', 'asas', '2022-07-29 07:45:51', '2022-08-02 01:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `product_id`, `term_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2022-07-30 08:23:36', '2022-07-30 08:23:36');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `product_id`, `category_id`, `created_at`, `updated_at`) VALUES
(5, 1, 1, '2022-07-30 08:23:36', '2022-07-30 08:23:36'),
(6, 1, 2, '2022-07-30 08:23:36', '2022-07-30 08:23:36'),
(7, 2, 2, '2022-08-02 01:01:57', '2022-08-02 01:01:57'),
(8, 2, 3, '2022-08-02 01:01:57', '2022-08-02 01:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `stock_statuses`
--

CREATE TABLE `stock_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stock_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_statuses`
--

INSERT INTO `stock_statuses` (`id`, `stock_name`, `created_at`, `updated_at`) VALUES
(1, 'In stock', NULL, NULL),
(2, 'Out of stock', NULL, NULL),
(3, 'On backorders', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `terms_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `attribute_id`, `terms_name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, '1', 'Red', 'red', 'red', '2022-07-29 07:36:37', '2022-07-29 07:36:37'),
(2, '1', 'Green', 'green', 'green', '2022-07-29 07:36:37', '2022-07-29 07:36:37'),
(3, '1', 'Blue', 'blue', 'blue', '2022-07-29 07:36:37', '2022-07-29 07:36:37'),
(4, '2', 'Small', 'small', 'small', '2022-07-29 07:36:37', '2022-07-29 07:36:37'),
(5, '2', 'Medium', 'medium', 'medium', '2022-07-29 07:36:37', '2022-07-29 07:36:37'),
(6, '2', 'Large', 'large', 'large', '2022-07-29 07:36:37', '2022-07-29 07:36:37'),
(7, '3', '10kg', 'tenkg', '10kg', '2022-07-29 07:36:37', '2022-07-29 07:36:37'),
(8, '3', '20kg', 'twentykg', 'twentykg', '2022-07-29 07:36:37', '2022-07-29 07:36:37'),
(9, '3', '30kg', 'thirtykg', 'thirtykg', '2022-07-29 07:36:37', '2022-07-29 07:36:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `is_shopowner` tinyint(1) DEFAULT NULL,
  `is_seller` tinyint(1) DEFAULT NULL,
  `is_user` tinyint(1) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `is_shopowner`, `is_seller`, `is_user`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@demo.com', NULL, '$2y$10$sndfO7pz4EqIpCzOWY5BCOLon8wEl4XLrB2KMRM8XN2CyHZRn8H7i', 1, 0, 0, 0, NULL, '2022-07-29 07:36:23', '2022-07-29 07:36:23'),
(2, 'Owner', 'owner@demo.com', NULL, '$2y$10$92oLWnkCLeTOeAGwUYEjtehhsC1mK2kREDxEes/RAfE5UN2mGpQku', 0, 1, 0, 0, NULL, '2022-07-29 07:36:23', '2022-07-29 07:36:23'),
(3, 'Seller', 'seller@demo.com', NULL, '$2y$10$tfMKl1wlR5o4MX.NqKQ5nOUFaUhjsej8qQx/lkTL2tFcR4Li/FJkO', 0, 0, 1, 0, NULL, '2022-07-29 07:36:24', '2022-07-29 07:36:24'),
(4, 'User', 'user@demo.com', NULL, '$2y$10$2EIMiUwaija1Zxl6eITs4uSbRuj8AYnauvzR9L67VHbgPzHDuTe6e', 0, 0, 0, 1, NULL, '2022-07-29 07:36:24', '2022-07-29 07:36:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `back_orders`
--
ALTER TABLE `back_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bulks`
--
ALTER TABLE `bulks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `preparations`
--
ALTER TABLE `preparations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_barcode_unique` (`barcode`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_statuses`
--
ALTER TABLE `stock_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `back_orders`
--
ALTER TABLE `back_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bulks`
--
ALTER TABLE `bulks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `preparations`
--
ALTER TABLE `preparations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stock_statuses`
--
ALTER TABLE `stock_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

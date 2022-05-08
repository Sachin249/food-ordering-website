-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2022 at 08:50 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_food_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT current_timestamp(),
  `update_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `create_date`, `update_date`) VALUES
(1, 'admin@gmail.com', 'admin', '2022-03-19 13:58:34', '2022-04-16 06:47:24');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `product_price` varchar(255) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `category_slug` varchar(255) DEFAULT NULL,
  `status` varchar(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'breakfast', 'bf', '1', '2022-04-15 07:59:49', '2022-04-15 07:59:49'),
(2, 'lunch', 'lunch', '1', '2022-04-15 07:59:49', '2022-04-15 07:59:49'),
(3, 'dinner', 'dinner', '1', '2022-04-15 07:59:49', '2022-04-15 07:59:49'),
(5, 'desserts', 'desserts', '1', '2022-04-15 07:59:49', '2022-04-15 07:59:49');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `company_mobile` varchar(255) NOT NULL,
  `company_email` varchar(255) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `company_mobile`, `company_email`, `company_address`, `created_at`, `updated_at`) VALUES
(1, '+091 1234 5678', 'ofs@gmail.com', 'Bus Stand, Mahatma Gandhi Road, opposite Sarvate, Murai Mohalla, Chhawni, Indore, Madhya Pradesh 452001', '2022-04-09 17:02:55', '2022-04-09 17:21:53');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `value` int(11) NOT NULL,
  `type` enum('Value','Per') NOT NULL,
  `min_order_amt` int(11) NOT NULL,
  `is_one_time` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `title`, `code`, `value`, `type`, `min_order_amt`, `is_one_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 'April Coupon', 'April2022', 30, 'Value', 300, 0, 1, '2022-04-11 12:28:54', '2022-04-15 07:49:18'),
(3, 'new', 'new', 10, 'Per', 0, 0, 1, '2022-04-14 09:07:58', '2022-04-15 02:58:02');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_02_01_125136_create_admins_table', 1),
(6, '2022_02_02_031929_create_categories_table', 2),
(7, '2022_03_19_095009_create_products_table', 3),
(8, '2022_03_19_100340_create_products_table', 4),
(9, '2022_03_31_190731_create_purchase_orders_table', 5),
(10, '2022_03_31_191328_create_purchase_orders_table', 6),
(11, '2022_04_07_105113_create_services_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `coupon_code` varchar(50) DEFAULT NULL,
  `order_status` int(11) NOT NULL DEFAULT 0,
  `payment_type` enum('COD','Gateway') NOT NULL,
  `payment_status` int(11) NOT NULL,
  `payment_id` varchar(50) DEFAULT NULL,
  `total_amt` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `name`, `email`, `country`, `state`, `city`, `address`, `mobile`, `coupon_code`, `order_status`, `payment_type`, `payment_status`, `payment_id`, `total_amt`, `created_at`, `updated_at`) VALUES
(1, 'sss@gmail.com', 'Sachin', 'sachin@gmail.com', 'India', 'Madhya Pradesh', 'Indore', '334 , ambedkar nagar ,lig indore', '1234567890', 'April2022', 0, 'COD', 0, '', '563', '2022-04-14 15:27:41', '2022-04-14 15:27:41'),
(2, 'sachin@gmail.com', 'Sachin', 'sachin@gmail.com', 'India', 'Madhya Pradesh', 'Indore', '334 , ambedkar nagar ,lig indore', '9131775669', 'April2022', 0, 'COD', 0, '', '361', '2022-04-14 18:20:26', '2022-04-14 18:20:26');

-- --------------------------------------------------------

--
-- Table structure for table `orders_details`
--

CREATE TABLE `orders_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `notification` int(11) NOT NULL DEFAULT 1,
  `order_status` int(11) NOT NULL DEFAULT 0,
  `packed_by_courier` int(11) NOT NULL DEFAULT 0,
  `on_the_way` int(11) NOT NULL DEFAULT 0,
  `delivered` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_details`
--

INSERT INTO `orders_details` (`id`, `order_id`, `product_id`, `price`, `qty`, `notification`, `order_status`, `packed_by_courier`, `on_the_way`, `delivered`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 221, 3, 0, 0, 0, 0, 0, '2022-04-14 15:27:41', '2022-04-15 07:50:00'),
(2, 2, 9, 30, 2, 0, 0, 0, 0, 0, '2022-04-14 18:20:26', '2022-04-15 07:50:00'),
(3, 2, 10, 221, 1, 0, 0, 0, 0, 0, '2022-04-14 18:20:26', '2022-04-15 07:50:00'),
(4, 2, 14, 60, 3, 0, 0, 0, 0, 0, '2022-04-14 18:20:26', '2022-04-15 07:50:07');

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_category`, `product_slug`, `product_name`, `product_desc`, `product_price`, `product_image`, `status`, `created_at`, `updated_at`) VALUES
(6, '2', 'burger', 'Burger', 'A hamburger is a food consisting of fillings  usually a patty of ground meat.', '122', '1647720199.jpg', 1, '2022-04-15 07:53:46', '2022-04-15 07:53:58'),
(7, '2', 'pizza', 'pizza', 'Pizza is a dish of Italian origin consisting of a usually round', '121', '1647800690.jpg', 1, '2022-04-15 07:53:46', '2022-04-15 07:53:58'),
(8, '2', 'manchurian', 'manchurian', 'Manchurian made by  ingredients such as chicken, cauliflower, prawns and paneer', '151', '1647800978.jpg', 1, '2022-04-15 07:53:46', '2022-04-15 07:53:58'),
(9, '1', 'poha', 'poha', 'Pohaa, also known as pauwa, sira, chira, or aval, among many other names.', '30', '1648974534.jpg', 1, '2022-04-15 07:53:46', '2022-04-15 07:53:58'),
(10, '1', 'pasta', 'pasta', 'Pasta is a type of food typically made from an dough of wheat flour.', '221', '1648973980.jpg', 1, '2022-04-15 07:53:46', '2022-04-15 07:53:58'),
(13, '5', 'rasmalai', 'rasmalai', 'Ras malai is a dessert originating from the eastern  Indian subcontinent.', '230', '1648973933.jpg', 1, '2022-04-15 07:53:46', '2022-04-15 07:53:58'),
(14, '1', 'meggie', 'meggie', 'Maggi is an international brand of seasonings, instant soups, and noodles', '60', '1648974564.jpeg', 1, '2022-04-15 07:53:46', '2022-04-15 07:53:58'),
(15, '3', 'matar paneer', 'matar paneer', 'matar paneer consisting of peas and paneer in a tomato based sauce, spiced.', '199', '1648974729.jpg', 1, '2022-04-15 07:53:46', '2022-04-15 07:53:58'),
(16, '3', 'butter khichdi', 'butter khichdi', 'It.made with rice and moong dal. Nutritious and light on the tummy.', '110', '1648974883.jpg', 1, '2022-04-15 07:53:46', '2022-04-15 07:53:58'),
(17, '3', 'special thali', 'special thali', 'Special thali - 4 tandoori roti , 2 seasonal veg , dal & rice & 1  piece of sweet.', '120', '1648974993.jpg', 1, '2022-04-15 07:53:46', '2022-04-15 07:53:58'),
(18, '5', 'gajar halwa', 'gajar halwa', 'Gajar halwa is a carrot-based sweet dessert from the Indian subcontinent.', '250', '1648975234.jpg', 1, '2022-04-15 07:53:46', '2022-04-15 07:53:58'),
(19, '5', 'ice cream', 'ice cream', 'Ice cream is a sweetened frozen food typically eaten as a snack or dessert', '150', '1648975366.jpg', 1, '2022-04-15 07:53:46', '2022-04-15 07:53:58');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `useremail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobileno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `packed_by_courier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `on_the_way` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `delivered` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `tracking_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`order_id`, `product_id`, `quantity`, `price`, `subtotal`, `fullname`, `useremail`, `profile_email`, `mobileno`, `address`, `notification`, `order_status`, `packed_by_courier`, `on_the_way`, `delivered`, `tracking_id`, `created_at`, `updated_at`) VALUES
(1, '6', '1', '122', '122', 'sachin sen', 'sachin@gmail.com', 'sachin@gmail.com', '9131775669', 'indore', '0', '0', '0', '0', '0', NULL, '2022-04-15 07:54:31', '2022-04-07 09:08:19'),
(2, '8', '2', '151', '302', 'sks', 'sks@gmail.com', 'sks@gmail.com', '9131775669', 'indore', '0', '1', '0', '0', '0', NULL, '2022-04-15 07:54:31', '2022-04-03 11:06:14'),
(3, '8', '1', '151', '151', 'adda', 'sks@gmail.com', 'sks@gmail.com', '3243234324', 'indore', '0', '1', '0', '0', '0', NULL, '2022-04-15 07:54:31', '2022-04-03 11:07:12'),
(4, '9', '1', '30', '30', 'Sandeep Kumar', 'sandeep@gmail.com', 'sks@gmail.com', '1737123721', 'sudama nagar ,indore', '0', '0', '0', '0', '0', NULL, '2022-04-15 07:54:31', '2022-04-03 11:16:53');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_status` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `service_desc`, `service_image`, `service_status`, `created_at`, `updated_at`) VALUES
(1, 'birthday party', 'For more information please contact us.', '1649482098.png', 1, '2022-04-15 07:54:54', '2022-04-15 07:55:08'),
(4, 'Wedding', 'For more information please contact us.', '1649481399.jpg', 1, '2022-04-15 07:54:54', '2022-04-15 07:55:08'),
(5, 'Business Dinner', 'For more information please contact us.', '1649481723.jpg', 1, '2022-04-15 07:54:54', '2022-04-15 07:55:08');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `staff_name` varchar(255) NOT NULL,
  `staff_role` varchar(255) NOT NULL,
  `staff_image` varchar(255) NOT NULL,
  `staff_status` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_name`, `staff_role`, `staff_image`, `staff_status`, `created_at`, `updated_at`) VALUES
(1, 'John Johnson', 'Manager', '1649484208.jpg', '1', '2022-04-09 06:03:28', '2022-04-09 06:15:17'),
(2, 'Anna Schmidt', 'Chef', '1649484612.jpg', '1', '2022-04-09 06:10:12', '2022-04-09 06:14:54'),
(3, 'Ivan Gonzales', 'Chef', '1649485079.jpg', '1', '2022-04-09 06:17:59', '2022-04-09 06:18:09'),
(4, 'Joseph Martinez', 'Chef', '1649486200.jpg', '1', '2022-04-09 06:18:58', '2022-04-09 12:03:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_status` int(11) DEFAULT 1,
  `is_verify` int(11) NOT NULL DEFAULT 0,
  `rand_id` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `user_image`, `address`, `remember_token`, `user_status`, `is_verify`, `rand_id`, `created_at`, `updated_at`) VALUES
(1, 'sachin', 'sachin@gmail.com', NULL, '123', '1648905987.jpeg', 'indore', NULL, 1, 1, '', '2022-04-15 07:55:30', '2022-04-16 06:46:38'),
(2, 'sks', 'sks@gmail.com', NULL, '111', '1649947034.jpg', 'dewas', NULL, 1, 1, '', '2022-04-15 07:55:30', '2022-04-16 06:48:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_details`
--
ALTER TABLE `orders_details`
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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders_details`
--
ALTER TABLE `orders_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `order_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

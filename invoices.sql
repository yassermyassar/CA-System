-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 19 مارس 2024 الساعة 20:48
-- إصدار الخادم: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invoices`
--

-- --------------------------------------------------------

--
-- بنية الجدول `failed_jobs`
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
-- بنية الجدول `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_Date` date DEFAULT NULL,
  `Due_date` date DEFAULT NULL,
  `product` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `Amount_collection` decimal(8,2) DEFAULT NULL,
  `Amount_Commission` decimal(8,2) NOT NULL,
  `Discount` decimal(8,2) NOT NULL,
  `Value_VAT` decimal(8,2) NOT NULL,
  `Rate_VAT` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Total` decimal(8,2) NOT NULL,
  `Status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Value_Status` int(11) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Payment_Date` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `invoices_attachments`
--

CREATE TABLE `invoices_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Created_by` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `invoices_details`
--

CREATE TABLE `invoices_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_invoice` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Section` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Value_status` int(11) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Payment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_01_04_182307_create_sections_table', 1),
(7, '2024_01_05_140950_create_invoices_table', 1),
(8, '2024_01_12_190221_create_products_table', 1),
(9, '2024_01_15_202038_create_invoices_details_table', 1),
(10, '2024_01_27_185126_create_invoices_attachments_table', 1),
(11, '2024_02_14_050057_add_new_column__payment_date_to_invoices_details_table', 1),
(12, '2024_02_29_051106_create_permission_tables', 1),
(13, '2024_03_11_205002_create_notifications_table', 1);

-- --------------------------------------------------------

--
-- بنية الجدول `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- بنية الجدول `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'الفواتير', 'web', '2024-03-19 16:47:45', '2024-03-19 16:47:45'),
(2, 'قائمة الفواتير', 'web', '2024-03-19 16:47:45', '2024-03-19 16:47:45'),
(3, 'الفواتير المدفوعة', 'web', '2024-03-19 16:47:45', '2024-03-19 16:47:45'),
(4, 'الفواتير المدفوعة جزئيا', 'web', '2024-03-19 16:47:45', '2024-03-19 16:47:45'),
(5, 'الفواتير الغير مدفوعة', 'web', '2024-03-19 16:47:45', '2024-03-19 16:47:45'),
(6, 'ارشيف الفواتير', 'web', '2024-03-19 16:47:45', '2024-03-19 16:47:45'),
(7, 'التقارير', 'web', '2024-03-19 16:47:45', '2024-03-19 16:47:45'),
(8, 'تقرير الفواتير', 'web', '2024-03-19 16:47:45', '2024-03-19 16:47:45'),
(9, 'تقرير العملاء', 'web', '2024-03-19 16:47:45', '2024-03-19 16:47:45'),
(10, 'المستخدمين', 'web', '2024-03-19 16:47:45', '2024-03-19 16:47:45'),
(11, 'قائمة المستخدمين', 'web', '2024-03-19 16:47:45', '2024-03-19 16:47:45'),
(12, 'صلاحيات المستخدمين', 'web', '2024-03-19 16:47:45', '2024-03-19 16:47:45'),
(13, 'الاعدادات', 'web', '2024-03-19 16:47:45', '2024-03-19 16:47:45'),
(14, 'المنتجات', 'web', '2024-03-19 16:47:45', '2024-03-19 16:47:45'),
(15, 'الاقسام', 'web', '2024-03-19 16:47:45', '2024-03-19 16:47:45'),
(16, 'اضافة فاتورة', 'web', '2024-03-19 16:47:46', '2024-03-19 16:47:46'),
(17, 'حذف الفاتورة', 'web', '2024-03-19 16:47:46', '2024-03-19 16:47:46'),
(18, 'تصدير EXCEL', 'web', '2024-03-19 16:47:46', '2024-03-19 16:47:46'),
(19, 'تغير حالة الدفع', 'web', '2024-03-19 16:47:46', '2024-03-19 16:47:46'),
(20, 'تعديل الفاتورة', 'web', '2024-03-19 16:47:46', '2024-03-19 16:47:46'),
(21, 'ارشفة الفاتورة', 'web', '2024-03-19 16:47:46', '2024-03-19 16:47:46'),
(22, 'طباعةالفاتورة', 'web', '2024-03-19 16:47:46', '2024-03-19 16:47:46'),
(23, 'اضافة مرفق', 'web', '2024-03-19 16:47:46', '2024-03-19 16:47:46'),
(24, 'حذف المرفق', 'web', '2024-03-19 16:47:46', '2024-03-19 16:47:46'),
(25, 'اضافة مستخدم', 'web', '2024-03-19 16:47:46', '2024-03-19 16:47:46'),
(26, 'تعديل مستخدم', 'web', '2024-03-19 16:47:46', '2024-03-19 16:47:46'),
(27, 'حذف مستخدم', 'web', '2024-03-19 16:47:46', '2024-03-19 16:47:46'),
(28, 'عرض صلاحية', 'web', '2024-03-19 16:47:46', '2024-03-19 16:47:46'),
(29, 'اضافة صلاحية', 'web', '2024-03-19 16:47:46', '2024-03-19 16:47:46'),
(30, 'تعديل صلاحية', 'web', '2024-03-19 16:47:46', '2024-03-19 16:47:46'),
(31, 'حذف صلاحية', 'web', '2024-03-19 16:47:46', '2024-03-19 16:47:46'),
(32, 'اضافة منتج', 'web', '2024-03-19 16:47:46', '2024-03-19 16:47:46'),
(33, 'تعديل منتج', 'web', '2024-03-19 16:47:46', '2024-03-19 16:47:46'),
(34, 'حذف منتج', 'web', '2024-03-19 16:47:46', '2024-03-19 16:47:46'),
(35, 'اضافة قسم', 'web', '2024-03-19 16:47:46', '2024-03-19 16:47:46'),
(36, 'تعديل قسم', 'web', '2024-03-19 16:47:46', '2024-03-19 16:47:46'),
(37, 'حذف قسم', 'web', '2024-03-19 16:47:46', '2024-03-19 16:47:46'),
(38, 'الاشعارات', 'web', '2024-03-19 16:47:46', '2024-03-19 16:47:46');

-- --------------------------------------------------------

--
-- بنية الجدول `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Product_name` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'owner', 'web', '2024-03-19 16:47:46', '2024-03-19 16:47:46');

-- --------------------------------------------------------

--
-- بنية الجدول `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1);

-- --------------------------------------------------------

--
-- بنية الجدول `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_name` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `role_name`, `status`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, ' yasser darwish', 'admin@gmail.com', NULL, '[\"owner\"]', 'مفعل', '$2y$10$pRAj1Yt.KDvzc0VoWI3lAu9TYLHVYzvCbKugE.kK9zwo2.sGKm8Aq', NULL, '2024-03-19 16:47:46', '2024-03-19 16:47:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_section_id_foreign` (`section_id`);

--
-- Indexes for table `invoices_attachments`
--
ALTER TABLE `invoices_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_attachments_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `invoices_details`
--
ALTER TABLE `invoices_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_details_id_invoice_foreign` (`id_invoice`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_section_id_foreign` (`section_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices_attachments`
--
ALTER TABLE `invoices_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices_details`
--
ALTER TABLE `invoices_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- القيود للجدول `invoices_attachments`
--
ALTER TABLE `invoices_attachments`
  ADD CONSTRAINT `invoices_attachments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- القيود للجدول `invoices_details`
--
ALTER TABLE `invoices_details`
  ADD CONSTRAINT `invoices_details_id_invoice_foreign` FOREIGN KEY (`id_invoice`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- القيود للجدول `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- القيود للجدول `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- القيود للجدول `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- القيود للجدول `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

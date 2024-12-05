-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-12-2024 a las 11:41:10
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `alumnet`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnes`
--

CREATE TABLE `alumnes` (
  `id_alumne` bigint(20) UNSIGNED NOT NULL,
  `id_usuari` bigint(20) UNSIGNED NOT NULL,
  `curs` varchar(255) NOT NULL,
  `classe` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id_categoria` bigint(20) UNSIGNED NOT NULL,
  `nom_categoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grup`
--

CREATE TABLE `grup` (
  `id_grup` bigint(20) UNSIGNED NOT NULL,
  `nom_grup` varchar(100) NOT NULL,
  `num_membres` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mentors`
--

CREATE TABLE `mentors` (
  `id_mentor` bigint(20) UNSIGNED NOT NULL,
  `id_usuari` bigint(20) UNSIGNED NOT NULL,
  `especialitat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_12_02_095634_create_personal_access_tokens_table', 1),
(5, '2024_12_02_112507_create_table_users', 1),
(6, '2024_12_02_120717_create_table_alumnes', 1),
(7, '2024_12_02_121134_create_table_mentors', 1),
(8, '2024_12_02_121411_create_table_professors', 1),
(9, '2024_12_03_084147_create_table_publicacions', 1),
(10, '2024_12_03_090118_create_table_categories', 1),
(11, '2024_12_03_090236_create_table_grup', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `professors`
--

CREATE TABLE `professors` (
  `id_professor` bigint(20) UNSIGNED NOT NULL,
  `id_usuari` bigint(20) UNSIGNED NOT NULL,
  `departament` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacions`
--

CREATE TABLE `publicacions` (
  `id_publicacio` bigint(20) UNSIGNED NOT NULL,
  `titol` varchar(100) NOT NULL,
  `contingut` text NOT NULL,
  `id_usuari` bigint(20) UNSIGNED NOT NULL,
  `estat` enum('activa','inactiva') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `publicacions`
--

INSERT INTO `publicacions` (`id_publicacio`, `titol`, `contingut`, `id_usuari`, `estat`, `created_at`, `updated_at`) VALUES
(1, 'Classes de reforç per a Matemàtiques', 'Ofereixo classes particulars de reforç en Matemàtiques per a alumnes de grau mitjà. Sessions personalitzades per superar dificultats.', 1, 'activa', '2024-12-05 08:51:27', '2024-12-05 08:51:27'),
(2, 'Anglès per a alumnes de grau mitjà', 'Professor amb experiència ofereix classes d\'anglès per millorar la comprensió oral i escrita.', 2, 'activa', '2024-12-05 08:51:27', '2024-12-05 08:51:27'),
(3, 'Reforç en Ciències Naturals', 'Classes particulars de Ciències Naturals per a alumnes que necessiten reforçar conceptes clau del temari.', 3, 'activa', '2024-12-05 08:51:27', '2024-12-05 08:51:27'),
(4, 'Classes de Llengua Catalana', 'Millora la teva comprensió i expressió en català amb aquestes classes especialitzades.', 4, 'activa', '2024-12-05 08:51:27', '2024-12-05 08:51:27'),
(5, 'Introducció a la Programació', 'Aprèn els conceptes bàsics de programació amb classes pràctiques per a alumnes de grau mitjà.', 5, 'activa', '2024-12-05 08:51:27', '2024-12-05 08:51:27'),
(6, 'Preparació per a exàmens', 'T\'ajudem a preparar-te per als exàmens amb tècniques d\'estudi i reforç específic.', 6, 'activa', '2024-12-05 08:51:27', '2024-12-05 08:51:27'),
(7, 'Suport en Física i Química', 'Classes adaptades per comprendre i aplicar conceptes de Física i Química.', 7, 'activa', '2024-12-05 08:51:27', '2024-12-05 08:51:27'),
(8, 'Aprèn a fer treballs en equip', 'Sessions per millorar habilitats en treball en equip i projectes col·laboratius.', 8, 'activa', '2024-12-05 08:51:27', '2024-12-05 08:51:27'),
(9, 'Classes pràctiques de Tecnologia', 'Explora conceptes de tecnologia amb classes pràctiques i adaptades.', 9, 'activa', '2024-12-05 08:51:27', '2024-12-05 08:51:27'),
(10, 'Habilitats comunicatives', 'Millora les teves habilitats per parlar en públic amb aquestes sessions personalitzades.', 10, 'activa', '2024-12-05 08:51:27', '2024-12-05 08:51:27'),
(11, 'Classes de reforç en Història', 'Professor qualificat ofereix classes de reforç en Història per a grau mitjà.', 11, 'activa', '2024-12-05 08:51:27', '2024-12-05 08:51:27'),
(12, 'Reforç per a projectes escolars', 'Ajuda en l\'organització i desenvolupament de projectes acadèmics.', 12, 'activa', '2024-12-05 08:51:27', '2024-12-05 08:51:27'),
(13, 'Tècniques de memòria i estudi', 'Aprèn tècniques efectives per retenir informació i estudiar millor.', 13, 'activa', '2024-12-05 08:51:27', '2024-12-05 08:51:27'),
(14, 'Suport en Economia', 'Classes d\'economia per entendre conceptes bàsics i avançats.', 14, 'activa', '2024-12-05 08:51:27', '2024-12-05 08:51:27'),
(15, 'Classes de reforç en Dibuix Tècnic', 'Millora les teves habilitats en dibuix tècnic amb un professor especialitzat.', 15, 'activa', '2024-12-05 08:51:27', '2024-12-05 08:51:27'),
(16, 'Orientació acadèmica', 'Ajuda per escollir les opcions acadèmiques més adequades segons les teves habilitats.', 16, 'activa', '2024-12-05 08:51:27', '2024-12-05 08:51:27'),
(17, 'Classes d\'Informàtica', 'Aprèn a utilitzar programes essencials per a la vida acadèmica i laboral.', 17, 'activa', '2024-12-05 08:51:27', '2024-12-05 08:51:27'),
(18, 'Classes per millorar la lectura', 'Ajuda personalitzada per millorar la velocitat i comprensió lectora.', 18, 'activa', '2024-12-05 08:51:27', '2024-12-05 08:51:27'),
(19, 'Reforç per a Geografia', 'Classes dinàmiques per comprendre i aplicar conceptes de Geografia.', 19, 'activa', '2024-12-05 08:51:27', '2024-12-05 08:51:27'),
(20, 'Introducció al Màrqueting Digital', 'Coneix les bases del màrqueting digital amb classes adaptades.', 20, 'activa', '2024-12-05 08:51:27', '2024-12-05 08:51:27'),
(21, 'fsdf', 'sdf', 13, 'activa', '2024-12-05 08:51:44', '2024-12-05 08:51:44'),
(22, 'dsd', 'sdsd', 15, 'inactiva', '2024-12-05 09:40:21', '2024-12-05 09:40:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('irJxW6qsgBxIBIhbQVfOSxKohIrTUAw6C0GELE2P', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia3ZieUN4WHBmYVFxU2EyUjN2Mk13UnBWVTRJNjZwa1VNWlJFQnFKTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wdWJsaWNhY2lvbnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1733395221);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Estudiante','Profesor','Mentor','Admin') NOT NULL,
  `phone` char(9) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris`
--

CREATE TABLE `usuaris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(100) NOT NULL,
  `cognom1` varchar(100) NOT NULL,
  `cognom2` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `rol` enum('alumne','mentor','professor') NOT NULL,
  `data_naixement` date DEFAULT NULL,
  `telefon` varchar(9) DEFAULT NULL,
  `foto_profile` varchar(255) DEFAULT NULL,
  `biografia` text DEFAULT NULL,
  `major` enum('si','no') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuaris`
--

INSERT INTO `usuaris` (`id`, `nom`, `cognom1`, `cognom2`, `email`, `password`, `rol`, `data_naixement`, `telefon`, `foto_profile`, `biografia`, `major`, `created_at`, `updated_at`) VALUES
(1, 'Joan', 'Garcia', 'Fernandez', 'joan.garcia@example.com', 'hashed_password_1', 'alumne', '1988-04-11', '675504367', 'profile1.jpg', 'Biograf de Joan.', 'si', '2024-12-03 09:48:31', '2024-12-03 09:48:31'),
(2, 'Maria', 'Fernandez', 'Martinez', 'joan.fernandez@example.com', 'hashed_password_2', 'professor', '2000-11-29', '674312486', 'profile2.jpg', 'Biograf de Maria.', 'si', '2024-12-03 09:48:31', '2024-12-03 09:48:31'),
(3, 'Carlos', 'Martinez', 'Diaz', 'maria.garcia@example.com', 'hashed_password_3', 'mentor', '1998-11-17', '634499626', 'profile3.jpg', 'Biografía de Carlos.', 'no', '2024-12-03 09:48:31', '2024-12-03 09:48:31'),
(4, 'Laura', 'Diaz', 'Soto', 'maria.fernandez@example.com', 'hashed_password_4', 'mentor', '2001-01-14', '610852617', 'profile4.jpg', 'Biografía de Laura.', 'si', '2024-12-03 09:48:31', '2024-12-03 09:48:31'),
(5, 'Andrés', 'Soto', 'Lopez', 'carlos.garcia@example.com', 'hashed_password_5', 'alumne', '1983-12-10', '654901194', 'profile5.jpg', 'Biografía de Andrés.', 'si', '2024-12-03 09:48:31', '2024-12-03 09:48:31'),
(6, 'Sofia', 'Lopez', 'Navarro', 'carlos.fernandez@example.com', 'hashed_password_6', 'professor', '1990-05-29', '658305973', 'profile6.jpg', 'Biografía de Sofia.', 'si', '2024-12-03 09:48:31', '2024-12-03 09:48:31'),
(7, 'Lucas', 'Navarro', 'Torres', 'laura.garcia@example.com', 'hashed_password_7', 'alumne', '1985-04-02', '606927279', 'profile7.jpg', 'Biografía de Lucas.', 'no', '2024-12-03 09:48:31', '2024-12-03 09:48:31'),
(8, 'Ana', 'Torres', 'Ortega', 'laura.fernandez@example.com', 'hashed_password_8', 'mentor', '1986-06-02', '628163575', 'profile8.jpg', 'Biografía de Ana.', 'no', '2024-12-03 09:48:31', '2024-12-03 09:48:31'),
(9, 'Martín', 'Ortega', 'Sanchez', 'andrés.garcia@example.com', 'hashed_password_9', 'mentor', '1988-06-02', '691311351', 'profile9.jpg', 'Biografía de Martín.', 'no', '2024-12-03 09:48:31', '2024-12-03 09:48:31'),
(10, 'Clara', 'Sanchez', 'Garcia', 'andrés.fernandez@example.com', 'hashed_password_10', 'mentor', '1986-02-10', '627183499', 'profile10.jpg', 'Biografía de Clara.', 'no', '2024-12-03 09:48:31', '2024-12-03 09:48:31'),
(11, 'Pedro', 'Garcia', 'Fernandez', 'sofia.garcia@example.com', 'hashed_password_11', 'professor', '1993-08-11', '625835464', 'profile11.jpg', 'Biografía de Pedro.', 'no', '2024-12-03 09:48:31', '2024-12-03 09:48:31'),
(12, 'Elena', 'Fernandez', 'Martinez', 'sofia.fernandez@example.com', 'hashed_password_12', 'professor', '1988-06-28', '653545287', 'profile12.jpg', 'Biografía de Elena.', 'si', '2024-12-03 09:48:31', '2024-12-03 09:48:31'),
(13, 'Diego', 'Martinez', 'Diaz', 'lucas.garcia@example.com', 'hashed_password_13', 'professor', '1999-07-17', '653978482', 'profile13.jpg', 'Biografía de Diego.', 'no', '2024-12-03 09:48:31', '2024-12-03 09:48:31'),
(14, 'Marta', 'Diaz', 'Soto', 'lucas.fernandez@example.com', 'hashed_password_14', 'professor', '1994-12-04', '604522913', 'profile14.jpg', 'Biografía de Marta.', 'si', '2024-12-03 09:48:31', '2024-12-03 09:48:31'),
(15, 'Daniel', 'Soto', 'Lopez', 'ana.garcia@example.com', 'hashed_password_15', 'professor', '2004-01-31', '681691557', 'profile15.jpg', 'Biografía de Daniel.', 'si', '2024-12-03 09:48:31', '2024-12-03 09:48:31'),
(16, 'Julia', 'Lopez', 'Navarro', 'ana.fernandez@example.com', 'hashed_password_16', 'alumne', '2003-05-15', '623708242', 'profile16.jpg', 'Biografía de Julia.', 'no', '2024-12-03 09:48:31', '2024-12-03 09:48:31'),
(17, 'Fernando', 'Navarro', 'Torres', 'martín.garcia@example.com', 'hashed_password_17', 'alumne', '1990-09-08', '681553641', 'profile17.jpg', 'Biografía de Fernando.', 'si', '2024-12-03 09:48:31', '2024-12-03 09:48:31'),
(18, 'Raquel', 'Torres', 'Ortega', 'martín.fernandez@example.com', 'hashed_password_18', 'mentor', '1992-01-12', '657000569', 'profile18.jpg', 'Biografía de Raquel.', 'no', '2024-12-03 09:48:31', '2024-12-03 09:48:31'),
(19, 'Pablo', 'Ortega', 'Sanchez', 'clara.garcia@example.com', 'hashed_password_19', 'professor', '1993-01-15', '639484423', 'profile19.jpg', 'Biografía de Pablo.', 'si', '2024-12-03 09:48:31', '2024-12-03 09:48:31'),
(20, 'Isabel', 'Sanchez', 'Garcia', 'clara.fernandez@example.com', 'hashed_password_20', 'mentor', '1990-01-11', '672823340', 'profile20.jpg', 'Biografía de Isabel.', 'no', '2024-12-03 09:48:31', '2024-12-03 09:48:31');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnes`
--
ALTER TABLE `alumnes`
  ADD PRIMARY KEY (`id_alumne`),
  ADD KEY `alumnes_id_usuari_foreign` (`id_usuari`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `grup`
--
ALTER TABLE `grup`
  ADD PRIMARY KEY (`id_grup`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mentors`
--
ALTER TABLE `mentors`
  ADD PRIMARY KEY (`id_mentor`),
  ADD KEY `mentors_id_usuari_foreign` (`id_usuari`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `professors`
--
ALTER TABLE `professors`
  ADD PRIMARY KEY (`id_professor`),
  ADD KEY `professors_id_usuari_foreign` (`id_usuari`);

--
-- Indices de la tabla `publicacions`
--
ALTER TABLE `publicacions`
  ADD PRIMARY KEY (`id_publicacio`),
  ADD KEY `publicacions_id_usuari_foreign` (`id_usuari`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `usuaris`
--
ALTER TABLE `usuaris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuaris_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnes`
--
ALTER TABLE `alumnes`
  MODIFY `id_alumne` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id_categoria` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grup`
--
ALTER TABLE `grup`
  MODIFY `id_grup` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mentors`
--
ALTER TABLE `mentors`
  MODIFY `id_mentor` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `professors`
--
ALTER TABLE `professors`
  MODIFY `id_professor` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `publicacions`
--
ALTER TABLE `publicacions`
  MODIFY `id_publicacio` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuaris`
--
ALTER TABLE `usuaris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnes`
--
ALTER TABLE `alumnes`
  ADD CONSTRAINT `alumnes_id_usuari_foreign` FOREIGN KEY (`id_usuari`) REFERENCES `usuaris` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `mentors`
--
ALTER TABLE `mentors`
  ADD CONSTRAINT `mentors_id_usuari_foreign` FOREIGN KEY (`id_usuari`) REFERENCES `usuaris` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `professors`
--
ALTER TABLE `professors`
  ADD CONSTRAINT `professors_id_usuari_foreign` FOREIGN KEY (`id_usuari`) REFERENCES `usuaris` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `publicacions`
--
ALTER TABLE `publicacions`
  ADD CONSTRAINT `publicacions_id_usuari_foreign` FOREIGN KEY (`id_usuari`) REFERENCES `usuaris` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

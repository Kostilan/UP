-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 15 2024 г., 11:41
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `pro-chitai`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE `authors` (
  `id` bigint UNSIGNED NOT NULL,
  `surname_author` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_author` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id`, `surname_author`, `name_author`) VALUES
(3, 'Аурора', 'Бел'),
(4, ' Носов ', 'Николай'),
(5, 'Нейстайко', 'Всеволов');

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `id` bigint UNSIGNED NOT NULL,
  `title_book` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` bigint UNSIGNED NOT NULL,
  `publication_id` bigint UNSIGNED NOT NULL,
  `year_publication` int NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditorium` int NOT NULL,
  `pages` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `title_book`, `photo`, `document`, `author_id`, `publication_id`, `year_publication`, `description`, `auditorium`, `pages`, `created_at`, `updated_at`) VALUES
(9, 'Неукротимый', 'neukrotimyj-lp_353370.jpg', 'Aurora_Bell_Neukrotimyi_(LP)_Litmir.net_bid211684_b1e99.pdf', 3, 4, 2014, 'Это не история любви. Это история о любви, в которой что-то пошло не так.', 18, 70, '2024-04-11 12:39:51', '2024-04-11 12:39:51'),
(10, 'Заплатка', 'zaplatka_327961.jpg', 'Nosov_Zaplatka_RuLit_Me_327961.pdf', 4, 5, 1999, 'Рассказ Н. Носова с иллюстрациями Е. Васильева для дошкольного возраста.', 6, 14, '2024-04-11 15:53:39', '2024-04-11 15:53:39'),
(11, 'Тореадоры из Васюковки', 'toreadory-iz-vasyukovki_279602.jpg', 'Nestaiko_Vsevolod_Toreadory_iz_Vasukovkibr_(Povesti)_Litmir.net_653845_e4d17.pdf', 5, 5, 2013, 'Решением Международного совета по детской и юношеской литературе эта книга в 1979 году внесена в почетный список Андерсена как одно из \"выдающихся произведений современной детской литературы\".\n\n\n', 6, 433, '2024-04-11 19:53:42', '2024-04-11 19:53:42'),
(12, 'Gjg', 'srOeV711JFlkBdbRGonFM60hYev23Y8ORPlq3Uki.png', 'AF2qdkwrdfAb5GxitKoh0Ssv2WrKLdZvRZutIziw.pdf', 4, 4, 1999, 'апв', 11, 122, '2024-04-16 05:37:18', '2024-04-16 05:37:18'),
(13, 'Неукротимый', 'neukrotimyj-lp_353370.jpg', 'Aurora_Bell_Neukrotimyi_(LP)_Litmir.net_bid211684_b1e99.pdf', 3, 4, 2014, 'Это не история любви. Это история о любви, в которой что-то пошло не так.', 18, 70, '2024-04-11 12:39:51', '2024-04-11 12:39:51'),
(14, 'Заплатка', 'zaplatka_327961.jpg', 'Nosov_Zaplatka_RuLit_Me_327961.pdf', 4, 5, 1999, 'Рассказ Н. Носова с иллюстрациями Е. Васильева для дошкольного возраста.', 6, 14, '2024-04-11 15:53:39', '2024-04-11 15:53:39'),
(15, 'Тореадоры из Васюковки', 'toreadory-iz-vasyukovki_279602.jpg', 'Nestaiko_Vsevolod_Toreadory_iz_Vasukovkibr_(Povesti)_Litmir.net_653845_e4d17.pdf', 5, 5, 2013, 'Решением Международного совета по детской и юношеской литературе эта книга в 1979 году внесена в почетный список Андерсена как одно из \"выдающихся произведений современной детской литературы\".\r\n\r\n\r\n', 6, 433, '2024-04-11 19:53:42', '2024-04-11 19:53:42'),
(16, 'Gjg', 'srOeV711JFlkBdbRGonFM60hYev23Y8ORPlq3Uki.png', 'AF2qdkwrdfAb5GxitKoh0Ssv2WrKLdZvRZutIziw.pdf', 4, 4, 1999, 'апв', 11, 122, '2024-04-16 05:37:18', '2024-04-16 05:37:18');

-- --------------------------------------------------------

--
-- Структура таблицы `book_marks`
--

CREATE TABLE `book_marks` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `book_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `book_marks`
--

INSERT INTO `book_marks` (`id`, `user_id`, `book_id`, `created_at`, `updated_at`) VALUES
(6, 3, 10, '2024-04-14 03:51:35', '2024-04-14 03:51:35'),
(7, 5, 10, '2024-04-16 08:00:09', '2024-04-16 08:00:09');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `title_category` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_category` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `title_category`, `description_category`) VALUES
(3, 'Научные ', 'Научные книги представляют собой тексты, написанные с учетом академических стандартов и научной методологии. Эти книги часто предназначены для специалистов в определенной области знаний, а также для широкой аудитории, заинтересованной в научных исследованиях и открытиях. '),
(4, 'Учебные', 'Учебные книги представляют собой литературу, разработанную для обучения студентов и обучающихся в различных образовательных учреждениях или самообразования. Они предназначены для передачи основных концепций, теорий и практических навыков в определенной области знаний'),
(5, 'Дневники', 'Категория \"Дневники и мемуары\" включает в себя литературные произведения, основанные на личных впечатлениях, переживаниях и воспоминаниях автора. Эти книги могут быть как официальными мемуарами известных личностей, так и частными дневниками, заполненными повседневными записями и рассказами.');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `evaluation` int NOT NULL,
  `comment_text` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `book_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `evaluation`, `comment_text`, `user_id`, `book_id`, `created_at`, `updated_at`) VALUES
(3, 5, 'Книга мне понравилась', 3, 11, '2024-04-14 02:29:05', '2024-04-14 02:29:05'),
(4, 4, 'на один раз', 3, 9, '2024-04-15 01:32:01', '2024-04-15 01:32:01'),
(5, 5, 'Книга прекрасна', 4, 11, '2024-04-15 01:32:01', '2024-04-15 01:32:01'),
(6, 2, 'Книга мне не понравилась', 3, 10, '2024-04-16 04:44:10', '2024-04-16 04:46:10'),
(7, 5, 'Хорошая книга', 4, 9, '2024-04-16 07:55:35', '2024-04-16 07:55:59');

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE `genres` (
  `id` bigint UNSIGNED NOT NULL,
  `title_genre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_genre` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`id`, `title_genre`, `description_genre`) VALUES
(1, 'Фэнтези', 'Фэнтези – это жанр, в котором происходят волшебные или фантастические события. Он часто включает в себя мифологические элементы, магию, сказочные существа и фантастические миры.'),
(2, 'Детектив', 'Детектив – это жанр, в котором основное внимание уделяется разгадке загадок и преступлений. Обычно включает в себя персонажа-детектива или группу детективов, которые расследуют преступления и пытаются найти виновных.'),
(3, 'Роман', 'Роман – это широкий жанр, охватывающий широкий спектр литературных произведений, фокусирующихся на человеческих отношениях и жизненных историях персонажей. Романы могут включать в себя элементы любви, приключений, драмы и многого другого.'),
(4, 'Ужасы', 'Жанр ужасов стремится вызвать чувство страха, тревоги и напряжения у читателей. Этот жанр включает в себя элементы мистики, мрачной атмосферы, паранормальных явлений и угроз из потусторонних миров.'),
(5, 'Исторический роман', 'Исторический роман основан на реальных исторических событиях, периодах или личностях, но с добавлением вымышленных персонажей или сюжетных линий. Часто это позволяет авторам создавать увлекательные истории, в которых исторические факты переплетаются с вымышленными событиями.'),
(6, 'Детские', 'Это литература, специально предназначенная для детей до 16 лет и осуществляющая языком художественных образов задачи воспитания и образования детей. Помимо этого существует понятие «детское чтение», в сферу которого могут входить произведения, изначально предназначенные авторами для взрослых, такие как знаменитые сказки А. С. Пушкина, Шарля Перро, В. Гауфа, Х. К. Андерсена, братьев Гримм, а также «Робинзон Крузо» Даниэля Дефо.');

-- --------------------------------------------------------

--
-- Структура таблицы `link_book_categories`
--

CREATE TABLE `link_book_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `book_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `link_book_categories`
--

INSERT INTO `link_book_categories` (`id`, `book_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 9, 5, '2024-04-15 01:37:23', '2024-04-15 01:37:23'),
(2, 10, 4, '2024-04-15 01:37:23', '2024-04-15 01:37:23'),
(3, 11, 4, '2024-04-15 01:37:51', '2024-04-15 01:37:51');

-- --------------------------------------------------------

--
-- Структура таблицы `link_book_genre`
--

CREATE TABLE `link_book_genre` (
  `id` bigint UNSIGNED NOT NULL,
  `book_id` bigint UNSIGNED NOT NULL,
  `genre_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `link_book_genre`
--

INSERT INTO `link_book_genre` (`id`, `book_id`, `genre_id`, `created_at`, `updated_at`) VALUES
(9, 10, 6, '2024-04-12 04:26:08', '2024-04-12 04:26:08'),
(10, 11, 6, '2024-04-12 04:26:08', '2024-04-12 04:26:08'),
(11, 9, 2, '2024-04-12 04:26:59', '2024-04-12 04:26:59'),
(12, 9, 3, '2024-04-12 04:26:59', '2024-04-12 04:26:59');

-- --------------------------------------------------------

--
-- Структура таблицы `publications`
--

CREATE TABLE `publications` (
  `id` bigint UNSIGNED NOT NULL,
  `title_publications` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `publications`
--

INSERT INTO `publications` (`id`, `title_publications`) VALUES
(4, 'Метелица Ника'),
(5, 'Детская литература'),
(6, 'Книголюб');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `evaluation` int NOT NULL,
  `review_text` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `book_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `evaluation`, `review_text`, `user_id`, `book_id`, `created_at`, `updated_at`) VALUES
(2, 5, 'Хорошая книга для детей', 3, 11, '2024-04-14 22:25:55', '2024-04-14 22:25:55'),
(3, 4, 'Почитать на один раз', 5, 11, '2024-04-14 22:27:15', '2024-04-14 22:27:15'),
(4, 3, 'Книженция на ночь', 6, 10, '2024-04-14 22:28:17', '2024-04-14 22:28:17');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `title_role` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `title_role`) VALUES
(1, 'Сотрудник'),
(2, 'Клиент');

-- --------------------------------------------------------

--
-- Структура таблицы `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `subscription_type_id` bigint UNSIGNED NOT NULL,
  `subscription_start_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `user_id`, `subscription_type_id`, `subscription_start_date`) VALUES
(26, 5, 1, '2024-04-16'),
(27, 5, 1, '2024-04-16');

-- --------------------------------------------------------

--
-- Структура таблицы `type_subscriptions`
--

CREATE TABLE `type_subscriptions` (
  `id` bigint UNSIGNED NOT NULL,
  `title_subscription_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost_title_subscription` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `type_subscriptions`
--

INSERT INTO `type_subscriptions` (`id`, `title_subscription_type`, `cost_title_subscription`) VALUES
(1, 'Месяц', 399),
(2, 'Полгода', 999),
(3, 'Год', 1890);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `surname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patronymic` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `phone` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `surname`, `name`, `patronymic`, `login`, `password`, `email`, `birthday`, `phone`, `role_id`, `created_at`, `updated_at`) VALUES
(3, 'Корешков', 'Иван', 'Витальевич', 'Vanya', '$2y$10$KTDPCWhgflFLQQcn/UmPp.Ckcb6NXaq0Fo71tbLg5ROkznO65Q7wi', 'vanya@mail.ru', '2000-06-29', '89745195874', 2, '2024-04-11 07:02:04', '2024-04-11 07:02:04'),
(4, 'Горнов', 'Олег', 'Витальевич', 'admin', '$2y$10$HXdEitXbmGlwmPSUPuCY.uHHIxS9MonTdx/JOvVWA9rjAyqm05cc6', 'admin@mail.ru', '1998-08-21', '89674588521', 1, '2024-04-12 01:32:45', '2024-04-12 01:32:45'),
(5, 'Ефимов', 'Георгий', 'Александрович', 'Комаров', '$2y$10$IZczMOqKjdfdtgzUaSpIOOHXDQO.dE.3nd7QMuXtqJFETnW0c0xbq', 'Alister@mail.ru', '2001-12-12', '89876321478', 2, '2024-04-12 12:09:00', '2024-04-12 13:27:33'),
(6, 'Зверев', 'Львов', 'Анатольевич', 'Lev', '$2y$10$ksw/xmbw7.dnWMIYz2/Z.ujzetJ2zYiaZ3aO109HBL05KLFEhqbSq', 'lev@mail.ru', '1999-02-22', '89874587541', 2, '2024-04-14 21:56:43', '2024-04-14 21:56:43');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `books_author_id_foreign` (`author_id`),
  ADD KEY `books_publication_id_foreign` (`publication_id`);

--
-- Индексы таблицы `book_marks`
--
ALTER TABLE `book_marks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_marks_user_id_foreign` (`user_id`),
  ADD KEY `book_marks_book_id_foreign` (`book_id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_book_id_foreign` (`book_id`);

--
-- Индексы таблицы `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `link_book_categories`
--
ALTER TABLE `link_book_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `link_book_category_book_id_foreign` (`book_id`),
  ADD KEY `link_book_category_category_id_foreign` (`category_id`);

--
-- Индексы таблицы `link_book_genre`
--
ALTER TABLE `link_book_genre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `link_book_genre_book_id_foreign` (`book_id`),
  ADD KEY `link_book_genre_genre_id_foreign` (`genre_id`);

--
-- Индексы таблицы `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_book_id_foreign` (`book_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriptions_user_id_foreign` (`user_id`),
  ADD KEY `subscriptions_subscription_type_id_foreign` (`subscription_type_id`);

--
-- Индексы таблицы `type_subscriptions`
--
ALTER TABLE `type_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `authors`
--
ALTER TABLE `authors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `book_marks`
--
ALTER TABLE `book_marks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `genres`
--
ALTER TABLE `genres`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `link_book_categories`
--
ALTER TABLE `link_book_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `link_book_genre`
--
ALTER TABLE `link_book_genre`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `publications`
--
ALTER TABLE `publications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `type_subscriptions`
--
ALTER TABLE `type_subscriptions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`),
  ADD CONSTRAINT `books_publication_id_foreign` FOREIGN KEY (`publication_id`) REFERENCES `publications` (`id`);

--
-- Ограничения внешнего ключа таблицы `book_marks`
--
ALTER TABLE `book_marks`
  ADD CONSTRAINT `book_marks_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `book_marks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `link_book_categories`
--
ALTER TABLE `link_book_categories`
  ADD CONSTRAINT `link_book_category_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `link_book_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Ограничения внешнего ключа таблицы `link_book_genre`
--
ALTER TABLE `link_book_genre`
  ADD CONSTRAINT `link_book_genre_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `link_book_genre_genre_id_foreign` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`);

--
-- Ограничения внешнего ключа таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_subscription_type_id_foreign` FOREIGN KEY (`subscription_type_id`) REFERENCES `type_subscriptions` (`id`),
  ADD CONSTRAINT `subscriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

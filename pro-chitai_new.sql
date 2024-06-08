-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 06 2024 г., 22:40
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
(8, 'Беляев', 'Александр'),
(9, 'Пушкин', 'Александр'),
(10, 'Андерсен', 'Ганс Христиан'),
(11, 'Вересаев', 'Викентий'),
(12, 'Карамзин', 'Николай'),
(13, 'Достоевский', 'Федор');

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
(23, 'Мертвая голова', 'KB1xN6gOWqOALhAiwoPS6FaV3lXAXCWDFHPxlr1O.png', 'eFC4W2s1g51AvA22OGnmtw5N4BpbYzZexjsA40Os.pdf', 8, 4, 2012, 'Один из ранних научно-фантастических рассказов Беляева, близких по жанру географическо-приключенческой литературе. Впервые опубликован в 1928 года. Сюжет рассказа вдохновлен газетным сообщением о найденном где-то в дебрях Амазонии одичавшем человеке.\r\nНазвание рассказа несет двойную нагрузку: с одной стороны, это наименование редкого вида южноамериканских бабочек, в погоне за которой и заблудился в джунглях герой рассказа, а с другой — это символ утраты человеком своей человеческой сущности в социальном безмолвии необитаемых лесов.', 12, 74, '2024-05-29 19:03:48', '2024-06-04 01:50:57'),
(24, 'Сказка о рыбаке и рыбке', 'pX00ghcO0RJsgkdjjyd9H8wkiRxgTgdThDTbh6OZ.jpg', 'kC2umWJ8zbG9NDe0Aj0JvvH8Xwo2563Bnt9b7zlv.pdf', 9, 5, 2010, 'Жил старик со своею старухой. У самого синего моря. Однажды старик закинул невод и поймал Золотую рыбку. И обещала она выполнить старику три его желания, если он ее отпустит.', 6, 6, '2024-05-29 19:09:43', '2024-05-29 23:32:10'),
(25, 'Сказка о попе и о работнике его Балде', 'rsbAzXhS6XzbFuwtt3COyBz27ZOcGU4E2LMEVEWs.jpg', 'DzVZ5Oa0WGLMkNYOYoI766yViWqMH43edPmYWH0z.pdf', 9, 5, 2015, 'Сказка Александра Сергеевича Пушкина для детей дошкольного возраста.', 6, 5, '2024-05-29 19:49:09', '2024-05-29 23:33:30'),
(26, 'Русалочка', '6NXJgoTiKZBAli4HJtT1BOpxp5nZNAwQ4z563AYS.jpg', 'Ztd9udjEaQzBRSDDfgTzYfiVoVRZ8gNUk2hjvqY2.pdf', 10, 5, 2007, 'Великий сказочник Х. К. Андерсен написал эту легендарную историю на берегу моря, в далекой Дании. Это сказка про Русалочку, которая бесстрашно окунается в океан любви, бескрайний и опасный, как сама жизнь. ', 6, 26, '2024-05-29 20:12:50', '2024-05-29 23:35:27'),
(27, 'Записки врача', 'FhP1V03hIHRw66fpZelPeND6AdLBbtq3rMYjUprj.jpg', 'ldvjdTfOrxaLmXvyA0VxAjdFk9CJ08JZ2N381YwD.pdf', 11, 4, 2012, 'Эта автобиографическая повесть Вересаева принесла ему всероссийскую известность и вызвала бурю обсуждений и даже осуждений в адрес автора. Вивисекция, опыты над живыми людьми, материальное положение врачей, врачебные ошибки — эти и многие другие вопросы, которые ранее замалчивались, Вересаев открыто и беспристрастно передаёт на суд читателю, обнажая множество тайн и пороков врачебной деятельности.', 16, 394, '2024-05-29 20:32:46', '2024-05-29 23:39:25'),
(28, 'Идиот', 'LXV5rxwZSbSyFG0aKCwZIh2ATvNebk92qqyMvqqr.png', 'oFTOwHlAgk61FqU6d5gx4YkroiAe1wTvd6EAnWL5.pdf', 13, 4, 2018, 'Роман, в котором творческие принципы Достоевского воплощаются в полной мере, а удивительное владение сюжетом достигает подлинного расцвета. Яркая и почти болезненно талантливая история несчастного князя Мышкина, неистового Парфена Рогожина и отчаявшейся Настасьи Филипповны, много раз экранизированная и поставленная на сцене.', 16, 994, '2024-05-29 21:15:16', '2024-05-29 23:43:40'),
(29, 'Преступление и наказание', 'u23MznJRFMD0Dt72EhCo4T3DodLRseovQ0zEtNeq.png', 'EgbHICCXHqbTFceUr16KMC2N4MI2YR6fdyepvlcQ.pdf', 13, 4, 2018, 'Роман «Преступление и наказание» Федора Достоевского повествует о бедном студенте Родионе Раскольникове. Родион разработал некую философскую теорию, которая вкупе с бедственным положением, подводит его к грани помешательства. Желая подтвердить свою мысль и получить ответ на один из вечных вопросов человеческого существования, Родион решается переступить нравственные законы и совершить преступление. Роман о духовной трансформации и муках человека, решившегося на убийство.', 16, 817, '2024-05-29 21:16:32', '2024-05-30 00:03:11');

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
(8, 3, 24, '2024-05-29 22:07:14', '2024-05-29 22:07:14'),
(11, 3, 25, '2024-06-02 06:37:56', '2024-06-02 06:37:56'),
(12, 3, 26, '2024-06-02 06:38:01', '2024-06-02 06:38:01'),
(13, 3, 27, '2024-06-02 06:38:05', '2024-06-02 06:38:05'),
(14, 3, 28, '2024-06-02 06:38:11', '2024-06-02 06:38:11'),
(15, 3, 29, '2024-06-02 06:38:20', '2024-06-02 06:38:20');

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
(11, 5, 'на один', 3, 24, '2024-05-30 02:49:59', '2024-06-04 07:27:09'),
(12, 5, 'Книга прекрасна', 4, 26, '2024-05-30 02:53:14', '2024-05-30 02:53:14'),
(13, 4, 'Книг хорошая', 9, 23, '2024-05-30 04:49:53', '2024-05-30 04:49:53'),
(14, 4, 'Книг хорошая', 9, 23, '2024-05-30 04:49:53', '2024-05-30 04:49:53'),
(15, 4, 'Книг хорошая', 9, 23, '2024-05-30 04:49:53', '2024-05-30 04:49:53'),
(16, 4, 'Книг хорошая', 9, 23, '2024-05-30 04:49:53', '2024-05-30 04:49:53'),
(17, 4, 'Книг хорошая', 9, 23, '2024-05-30 04:49:53', '2024-05-30 04:49:53'),
(18, 4, 'Книг хорошая', 9, 23, '2024-05-30 04:49:53', '2024-05-30 04:49:53'),
(19, 4, 'Книг хорошая', 9, 23, '2024-05-30 04:49:53', '2024-05-30 04:49:53'),
(20, 4, 'Книг хорошая', 9, 23, '2024-05-30 04:49:53', '2024-05-30 04:49:53'),
(21, 4, 'Книг хорошая', 9, 23, '2024-05-30 04:49:53', '2024-05-30 04:49:53'),
(22, 4, 'Книг хорошая', 9, 23, '2024-05-30 04:49:53', '2024-05-30 04:49:53'),
(23, 4, 'Книг хорошая', 9, 23, '2024-05-30 04:49:53', '2024-05-30 04:49:53'),
(24, 4, 'Книг хорошая', 9, 23, '2024-05-30 04:49:53', '2024-05-30 04:49:53'),
(25, 4, 'Книг хорошая', 9, 23, '2024-05-30 04:49:53', '2024-05-30 04:49:53'),
(26, 4, 'Книг хорошая', 9, 23, '2024-05-30 04:49:53', '2024-05-30 04:49:53'),
(27, 4, 'Книг хорошая', 9, 23, '2024-05-30 04:49:53', '2024-05-30 04:49:53'),
(28, 4, 'Книг хорошая', 9, 23, '2024-05-30 04:49:53', '2024-05-30 04:49:53'),
(30, 5, 'good job!', 3, 23, '2024-06-03 10:41:42', '2024-06-06 00:32:47'),
(31, 2, 'к', 3, 25, '2024-06-03 07:42:47', '2024-06-03 07:42:47'),
(32, 2, 'к3', 3, 27, '2024-06-03 07:43:12', '2024-06-03 07:43:20'),
(33, 3, 'авп', 3, 28, '2024-06-03 07:43:35', '2024-06-03 07:43:35'),
(34, 2, '213', 3, 26, '2024-06-03 07:44:21', '2024-06-03 07:44:21');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
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
(20, 27, 3, '2024-05-29 20:32:46', '2024-05-29 20:32:46'),
(21, 27, 4, '2024-05-29 20:32:46', '2024-05-29 20:32:46'),
(22, 27, 5, '2024-05-29 20:32:46', '2024-05-29 20:32:46');

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
(34, 23, 3, '2024-05-29 19:03:48', '2024-05-29 19:03:48'),
(35, 23, 4, '2024-05-29 19:03:48', '2024-05-29 19:03:48'),
(36, 24, 1, '2024-05-29 19:09:43', '2024-05-29 19:09:43'),
(37, 24, 3, '2024-05-29 19:09:43', '2024-05-29 19:09:43'),
(38, 24, 6, '2024-05-29 19:09:43', '2024-05-29 19:09:43'),
(39, 25, 3, '2024-05-29 19:49:09', '2024-05-29 19:49:09'),
(40, 25, 6, '2024-05-29 19:49:09', '2024-05-29 19:49:09'),
(41, 26, 1, '2024-05-29 20:12:50', '2024-05-29 20:12:50'),
(42, 26, 3, '2024-05-29 20:12:50', '2024-05-29 20:12:50'),
(43, 26, 6, '2024-05-29 20:12:50', '2024-05-29 20:12:50'),
(44, 27, 4, '2024-05-29 20:32:46', '2024-05-29 20:32:46'),
(45, 28, 3, '2024-05-29 21:15:16', '2024-05-29 21:15:16'),
(46, 29, 3, '2024-05-29 21:16:32', '2024-05-29 21:16:32');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `notes`
--

CREATE TABLE `notes` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `book_id` bigint UNSIGNED NOT NULL,
  `page` int NOT NULL,
  `all_pages` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `notes`
--

INSERT INTO `notes` (`id`, `user_id`, `book_id`, `page`, `all_pages`, `created_at`, `updated_at`) VALUES
(2, 3, 23, 2, 74, '2024-06-06 03:47:56', '2024-06-06 13:22:26');

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, 'Корешков', 'Иван', 'Витальевич', 'Vanya', '$2y$10$KTDPCWhgflFLQQcn/UmPp.Ckcb6NXaq0Fo71tbLg5ROkznO65Q7wi', 'vanya@mail.ru', '2000-06-29', '89745195874', 2, '2024-04-11 07:02:04', '2024-06-04 03:58:32'),
(4, 'Горнов', 'Олег', 'Витальевич', 'admin', '$2y$10$HXdEitXbmGlwmPSUPuCY.uHHIxS9MonTdx/JOvVWA9rjAyqm05cc6', 'admin@mail.ru', '1998-08-21', '89674588521', 1, '2024-04-12 01:32:45', '2024-04-12 01:32:45'),
(6, 'Зверев', 'Львов', 'Анатольевич', 'Lev', '$2y$10$ksw/xmbw7.dnWMIYz2/Z.ujzetJ2zYiaZ3aO109HBL05KLFEhqbSq', 'lev@mail.ru', '1999-02-22', '89874587541', 2, '2024-04-14 21:56:43', '2024-04-14 21:56:43'),
(8, 'Ефимов', 'Георгий', 'Александрович', 'Комар', '$2y$10$O2bvHt6q.bQ5AVLg7jWIseMilOWWNmKqhIZIesbQWkKDdarYxPBsS', 'Alister@mail.ru', '2001-12-12', '89876321478', 2, '2024-05-29 22:16:11', '2024-05-29 22:17:24'),
(9, 'Кушнерук', 'Александр', 'Сергеевич', 'Кушнерук', '$2y$10$xDKCyuAloQkaddcHi1CRQ.oopDgVai3nDZ4VqIw3TGiW4VdsRVKA2', 'Sasha_kushneruk@mail.ru', '2004-12-12', '89613690452', 2, '2024-05-30 04:48:46', '2024-05-30 04:48:46');

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
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `book_marks`
--
ALTER TABLE `book_marks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `genres`
--
ALTER TABLE `genres`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `link_book_categories`
--
ALTER TABLE `link_book_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `link_book_genre`
--
ALTER TABLE `link_book_genre`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `publications`
--
ALTER TABLE `publications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
-- Ограничения внешнего ключа таблицы `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notes_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

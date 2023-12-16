<!-- resources/views/layouts/base.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Добавьте здесь ваши общие стили, скрипты и мета-теги -->
</head>
<body>
    <header>
        <!-- Заголовок сайта, навигационное меню и т.д. -->
        <h1>Мой сайт</h1>
        <nav>
            <ul>
                <li><a href="/">Главная</a></li>
                <!-- Добавьте здесь другие ссылки навигации -->
            </ul>
        </nav>
    </header>

    <div id="content">
        @yield('content')
        <!-- Этот блок будет заполняться содержимым из производных шаблонов -->
    </div>

    <footer>
        <!-- Нижний колонтитул сайта -->
        <p>&copy; 2023 Мой сайт. Все права защищены.</p>
    </footer>

    <!-- Добавьте здесь ваши общие скрипты -->
</body>
</html>

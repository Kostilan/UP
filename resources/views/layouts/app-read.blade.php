@php
    use Illuminate\Support\Facades\Auth;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>
</head>

<body>
    <header>
        <nav class="nav">
            <ul class="nav-list">
                    <li>
                        <a href="{{ route('index') }}">Назад</a>
                    </li>
            </ul>
        </nav>
    </header>

    @if (session('success'))
        <div class="">{{ session('success') }}</div>
    @endif
    <div id="content">
        @yield('content')
        <!-- Этот блок будет заполняться содержимым из производных шаблонов -->
    </div>

    <footer class="">
        <!-- Нижний колонтитул сайта -->
        <p>&copy; 2024 Мой сайт. Все права защищены.</p>
    </footer>

    <!-- Добавьте здесь ваши общие скрипты -->
</body>

</html>

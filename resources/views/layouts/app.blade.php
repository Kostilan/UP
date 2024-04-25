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
        <a class="navbar-brand" href="{{ route('index') }}">ПроЧитай</a>
        <nav class="nav">
            <ul class="nav-list">
                @guest
                    <li>
                        <a href="{{ route('index') }}">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('newBooks') }}">Новое</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('popularBooks') }}">Популярное</a>
                    </li>
                    <li class="nav-item">
                        <button class="nav-button" id="loginLink">Авторизация</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-button" id="registerLink">Регистрация</button>
                    </li>
                @endguest
                @auth
                    @if (Auth::user()->role_id == 1)
                        <li>
                            <a href="{{ route('admin') }}">Книги</a>
                        </li>
                        <li>
                            <a href="{{ route('authors') }}">Авторы</a>
                        </li>
                        <li>
                            <a href="{{ route('genres') }}">Жанры</a>
                        </li>
                        <li>
                            <a href="{{ route('categories') }}">Категории</a>
                        </li>
                        <li>
                            <a href="{{ route('publications') }}">Издательства</a>
                        </li>
                    @endif

                    @if (Auth::user()->role_id == 2)
                        <li>
                            <a href="{{ route('index') }}">Главная</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('newBooks') }}">Новое</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('popularBooks') }}">Популярное</a>
                        </li>
                        <li>
                            <a href="{{ route('account') }}">Кабинет</a>
                        </li>
                        <li>
                            <a href="{{ route('subscriptions') }}">Подписка</a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('signout') }}">Выход</a>
                    </li>
                @endauth
            </ul>
        </nav>
    </header>
    <div id="modalRegister" class="modal">
        <div class="modal-wrap">
            <div class="modal-window">
                <button class="modal-close" id="modal-close-register">&#5815;</button>
                <div id="m_body_register" class="container">
                    <h1>Регистрация</h1>
                    <form action="/signUp" method="POST">
                        @csrf
                        <div class="form-div">
                            <label for="surname" class="form-label">Фамилия</label>
                            <input type="text" class="form-input" id="" name="surname">
                            @error('surname')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-div">
                            <label for="name" class="form-label">Имя</label>
                            <input type="text" class="form-input" id="" name="name">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-div">
                            <label for="patronymic" class="form-label">Отчество</label>
                            <input type="text" class="form-input" id="" name="patronymic">
                            @error('patronymic')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-div">
                            <label for="login" class="form-label">Логин</label>
                            <input type="text" class="form-input" id="" name="login">
                            @error('login')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-div">
                            <label for="password" class="form-label">Пароль</label>
                            <input type="password" class="form-input" id="" name="password">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-div">
                            <label for="password_repeat" class="form-label">Повтор пароля</label>
                            <input type="password" class="form-input" id="" name="password_repeat">
                            @error('password_repeat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-div">
                            <label for="email" class="form-label">Почта</label>
                            <input type="email" class="form-input" id="" name="email">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-div">
                            <label for="birthday" class="form-label">Дата рождения</label>
                            <input type="date" class="form-input" id="" name="birthday">
                            @error('birthday')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-div">
                            <label for="phone" class="form-label">Телефон</label>
                            <input type="number" class="form-input" id="" name="phone">
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="modalLogin" class="modal">
        <div class="modal-wrap">
            <div class="modal-window">
                <button class="modal-close" id="modal-close-login">&#5815;</button>
                <div class="container" id="m_body_login">
                    <h2>Авторизация</h2>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="POST" action="/logIn">
                        @csrf
                        <div class="form-div">
                            <label for="login" class="form-label">Логин</label>
                            <input type="text" class="form-input" id="login" name="login">
                            @error('login')
                                <div class="text_error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-div">
                            <label for="password" class="form-label">Пароль</label>
                            <input type="password" class="form-input" id="password" name="password">
                            @error('password')
                                <div class="text_error">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Войти</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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

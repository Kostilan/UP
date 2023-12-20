<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-reboot.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-utilities.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.esm.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">ПроЧитай</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="/newBooks">Новое</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Популярное</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/account">Аккаунт</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/subscriptions">Подписка</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/signout">Выход</a>
                        </li>
                    @endauth
                    <li class="nav-item">
                        @guest
                            <div class="d-flex">
                                <button class="nav-link active" id="loginLink">Авторизация</button>
                                <button class="nav-link active" id="registerLink">Регистрация</button>
                            </div>
                        @endguest
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="modalRegister" class="modal">
        <div class="modal-wrap">
            <div class="modal-window">
                <button class="modal-close" id="modal-close-register">&#5815;</button>
                <div id="m_body_register">
                    <h1>Регистрация</h1>
                    <form action="/signUp" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="surname" class="form-label">Фамилия</label>
                            <input type="text" class="form-control" id="" name="surname">
                            @error('surname')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Имя</label>
                            <input type="text" class="form-control" id="" name="name">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="patronymic" class="form-label">Отчество</label>
                            <input type="text" class="form-control" id="" name="patronymic">
                            @error('patronymic')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="login" class="form-label">Логин</label>
                            <input type="text" class="form-control" id="" name="login">
                            @error('login')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Пароль</label>
                            <input type="password" class="form-control" id="" name="password">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_repeat" class="form-label">Повтор пароля</label>
                            <input type="password" class="form-control" id="" name="password_repeat">
                            @error('password_repeat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Почта</label>
                            <input type="email" class="form-control" id="" name="email">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-label">Дата рождения</label>
                            <input type="date" class="form-control" id="" name="birthday">
                            @error('birthday')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Телефон</label>
                            <input type="number" class="form-control" id="" name="phone">
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
                <div id="m_body_login">
                    <h1>Авторизация</h1>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="POST" action="/logIn">
                        @csrf
                        <div class="mb-3">
                            <label for="login" class="form-label">Логин</label>
                            <input type="text" class="form-control" id="login" name="login">
                            @error('login')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Пароль</label>
                            <input type="password" class="form-control" id="password" name="password">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Войти</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif
    <div id="content">
        @yield('content')
        <!-- Этот блок будет заполняться содержимым из производных шаблонов -->
    </div>

    <footer class="mt-5">
        <!-- Нижний колонтитул сайта -->
        <p>&copy; 2023 Мой сайт. Все права защищены.</p>
    </footer>

    <!-- Добавьте здесь ваши общие скрипты -->
</body>

</html>

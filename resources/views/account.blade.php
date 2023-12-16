@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
    <main class="d-flex container w-75">
        <div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <h3>Аккаунт</h3>
                </li>
                <li class="list-group-item"><a id="" class="link-dark link-underline-light" href="/account">Обо
                        мне</a></li>
                <li class="list-group-item"><a id="accountBookmark" class="link-dark link-underline-light"
                        href="/account/accountBookMarks">Закладки</a></li>
            </ul>
        </div>
        <div id="bodyAccount" class="container">
            <div class="accountUser">
                <h1>Обо мне</h1>
                <form action="/account/accountUserUpdater" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="surname" class="form-label">Фамилия</label>
                        <input type="text" class="form-control" id="" name="surname"
                            value="{{ $user->surname }}">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Имя</label>
                        <input type="text" class="form-control" id="" name="name"
                            value="{{ $user->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="patronymic" class="form-label">Отчество</label>
                        <input type="text" class="form-control" id="" name="patronymic"
                            value="{{ $user->patronymic }}">
                    </div>
                    <div class="mb-3">
                        <label for="login" class="form-label">Логин</label>
                        <input type="text" class="form-control" id="" name="login"
                            value="{{ $user->login }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Почта</label>
                        <input type="email" class="form-control" id="" name="email"
                            value="{{ $user->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="birthday" class="form-label">Дата рождения</label>
                        <input type="date" class="form-control" id="" name="birthday"
                            value="{{ $user->birthday }}">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Телефон</label>
                        <input type="number" class="form-control" id="" name=phone value="{{ $user->phone }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Обновить</button>
                </form>
            </div>
        </div>
    </main>

@endsection

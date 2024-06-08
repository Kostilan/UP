@extends('layouts.app')

@section('title', 'Аккаунт')

@section('content')
    <main class="container-flex">
        <div class="genre-left">
            <div class="genre ">
                <ul class="genre-list">
                    <li class="list-group-item">
                        <h3>Аккаунт</h3>
                    </li>
                    <li class="list-group-item"><a id="" class="link-dark link-underline-light" href="/account">Обо
                            мне</a></li>
                    <li class="list-group-item"><a id="" class="link-dark link-underline-light"
                            href="{{ route('accountBookMarks') }}">Избранное</a></li>
                    <li class="list-group-item"><a id="" class="link-dark link-underline-light"
                            href="{{ route('accountComments') }}">Мои комментарии</a></li>
                    <li class="list-group-item"><a id="" class="link-dark link-underline-light"
                            href="{{ route('accountRead') }}">Я читаю</a></li>
                </ul>
            </div>
        </div>
        <div id="" class="container">
            <div class="">
                <h1>Обо мне</h1>
                <form action="/account/accountUserUpdate" method="POST">
                    @csrf
                    <div class="form-user">
                        <label for="surname" class="form-label-user">Фамилия</label>
                        <input type="text" class="form-account" id="" name="surname"
                            value="{{ $user->surname }}">
                        @error('surname')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-user">
                        <label for="name" class="form-label-user">Имя</label>
                        <input type="text" class="form-account" id="" name="name"
                            value="{{ $user->name }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-user">
                        <label for="patronymic" class="form-label-user">Отчество</label>
                        <input type="text" class="form-account" id="" name="patronymic"
                            value="{{ $user->patronymic }}">
                        @error('patronymic')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-user">
                        <label for="login" class="form-label-user">Логин</label>
                        <input type="text" class="form-account" id="" name="login"
                            value="{{ $user->login }}">
                        @error('login')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-user">
                        <label for="email" class="form-label-user">Почта</label>
                        <input type="email" class="form-account" id="" name="email"
                            value="{{ $user->email }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-user">
                        <label for="birthday" class="form-label-user">Дата рождения</label>
                        <input type="date" class="form-account" id="" name="birthday"
                            value="{{ $user->birthday }}">
                        @error('birthday')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-user">
                        <label for="phone" class="form-label-user">Телефон</label>
                        <input type="number" class="form-account" id="" name=phone value="{{ $user->phone }}">
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Обновить</button>
                </form>
            </div>
        </div>
    </main>

@endsection

@extends('layouts.app')

@section('title', 'Страница создания авторов')

@section('content')
    <div class="container">
        <h2>Создание авторов</h2>

        @if (session('error'))
            <div class="alert alert-success mt-2">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success mt-2">{{ session('success') }}</div>
        @endif
        <form action="/admin/authors/authorCreate" method="POST">
            @csrf
            <div class="form-div">
                <label for="surname_author" class="form-label">Фамилия</label>
                <input type="text" class="form-input" id="" name="surname_author">
                @error('surname_author')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-div">
                <label for="name_author" class="form-label">Имя</label>
                <input type="text" class="form-input" id="" name="name_author">
                @error('name_author')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
@endsection

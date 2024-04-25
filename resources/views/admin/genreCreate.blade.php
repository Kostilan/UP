@extends('layouts.app')

@section('title', 'Страница создания жанров')

@section('content')
    <div class="container">
    <h2>Создание жанров</h2>

        @if (session('error'))
            <div class="alert alert-success mt-2">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success mt-2">{{ session('success') }}</div>
        @endif
        <form action="/admin/genres/genreCreate" method="POST">
            @csrf
            <div class="form-div">
                <label for="title_genre" class="form-label">Название жанра</label>
                <input type="text" class="form-input" id="" name="title_genre">
                @error('title_genre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-div">
                <label for="description_genre" class="form-label">Описание жанра</label>
                <textarea type="text" class="form-input" id="" name="description_genre"></textarea>
                @error('description_genre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
@endsection

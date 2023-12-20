@extends('layouts.app-admin')

@section('title', 'Страница создания жанров')

@section('content')
    <h2>Создание жанров</h2>
    <div class="container">
        @if (session('error'))
            <div class="alert alert-success mt-2">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success mt-2">{{ session('success') }}</div>
        @endif
        <form action="/admin/genres/genreCreate" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title_genre" class="form-label">Название жанра</label>
                <input type="text" class="form-control" id="" name="title_genre">
                @error('title_genre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description_genre" class="form-label">Описание жанра</label>
                <input type="text" class="form-control" id="" name="description_genre">
                @error('description_genre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
@endsection

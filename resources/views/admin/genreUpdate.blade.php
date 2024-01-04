@extends('layouts.app-admin')

@section('title', 'Страница редактирование жанров')

@section('content')
    <h2>Редактирование жанров</h2>
    <div class="container">
        @if (session('error'))
            <div class="alert alert-success mt-2">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success mt-2">{{ session('success') }}</div>
        @endif
        <form action="/admin/genres/genreUpdate" method="POST">
            @csrf
            <input type="hidden" value="{{$genre->id}}" name="idGenre">
            <div class="mb-3">
                <label for="title_genre" class="form-label">Название жанра</label>
                <input type="text" class="form-control" id="" name="title_genre"  value="{{$genre->title_genre}}">
                @error('title_genre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description_genre" class="form-label">Описание жанра</label>
                <textarea type="text" class="form-control" id="" name="description_genre">{{$genre->description_genre}}</textarea>
                @error('description_genre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Редактировать</button>
        </form>
    </div>
@endsection

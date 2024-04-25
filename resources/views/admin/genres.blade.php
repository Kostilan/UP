@extends('layouts.app')

@section('title', 'Страница жанров')

@section('content')
    <div class="container">
        <h2>Список жанров</h2>

        @if (session('error'))
            <div class="alert alert-success mt-2">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success mt-2">{{ session('success') }}</div>
        @endif
        <a class="btn btn-primary" href="/admin/genres/genresCreate">Создать жанры</a>
        {{-- <br> --}}
        <table class="table container">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Авторы</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($genres as $genre)
                    <tr>
                        <td>{{ $genre->id }}</td>
                        <td>{{ $genre->title_genre }}</td>
                        <td>
                            <a href="/admin/genres/genresUpdate/{{ $genre->id }}"
                                class="btn btn-warning link-light">Редактировать</a>
                            <form action="/admin/genres/genreDelete/{{ $genre->id }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Вы уверены?')">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

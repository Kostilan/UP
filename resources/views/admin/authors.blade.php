@extends('layouts.app')

@section('title', 'Страница авторов')

@section('content')
    <div class="container">
        <h2>Список авторов</h2>

        @if (session('error'))
            <div class="alert alert-success mt-2">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success mt-2">{{ session('success') }}</div>
        @endif
        <a class="btn btn-admin_category" href="/admin/authors/authorsCreate">Создать авторов</a>
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
                @foreach ($authors as $author)
                    <tr>
                        <td>{{ $author->id }}</td>
                        <td>{{ $author->surname_author }} {{ $author->name_author }}</td>
                        <td>
                            <a href="/admin/authors/authorsUpdate/{{ $author->id }}"
                                class="btn btn-warning link-light">Редактировать</a>
                            <form action="/admin/authors/authorDelete/{{ $author->id }}" method="POST"
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
        <div class="pagination">
            {{ $authors->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection

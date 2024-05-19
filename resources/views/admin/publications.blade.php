@extends('layouts.app')

@section('title', 'Страница издательств')

@section('content')
    <div class="container">
        <h2>Список издательств</h2>

        @if (session('errorPublication'))
            <div class="alert alert-success mt-2">{{ session('errorPublication') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success mt-2">{{ session('success') }}</div>
        @endif
        <a class="btn btn-admin_category" href="/admin/publications/publicationsCreate">Создать издательств</a>
        {{-- <br> --}}
        <table class="table container">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название издательства</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($publications as $publication)
                    <tr>
                        <td>{{ $publication->id }}</td>
                        <td>{{ $publication->title_publications }}</td>
                        <td>
                            <a href="/admin/publications/publicationsUpdate/{{ $publication->id }}"
                                class="btn btn-warning link-light">Редактировать</a>
                            <form action="/admin/publications/publicationDelete/{{ $publication->id }}" method="POST"
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
            {{ $publications->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection

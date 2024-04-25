    @extends('layouts.app')

    @section('title', 'Страница категорий')

    @section('content')
        <div class="container">
            <h2>Список категорий</h2>
            @if (session('error'))
                <div class="alert alert-success mt-2">{{ session('error') }}</div>
            @endif
            @if (session('success'))
                <div class="alert alert-success mt-2">{{ session('success') }}</div>
            @endif
            <a class="btn btn-primary" href="/admin/categories/categoriesCreate">Создать категорию</a>
            {{-- <br> --}}
            <table class="table container">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Категории</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->title_category }}</td>
                            <td>
                                <a href="/admin/categories/categoriesUpdate/{{ $category->id }}"
                                    class="btn btn-warning link-light">Редактировать</a>
                                <form action="/admin/categories/categoryDelete/{{ $category->id }}" method="POST"
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

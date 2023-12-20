@extends('layouts.app-admin')

@section('title', 'Страница редактирования авторов')

@section('content')
    <h2>Редактирование авторов</h2>
    <div class="container">
        @if (session('error'))
            <div class="alert alert-success mt-2">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success mt-2">{{ session('success') }}</div>
        @endif
        <form action="/admin/authors/authorUpdate" method="POST">
            @csrf
            <input type="hidden" value="{{$author->id}}" name="idAuthor">
            <div class="mb-3">
                <label for="surname_author" class="form-label">Фамилия</label>
                <input type="text" class="form-control" id="" name="surname_author" value="{{$author->surname_author}}">
                @error('surname_author')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name_author" class="form-label">Имя</label>
                <input type="text" class="form-control" id="" name="name_author" value="{{$author->name_author}}">
                @error('name_author')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Редактировать</button>
        </form>
    </div>
@endsection

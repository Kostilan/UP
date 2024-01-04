@extends('layouts.app-admin')

@section('title', 'Страница редактирование Категории')

@section('content')
    <h2>Редактирование категории</h2>
    <div class="container">
        @if (session('error'))
            <div class="alert alert-success mt-2">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success mt-2">{{ session('success') }}</div>
        @endif
        <form action="/admin/categories/categoryUpdate" method="POST">
            @csrf
            <input type="hidden" value="{{$genre->id}}" name="idCategory">
            <div class="mb-3">
                <label for="title_category" class="form-label">Название категории</label>
                <input type="text" class="form-control" id="" name="title_category"  value="{{$genre->title_category}}">
                @error('title_category')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description_category" class="form-label">Описание категории</label>
                <textarea type="text" class="form-control" id="" name="description_category">{{$genre->description_category}}</textarea>
                @error('description_category')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Редактировать</button>
        </form>
    </div>
@endsection

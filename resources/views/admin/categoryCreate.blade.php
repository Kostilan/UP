@extends('layouts.app')

@section('title', 'Страница создания категорий')

@section('content')
    <div class="container">
        <h2>Создание категории</h2>

        @if (session('error'))
            <div class="alert alert-success mt-2">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success mt-2">{{ session('success') }}</div>
        @endif
        <form action="/admin/categories/categoryCreate" method="POST">
            @csrf
            <div class="form-div">
                <label for="title_category" class="form-label">Название категории</label>
                <input type="text" class="form-input" id="" name="title_category">
                @error('title_category')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-div">
                <label for="description_category" class="form-label">Описание категории</label>
                <textarea type="text" class="form-input" id="" name="description_category"></textarea>
                @error('description_category')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Страница создания издательств')

@section('content')
    <div class="container">
    <h2>Создание издательств</h2>

        @if (session('error'))
            <div class="alert alert-success mt-2">{{ session('error') }}</div>
        @endif
        @if (session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif
        <form action="/admin/publications/publicationCreate" method="POST">
            @csrf
            <div class="form-div">
            <label for="title_publications" class="form-label">Издательство</label>
            <input type="text" class="form-input" id="" name="title_publications">
            @error('title_publications')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
@endsection

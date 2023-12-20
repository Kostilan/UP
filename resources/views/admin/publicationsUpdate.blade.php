@extends('layouts.app-admin')

@section('title', 'Страница редактирования издательств')

@section('content')
    <h2>Редактирование издательства</h2>
    <div class="container">
        @if (session('errorPublication'))
            <div class="alert alert-success mt-2">{{ session('errorPublication') }}</div>
        @endif
        @if (session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif
        <form action="/admin/publications/publicationUpdate" method="POST">
            @csrf
            <input type="hidden" value="{{$publication->id}}" name="idPublication">
            <div class="mb-3">
            <label for="title_publications" class="form-label">Издательство</label>
            <input type="text" class="form-control" id="" name="title_publications" value="{{ $publication->title_publications }}">
            @error('title_publications')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>
            <button type="submit" class="btn btn-primary">Редактировать</button>
        </form>
    </div>
@endsection

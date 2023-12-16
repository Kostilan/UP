@extends('layouts.app')

@section('title', 'Страница книги')

@section('content')
<section class="d-flex container-fluid book-container">
        <img src="{{$book->photo}}" alt="Книга">
        <div class="container-fluid">
            <p class="book-text-name">
                {{$book->title_book}}
            </p>
            <p class="fw-bold">Автор: <a href="">{{$book->author->surname_author}} {{$book->author->name_author}}</a></p>
            <div class="d-flex">
                <span class="text-warning  fs-4">4.5 &#9733; <br>
                    <p class="text-dark opacity-75 fs-5">168</p>
                </span>
                <span class="book-divider-line"></span>
                <span class="text-primary-emphasis fs-4">75 &#9993;<br>
                    <p class="text-dark opacity-75 fs-5">Отзывы</p>
                </span>
            </div>
            <div class="d-flex mb-3">
                <a href="">
                    <div class="book-block fs-6 me-3">Читать фрагмент</div>
                </a>
                <a href="">
                    <div class="book-block fs-6">Добавить в закладки &#10084;</div>
                </a>
            </div>
            <section class="d-flex">
                <p class="fw-bold">Объем: </p>
                <p> {{$book->pages}} стр.</p>
            </section>
            <p class="fw-bold">Жанры: <a href="">Фантастика</a>, <a href="">Детективы</a></p>
            <section class=" w-75">
                <span class="fw-bold fs-6">Описание книги: </span>
                <p>{{$book->description}}</p>
            </section>
        </div>
    </section>
@endsection
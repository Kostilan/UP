@extends('layouts.app')

@section('title', 'Страница книги')

@section('content')
    <section class="d-flex container-fluid book-container">
        <img src="{{ $book->photo }}" alt="Книга">
        <div class="container-fluid">
            <p class="book-text-name">
                {{ $book->title_book }}
            </p>
            <p class="fw-bold">Автор: <a href="">{{ $book->author->surname_author }}
                    {{ $book->author->name_author }}</a></p>
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
                @auth
                    <a href="">
                        <div class="book-block fs-6 me-3">Читать фрагмент</div>
                    </a>
                    @if (!$isBookMark)
                        <a href="/bookProduct/bookMarks/{{ $book->id }}">
                            <div class="book-block fs-6">Добавить в закладки &#10084;</div>
                        </a>
                    @else
                        <a href="/bookProduct/bookMarks/{{$book->id}}/delete">
                            <div class="book-block fs-6">Удалить из закладок &#10084;</div>
                        </a>
                    @endif
                </div>
            @endauth
            <section class="d-flex">
                <p class="fw-bold">Объем: </p>
                <p> {{ $book->pages }} стр.</p>
            </section>
            <p class="fw-bold">Жанры: <a href=""> Фантастика</a>, <a href="">Детективы</a></p>
            <section class=" w-75">
                <span class="fw-bold fs-6">Описание книги: </span>
                <p>{{ $book->description }}</p>
            </section>
        </div>
    </section>

          <!-- Добавьте секцию для отзывов -->
          <div class="container-fluid mt-5">
            <h2 class="fw-bold mb-3">Отзывы</h2>

            @foreach($book->comments as $comment)
                <div class="card mb-3">
                    <div class="card-body">
                        <p class="card-text">{{ $comment->text }}</p>
                        <p class="card-text">Оценка: {{ $comment->rating }}/5</p>
                        <p class="card-text">Автор: {{ $comment->user->name }}</p>
                    </div>
                </div>
            @endforeach

            <!-- Добавьте форму для добавления нового отзыва (если это нужно) -->
            @auth
            <div class="container">
                <form action="" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="comment-text" class="form-label">Текст отзыва:</label>
                        <textarea class="form-control" id="comment-text" name="text"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="comment-rating" class="form-label">Оценка:</label>
                        <input type="number" class="form-control" id="comment-rating" name="rating" min="1" max="5">
                    </div>
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <button type="submit" class="btn btn-primary">Оставить отзыв</button>
                </form>
            </div>
            @endauth
        </div>
@endsection

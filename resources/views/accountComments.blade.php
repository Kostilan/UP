@extends('layouts.app')

@section('title', 'Мои комментарии')

@section('content')
    <main class="container-flex">
        <div class="genre-left">
            <div class="genre ">
                <ul class="genre-list">
                    <li class="list-group-item">
                        <h3>Аккаунт</h3>
                    </li>
                    <li class="list-group-item"><a id="" class="link-dark link-underline-light" href="/account">Обо
                            мне</a></li>
                    <li class="list-group-item"><a id="" class="link-dark link-underline-light"
                            href="/account/accountBookMarks">Избранное</a></li>
                    <li class="list-group-item"><a id="" class="link-dark link-underline-light"
                            href="{{ route('accountComments') }}">Мои комментарии</a></li>
                    <li class="list-group-item"><a id="" class="link-dark link-underline-light"
                            href="{{ route('accountRead') }}">Я читаю</a></li>
                </ul>
            </div>
        </div>
        <div id="" class="container">
            <h1>Мои комментарии</h1>
            <div class="content-wrapper">
                @foreach ($comments as $comment)
                    <div class="comment-container">
                        <div class="comment-evaluation">
                            @switch($comment->evaluation)
                                @case(1)
                                    <p class="book-evaluation">&#9733</p>
                                    <p class="evaluation-text"> Ужасно!</p>
                                @break
            
                                @case(2)
                                    <p class="book-evaluation">&#9733&#9733</p>
                                    <p class="evaluation-text"> Плохо</p>
                                @break
            
                                @case(3)
                                    <p class="book-evaluation">&#9733&#9733&#9733</p>
                                    <p class="evaluation-text"> Приемлимо</p>
                                @break
            
                                @case(4)
                                    <p class="book-evaluation">&#9733&#9733&#9733&#9733</p>
                                    <p class="evaluation-text"> Хорошо!</p>
                                @break
            
                                @case(5)
                                    <p class="book-evaluation">&#9733&#9733&#9733&#9733&#9733</p>
                                    <p class="evaluation-text"> Отлично!</p>
                                @break
            
                                @default
                            @endswitch()
                        </div>
                        <p class="comment-date">Опубликовано
                            {{ \Carbon\Carbon::parse($comment->updated_at)->format('d.m.Y H:i') }} Пользователем
                            {{ $comment->user->login }}</p>
                        <p class="comment-text">{{ $comment->comment_text }}</p>
                        <p class="comment-text">Перейти к книге<a href="{{ url('bookProduct', $comment->book_id) }}">
                            {{ $comment->book->title_book }}</a></p>
                    </div>
                @endforeach
            </div>
            <div class="pagination">{{ $comments->links('vendor/pagination/custom') }}</div>
    </main>
@endsection



@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
<div class="d-flex container-fluid main">
    <div class="genre">
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <h3>Жанры</h3>
        </li>
        @foreach ($genres as $item)
        <li class="list-group-item"><a class="link-dark link-underline-light" href="#">{{$item->title_genre}}</a></li>
        @endforeach
      </ul>
    </div>
    <div class="list-catalog">
      @foreach ($books->chunk(3) as $chunkedBooks)
          <div class="d-flex book-list">
              @foreach ($chunkedBooks as $book)
                  <div class="book">
                      <a href="{{ url('bookProduct', $book->id) }}">
                          <img class="main-book-img" src="{{ $book->photo}}" alt="{{ $book->title_book }}">
                      </a>
                      <a class="link-dark link-underline-opacity-0" href="{{ url('bookProduct', $book->id) }}">
                          <p>{{ $book->title_book }}</p>
                          <p class="opacity-75">{{ $book->author->surname_author }} {{ $book->author->name_author }}</p>
                      </a>
                  </div>
              @endforeach
          </div>
      @endforeach

      <div class="pagination">
          {{ $books->links() }}
      </div>
  </div>
@endsection
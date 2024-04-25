@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
<div class="container-flex">
    <div class="genre">
      <ul class="genre-list">
        <li class="">
          <h3>Жанры</h3>
        </li>
        @foreach ($genres as $item)
        <li class="list-group-item"><a class="link-dark" href="{{route('genreBooks', ['id' => $item->id])}}">{{$item->title_genre}}</a></li>
        @endforeach
      </ul>
    </div>
    <div class="list-catalog">
      @if ($books)
      @foreach ($books->chunk(3) as $chunkedBooks)
          <div class="book-list mb-5">
              @foreach ($chunkedBooks as $book)
                  <div class="book">
                      <a href="{{ url('bookProduct', $book->id) }}">
                          <img class="main-book-img" src="{{ asset('storage/photo/' . $book->photo) }}" alt="{{ $book->title_book }}">
                      </a>
                      <a class="link-dark " href="{{ url('bookProduct', $book->id) }}">
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
    @else
    <p>Книги не найдены.</p>
  @endif
  </div>
@endsection
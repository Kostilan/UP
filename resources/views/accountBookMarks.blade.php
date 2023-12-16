<h1>Мои закладки</h1>
 <div class="list-catalog container-fluid">
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
@extends('layouts.app-read')

@section('title', 'Чтение книги')

@section('content')
    <div class="">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="read comment-evaluation">
            <div>
                {!! $currentChunk !!}
            </div>
            <div class="bookmark">
                <form action="{{ route('addBookmark') }}" method="POST">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $id }}">
                    <input type="hidden" name="page" value="{{ $page }}">
                    <input type="hidden" name="all_pages" value="{{ $totalPages }}">
                    <button type="submit" class="btn btn-primary">Добавить закладку</button>
                </form>
            </div>
        </div>

        <div class="pagination">
            <nav role="navigation">
                <ul class="flex">
                    @if ($page > 1)
                        <li>
                            <a href="{{ request()->url() }}?page={{ $page - 1 }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    @else
                        <li class="disabled">
                            <span aria-hidden="true">&laquo;</span>
                        </li>
                    @endif

                    @for ($i = 1; $i <= $totalPages; $i++)
                        @if ($i <= 5 || ($i > $page - 3 && $i < $page + 3) || $i > $totalPages - 5)
                            <li class="{{ $i == $page ? 'active' : '' }}">
                                <a href="{{ request()->url() }}?page={{ $i }}">{{ $i }}</a>
                            </li>
                        @elseif ($i == 6 || $i == $totalPages - 5)
                            <li class="disabled"><span>...</span></li>
                        @endif
                    @endfor

                    @if ($page < $totalPages)
                        <li>
                            <a href="{{ request()->url() }}?page={{ $page + 1 }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    @else
                        <li class="disabled">
                            <span aria-hidden="true">&raquo;</span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
@endsection

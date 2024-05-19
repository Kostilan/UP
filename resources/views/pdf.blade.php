@extends('layouts.app-read')

@section('title', 'Чтение документа')

@section('content')
<div class="container">

    <div class="read">
        {!! $currentChunk !!}
    </div>

    <div class="pagination">
        <nav role="navigation">
            <ul class="flex">
                @if ($page > 1)
                    <li>
                        <a href="{{ request()->fullUrlWithQuery(['page' => $page - 1]) }}" aria-label="Previous">
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
                            <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">{{ $i }}</a>
                        </li>
                    @elseif ($i == 6 || $i == $totalPages - 5)
                        <li class="disabled"><span>...</span></li>
                    @endif
                @endfor

                @if ($page < $totalPages)
                    <li>
                        <a href="{{ request()->fullUrlWithQuery(['page' => $page + 1]) }}" aria-label="Next">
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
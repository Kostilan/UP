@extends('layouts.app')

@section('title', 'Рецензии')

@section('content')
    @auth
        @if (!isset($reviewExists) || !$reviewExists)
            <div class="comment-form">
                <h3>Добавить Рецензию</h3>
                <form action="{{ route('reviewCreate_valid') }}" method="post">
                    @csrf
                    <div class="form-div_review">
                        <label for="review-text" class="form-label">Текст рецензии:</label>
                        <textarea class="review-text" id="review-text" name="review_text"></textarea>
                        @error('review_text')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-div">
                        <label for="comment-rating" class="form-label">Оценка:</label>
                        <input type="number" class="form-input" id="comment-rating" name="evaluation" min="1" max="5">
                        @error('evaluation')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="hidden" name="book_id" value="{{ $book_id }}">
                    <button type="submit" class="btn btn-primary">Оставить отзыв</button>
                </form>
            </div>
        @else
            <div class="comment-form">
                <h3>Редактировать Рецензию</h3>
                <form action="{{ route('reviewUpdate_valid', ['id' => $reviewExists->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-div_review">
                        <label for="review-text" class="form-label">Текст рецензии:</label>
                        <textarea class="form-input" id="review-text" name="review_text">{{ $reviewExists->review_text }}</textarea>
                        @error('review_text')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-div">
                        <label for="comment-rating" class="form-label">Оценка:</label>
                        <input type="number" class="form-input" id="comment-rating" name="evaluation" min="1" max="5" value="{{ $reviewExists->evaluation }}">
                        @error('evaluation')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="hidden" name="book_id" value="{{ $reviewExists->book_id }}">
                    <button type="submit" class="btn btn-primary">Обновить отзыв</button>
                </form>
            </div>
        @endif
    @endauth

    <h2 class="comment-title">Рецензии</h2>
    <div>
        @foreach ($reviews as $review)
            <div class="comment-container">
                <?php echo html_entity_decode($review->review_text); ?>
                <p class="comment-text">Оценка: {{ $review->evaluation }}</p>
                <p class="comment-text">Пользователь: {{ $review->user->login }}</p>
            </div>
        @endforeach
    </div>
@endsection

<!-- Подключение скомпилированного JS -->
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ asset('js/ckeditor.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        CKEDITOR.replace('review-text', {
            height: '400px', // Установите нужную высоту
            width: '100%'    // Установите нужную ширину, если нужно
        });
    });
</script>

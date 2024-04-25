@extends('layouts.app')

@section('title', 'Страница книги')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PDF View</title>
    </head>

    <body>
        <!-- PDF Viewer -->
        <div id="pdfViewer">
            @foreach (glob($imagePath . '*.jpg') as $image)
                <img src="{{ asset(str_replace(storage_path('app/public'), 'storage', $image)) }}" alt="Page">
            @endforeach
        </div>

        <!-- Button to load next page -->
        <button id="loadNextPage">Load Next Page</button>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            // Функция для загрузки следующей страницы PDF
            function loadNextPage() {
                // Определяем текущее количество изображений
                var currentPage = $('#pdfViewer img').length;

                // Отправляем AJAX-запрос для загрузки следующей страницы
                $.ajax({
                    url: '/loadNextPage/' + (currentPage + 1),
                    type: 'GET',
                    success: function(response) {
                        // Вставляем полученное изображение в конец элемента просмотра
                        $('#pdfViewer').append(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            // Связываем кнопку для загрузки следующей страницы с соответствующей функцией
            $('#loadNextPage').click(function() {
                loadNextPage();
            });
            
        </script>
    </body>

    </html>
@endsection

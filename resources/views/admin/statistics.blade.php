@extends('layouts.app')

@section('title', 'Статистика чтения')

@section('content')
    <div class="container">
        <h1>Статистика чтения</h1>
        <canvas id="readingProgressChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('readingProgressChart').getContext('2d');
            const readingProgressData = @json($readingProgress);
            const labels = readingProgressData.map(data => data.book_title);
            const progress = readingProgressData.map(data => data.progress);

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Прогресс чтения (%)',
                        data: progress,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100
                        }
                    }
                }
            });
        });
    </script>
@endsection

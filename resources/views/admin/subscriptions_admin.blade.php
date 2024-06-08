@extends('layouts.app')

@section('title', 'Страница жанров')

@section('content')
    <div class="container">
        <h1>Статистика подписок</h1>
        <canvas id="subscriptionChart"></canvas>
        <script>
            const ctx = document.getElementById('subscriptionChart').getContext('2d');
            const subscriptionData = @json($subscriptionData);
            const labels = Object.keys(subscriptionData);
            const data = {
                labels: labels,
                datasets: [{
                        label: 'Количество подписок',
                        data: labels.map(label => subscriptionData[label].count),
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        yAxisID: 'y',
                    },
                    {
                        label: 'Сумма денег',
                        data: labels.map(label => subscriptionData[label].total_amount),
                        borderColor: 'rgba(153, 102, 255, 1)',
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        yAxisID: 'y1',
                    }
                ]
            };
            const config = {
                type: 'line',
                data: data,
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            grid: {
                                drawOnChartArea: false,
                            }
                        }
                    }
                },
            };
            new Chart(ctx, config);
        </script>

        <h2>Остальные данные</h2>
        <!-- Ваши данные здесь -->

        <table>
            <thead>
                <tr>
                    <th>Тип подписки</th>
                    <th>Сумма денег</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subscriptionData as $type => $data)
                    @php
                        $totalAmount = 0;
                        foreach ($data as $typeData) {
                            $totalAmount += $typeData['total_amount'];
                        }
                    @endphp
                    <tr>
                        <td>{{ $type }}</td>
                        <td>{{ $totalAmount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
 

@endsection

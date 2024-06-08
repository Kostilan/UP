@extends('layouts.app')

@section('title', 'Страница подписки')

@section('content')
<div class="container">
    @if (session('subscription_success'))
        <div class="alert alert-success mt-2">{{ session('subscription_success') }}</div>
    @endif

    @if (count($subscriptions) > 0)
        @php
            $hasActiveSubscription = false;
        @endphp
        @foreach ($subscriptions as $subscription)
            @if (!$subscription->has_expired)
                @php
                    $hasActiveSubscription = true;
                @endphp
                <p>{{ $subscription->remaining_time }}</p>
                <p>Ваша подписка активна.</p>
                @break
            @endif
        @endforeach

        @if (!$hasActiveSubscription)
            @foreach ($subscriptions as $subscription)
                <p>{{ $subscription->remaining_time }}</p>
            @endforeach
            <h2>Выберите тип подписки:</h2>
            <form action="/subscriptions/subscriptionCreate" method="post">
                @csrf
                @foreach ($typeSubscriptions as $typeSubscription)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="subscription_type" id="type{{ $typeSubscription->id }}" value="{{ $typeSubscription->id }}" required>
                        <label class="form-check-label" for="type{{ $typeSubscription->id }}">
                            {{ $typeSubscription->title_subscription_type }} - {{ $typeSubscription->cost_title_subscription }} руб.
                        </label>
                    </div>
                @endforeach
                @error('subscription_type')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-primary mt-3">Подписаться</button>
            </form>
        @endif
    @else
        <h2>Выберите тип подписки:</h2>
        <form action="/subscriptions/subscriptionCreate" method="post">
            @csrf
            @foreach ($typeSubscriptions as $typeSubscription)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="subscription_type" id="type{{ $typeSubscription->id }}" value="{{ $typeSubscription->id }}" required>
                    <label class="form-check-label" for="type{{ $typeSubscription->id }}">
                        {{ $typeSubscription->title_subscription_type }} - {{ $typeSubscription->cost_title_subscription }} руб.
                    </label>
                </div>
            @endforeach
            @error('subscription_type')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary mt-3">Подписаться</button>
        </form>
    @endif
</div>
@endsection

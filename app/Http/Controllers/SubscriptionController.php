<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Subscription;
use App\Models\TypeSubscription;

class SubscriptionController extends Controller
{
    public function subscriptions()
    {
        $typeSubscriptions = TypeSubscription::all();
        return view('subscriptions', compact('typeSubscriptions'));
    }

    public function subscriptionCreate(Request $request)
    {
        $request->validate([
            'subscription_type' => 'required|exists:type_subscriptions,id',
        ], [
            'subscription_type.required' => 'Выберите тип подписки.',
            'subscription_type.exists' => 'Выбранный тип подписки недействителен..',
        ]);

        // Получение данных из формы
        $userId = Auth::id();
        $subscriptionStartDate = now(); // Текущая дата и время

        // Создание подписки
        Subscription::create([
            'user_id' => $userId,
            'subscription_type_id' => $request['subscription_type'],
            'subscription_start_date' => $subscriptionStartDate,
        ]);

        // Дополнительные действия, если необходимо

        // Редирект или что-то еще
        return redirect('/')->with('subscription_success', 'Подписка успешно оформлена!');
    }
}

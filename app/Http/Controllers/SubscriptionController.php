<?php

namespace App\Http\Controllers;

use App\Notifications\SubscriptionNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProChitai;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Subscription;
use App\Models\TypeSubscription;

class SubscriptionController extends Controller
{
    public function subscriptions()
    {
        $typeSubscriptions = TypeSubscription::all();
        $subscription = Subscription::where('user_id',Auth::id())->get();
        return view('subscriptions', compact('typeSubscriptions','subscription'));
    }

    public function subscriptionCreate(Request $request)
    {
        $request->validate([
            'subscription_type' => 'required|exists:type_subscriptions,id',
        ], [
            'subscription_type.required' => 'Выберите тип подписки.',
            'subscription_type.exists' => 'Выбранный тип подписки недействителен.',
        ]);
    
        $userId = Auth::id();
        $subscriptionStartDate = now(); // Текущая дата и время
    
        Subscription::create([
            'user_id' => $userId,
            'subscription_type_id' => $request['subscription_type'],
            'subscription_start_date' => $subscriptionStartDate,
        ]);
        
        $subscription_type = TypeSubscription::find($request['subscription_type']);
        $user = Auth::user();
    
        // Отправка письма на почту пользователя с помощью класса ProChitai
        Mail::to($user->email)->send(new ProChitai($user, $subscription_type));
    
        // Редирект или что-то еще
        return redirect()->back()->with('subscription_success', 'Подписка успешно оформлена!');
    }
}

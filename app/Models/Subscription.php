<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\TypeSubscription;

use Carbon\Carbon;

class Subscription extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'subscription_type_id',
        'subscription_start_date',
    ];

    protected $appends = ['remainingDays', 'hasExpired'];

    public function typeSubscription()
    {
        return $this->belongsTo(TypeSubscription::class);
    }

    public function getRemainingTimeAttribute()
    {
        $startDate = Carbon::parse($this->subscription_start_date);
        $currentDate = Carbon::now();
        $remainingTime = '';

        switch ($this->subscription_type_id) {
            case 1:
                $endDate = $startDate->clone()->addMonth();
                break;
            case 2:
                $endDate = $startDate->clone()->addMonths(6);
                break;
            case 3:
                $endDate = $startDate->clone()->addYear();
                break;
            default:
                $remainingTime = 'Неизвестный тип подписки';
                return $remainingTime;
        }

        $remainingDays = $currentDate->diffInDays($endDate, false);
        $remainingTime = $remainingDays >= 0 ? $remainingDays . ' дней у вас осталось до истечения подписки.' : 'Подписка истекла.';

        return $remainingTime;
    }

    public function getRemainingDaysAttribute()
    {
        $startDate = Carbon::parse($this->subscription_start_date);
        $currentDate = Carbon::now();
        $remainingDays = $currentDate->diffInDays($startDate, false);

        return $remainingDays;
    }

    public function getHasExpiredAttribute()
    {
        $startDate = Carbon::parse($this->subscription_start_date);
        $currentDate = Carbon::now();

        switch ($this->subscription_type_id) {
            case 1:
                return $startDate->clone()->addMonth()->isPast();
            case 2:
                return $startDate->clone()->addMonths(6)->isPast();
            case 3:
                return $startDate->clone()->addYear()->isPast();
            default:
                return false;
        }
    }
}

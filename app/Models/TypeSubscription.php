<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Subscription;

class TypeSubscription extends Model
{
    protected $fillable = [
        'title_subscription_type',
        'cost_title_subscription',
    ];

    public function subscription(){
        return $this->hasMany(Subscription::class);
    }
}

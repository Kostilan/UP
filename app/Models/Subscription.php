<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\TypeSubscription;

class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'subscription_type_id',
        'subscription_start_date',
    ];

    public function typeSubscription(){
        return $this->belongsTo(TypeSubscription::class);
    }

    public $timestamps = false;
}

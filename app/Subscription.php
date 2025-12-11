<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Authenticatable
{

    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function s_name()
    {
        return $this->belongsTo('App\SubscriptionsName', 'name_id');
    }
}

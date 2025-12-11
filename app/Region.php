<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Authenticatable
{

    use SoftDeletes;

    public function city()
    {
        return $this->belongsTo("\App\City");
    }
}

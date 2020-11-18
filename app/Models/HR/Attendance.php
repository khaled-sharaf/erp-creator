<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}

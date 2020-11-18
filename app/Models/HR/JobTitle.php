<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Model;

class JobTitle extends Model
{
    protected $guarded = [];

    public function department()
    {
        return $this->belongsTo('App\Models\HR\Department');
    }

    public function users()
    {
        return $this->hasMany('App\User');    
    }
}

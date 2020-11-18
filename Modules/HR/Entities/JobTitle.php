<?php

namespace Modules\HR\Entities;

use Illuminate\Database\Eloquent\Model;
use App\User;

class JobTitle extends Model
{
    protected $guarded = [];

    public function department()
    {
        return $this->belongsTo('App\Models\HR\Department');
    }

    public function users()
    {
        return $this->hasMany(User::class);    
    }
}

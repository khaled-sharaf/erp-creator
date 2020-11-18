<?php

namespace Modules\HR\Entities;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Department extends Model
{
    protected $guarded = [];

    public function jobTitles()
    {
        return $this->hasMany('App\Models\HR\JobTitle');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

}

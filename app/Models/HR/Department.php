<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $guarded = [];

    public function jobTitles()
    {
        return $this->hasMany('App\Models\HR\JobTitle');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function sales()
    {
        return $this->hasMany('App\User')->where('deparetement_id',1);
    }

}

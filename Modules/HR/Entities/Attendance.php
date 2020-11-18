<?php

namespace Modules\HR\Entities;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Attendance extends Model
{
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

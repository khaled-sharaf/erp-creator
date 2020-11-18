<?php

namespace Modules\Design\Entities;

use Illuminate\Database\Eloquent\Model;

class Printing extends Model
{
    protected $guarded = [];

    public function lead()
    {
        return $this->belongsTo('App\Models\CRM\Lead', 'lead_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}

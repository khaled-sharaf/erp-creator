<?php

namespace App\Models\WebDevelopment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Website extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = [];
    // public $timestamps = false;

    /*** relations********************************************************/

    public function lead()
    {
        return $this->belongsTo('App\Models\CRM\Lead', 'lead_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

}

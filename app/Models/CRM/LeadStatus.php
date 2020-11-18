<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Model;

class LeadStatus extends Model
{
    protected $guarded = [];


    public function leads()
    {
        return $this->hasMany('App\Models\CRM\Lead', 'lead_status_id');
    }
}

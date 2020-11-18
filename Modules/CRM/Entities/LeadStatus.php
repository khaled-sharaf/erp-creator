<?php

namespace Modules\CRM\Entities;

use Illuminate\Database\Eloquent\Model;

class LeadStatus extends Model
{
    protected $guarded = [];


    public function leads()
    {
        return $this->hasMany('Modules\CRM\Entities\Lead', 'lead_status_id');
    }
}

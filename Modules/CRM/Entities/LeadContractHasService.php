<?php

namespace Modules\CRM\Entities;

use Illuminate\Database\Eloquent\Model;

class LeadContractHasService extends Model
{
    protected $guarded = [];


    public function originalServices()
    {
        return $this->belongsTo('Modules\CRM\Entities\Service', 'service_id');
    }
}

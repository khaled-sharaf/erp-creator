<?php

namespace Modules\CRM\Entities;

use Illuminate\Database\Eloquent\Model;

class QuotationHasService extends Model
{
    protected $guarded = [];


    public function originalServices()
    {
        return $this->belongsTo('Modules\CRM\Entities\Service', 'service_id');
    }
    
}

<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Model;

class QuotationHasService extends Model
{
    protected $guarded = [];

    public function originalServices()
    {
        return $this->belongsTo('App\Models\CRM\Service', 'service_id');
    }
    
}

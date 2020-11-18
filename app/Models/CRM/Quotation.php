<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    
    protected $guarded = [];

    /*** relations 
    ***********************************************************************************/

    public function services()
    {
        return $this->hasMany('App\Models\CRM\QuotationHasService', 'quotation_id');
    }

    public function lead()
    {
        return $this->belongsTo('App\Models\CRM\Lead', 'lead_id');
    }

    public function personalSales()
    {
        return $this->belongsTo('App\User', 'sales_id');
    }

    public function currency()
    {
        return $this->belongsTo('App\Models\Accounting\Currency','currency_id','id');
    }

}

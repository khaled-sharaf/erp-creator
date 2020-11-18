<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadContract extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = [];

    /*** relations
    ***********************************************************************************/

    public function services()
    {
        return $this->hasMany('App\Models\CRM\LeadContractHasService', 'lead_contract_id');
    }

    public function terms()
    {
        return $this->hasMany('App\Models\CRM\Term');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\CRM\ContractPayment');
    }

    public function lead()
    {
        return $this->belongsTo('App\Models\CRM\Lead', 'lead_id');
    }

    public function personalSales()
    {
        return $this->belongsTo('App\User', 'sales_id');
    }

    public function personalSalesCommission()
    {
        return $this->belongsTo('App\Models\CRM\SalesCommission', 'sales_id', 'sales_id');
    }

    public function createdByUser()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function project()
    {
        return $this->hasOne('App\Models\ProjectManagement\Project', 'lead_contract_id');
    }

    public function currency()
    {
        return $this->belongsTo('App\Models\Accounting\Currency','currency_id','id');
    }

}

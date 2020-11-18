<?php

namespace Modules\CRM\Entities;

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
        return $this->hasMany('Modules\CRM\Entities\LeadContractHasService', 'lead_contract_id');
    }

    public function terms()
    {
        return $this->hasMany('Modules\CRM\Entities\Term');
    }

    public function payments()
    {
        return $this->hasMany('Modules\CRM\Entities\ContractPayment');
    }

    public function lead()
    {
        return $this->belongsTo('Modules\CRM\Entities\Lead', 'lead_id');
    }

    public function personalSales()
    {
        return $this->belongsTo('App\User', 'sales_id');
    }

    public function personalSalesCommission()
    {
        return $this->belongsTo('Modules\CRM\Entities\SalesCommission', 'sales_id', 'sales_id');
    }

    public function createdByUser()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function project()
    {
        return $this->hasOne('Modules\ProjectManagement\Entities\Project', 'lead_contract_id');
    }

}

<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = [];
    private $selected = ['id', 'name', 'kind', 'created_at', 'updated_at', 'deleted_at', 'balance', 'credit', 'debit'];


    /*** scopes
    ***********************************************************************************/

    public function scopeBank($query)
    {
        $selected = array_merge($this->selected, ['account_no', 'type']);
        $query->select($selected)->where('kind', 'bank');
    }

    public function scopeCash($query)
    {
        $query->select($this->selected)->where('kind', 'cash');
    }

    public function scopePartner($query)
    {
        $selected = array_merge($this->selected, ['ratio', 'id_card', 'type']);
        $query->select($selected)->where('kind', 'partner');
    }


    /*** relations
    ***********************************************************************************/

    public function payments()
    {
        return $this->hasMany('App\Models\Accounting\Payment', 'account_id');
    }

}

<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Payment extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = [];


    /*** relations
    ***********************************************************************************/

    public function account()
    {
        return $this->belongsTo('App\Models\Accounting\Account');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Models\Accounting\Supplier');
    }

    public function expense()
    {
        return $this->belongsTo('App\Models\Accounting\Expense');
    }

}

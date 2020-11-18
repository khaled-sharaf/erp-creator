<?php

namespace Modules\Accounting\Entities;

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
        return $this->belongsTo('Modules\Accounting\Entities\Account');
    }

    public function supplier()
    {
        return $this->belongsTo('Modules\Accounting\Entities\Supplier');
    }

    public function expense()
    {
        return $this->belongsTo('Modules\Accounting\Entities\Expense');
    }

}

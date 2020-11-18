<?php

namespace Modules\Accounting\Entities;

use Illuminate\Database\Eloquent\Model;

class FixedAsset extends Model
{
    //

    protected $guarded = [];


    public function supplier()
    {
        return $this->belongsTo('Modules\Accounting\Entities\Supplier');
    }
}

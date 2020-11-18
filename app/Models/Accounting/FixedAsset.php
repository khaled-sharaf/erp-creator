<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;

class FixedAsset extends Model
{
    //

    protected $guarded = [];


    public function supplier()
    {
        return $this->belongsTo('App\Models\Accounting\Supplier');
    }
}

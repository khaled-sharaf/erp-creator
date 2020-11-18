<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Model;


class Expense extends Model
{
    
    protected $guarded = [];


    public function scopeActivate($query)
    {
        $query->where('active', 1);
    }

    public function scopeDisactive($query)
    {
        $query->where('active', 0);
    }

}

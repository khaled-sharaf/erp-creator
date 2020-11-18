<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = [];
}
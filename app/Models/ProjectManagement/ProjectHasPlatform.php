<?php

namespace App\Models\ProjectManagement;

use Illuminate\Database\Eloquent\Model;

class ProjectHasPlatform extends Model
{
    protected $guarded = [];


    public function originalPlatform()
    {
        return $this->belongsTo('App\Models\ProjectManagement\Platform', 'platform_id');
    }
    
}

<?php

namespace Modules\ProjectManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectHasPlatform extends Model
{
    protected $guarded = [];


    public function originalPlatform()
    {
        return $this->belongsTo('Modules\ProjectManagement\Entities\Platform', 'platform_id');
    }
    
}

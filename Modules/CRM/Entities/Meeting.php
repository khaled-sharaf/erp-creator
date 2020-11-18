<?php

namespace Modules\CRM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meeting extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = [];


    public function users()
    {
        return $this->belongsToMany('App\User', 'assigned_to_meeting', 'metting_id', 'user_id');
    }

    public function parentMeeting()
    {
        return $this->belongsTo('Modules\CRM\Entities\Meeting', 'meeting_id');
    }

    public function nextMeetings()
    {
        return $this->hasMany('Modules\CRM\Entities\Meeting', 'meeting_id');
    }

    public function lead()
    {
        return $this->belongsTo('Modules\CRM\Entities\Lead', 'lead_id');
    }

    public function createdByUser()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    /* scope */
    
    public function scopeOnlyParents()
    {
        return $this->whereNull('meeting_id');
    }
}

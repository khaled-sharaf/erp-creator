<?php

namespace App\Models\ProjectManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use File;

class Project extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = [];

    const DIRECTORY_MODEL = 'storage/projects';
    const DIRECTORY_IMAGE = 'images-materials';
    const DIRECTORY_SRC = 'resources';



    /*** create directory project
    ***********************************************************************************/

    public static function createDir($id) {
        $dirname = 'project-' . $id;
        if (!is_dir(public_path(self::DIRECTORY_MODEL))) {
            File::makeDirectory(public_path(self::DIRECTORY_MODEL), 0777, true);
        }
        if (!is_dir(public_path(self::DIRECTORY_MODEL . '/' . $dirname))) {
            File::makeDirectory(public_path(self::DIRECTORY_MODEL . '/' . $dirname), 0777, true);
        }
        if (!is_dir(public_path(self::DIRECTORY_MODEL . '/' . $dirname . '/' . self::DIRECTORY_IMAGE))) {
            File::makeDirectory(public_path(self::DIRECTORY_MODEL . '/' . $dirname . '/' . self::DIRECTORY_IMAGE), 0777, true);
        }
        if (!is_dir(public_path(self::DIRECTORY_MODEL . '/' . $dirname . '/' . self::DIRECTORY_SRC))) {
            File::makeDirectory(public_path(self::DIRECTORY_MODEL . '/' . $dirname . '/' . self::DIRECTORY_SRC), 0777, true);
        }
        return true;
    }



    /*** relations
    ***********************************************************************************/


    public function platforms()
    {
        return $this->hasMany('App\Models\ProjectManagement\ProjectHasPlatform', 'project_id');
    }


    public function contract()
    {
        return $this->belongsTo('App\Models\CRM\LeadContract', 'lead_contract_id');
    }


    public function services()
    {
        // return $this->contract()->services;
    }


    public function designer()
    {
        return $this->belongsTo('App\User', 'designer_id');
    }


    public function marketer()
    {
        return $this->belongsTo('App\User', 'marketer_id');
    }


    public function advertiser()
    {
        return $this->belongsTo('App\User', 'advertiser_id');
    }


    public function createdByUser()
    {
        return $this->belongsTo('App\User', 'created_by');
    }


}

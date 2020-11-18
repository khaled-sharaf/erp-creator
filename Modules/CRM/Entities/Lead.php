<?php

namespace Modules\CRM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Image;
use File;

class Lead extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = [];

    const DIRECTORY_IMAGE = 'images/lead-logos';
    const DEFAULT_IMAGE = self::DIRECTORY_IMAGE . '/default-avatar.png';


    /*** relations
    ***********************************************************************************/

    public function user()
    {
        return $this->belongsTo('App\User', 'assign_to');
    }

    public function status()
    {
        return $this->belongsTo('Modules\CRM\Entities\LeadStatus', 'lead_status_id');
    }

    public function meetings()
    {
        return $this->hasMany('Modules\CRM\Entities\Meeting');
    }

    public function createdByUser()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function logos()
    {
        return $this->hasMany('App\Models\Designs\Logo');
    }

    public function socialMedias()
    {
        return $this->hasMany('App\Models\Designs\SocialMedia');
    }

    public function printings()
    {
        return $this->hasMany('App\Models\Designs\Printing');
    }

    public function websites()
    {
        return $this->hasMany('App\Models\WebDevelopment\Website');
    }

    public function leadContracts()
    {
        return $this->hasMany('Modules\CRM\Entities\LeadContract');
    }
    /*** helpers
    ***********************************************************************************/

    public static function saveImage($photo, $model = null) {
        if (strpos($photo, 'data:image/') === 0) {
            $get_ext = explode(';', explode('/', $photo)[1])[0];
            $ext = $get_ext == 'jpeg' ? 'jpg' : $get_ext;
            $imageNewName = uniqid('lead-company-logo-') . '.' . $ext;
            $imagePath =  self::DIRECTORY_IMAGE . '/' . $imageNewName;
            if (!is_dir(public_path(self::DIRECTORY_IMAGE))) {
                File::makeDirectory(public_path(self::DIRECTORY_IMAGE), 0777, true);
            }

            // delete old image if exists
            if ($model !== null) {
                deleteImageModel($model, 'company_logo', self::DEFAULT_IMAGE);
            }

            Image::make($photo)
            ->save(public_path($imagePath), 60);

            return $imagePath;
        }
        return $photo;
    }

}

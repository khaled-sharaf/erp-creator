<?php

namespace Modules\Design\Entities;

use Image;
use File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Logo extends Model
{
    protected $guarded = [];

    public function lead()
    {
        return $this->belongsTo('App\Models\CRM\Lead', 'lead_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    // public function leadContract()
    // {
    //     return $this->belongsTo('App\Models\CRM\LeadContract', 'lead_contract_id');
    // }

}

    // /*** helpers
    // ***********************************************************************************/

    // public static function saveImage($photo, $user = null) {
    //     if (strpos($photo, 'data:image/') === 0) {
    //         $get_ext = explode(';', explode('/', $photo)[1])[0];
    //         $ext = $get_ext == 'jpeg' ? 'jpg' : $get_ext;
    //         $imageNewName = uniqid('user-avatar-image-') . '.' . $ext;
    //         $imagePath =  self::DIRECTORY_IMAGE . '/' . $imageNewName;
    //         if (!is_dir(public_path(self::DIRECTORY_IMAGE))) {
    //             File::makeDirectory(public_path(self::DIRECTORY_IMAGE), 0777, true);
    //         }

    //         // delete old image if exists
    //         if ($user !== null) {
    //             deleteImageModel($user, 'photo', self::DEFAULT_IMAGE);
    //         }

    //         Image::make($photo)
    //         ->resize(200, 200)
    //         ->save(public_path($imagePath), 60);

    //         return $imagePath;
    //     }
    //     return $photo;
    // }


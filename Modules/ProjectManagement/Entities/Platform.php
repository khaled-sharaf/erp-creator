<?php

namespace Modules\ProjectManagement\Entities;

use Illuminate\Database\Eloquent\Model;

use File;
use Image;

class Platform extends Model
{

    protected $guarded = [];


    const DIRECTORY_IMAGE = 'images/platforms';

    /*** helpers
    ***********************************************************************************/

    public static function saveImage($photo, $model = null) {
        if (strpos($photo, 'data:image/') === 0) {
            $get_ext = explode(';', explode('/', $photo)[1])[0];
            $ext = $get_ext == 'jpeg' ? 'jpg' : $get_ext;
            $imageNewName = uniqid('platform-logo-') . '.' . $ext;
            $imagePath =  self::DIRECTORY_IMAGE . '/' . $imageNewName;
            if (!is_dir(public_path(self::DIRECTORY_IMAGE))) {
                File::makeDirectory(public_path(self::DIRECTORY_IMAGE), 0777, true);
            }
            // delete old image if exists
            if ($model !== null) {
                deleteImageModel($model, 'logo');
            }
            Image::make($photo)
            ->resize(80, 80)
            ->save(public_path($imagePath), 80);
            return $imagePath;
        }
        return $photo;
    }

}

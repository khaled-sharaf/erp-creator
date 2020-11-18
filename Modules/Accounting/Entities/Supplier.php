<?php

namespace Modules\Accounting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Image;
use File;

class Supplier extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = [];

    const DIRECTORY_IMAGE = 'images/supplier-logos';
    const DEFAULT_IMAGE = self::DIRECTORY_IMAGE . '/default-avatar.png';

   

   /*** relations
    ***********************************************************************************/

    public function services()
    {
        return $this->hasMany('Modules\Accounting\Entities\SupplierHasService', 'supplier_id');
    }



    /*** helpers
    ***********************************************************************************/

    public static function saveImage($photo, $model = null) {
        if (strpos($photo, 'data:image/') === 0) {
            $get_ext = explode(';', explode('/', $photo)[1])[0];
            $ext = $get_ext == 'jpeg' ? 'jpg' : $get_ext;
            $imageNewName = uniqid('supplier-company-logo-') . '.' . $ext;
            $imagePath =  self::DIRECTORY_IMAGE . '/' . $imageNewName;
            if (!is_dir(public_path(self::DIRECTORY_IMAGE))) {
                File::makeDirectory(public_path(self::DIRECTORY_IMAGE), 0777, true);
            }

            // delete old image if exists
            if ($model !== null) {
                deleteImageModel($model, 'logo', self::DEFAULT_IMAGE);
            }

            Image::make($photo)
            ->save(public_path($imagePath), 60);

            return $imagePath;
        }
        return $photo;
    }


}

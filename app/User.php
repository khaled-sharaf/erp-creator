<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

use Image;
use File;
use Illuminate\Support\Str;


class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasRoles;

    const DIRECTORY_IMAGE = 'images/user-avatar';
    const DEFAULT_IMAGE = self::DIRECTORY_IMAGE . '/default-avatar.png';

    protected $dates = ['deleted_at'];

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];

    const DIRECTORY_MODEL = 'storage/employees';
    const DIRECTORY_DOCUMENTS = 'documents';



    /*** create directory employee
    ***********************************************************************************/
    public static function createDir($id) {
        $dirname = 'employee-' . $id;
        if (!is_dir(public_path(self::DIRECTORY_MODEL))) {
            File::makeDirectory(public_path(self::DIRECTORY_MODEL), 0777, true);
        }
        if (!is_dir(public_path(self::DIRECTORY_MODEL . '/' . $dirname))) {
            File::makeDirectory(public_path(self::DIRECTORY_MODEL . '/' . $dirname), 0777, true);
        }
        if (!is_dir(public_path(self::DIRECTORY_MODEL . '/' . $dirname . '/' . self::DIRECTORY_DOCUMENTS))) {
            File::makeDirectory(public_path(self::DIRECTORY_MODEL . '/' . $dirname . '/' . self::DIRECTORY_DOCUMENTS), 0777, true);
        }
        return true;
    }


    /*** relations
    ***********************************************************************************/

    public function department()
    {
        return $this->belongsTo('Modules\HR\Entities\Department');
    }

    public function jobTitle()
    {
        return $this->belongsTo('Modules\HR\Entities\JobTitle');
    }

    /*** helpers
    ***********************************************************************************/

    public static function saveImage($photo, $user = null) {
        if (strpos($photo, 'data:image/') === 0) {
            $get_ext = explode(';', explode('/', $photo)[1])[0];
            $ext = $get_ext == 'jpeg' ? 'jpg' : $get_ext;
            $imageNewName = uniqid('user-avatar-image-') . '.' . $ext;
            $imagePath =  self::DIRECTORY_IMAGE . '/' . $imageNewName;
            if (!is_dir(public_path(self::DIRECTORY_IMAGE))) {
                File::makeDirectory(public_path(self::DIRECTORY_IMAGE), 0777, true);
            }

            // delete old image if exists
            if ($user !== null) {
                deleteImageModel($user, 'photo', self::DEFAULT_IMAGE);
            }

            Image::make($photo)
            ->resize(200, 200)
            ->save(public_path($imagePath), 60);

            return $imagePath;
        }
        return $photo;
    }

}

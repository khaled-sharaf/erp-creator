<?php

namespace App\Http\Controllers\Admin\HR;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class PermissionGroup extends Model
{
    protected $fillable = [
        'name'
    ];

    public function permissions() {
        return $this->hasMany(Permission::class);
    }

}

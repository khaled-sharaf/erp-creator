<?php

namespace Modules\HR\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Modules\HR\Entities\Acl;
use Modules\HR\Entities\PermissionGroup;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;

class AclController extends Controller
{

    public function index()
    {
        $roles = Acl::listRole();
        return resHandel($roles);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name|string|max:180',
            'permissions' => 'array|required|min:1'
        ]);
        Acl::createRole($request);
        return resHandel();
    }

    public function update($id, Request $request)
    {
        $role = Role::find($id);
        $request->validate([
            'name' => 'required|string|max:180|unique:roles,name,' . $id,
            'permissions' => 'array|required|min:1'
        ]);
        Acl::updateRole($role, $request);
        return resHandel(Acl::listRole());
    }


    public function destroy($id)
    {
        Role::destroy($id);
        return resHandel();
    }


    public function getNameRoles()
    {
        return resHandel(Role::all()->pluck('name')->toArray());
    }



    public function getListPermissions()
    {
        return resHandel(PermissionGroup::with('permissions')->get());
    }



    public function getRolesAndPermissionsForUser($id)
    {
        $user = User::find($id);
        $permissions = $id ? $user->getPermissionNames() : [];
        $roles = $id ? $user->getRoleNames() : [];
        return resHandel([
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }


    public function assignToUser($id, Request $request)
    {
        $user = User::find($id);
        $user->syncRoles($request->roles);
        $user->syncPermissions($request->permissions);
        return resHandel();
    }

}

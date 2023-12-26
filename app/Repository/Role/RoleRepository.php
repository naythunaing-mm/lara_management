<?php

namespace App\Repository\Role;

use App\Utility;
use App\ReturnMessages;
use Spatie\Permission\Models\Role;
use App\Repository\Role\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    public function roleStore($paraData)
    {
        $returnObj = array();
        $returnObj['LaraManagement']     = ReturnMessages::INTERNAL_SERVER_ERROR;
        try {
            $paraObj                     = new Role();
            $paraObj->name               = $paraData['name'];
            $paraObj->givePermissionTo($paraData['permission']);
            $paraObj->save();
            $returnObj['LaraManagement'] = ReturnMessages::OK;
            return $returnObj;
        } catch(\Exception $e) {
            $returnObj['LaraManagement'] = ReturnMessages::INTERNAL_SERVER_ERROR;
            return $returnObj;
        }
    }

    public function getRoles()
    {
        $roles = Role::with('permissions')
                       ->orderBy("id", "desc")->get();
        return $roles;
    }

    public function editForm($id)
    {
        $roles = Role::find($id);
        return $roles;
    }

    public function getUpdate($paraData)
    {
        $returnObj                       = array();
        $returnObj['LaraManagement']     = ReturnMessages::INTERNAL_SERVER_ERROR;
        try {
            $id                          = $paraData['id'];
            $paraObj                     = Role::find($id);
            $paraObj->name               = $paraData['name'];
            $paraObj->save();
            $oldPermissions              = $paraObj->permissions()->pluck('name')->toArray();
            $paraObj->revokePermissionTo($oldPermissions);
            $paraObj->givePermissionTo($paraData['permission']);
            $returnObj['LaraManagement'] = ReturnMessages::OK;
            return $returnObj;
        } catch(\Exception $e) {
            $returnObj['LaraManagement'] = ReturnMessages::INTERNAL_SERVER_ERROR;
            return $returnObj;
        }
    }

    public function getDelete($id)
    {
        $returnObj   = array();
        $returnObj['LaraManagement'] = ReturnMessages::INTERNAL_SERVER_ERROR;
        try {
            $paraObj                 = Role::find($id);
            $paraObj->delete();
            $returnObj['LaraManagement'] = ReturnMessages::OK;
            return $returnObj;
        } catch (\Exception $e) {
            $returnObj['LaraManagement'] = ReturnMessages::INTERNAL_SERVER_ERROR;
            return $returnObj;
        }
    }

}

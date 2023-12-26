<?php

namespace App\Repository\Permission;

use App\ReturnMessages;
use Spatie\Permission\Models\Permission;
use App\Repository\Permission\PermissionRepositoryInterface;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function permissionStore($paraData)
    {
        $returnObj = array();
        $returnObj['LaraManagement']     = ReturnMessages::INTERNAL_SERVER_ERROR;
        try {
            $paraObj                     = new Permission();
            $paraObj->name               = $paraData['name'];
            $paraObj->save();
            $returnObj['LaraManagement'] = ReturnMessages::OK;
            return $returnObj;
        } catch(\Exception $e) {
            $returnObj['LaraManagement'] = ReturnMessages::INTERNAL_SERVER_ERROR;
            return $returnObj;
        }
    }

    public function getpermissions()
    {
        $permissions = Permission::SELECT("id", "name")
                       ->orderBy("id", "desc")->get();
        return $permissions;
    }

    public function editForm($id)
    {
        $permissions = Permission::find($id);
        return $permissions;
    }

    public function getUpdate($paraData)
    {
        $returnObj                       = array();
        $returnObj['LaraManagement']     = ReturnMessages::INTERNAL_SERVER_ERROR;
        try {
            $id                          = $paraData['id'];
            $paraObj                     = Permission::find($id);
            $paraObj->name               = $paraData['name'];
            $paraObj->save();
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
            $paraObj                 = Permission::find($id);
            $paraObj->delete();
            $returnObj['LaraManagement'] = ReturnMessages::OK;
            return $returnObj;
        } catch (\Exception $e) {
            $returnObj['LaraManagement'] = ReturnMessages::INTERNAL_SERVER_ERROR;
            return $returnObj;
        }
    }

}

<?php

namespace App\Repository\Role;

use App\Utility;
use App\ReturnMessages;
use Yajra\DataTables\DataTables;
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

    public function roleDatatableListing()
    {
        $roles = Role::select('id', 'name');

        return Datatables::of($roles)
            ->addColumn('actions', function ($each) {
                $action_edit = '<a href="' . route('roleEdit', $each->id) . '"><i class="bx bx-edit-alt me-1"></i></a>';
                $action_delete = '<a href="' . route('roleDelete', $each->id) . '"><i class="bx bx-trash me-1"></i></a>';
                return $action_edit . " | " . $action_delete;
            })
            ->addColumn('permissions', function ($each) {
                $permissionBadges = '';

                foreach ($each->permissions as $permission) {
                    $permissionBadges .= '<span class="badge rounded-pill bg-primary">' . $permission->name . '</span> ';
                }

                return $permissionBadges;
            })
            ->rawColumns(['actions','permissions'])
            ->make(true);
    }

}

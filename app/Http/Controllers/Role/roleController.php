<?php

namespace App\Http\Controllers\Role;

use App\Repository\Permission\PermissionRepositoryInterface;
use App\Utility;
use App\ReturnMessages;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleRequest;
use App\Repository\Role\RoleRepositoryInterface;

class roleController extends Controller
{
    private $roleRepository;
    protected $permissionRepository;
    public function __construct(
        RoleRepositoryInterface $roleRepository,
        PermissionRepositoryInterface $permissionRepository
    ) {
        DB::connection()->enableQueryLog();
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }
    public function roleForm()
    {
        $permissions = $this->permissionRepository->getPermissions();
        return view('layouts.Backend.Role.roleForm', compact(['permissions']));
    }

    public function roleStore(roleRequest $request)
    {
        try {
            $result = $this->roleRepository->roleStore($request->all());
            $logs   = "Role Insert Screen :: ";
            Utility::saveLog($logs);
            if($result['LaraManagement'] == ReturnMessages::OK) {
                return redirect('admin-backend/role/roleListing')->with('success_msg', 'Data Insert Successful.');
            } else {
                return redirect('admin-backend/role/roleListing')->with('error_msg', 'Data Insert Fail!');
            }
        } catch (\Exception $e) {
            $logs = "Role Insert Error ::";
            $logs = $e->getMessage();
            abort(500);
        }
    }

    public function roleListing()
    {
        try {
            $roles  = $this->roleRepository->getRoles();
            $logs   = "Roles Listing Screen :: ";
            Utility::saveLog($logs);
            return view('layouts.Backend.Role.roleListing', compact(['roles']));
        } catch(\Exception $e) {
            $logs = "Role Listing Error ::";
            $logs = $e->getMessage();
            abort(500);
        }
    }

    public function editForm($id)
    {
        try {
            $permissions = $this->permissionRepository->getPermissions();
            $roles = $this->roleRepository->editForm($id);
            $oldPermissions = $roles->permissions->pluck('id');
            return view('layouts.Backend.Role.roleForm', compact(['roles','permissions','oldPermissions']));
        } catch(\Exception $e) {
            abort(500);
        }
    }

    public function RoleUpdate(RoleRequest $request)
    {
        try {
            $result  = $this->roleRepository->getUpdate($request->all());
            $logs    = "Role Update Screen :: ";
            Utility::saveLog($logs);
            if ($result['LaraManagement'] == ReturnMessages::OK) {
                return redirect('admin-backend/role/roleListing')->with('success_msg', 'Data Insert Successful.');
            } else {
                return redirect('admin-backend/role/roleListing')->with('error_msg', 'Data Insert Fail!');
            }
        } catch(\Exception $e) {
            $logs = "Role Update Error :: ";
            $logs = $e->getMessage();
            abort(500);
        }
    }

    public function RoleDelete($id)
    {
        try {
            $result = $this->roleRepository->getDelete($id);
            $logs   = "Role Delete Screen :: ";
            Utility::saveLog($logs);
            if ($result['LaraManagement'] == ReturnMessages::OK) {
                return redirect('admin-backend/role/roleListing')->with('success_msg', 'Data Delete Successful.');
            } else {
                return redirect('admin-backend/role/roleListing')->with('error_msg', 'Data Delete Fail!');
            }
        } catch (\Exception $e) {
            $logs = "Role Delete Error :: ";
            $logs = $e->getMessage();
            abort(500);
        }
    }
}

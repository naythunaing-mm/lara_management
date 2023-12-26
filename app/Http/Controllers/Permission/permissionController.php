<?php

namespace App\Http\Controllers\Permission;

use App\Utility;
use App\ReturnMessages;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\PermissionRequest;
use App\Repository\Permission\PermissionRepositoryInterface;

class PermissionController extends Controller
{
    private $permissionRepository;
    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        DB::connection()->enableQueryLog();
        $this->permissionRepository = $permissionRepository;
    }
    public function permissionForm()
    {
        return view('layouts.Backend.Permission.permissionForm');
    }

    public function permissionStore(PermissionRequest $request)
    {
        try {
            $result = $this->permissionRepository->permissionStore($request->all());
            $logs   = "Permission Insert Screen :: ";
            Utility::saveLog($logs);
            if($result['LaraManagement'] == ReturnMessages::OK) {
                return redirect('admin-backend/permission/permissionListing')->with('success_msg', 'Data Insert Successful.');
            } else {
                return redirect('admin-backend/permission/permissionListing')->with('error_msg', 'Data Insert Fail!');
            }
        } catch (\Exception $e) {
            $logs = "Permission Insert Error ::";
            $logs = $e->getMessage();
            abort(500);
        }
    }

    public function permissionListing()
    {
        try {
            $permissions  = $this->permissionRepository->getPermissions();
            $logs   = "Permission Listing Screen :: ";
            Utility::saveLog($logs);
            return view('layouts.Backend.permission.permissionListing', compact(['permissions']));
        } catch(\Exception $e) {
            $logs = "Permission Listing Error ::";
            $logs = $e->getMessage();
            abort(500);
        }
    }

    public function editForm($id)
    {
        try {
            $permissions = $this->permissionRepository->editForm($id);
            return view('layouts.Backend.Permission.permissionForm', compact(['permissions']));
        } catch(\Exception $e) {
            abort(500);
        }
    }

    public function permissionUpdate(permissionRequest $request)
    {
        try {
            $result  = $this->permissionRepository->getUpdate($request->all());
            $logs    = "Permission Update Screen :: ";
            Utility::saveLog($logs);
            if ($result['LaraManagement'] == ReturnMessages::OK) {
                return redirect('admin-backend/permission/permissionListing')->with('success_msg', 'Data Insert Successful.');
            } else {
                return redirect('admin-backend/permission/permissionListing')->with('error_msg', 'Data Insert Fail!');
            }
        } catch(\Exception $e) {
            $logs = "Permission Update Error :: ";
            $logs = $e->getMessage();
            abort(500);
        }
    }

    public function permissionDelete($id)
    {
        try {
            $result = $this->permissionRepository->getDelete($id);
            $logs   = "Permission Delete Screen :: ";
            Utility::saveLog($logs);
            if ($result['LaraManagement'] == ReturnMessages::OK) {
                return redirect('admin-backend/permission/permissionListing')->with('success_msg', 'Data Delete Successful.');
            } else {
                return redirect('admin-backend/permission/permissionListing')->with('error_msg', 'Data Delete Fail!');
            }
        } catch (\Exception $e) {
            $logs = "Permission Delete Error :: ";
            $logs = $e->getMessage();
            abort(500);
        }
    }
}

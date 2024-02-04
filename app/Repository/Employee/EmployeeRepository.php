<?php

namespace App\Repository\Employee;

use App\Utility;
use App\Constant;
use Carbon\Carbon;
use App\Models\User;
use App\ReturnMessages;
use Yajra\DataTables\DataTables;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function employeeStore($paraData)
    {
        $returnObj = array();
        $returnObj['LaraManagement'] = ReturnMessages::INTERNAL_SERVER_ERROR;
        try {
            $profile_name = null;
            if(isset($paraData['profile'])) {
                // Corrected the array access for the profile file
                $profile_file = $paraData['profile'];
                $profile_name = uniqid() . '_' . time() . '.' . $profile_file->getClientOriginalExtension();
                // Used store method to save the file
                $profile_file->storeAs('employee', $profile_name, 'public');
            }
            $paraObj = new User();
            $paraObj->profile       = $profile_name;
            $paraObj->name          = $paraData['name'];
            $paraObj->email         = $paraData['email'];
            $paraObj->phone         = $paraData['phone'];
            $paraObj->nrc_number    = $paraData['nrc_number'];
            $paraObj->password      = $paraData['password'];
            $paraObj->birthday      = $paraData['birthday'];
            $paraObj->gender        = $paraData['gender'];
            $paraObj->address       = $paraData['address'];
            $paraObj->employee_id   = $paraData['employee_id'];
            $paraObj->department_id = $paraData['department_id'];
            $paraObj->date_of_join  = $paraData['date_of_join'];
            $paraObj->status        = $paraData['status'];
            $tempObj                = Utility::addCreated($paraObj);
            $paraObj->syncRoles($paraData['roles']);
            $tempObj->save();
            $returnObj['LaraManagement'] = ReturnMessages::OK;
            return $returnObj;
        } catch(\Exception $e) {
            $returnObj['LaraManagement'] = ReturnMessages::INTERNAL_SERVER_ERROR;
            return $returnObj;
        }
    }

    public function employeeDataTable()
    {
        $employee = User::with('getDepartment');
        return DataTables::of($employee)
        ->addColumn('profile', function ($each) {
            return '<div class="text-center p-1"><img src="' . $each->profilePath() . '" width="70px" height="70px" style="border-radius:10px;" class="border">'
                . '<p class="mb-0 p-1 text-mute">' . $each->name . '</p></div>';
        })
        ->addColumn('department', function ($each) {
            return $each->getDepartment ? $each->getDepartment->department : '-';
        })
        ->addColumn('roles', function ($each) {
            $roleBadge = '';
            foreach($each->roles as $role) {
                $roleBadge .= '<span class="badge rounded-pill bg-primary">' . $role->name . '</span> ';
            }
            return $roleBadge;
        })
        ->addColumn('actions', function ($each) {
            $action_edit = '<a href="' . route('employeeEdit', $each->id) . '"><span class="badge rounded-pill bg-primary"><i class="bx bx-edit-alt me-1"></span></i></a>';
            $action_delete = '<a href="' . route('employeeDelete', $each->id) . '"><span class="badge rounded-pill bg-primary"><i class=" bx bx-trash me-1"></span></i></a>';
            $action_detail = '<a href="' . route('employeeDetail', $each->id) . '"><span class="badge rounded-pill bg-primary"><i class=" menu-icon tf-icons bx bx-copy"></span></i></a>';
            return $action_edit . " | " . $action_delete . " | " . $action_detail;
        })

        ->editColumn('updated_at', function ($each) {
            return Carbon::parse($each->updated_at)->format('Y-m-d H:i:s');
        })
        ->editColumn('status', function ($each) {
            if ($each->status == 1) {
                return '<span class="badge rounded-pill bg-primary">Present</span>';
            } else {
                return '<span class="badge rounded-pill bg-danger">Leave</span>';
            }
        })
        ->rawColumns(['status','actions','profile','roles'])
        ->make(true);
    }

    public function employeeEdit($id)
    {
        $employee = User::find($id);
        return $employee;
    }

    public function getUpdate($paraData)
    {
        $returnObj = array();
        $returnObj['LaraManagement'] = ReturnMessages::INTERNAL_SERVER_ERROR;
        try {
            $id                     = $paraData['id'];
            $paraObj                = User::find($id);

            $profile_name = $paraObj->profile;
            if(isset($paraData['profile'])) {
                Storage::disk('public')->delete('employee/' . $paraObj->profile);
                $profile_file = $paraData['profile'];
                $profile_name = uniqid() . '_' . time() . '.' . $profile_file->getClientOriginalExtension();
                $profile_file->storeAs('employee', $profile_name, 'public');
            }
            $paraObj->profile       = $profile_name;
            $paraObj->name          = $paraData['name'];
            $paraObj->email         = $paraData['email'];
            $paraObj->phone         = $paraData['phone'];
            $paraObj->nrc_number    = $paraData['nrc_number'];
            $paraObj->password      = isset($paraData['password']) ? $paraData['password'] : $paraObj->password;
            $paraObj->birthday      = $paraData['birthday'];
            $paraObj->gender        = $paraData['gender'];
            $paraObj->address       = $paraData['address'];
            $paraObj->employee_id   = $paraData['employee_id'];
            $paraObj->department_id = $paraData['department_id'];
            $paraObj->date_of_join  = $paraData['date_of_join'];
            $paraObj->status        = $paraData['status'];
            $tempObj                = Utility::addUpdated($paraObj);
            $paraObj->syncRoles($paraData['roles']);
            $tempObj->save();
            $returnObj['LaraManagement'] = ReturnMessages::OK;
            return  $returnObj;
        } catch (\Exception $e) {
            $returnObj['LaraManagement'] = ReturnMessages::INTERNAL_SERVER_ERROR;
            return $returnObj;
        }
    }

    public function getDelete($id)
    {
        $returnObj = array();
        $returnObj['LaraManagement'] = ReturnMessages::INTERNAL_SERVER_ERROR;
        try {
            $paraObj = User::find($id);
            $tempObj = Utility::addDeleted($paraObj);
            $tempObj->save();
            $returnObj['LaraManagement'] = ReturnMessages::OK;
            return $returnObj;
        } catch (\Exception $e) {
            $returnObj['LaraManagement'] = ReturnMessages::INTERNAL_SERVER_ERROR;
            return $returnObj;
        }
    }

    public function employeeDetail($id)
    {
        $employee = User::find($id);
        return $employee;
    }
}

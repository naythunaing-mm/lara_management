<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Repository\Role\RoleRepositoryInterface;
use App\Repository\Employee\EmployeeRepositoryInterface;
use App\Repository\Department\DepartmentRepositoryInterface;
use Carbon\Carbon;

class QrCodeController extends Controller
{
    private $employeeRepository;
    private $departmentRepository;
    private $roleRepository;
    public function __construct(
        EmployeeRepositoryInterface $employeeRepository,
        DepartmentRepositoryInterface $departmentRepository,
        RoleRepositoryInterface $roleRepository,
    ) {
        DB::connection()->enableQueryLog();
        $this->employeeRepository   = $employeeRepository;
        $this->departmentRepository = $departmentRepository;
        $this->roleRepository       = $roleRepository;
    }
    public function QRgenerator($id)
    {
        $qrCode = QrCode::size(200)
            ->backgroundColor(105, 108, 255)
            ->color(255, 255, 255)
            ->margin(1)
            ->generate(getSiteSetting()->name);


        $employee    = $this->employeeRepository->employeeEdit($id);
        $roles       = $this->roleRepository->getRoles();
        $departments = $this->departmentRepository->getDepartments();
        $oldRoles    = $employee->roles->pluck('id');
        return view('layouts.Backend.QR.attendance', compact(['employee','departments','roles','oldRoles','qrCode']));
    }

    public function checkin(Request $request)
    {
        $addentance = new Attendance();
        $addentance->user_id = $request->employee_id;
        $addentance->created_at = Carbon::now();
        $addentance->updated_at = Carbon::now();
        $addentance->date = Carbon::today();
        $addentance->save();
        return redirect()->back()->with('success_msg', 'Update Data Successful.');
    }
}

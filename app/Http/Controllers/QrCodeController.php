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
use Yajra\DataTables\DataTables;

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
        $id = $request->employee_id;

        $attendance = Attendance::where('date', Carbon::today())
            ->where('user_id', $id)
            ->first();

        if (!$attendance) {
            $attendance = new Attendance();
            $attendance->user_id = $id;
            $attendance->created_at = Carbon::now();
            $attendance->updated_at = null;
            $attendance->date = Carbon::today();
            $attendance->save();

            return redirect()->back()->with('success_msg', 'Check-in successful.');
        } else {
            return redirect()->back()->with('error_msg', 'You have already checkein for today.');
        }

    }

    public function checkout(Request $request)
    {
        $id = $request->employee_id;

        $attendance = Attendance::where('date', Carbon::today())
            ->where('user_id', $id)
            ->first();
        if (is_null($attendance->updated_at)) {
            $attendance->updated_at = Carbon::now();
            $attendance->save();
            return redirect()->back()->with('success_msg', 'Check-out successful.');
        } else {
            return redirect()->back()->with('error_msg', 'You have already checke-out for today.');
        }
    }


    public function attendanceListing()
    {
        return view('layouts.Backend.QR.attendanceListing');
    }

    public function attendanceDataTable()
    {
        $attendance = Attendance::with('getUserID');

        return DataTables::of($attendance)
        ->addColumn('user_id', function ($attendance) {
            return $attendance->getUserID?->formatted_id ?? 'N/A';
        })
        ->addColumn('name', function ($attendance) {
            return $attendance->getUserID?->name ?? 'N/A';
        })
        ->addColumn('date', function ($attendance) {
            return Carbon::parse($attendance->created_at)->format('Y-m-d');
        })
        ->addColumn('actions', function ($attendance) {
            return '<button class="btn btn-sm btn-primary">Edit</button>
                    <button class="btn btn-sm btn-danger">Delete</button>';
        })
        ->editColumn('checkin', function ($attendance) {
            return Carbon::parse($attendance->created_at)
                ->setTimezone('Asia/Yangon')
                ->format('H:i:s');
        })
        ->editColumn('checkout', function ($attendance) {
            return $attendance->updated_at
                ? Carbon::parse($attendance->updated_at)
                    ->setTimezone('Asia/Yangon')
                    ->format('H:i:s')
                : 'N/A';
        })

        ->rawColumns(['actions'])
        ->make(true);

    }
}

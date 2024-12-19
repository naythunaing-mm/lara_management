<?php

namespace App\Http\Controllers;

use App\Utility;
use Carbon\Carbon;
use App\Models\User;
use Carbon\CarbonPeriod;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Repository\Role\RoleRepositoryInterface;
use App\Repository\Employee\EmployeeRepositoryInterface;
use App\Repository\Department\DepartmentRepositoryInterface;

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
            $attendance->created_at = Carbon::now('Asia/Yangon');
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
            $attendance->updated_at = Carbon::now('Asia/Yangon');
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
            return Carbon::parse($attendance->date)->format('Y-m-d');
        })
        ->addColumn('actions', function ($attendance) {
            return '<button class="btn btn-sm btn-primary">Edit</button>
                    <button class="btn btn-sm btn-danger">Delete</button>';
        })
        ->editColumn('created_at', function ($attendance) {
            return Carbon::parse($attendance->created_at)
                ->setTimezone('Asia/Yangon')
                ->format('H:i:s');
        })
        ->editColumn('updated_at', function ($attendance) {
            return $attendance->updated_at
                ? Carbon::parse($attendance->updated_at)
                    ->setTimezone('Asia/Yangon')
                    ->format('H:i:s')
                : 'N/A';
        })

        ->rawColumns(['actions'])
        ->make(true);

    }

    public function attendanceOverView()
    {
        return view('layouts.Backend.QR.attendanceOverView');
    }

    public function attendanceOverViewTable(Request $request)
    {
        $weekends = [];
        $month = $request->month;
        $year =  $request->year;
        $startOfMonth = $year . '-' . $month . '-1';
        $endOfMonth = Carbon::createFromDate($startOfMonth)->endOfMonth();
        $periods = new CarbonPeriod($startOfMonth, $endOfMonth);
        foreach ($periods as $date) {
            if ($date->isSaturday() || $date->isSunday()) {
                $weekends[] = $date->format('Y-m-d');
            }
        }
        $publicHolidays = Utility::getPublicHolidays($year);
        $employeeList    = $this->employeeRepository->employeeList();
        $attendances = Attendance::whereMonth('date', $month)->whereYear('date', $year)->get();
        return view('layouts.Backend.components.attendanceOverViewTable', compact(['periods','employeeList','attendances','weekends','publicHolidays']))->render();
    }
}

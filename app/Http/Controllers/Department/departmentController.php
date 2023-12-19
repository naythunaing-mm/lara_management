<?php

namespace App\Http\Controllers\Department;

use App\Utility;
use App\ReturnMessages;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Department\departmentRequest;
use App\Repository\Department\DepartmentRepositoryInterface;

class departmentController extends Controller
{
    private $departmentRepository;
    public function __construct(DepartmentRepositoryInterface $departmentRepository) {
        DB::connection()->enableQueryLog();
        $this->departmentRepository = $departmentRepository;
    }
    public function departmentForm() {
        return view('layouts.Backend.Department.departmentForm');
    }

    public function departmentStore(departmentRequest $request) {
        try {
            $result = $this->departmentRepository->departmentStore($request->all());
            $logs   = "Department Insert Screen :: ";
            Utility::saveLog($logs);
            if($result['LaraHR'] == ReturnMessages::OK) {
                return redirect('admin-backend/department/departmentListing');
            } else {
                return redirect('admin-backend/department/departmentListing');
            }
        } catch (\Exception $e) {
            $logs = "Department Insert Error ::";
            $logs = $e->getMessage();
            abort(500);
        }
    }

    public function departmentListing() {
        try {
            $departments = $this->departmentRepository->getDepartments();
            $logs        = "Department Listing Screen ::";
            Utility::saveLog($logs);
            return view('layouts.Backend.Department.departmentListing',compact(['departments']));
        } catch(\Exception $e) {
            $logs = "Department Listing Error ::";
            $logs = $e->getMessage();
            abort(500);
        }
    }

    public function editForm($id) {
        try {
            $departments = $this->departmentRepository->editForm($id);
            return view('layouts.Backend.Department.departmentForm',compact(['departments']));
        } catch(\Exception $e) {
            abort(500);
        }
    }
}

<?php

namespace App\Repository\Employee;

interface EmployeeRepositoryInterface
{
    public function employeeStore($paraData);
    public function employeeListing();
    public function employeeEdit($id);
}

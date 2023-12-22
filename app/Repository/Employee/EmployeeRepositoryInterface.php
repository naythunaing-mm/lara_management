<?php

namespace App\Repository\Employee;

interface EmployeeRepositoryInterface
{
    public function employeeStore($paraData);
    public function employeeListing();
    public function employeeEdit($id);
    public function getUpdate($paraData);
    public function getDelete($id);
    public function employeeDetail($id);
}

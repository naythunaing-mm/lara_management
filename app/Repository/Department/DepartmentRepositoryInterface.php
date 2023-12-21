<?php

namespace App\Repository\Department;

interface DepartmentRepositoryInterface
{
    public function departmentStore($paraData);
    public function getDepartments();
    public function editForm($id);
    public function getUpdate($paraData);
    public function getDelete($id);
}

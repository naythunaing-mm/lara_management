<?php

namespace App\Repository\Role;

interface RoleRepositoryInterface
{
    public function roleStore($paraData);
    public function getRoles();
    public function editForm($id);
    public function getUpdate($paraData);
    public function getDelete($id);
}

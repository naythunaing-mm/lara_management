<?php

namespace App\Repository\Permission;

interface PermissionRepositoryInterface
{
    public function permissionStore($paraData);
    public function getPermissions();
    public function editForm($id);
    public function getUpdate($paraData);
    public function getDelete($id);
}

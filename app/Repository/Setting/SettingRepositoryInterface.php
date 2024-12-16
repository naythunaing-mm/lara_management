<?php

namespace App\Repository\Setting;

interface SettingRepositoryInterface
{
    public function editForm();
    public function getUpdate($data);
}

<?php

namespace App\Repository\Setting;

use App\Models\siteSettings;
use App\Repository\Setting\SettingRepositoryInterface;

class settingRepository implements SettingRepositoryInterface
{
    public function editForm()
    {
        $settings = siteSettings::first();
        return $settings;
    }
}

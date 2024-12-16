<?php

namespace App\Repository\Setting;

use App\ReturnMessages;
use App\Models\siteSettings;
use App\Repository\Setting\SettingRepositoryInterface;

class settingRepository implements SettingRepositoryInterface
{
    public function editForm()
    {
        $settings = siteSettings::first();
        return $settings;
    }

    public function getUpdate($paraData)
    {
        $returnObj                       = array();
        $returnObj['LaraManagement']     = ReturnMessages::INTERNAL_SERVER_ERROR;
        try {
            $id                          = $paraData['id'];
            $paraObj                     = siteSettings::find($id);
            $paraObj->name               = $paraData['name'];
            $paraObj->email              = $paraData['email'];
            $paraObj->address            = $paraData['address'];
            $paraObj->checkin            = $paraData['checkin'];
            $paraObj->checkout           = $paraData['checkout'];
            $paraObj->break_start        = $paraData['break_start'];
            $paraObj->break_end          = $paraData['break_end'];
            $paraObj->hotel_checkin      = $paraData['hotel_checkin'];
            $paraObj->hotel_checkout     = $paraData['hotel_checkout'];
            $paraObj->online_phone       = $paraData['online_phone'];
            $paraObj->size_unit          = $paraData['size_unit'];
            $paraObj->occupancy          = $paraData['occupancy'];
            $paraObj->price_unit         = $paraData['price_unit'];
            $paraObj->save();
            $returnObj['LaraManagement'] = ReturnMessages::OK;
            return $returnObj;
        } catch (\Exception $e) {
            $returnObj['LaraManagement'] = ReturnMessages::INTERNAL_SERVER_ERROR;
            return $returnObj;
        }
    }
}

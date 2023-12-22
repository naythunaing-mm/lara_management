<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Repository\Setting\SettingRepositoryInterface;

class settingController extends Controller
{
    private $settingRepository;
    public function __construct(SettingRepositoryInterface $settingRepository)
    {
        DB::connection()->enableQueryLog();
        $this->settingRepository = $settingRepository;
    }
    public function editForm()
    {
        try {
            $settings = $this->settingRepository->editForm();
            return view('layouts.Backend.Setting.setting', compact(['settings']));
        } catch(\Exception $e) {
            abort(500);
        }
    }
}

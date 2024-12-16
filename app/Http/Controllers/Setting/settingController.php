<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function settingUpdate(Request $request)
    {
        try {
            $settingUpdate = $this->settingRepository->getUpdate($request->all());
            if ($settingUpdate) {
                return redirect()->back()->with('success_msg', 'Update data successful.');
            } else {
                return redirect()->back()->with('error_msg', 'Something wrong!');
            }

        } catch (\Exception $e) {
            abort(500);
        }
    }
}

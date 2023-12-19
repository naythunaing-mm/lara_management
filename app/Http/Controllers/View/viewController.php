<?php

namespace App\Http\Controllers\View;

use App\ReturnMessages;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\View\viewRequest;
use App\Repository\View\ViewRepositoryInterface;
use App\Utility;

class viewController extends Controller
{
    private $viewRepository;
    public function __construct(ViewRepositoryInterface $viewRepository) {
        DB::connection()->enableQueryLog();
        $this->viewRepository = $viewRepository;
    }

    public function viewListing() {
        try {
            $views = $this->viewRepository->getViews();
            $logs  = "View Listing Screen :: ";
            Utility::saveLog($logs);
            return view('layouts.Backend.View.viewListing',compact(['views']));
        } catch (\Exception $e) {
            $logs = "View Listing Error ::";
            $logs = $e->getMessage();
            abort(500);
        }
    }

    public function viewForm() {
        return view('layouts.Backend.View.viewForm');
    }

    public function viewStore(viewRequest $request) {
       
        try {
            $result = $this->viewRepository->viewStore($request->all());
            $logs   = "View Insert Screen :: ";
            Utility::saveLog($logs);
            if ($result['LaraHR'] == ReturnMessages::OK) {
                return redirect('admin-backend/view/viewListing')->with('success_msg','Insert Data Successful.');
            } else {
                return redirect('admin-backend/view/viewListing')->with('error_msg','Insert Data Fail!');
            }
        } catch (\Exception $e) {
            $logs = "View Insert Error ::";
            $logs = $e->getMessage();
            abort(500);
        }

    }

    public function editForm($id) {
        try {
            $view = $this->viewRepository->viewEdit($id);
            return view('layouts.Backend.View.viewForm',compact(['view']));
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function viewUpdate(viewRequest $request) {
        try {
            $result = $this->viewRepository->viewUpdate($request->all());
            $logs   = "View Update Screen :: ";
            Utility::saveLog($logs);
            if ($result['LaraHR'] == ReturnMessages::OK) {
                return redirect('admin-backend/view/viewListing')->with('success_msg','Data Insert Successful.');
            } else {
                return redirect('admin-backend/view/viewListing')->with('error_msg','Data Insert Fail!');
            }
        } catch (\Exception $e) {
            $logs = "View Update Error ::";
            $logs = $e->getMessage();
            abort(500);
        }
    }

    public function viewDelete($id) {
        try {
            $result = $this->viewRepository->viewDelete($id);
            $logs   = "View Delete Screen :: ";
            Utility::saveLog($logs);
            if($result['LaraHR'] == ReturnMessages::OK) {
                return redirect('admin-backend/view/viewListing')->with('success_msg','Delete Data Successful.');
            } else {
                return redirect('admin-backend/view/viewListing')->with('success_msg','Delete Data  Fail!');
            }
        } catch (\Exception $e) {
            $logs   = "View Delete Screen :: ";
            Utility::saveLog($logs);
            abort(500);
        }
    }
    
}

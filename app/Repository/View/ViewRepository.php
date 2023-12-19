<?php 
namespace App\Repository\View;
use App\Utility;
use App\Constant;
use App\Models\View;
use App\ReturnMessages;
use App\Repository\View\ViewRepositoryInterface;

class ViewRepository implements ViewRepositoryInterface {
    public function getViews() {
        $views = View::SELECT("id","name")
                ->whereNULL("deleted_at")
                ->orderBy("id","asc")
                ->paginate(Constant::PAGE_LIMIT);
        return $views;
    }

    public function viewEdit($id) {
        $view = View::find($id);
        return $view;
    }

    public function viewStore($paraData) {
        $returnObj = array();
        $returnObj['LaraHR'] = ReturnMessages::INTERNAL_SERVER_ERROR;
        try {
            $paraObj = new View();
            $paraObj->name = $paraData['name'];
            $tempObj       = Utility::addCreated($paraObj);
            $tempObj->save();
            $returnObj['LaraHR'] = ReturnMessages::OK;
            return $returnObj;
        } catch (\Exception $e) {
            $returnObj['LaraHR'] = ReturnMessages::INTERNAL_SERVER_ERROR;
            return $returnObj;
        }
    }

    public function viewUpdate($paraData) {
        $returnObj = array();
        $returnObj['LaraHR'] = ReturnMessages::INTERNAL_SERVER_ERROR;
        try {
            $id = $paraData['id'];
            $paraObj = View::find($id);
            $paraObj->name = $paraData['name'];
            $tempObj       = Utility::addUpdated($paraObj);
            $tempObj->save();
            $returnObj['LaraHR'] = ReturnMessages::OK;
            return $returnObj;
        } catch (\Exception $e) {
            $returnObj['LaraHR'] = ReturnMessages::INTERNAL_SERVER_ERROR;
            return $returnObj;
        }
    }

    public function viewDelete($id) {
        $returnObj = array();
        $returnObj['LaraHR'] = ReturnMessages::INTERNAL_SERVER_ERROR;
        try {
            $paraObj = View::find($id);
            $temObj  = Utility::addDeleted($paraObj);
            $temObj->save();
            $returnObj['LaraHR'] = ReturnMessages::OK;
            return $returnObj;
        } catch (\Exception $e) {
            $returnObj['LaraHR'] = ReturnMessages::INTERNAL_SERVER_ERROR;
            return $returnObj;
        }
    }
}
?>
<?php 
namespace App\Repository\View;
interface ViewRepositoryInterface {
    public function getViews();
    public function viewEdit($id);
    public function viewStore($paraData);
    public function viewUpdate($paraData);
    public function viewDelete($id);
}
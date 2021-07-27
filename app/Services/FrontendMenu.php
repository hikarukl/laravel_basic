<?php


namespace App\Services;

use App\Models\FrontendMenu as FrontendMenuModel;

class FrontendMenu
{
    public function getAllActiveMenus()
    {
        return FrontendMenuModel::active()->get();
    }
}
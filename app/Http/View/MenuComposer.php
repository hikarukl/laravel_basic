<?php

namespace App\Http\View;


use App\Models\AdminMenu;
use App\Models\FrontendMenu;
use Illuminate\View\View;

class MenuComposer
{
    /**
     * Bind data to view
     *
     *
     */
    public function compose(View $view)
    {
        $pageName = request()->route()->getName();
        $activeMenuInfo = $this->activeMenu($pageName);

        $view->with('menu_list', $activeMenuInfo['menu_list']);
        $view->with('parent_active_index', $activeMenuInfo['parent_active_index']);
        $view->with('child_active_index', $activeMenuInfo['child_active_index']);
        $view->with('layout', 'master');
    }

    public function activeMenu($pageName)
    {
        $rootMenu ='';
        $childMenu ='';

        $isAdmin = request()->segment(1) === 'admin';

        if (!$isAdmin) {
            $listMenu = FrontendMenu::active()->get();
        } else {
            $listMenu = AdminMenu::active()->get();
        }

        foreach ($listMenu as $key => $menu) {
            if ($menu->route == $pageName) {
                $rootMenu = $key;
            }

            if ($menu->subMenus->isNotEmpty()) {
                foreach ($menu->subMenus as $keySub => $subMenu) {
                    if ($subMenu->route  == $pageName) {
                        $rootMenu = $key;
                        $childMenu = $keySub;
                    }
                }
            }
        }

        return [
            'parent_active_index' => $rootMenu,
            'child_active_index'  => $childMenu,
            'menu_list'           => $listMenu
        ];
    }
}
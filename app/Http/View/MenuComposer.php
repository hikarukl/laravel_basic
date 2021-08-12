<?php

namespace App\Http\View;


use App\Models\AdminMenu;
use App\Models\FrontendMenu;
use App\Models\Role;
use Illuminate\View\View;
use App\Services\AdminMenu as AdminMenuService;

class MenuComposer
{
    /**
     * @var AdminMenuService
     */
    protected $adminMenuService;

    public function __construct(AdminMenuService $adminMenuService)
    {
        $this->adminMenuService = $adminMenuService;
    }

    /**
     * Bind data to view
     *
     *
     */
    public function compose(View $view)
    {
        if (request()->route()) {
            $pageName = request()->route()->getName();
            $activeMenuInfo = $this->activeMenu($pageName);

            $view->with('menu_list', $activeMenuInfo['menu_list']);
            $view->with('parent_active_index', $activeMenuInfo['parent_active_index']);
            $view->with('child_active_index', $activeMenuInfo['child_active_index']);
            $view->with('layout', $activeMenuInfo['layout']);
        }
    }

    public function activeMenu($pageName)
    {
        $rootMenu ='';
        $childMenu ='';

        $isAdminPage = request()->segment(1) === 'admin';

        if (!$isAdminPage) {
            $listMenu = FrontendMenu::active()->get();
        } else {
            $user = auth()->user();

            $listMenu = collect();
            if ($user) {
                if ($user->hasRole(Role::ROLE_ADMIN_NAME)) {
                    $listMenu = AdminMenu::menuList()->get();
                } else {
                    // Filter for user not admin
                    $listMenu = $user->getRootMenus();
                }
            }
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
            'menu_list'           => $listMenu,
            'layout'              => $isAdminPage ? 'layout.app' : 'master'
        ];
    }
}
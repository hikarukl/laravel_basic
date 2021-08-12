<?php

namespace App\Traits;

use App\Models\AdminHasMenu as AdminHasMenuModel;
use App\Models\AdminMenu;
use App\Models\AdminMenu as AdminMenuModel;
use App\Models\Role;
use App\Models\RoleHasMenu;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Collection;

trait AdminHasMenus
{
    /**
     * @var Collection
     */
    protected $rootMenus;

    /**
     * @var Collection
     */
    protected $childMenus;

    /**
     * Get root menus of user
     * is_root = 1
     * status = 1
     *
     * @return Collection
     *
     */
    public function getRootMenus()
    {
        // Check role admin
        if ($this->hasRole(Role::ROLE_ADMIN_NAME)) {
            $this->rootMenus = AdminMenuModel::where('status', AdminMenuModel::STATUS_ACTIVE)
                ->where('is_root', AdminMenuModel::MENU_IS_ROOT_NUM)
                ->get();
        } else {
            // Root menus config for user
            $listMenuIdUser = AdminHasMenuModel::where('admin_id', $this->id)
                ->join('admin_menus', 'admin_menus.id', '=', 'admin_has_menus.admin_menu_id')
                ->where('status', AdminMenuModel::STATUS_ACTIVE)
                ->where('is_root', AdminMenuModel::MENU_IS_ROOT_NUM)
                ->get()
                ->pluck('admin_menu_id')->toArray();

            // Root menus config for user's roles
            $listMenuIdRole = [];
            foreach ($this->getRoles() as $role) {
                $menuRole = $role->menus()->get()
                    ->where('status', AdminMenuModel::STATUS_ACTIVE)
                    ->where('is_root', AdminMenuModel::MENU_IS_ROOT_NUM)
                    ->pluck('id')->toArray();
                $listMenuIdRole = array_merge($listMenuIdRole, $menuRole);
            }

            $this->rootMenus = AdminMenuModel::whereIn('admin_menus.id', array_merge($listMenuIdRole, $listMenuIdUser))
                ->get();
        }

        return $this->rootMenus;
    }

    /**
     * Get child menus of user
     * is_root = 0
     * status = 1
     *
     * @return Collection
     *
     */
    public function getChildMenusOfRoot($rootId)
    {
        // Check role admin
        if ($this->hasRole(Role::ROLE_ADMIN_NAME)) {
            $this->childMenus = AdminMenuModel::where('status', AdminMenuModel::STATUS_ACTIVE)
                ->join('admin_menu_relations', 'admin_menu_relations.child_id', '=', 'admin_menus.id')
                ->where('admin_menu_relations.parent_id', $rootId)
                ->get();
        } else {
            // List menus config for user
            $listMenuIdUser = AdminHasMenuModel::where('admin_id', $this->id)
                ->join('admin_menus', 'admin_menus.id', '=', 'admin_has_menus.admin_menu_id')
                ->join('admin_menu_relations', 'admin_menu_relations.child_id', '=', 'admin_has_menus.admin_menu_id')
                ->where('status', AdminMenuModel::STATUS_ACTIVE)
                ->where('parent_id', $rootId)
                ->get()
                ->pluck('admin_menu_id')->toArray();

            // List menus config for user's roles
            $listMenuIdRole = [];
            foreach ($this->getRoles() as $role) {
                $menuRole = RoleHasMenu::where('role_id', $role->id)
                    ->join('admin_menus', 'admin_menus.id', '=', 'role_has_menus.admin_menu_id')
                    ->join('admin_menu_relations', 'admin_menu_relations.child_id', '=', 'role_has_menus.admin_menu_id')
                    ->where('status', AdminMenuModel::STATUS_ACTIVE)
                    ->where('parent_id', $rootId)
                    ->get()
                    ->pluck('admin_menu_id')->toArray();
                $listMenuIdRole = array_merge($listMenuIdRole, $menuRole);
            }

            $this->childMenus = AdminMenuModel::whereIn('admin_menus.id', array_merge($listMenuIdRole, $listMenuIdUser))
                ->get();
        }

        return $this->childMenus;
    }

    /**
     * Check menu of user
     *
     * @return bool
     *
     */
    public function hasMenu($menuSlugName)
    {
        $menuInfo = AdminMenu::where('slug', $menuSlugName)
            ->where('status', AdminMenu::STATUS_ACTIVE)
            ->first();

        if ($menuInfo) {
            $isUserHasMenu = AdminHasMenuModel::where('admin_menu_id', $menuInfo->id)
                ->where('admin_id', $this->id)
                ->get()
                ->isNotEmpty();

            if (!$isUserHasMenu) {
                $isUserHasMenu = RoleHasMenu::where('admin_menu_id', $menuInfo->id)
                    ->whereIn('role_id', $this->getRoles()->pluck('id')->toArray())
                    ->get()
                    ->isNotEmpty();
            }

            return $isUserHasMenu;
        }

        return false;
    }

}
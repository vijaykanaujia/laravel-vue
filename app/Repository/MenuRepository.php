<?php

namespace App\Repository;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class MenuRepository
{
    public function getMenu(User $user)
    {
        $menuIds = $user->getPermissionsViaRoles()->pluck('menu_id')->unique()->toArray();
        $menu = $user->hasRole('super-admin') ? Menu::where('status', 1) : Menu::whereIn('id', $menuIds)->where('status', 1);
        return $this->sortMenu($menu->orderBy('position', 'asc')->get());
    }

    protected function sortMenu(Collection $menu)
    {
        $parentMenus = $menu->where('parent_id', 0);
        foreach ($parentMenus as $parentMenu) {
            $submenu = $menu->where('parent_id', $parentMenu->id);
            if ($submenu->isNotEmpty()) {
                $parentMenu['submenu'] = $submenu->values()->toArray();
            }
        }
        return $parentMenus->values();
    }

}

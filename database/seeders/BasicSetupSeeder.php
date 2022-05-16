<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class BasicSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(1);
        $menu = Menu::create(['title' => 'Role', 'page' => 'role.index']);
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'menu.create', 'menu_id' => $menu->id]);

        $role->givePermissionTo($permission);
        $user->assignRole($role);

    }
}

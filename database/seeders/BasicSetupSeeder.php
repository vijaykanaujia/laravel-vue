<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BasicSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'super admin',
            'email' => 'superadmin@test.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $role = Role::create(['name' => 'super-admin']);
        $user->assignRole($role);
        $menus = [
            ['title' => 'Menu', 'page' => 'menu.index'],
            ['title' => 'Role', 'page' => 'role.index'],
            ['title' => 'Permission', 'page' => 'permission.index'],
            ['title' => 'User', 'page' => 'user.index'],
        ];
        foreach($menus as $menu){
            $menu = Menu::create(['title' => $menu['title'], 'page' => $menu['page']]);
            // $permission = Permission::create(['name' => $menu->page, 'menu_id' => $menu->id]);
            // $role->givePermissionTo($permission);
        }


    }
}

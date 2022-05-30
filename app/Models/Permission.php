<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;
use App\Traits\BaseModelTrait;
use App\Models\Menu;

class Permission extends SpatiePermission
{
    use HasFactory, BaseModelTrait;

    protected $guarded = [];
    protected $perPage = 10;

    protected $relations = ['menu'];

    public function getDisplayedColumns(){
        return ([
            ['ref' => 'select', 'name' => 'Select'],
            ['ref' => 'id', 'name' => 'ID'],
            ['ref' => 'name', 'name' => 'Name'],
            ['ref' => 'guard_name', 'name' => 'Guard Name'],
            ['ref' => 'menu_id', 'name' => 'Menu', 'data_type' => 'relation', 'data_string' => 'menu.title' ],
            ['ref' => 'created_at', 'name' => 'Created At', 'data_type' => 'date'],
            ['ref' => 'action', 'name' => 'Action', 'action_type'=> 
            [
                ['name' => 'edit', 'route_name' => 'permission.edit'],
                ['name' => 'delete', 'route_name' => 'permission.destroy'],
                ['name' => 'show', 'route_name' => 'permission.show']
            ]
            ]
        ]);
    }

    public function getAllColumns()
    {
        return ([
            'id' => 'int',
            'name' => 'text',
            'guard_name' => 'text',
            'menu_id' => 'int',
            'created_at' => 'date',
            'updated_at' => 'date',
        ]);
    }

    public function getDefaultColumns()
    {
        return [
            'id',
            'name',
            'guard_name',
            'menu_id',
            'created_at',
            'updated_at',
        ];
    }

    public function searchableColumns(){
        return [
            'name',
            'guard_name'
        ];
    }

    public function menu(){
        return $this->belongsTo(Menu::class);
    }
}

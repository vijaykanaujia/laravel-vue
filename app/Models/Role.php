<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;
use App\Traits\BaseModelTrait;

class Role extends SpatieRole
{
    use HasFactory, BaseModelTrait;

    protected $perPage = 10;

    public function getDisplayedColumns(){
        return ([
            ['ref' => 'select', 'name' => 'Select'],
            ['ref' => 'id', 'name' => 'ID'],
            ['ref' => 'name', 'name' => 'Name'],
            ['ref' => 'guard_name', 'name' => 'Guard'],
            ['ref' => 'action', 'name' => 'Action', 'action_type'=> 
            [
                ['name' => 'edit', 'route_name' => 'role.edit'],
                ['name' => 'delete', 'route_name' => 'role.destroy']
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
        ];
    }

    public function searchableColumns(){
        return [
            'name',
            'guard_name'
        ];
    }
}

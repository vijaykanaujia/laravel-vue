<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use App\Models\Permission;

class Menu extends BaseModel
{
    use HasFactory;
    public $timestamps = false;

    protected $relations = [
        'permissions',
    ];

    protected $guarded = [];

    public function getDisplayedColumns(){
        return ([
            ['ref' => 'select', 'name' => 'Select'],
            ['ref' => 'id', 'name' => 'ID'],
            ['ref' => 'title', 'name' => 'Title'],
            ['ref' => 'description', 'name' => 'Description'],
            ['ref' => 'icon', 'name' => 'Icon'],
            ['ref' => 'page', 'name' => 'Page'],
            ['ref' => 'parent_id', 'name' => 'Parent'],
            ['ref' => 'status', 'name' => 'Status'],
            ['ref' => 'action', 'name' => 'Action', 'action_type'=> 
            [
                ['name' => 'edit', 'route_name' => 'menu.edit'],
                ['name' => 'delete', 'route_name' => 'menu.destroy'],
                ['name' => 'show', 'route_name' => 'menu.show']
            ]
            ]
        ]);
    }

    public function getAllColumns()
    {
        return ([
            'id' => 'int',
            'title' => 	'text',
            'description' => 'text',
            'icon' => 'text',
            'page' => 'text',
            'parent_id' => 'text',
            'position' => 'text',
            'status' => 'int'
        ]);
    }

    public function getDefaultColumns()
    {
        return [
            'id',
            'title',
            'description',
            'icon',
            'page',
            'parent_id',
            'position',
            'status',
        ];
    }

    public function searchableColumns(){
        return [
            'title',
            'description',
            'parent_id'
        ];
    }

    public function permissions()
    {
        return $this->hasMany(permission::class);
    }
}

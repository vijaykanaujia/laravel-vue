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
    protected $with = ['parent'];

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
            ['ref' => 'action', 'name' => 'Action', 'actions'=> 
            [
                ['name' => 'edit', 'route_name' => 'menu.edit', 'type' => 'link', 'icon' => 'M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z'],
                ['name' => 'delete', 'route_name' => 'menu.destroy', 'type' => 'link', 'icon' => 'M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z'],
                ['name' => 'show', 'route_name' => 'menu.show', 'type' => 'link', 'icon' => 'M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z']
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
        return $this->hasMany(Permission::class);
    }

    public function parent(){
        return $this->belongsTo($this, 'parent_id');
    }
}

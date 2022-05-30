<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\BaseModelTrait;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, BaseModelTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getDisplayedColumns(){
        return ([
            ['ref' => 'select', 'name' => 'Select'],
            ['ref' => 'id', 'name' => 'ID'],
            ['ref' => 'name', 'name' => 'Name'],
            ['ref' => 'email', 'name' => 'Email'],
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
            'email' => 'text',
            'created_at' => 'date',
            'updated_at' => 'date',
        ]);
    }

    public function getDefaultColumns()
    {
        return [
            'id',
            'name',
            'email',
            'created_at',
            'updated_at',
        ];
    }

    public function searchableColumns(){
        return [
            'name',
            'email'
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permisions;

class Menu extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $relations = [
        'permissions',
    ];

    public function permissions()
    {
        return $this->hasMany(permission::class);
    }
}

<?php
namespace App\Http\Controllers;

use App\Models\User;

class UserService {

    public function __construct() {
        $this->user = new User();
    }

    public function assignRole($userId, $roleId) {
        $user = $this->user->find($userId);
        $user->assignRole($roleId);
    }
}
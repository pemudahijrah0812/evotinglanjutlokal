<?php

namespace App\Services;

use App\Models\UserModel;

class AuthService
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login(string $email, string $password)
    {
        $user = $this->userModel
            ->where('email', $email)
            ->first();

        if (!$user) {
            return null;
        }

        if (!password_verify($password, $user['password_hash'])) {
            return null;
        }

        // Jangan kirim password_hash ke frontend
        unset($user['password_hash']);

        return $user;
    }
}

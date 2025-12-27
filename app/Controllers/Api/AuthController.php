<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Services\AuthService;

class AuthController extends BaseController
{
    protected $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function login()
{
    // 1. Ambil JSON body
    $data = $this->request->getJSON(true);

    // 2. Fallback jika JSON tidak terbaca
    if (empty($data)) {
        $data = $this->request->getPost();
    }

    $email = $data['email'] ?? null;
    $password = $data['password'] ?? null;

    // 3. Validasi input
    if (!$email || !$password) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Email dan password wajib diisi'
        ])->setStatusCode(400);
    }

    // 4. Proses login
    $user = $this->authService->login($email, $password);

    if (!$user) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Email atau password salah'
        ])->setStatusCode(401);
    }

    // 5. Response sukses
    return $this->response->setJSON([
        'status' => 'success',
        'data' => [
            'user_id' => (int) $user['user_id'],
            'nama' => $user['nama'],
            'email' => $user['email'],
            'user_type' => $user['user_type'],
            'is_verified' => (int) $user['is_verified'],
            'profile_image_url' => $user['profile_image_url']
        ]
    ]);
}


}

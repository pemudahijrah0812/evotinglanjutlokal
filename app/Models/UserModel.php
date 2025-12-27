<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';

    protected $allowedFields = [
        'nama',
        'email',
        'nim',
        'password_hash',
        'user_type',
        'is_verified',
        'profile_image_url'
    ];

    protected $returnType = 'array';
    protected $useTimestamps = true;
}

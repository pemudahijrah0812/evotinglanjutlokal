<?php

namespace App\Models;

use CodeIgniter\Model;

class ElectionModel extends Model
{
    protected $table            = 'elections';
    protected $primaryKey       = 'election_id';

    protected $allowedFields = [
        'nama_pemilihan',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_akhir',
        'status',
        'banner_url',
        'created_by',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'nama_pemilihan' => 'required|min_length[3]',
        'tanggal_mulai'  => 'required|valid_date',
        'tanggal_akhir'  => 'required|valid_date',
    ];
}

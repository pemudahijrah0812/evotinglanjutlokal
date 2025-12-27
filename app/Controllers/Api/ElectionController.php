<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\ElectionModel;

class ElectionController extends BaseController
{
    protected $electionModel;

    public function __construct()
    {
        $this->electionModel = new ElectionModel();
    }

    // GET /api/elections
    public function index()
    {
        $data = $this->electionModel
            ->orderBy('tanggal_mulai', 'DESC')
            ->findAll();

        return $this->response->setJSON([
            'status' => 'success',
            'data'   => $data
        ]);
    }

    // GET /api/elections/{id}
    public function show($id = null)
    {
        $election = $this->electionModel->find($id);

        if (!$election) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => 'Pemilihan tidak ditemukan'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'data'   => $election
        ]);
    }

    // POST /api/elections
    public function create()
    {
        $data = $this->request->getJSON(true);

        if (!$this->electionModel->insert($data)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status'  => 'error',
                'message' => $this->electionModel->errors()
            ]);
        }

        return $this->response->setStatusCode(201)->setJSON([
            'status'  => 'success',
            'message' => 'Pemilihan berhasil ditambahkan'
        ]);
    }

    // PUT /api/elections/{id}
    public function update($id = null)
    {
        if (!$this->electionModel->find($id)) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => 'Pemilihan tidak ditemukan'
            ]);
        }

        $data = $this->request->getJSON(true);
        $this->electionModel->update($id, $data);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Pemilihan berhasil diperbarui'
        ]);
    }

    // DELETE /api/elections/{id}
    public function delete($id = null)
    {
        if (!$this->electionModel->find($id)) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 'error',
                'message' => 'Pemilihan tidak ditemukan'
            ]);
        }

        $this->electionModel->delete($id);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Pemilihan berhasil dihapus'
        ]);
    }
}

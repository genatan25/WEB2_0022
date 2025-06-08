<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;
use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;

class UserController extends ResourceController
{
    protected $modelName = 'App\Models\UserModel';
    protected $format    = 'json'; // Format respons JSON

    /**
     * Mendapatkan semua pengguna
     */
    public function index()
    {
        $users = $this->model->findAll();
        return $this->respond($users);
    }

    /**
     * Mendapatkan pengguna berdasarkan ID
     *
     * @param int|null $id
     */
    public function show($id = null)
    {
        $user = $this->model->find($id);
        if (!$user) {
            return $this->failNotFound('User tidak ditemukan.');
        }
        return $this->respond($user);
    }

    /**
     * Menambahkan pengguna baru
     */
    public function create()
    {
        $data = $this->request->getPost();

        if (!$this->validate($this->model->validationRules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        // Hash password
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        $this->model->save($data);
        return $this->respondCreated(['message' => 'User berhasil ditambahkan.']);
    }

    /**
     * Mengupdate pengguna berdasarkan ID
     *
     * @param int|null $id
     */
    public function update($id = null)
    {
        $user = $this->model->find($id);
        if (!$user) {
            return $this->failNotFound('User tidak ditemukan.');
        }

        $data = $this->request->getRawInput();

        // Aturan validasi
        if (!$this->validate($this->model->validationRules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        } else {
            unset($data['password']); // Jangan update password jika kosong
        }

        $this->model->update($id, $data);
        return $this->respond(['message' => 'User berhasil diperbarui.']);
    }

    /**
     * Menghapus pengguna berdasarkan ID
     *
     * @param int|null $id
     */
    public function delete($id = null)
    {
        $user = $this->model->find($id);
        if (!$user) {
            return $this->failNotFound('User tidak ditemukan.');
        }

        $this->model->delete($id);
        return $this->respondDeleted(['message' => 'User berhasil dihapus.']);
    }
}

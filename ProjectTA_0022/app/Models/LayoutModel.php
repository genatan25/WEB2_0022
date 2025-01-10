<?php

namespace App\Models;

use CodeIgniter\Model;

class LayoutModel extends Model
{
    protected $table            = 'frontend_pages'; // Sesuaikan dengan nama tabel Anda
    protected $primaryKey       = 'id_page';        // Sesuaikan dengan primary key tabel Anda
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'page_type',
        'title',
        'content',
        'background_image',
        'last_modified_by',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Mengambil pengaturan halaman frontend berdasarkan page_type tertentu
     *
     * @param string $page_type
     * @return array|null
     */
    public function getSettings(string $page_type = 'homepage'): ?array
    {
        return $this->where('page_type', $page_type)->first();
    }

    /**
     * Memperbarui pengaturan halaman frontend
     *
     * @param array $data
     * @param int|null $id_page
     * @return bool
     */
    public function updatePageSettings(array $data, ?int $id_page = null): bool
    {
        if ($id_page) {
            return $this->update($id_page, $data);
        }

        // Jika tidak ada ID halaman yang diberikan, cari berdasarkan page_type
        $page_type = $data['page_type'] ?? 'homepage';
        $settings = $this->getSettings($page_type);

        if ($settings) {
            return $this->update($settings['id_page'], $data);
        }

        // Jika belum ada pengaturan, buat baru
        $data['page_type'] = $page_type;
        return $this->insert($data) !== false;
    }
}

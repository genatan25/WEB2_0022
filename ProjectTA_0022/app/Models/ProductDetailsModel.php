<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductDetailsModel extends Model
{
    protected $table = 'product_details';
    protected $primaryKey = 'id_detail';
    protected $allowedFields = ['id_produk', 'key', 'value'];
    protected $useTimestamps = false;

    /**
     * Get all product details with product names.
     *
     * @return array
     */
    public function getAllDetails(): array
    {
        return $this->select('product_details.id_detail, product_details.id_produk, products.nama_produk, product_details.key, product_details.value')
            ->join('products', 'product_details.id_produk = products.id_produk', 'inner')
            ->orderBy('id_detail', 'ASC')
            ->findAll();
    }

    /**
     * Get product details by product ID.
     *
     * @param int $productId
     * @return array
     */
    public function getDetailsByProductId(int $productId): array
    {
        return $this->select('product_details.id_detail, product_details.id_produk, products.nama_produk, product_details.key, product_details.value')
            ->join('products', 'product_details.id_produk = products.id_produk', 'inner')
            ->where('product_details.id_produk', $productId)
            ->orderBy('id_detail', 'ASC')
            ->findAll();
    }

    /**
     * Add a new product detail with duplication check.
     *
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function addDetail(array $data): bool
    {
        // Check for required fields
        if (!isset($data['id_produk'], $data['key'], $data['value'])) {
            throw new \Exception("Missing required fields.");
        }

        // Check for duplicate key for the same product
        $existing = $this->where('id_produk', $data['id_produk'])
            ->where('key', $data['key'])
            ->first();

        if ($existing) {
            throw new \Exception("Duplicate key found for this product.");
        }

        // Insert data
        return $this->insert($data) !== false;
    }

    /**
     * Update a product detail by ID with duplication validation.
     *
     * @param int $idDetail
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function updateDetail(int $idDetail, array $data): bool
    {
        // Check if the detail exists
        if ($this->find($idDetail) === null) {
            throw new \Exception("Detail not found.");
        }

        // Check for duplicate key when updating
        if (isset($data['id_produk'], $data['key'])) {
            $existing = $this->where('id_produk', $data['id_produk'])
                ->where('key', $data['key'])
                ->where('id_detail !=', $idDetail)
                ->first();

            if ($existing) {
                throw new \Exception("Duplicate key found for this product.");
            }
        }

        // Update data
        return $this->update($idDetail, $data);
    }

    /**
     * Delete a product detail by ID.
     *
     * @param int $idDetail
     * @return bool
     * @throws \Exception
     */
    public function deleteDetail(int $idDetail): bool
    {
        // Check if the detail exists
        if ($this->find($idDetail) === null) {
            throw new \Exception("Detail not found.");
        }

        // Delete the detail
        return $this->delete($idDetail);
    }

    /**
     * Check if a key already exists for a product.
     *
     * @param int $productId
     * @param string $key
     * @param int|null $excludeId
     * @return bool
     */
    public function isDuplicateKey(int $productId, string $key, int $excludeId = null): bool
    {
        $query = $this->where('id_produk', $productId)
            ->where('key', $key);

        if ($excludeId) {
            $query->where('id_detail !=', $excludeId);
        }

        return $query->countAllResults() > 0;
    }
}

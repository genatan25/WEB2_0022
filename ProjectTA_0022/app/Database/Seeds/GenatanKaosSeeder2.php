<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GenatanKaosSeeder2 extends Seeder
{
    public function run()
    {
        // Mulai transaksi
        $this->db->transStart();

        // Seeder untuk Tabel users
        if ($this->db->table('users')->countAll() == 0) {
            $usersData = [
                [
                    'username' => 'genatan123',
                    'email' => 'genatan@gmail.com',
                    'password' => password_hash('genatan123', PASSWORD_BCRYPT),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'username' => 'adminku',
                    'email' => 'adminku@.com',
                    'password' => password_hash('adminku', PASSWORD_BCRYPT),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ];

            $this->db->table('users')->insertBatch($usersData);
        }

        // Seeder untuk Tabel transaction
        if ($this->db->table('transaction')->countAll() == 0) {
            $users = $this->db->table('users')->get()->getResultArray();

            $transactionsData = [
                [
                    'id_user' => $users[0]['id_user'],
                    'tgl_transaksi' => date('Y-m-d H:i:s'),
                    'jml_produk' => 3,
                    'grand_total' => 300000,
                ],
                [
                    'id_user' => $users[1]['id_user'],
                    'tgl_transaksi' => date('Y-m-d H:i:s'),
                    'jml_produk' => 2,
                    'grand_total' => 200000,
                ],
            ];

            $this->db->table('transaction')->insertBatch($transactionsData);
        }

        // Seeder untuk Tabel detail_transaction
        if ($this->db->table('detail_transaction')->countAll() == 0) {
            $transactions = $this->db->table('transaction')->get()->getResultArray();
            $products = $this->db->table('products')->get()->getResultArray();

            if (!empty($transactions) && !empty($products)) {
                $detailTransactionData = [
                    [
                        'id_transaction' => $transactions[0]['id_transaction'],
                        'id_produk' => $products[0]['id_produk'],
                        'jumlah' => 1,
                        'total_harga' => 100000,
                    ],
                    [
                        'id_transaction' => $transactions[0]['id_transaction'],
                        'id_produk' => $products[1]['id_produk'],
                        'jumlah' => 2,
                        'total_harga' => 200000,
                    ],
                    [
                        'id_transaction' => $transactions[1]['id_transaction'],
                        'id_produk' => $products[2]['id_produk'],
                        'jumlah' => 1,
                        'total_harga' => 100000,
                    ],
                    [
                        'id_transaction' => $transactions[1]['id_transaction'],
                        'id_produk' => $products[3]['id_produk'],
                        'jumlah' => 1,
                        'total_harga' => 100000,
                    ],
                ];

                $this->db->table('detail_transaction')->insertBatch($detailTransactionData);
            }
        }

        // Seeder untuk Tabel product_details
        if ($this->db->table('product_details')->countAll() == 0) {
            $products = $this->db->table('products')->get()->getResultArray();

            if (!empty($products)) {
                $productDetailsData = [
                    ['id_produk' => $products[0]['id_produk'], 'key' => 'Material', 'value' => 'Cotton Combed 30s'],
                    ['id_produk' => $products[0]['id_produk'], 'key' => 'Warna', 'value' => 'Hitam'],
                    ['id_produk' => $products[1]['id_produk'], 'key' => 'Ukuran', 'value' => 'L'],
                    ['id_produk' => $products[2]['id_produk'], 'key' => 'Material', 'value' => 'Polyester'],
                    ['id_produk' => $products[3]['id_produk'], 'key' => 'Warna', 'value' => 'Putih'],
                    ['id_produk' => $products[4]['id_produk'], 'key' => 'Desain', 'value' => 'Kustom'],
                    ['id_produk' => $products[5]['id_produk'], 'key' => 'Jenis', 'value' => 'Graphic'],
                    ['id_produk' => $products[6]['id_produk'], 'key' => 'Style', 'value' => 'Streetwear'],
                    ['id_produk' => $products[7]['id_produk'], 'key' => 'Material', 'value' => 'Denim'],
                    ['id_produk' => $products[8]['id_produk'], 'key' => 'Kategori', 'value' => 'Limited Edition'],
                    ['id_produk' => $products[9]['id_produk'], 'key' => 'Season', 'value' => 'Summer'],
                ];

                $this->db->table('product_details')->insertBatch($productDetailsData);
            }
        }

        // Selesaikan transaksi
        $this->db->transComplete();

        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            echo "Seeder gagal dijalankan. Transaksi dibatalkan.";
        } else {
            $this->db->transCommit();
            echo "Seeder berhasil dijalankan. Data telah diinsert ke database.";
        }
    }
}

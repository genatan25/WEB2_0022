<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GenatanKaosSeeder extends Seeder
{
    public function run()
    {
        // Mulai transaksi untuk memastikan semua operasi insert berhasil
        $this->db->transStart();

        /**
         * 1. Seeder untuk Tabel admins
         */
        if ($this->db->table('admins')->countAll() == 0) {
            $adminsData = [
                [
                    'username' => 'genatan123',
                    'password' => password_hash('genatan123', PASSWORD_BCRYPT),
                    'nama_lengkap' => 'genatan123',
                    'profile_color' => '#4A90E2',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'username' => 'adminku',
                    'password' => password_hash('adminku', PASSWORD_BCRYPT),
                    'nama_lengkap' => 'adminku',
                    'profile_color' => '#50E3C2',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'username' => 'superadmin',
                    'password' => password_hash('superadmin', PASSWORD_BCRYPT),
                    'nama_lengkap' => 'superadmin',
                    'profile_color' => '#F5A623',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ];

            $this->db->table('admins')->insertBatch($adminsData);
        }

        /**
         * 2. Seeder untuk Tabel categories
         */
        if ($this->db->table('categories')->countAll() == 0) {
            $categoriesData = [
                [
                    'nama_kategori' => 'Kaos Polos Premium',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'nama_kategori' => 'Kaos Graphic Design',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'nama_kategori' => 'Kaos Limited Edition',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'nama_kategori' => 'Kaos Custom Design',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'nama_kategori' => 'Kaos Couple',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ];

            $this->db->table('categories')->insertBatch($categoriesData);
        }

        /**
         * 3. Seeder untuk Tabel products
         */
        if ($this->db->table('products')->countAll() == 0) {
            $categories = $this->db->table('categories')->get()->getResultArray();

            if (!empty($categories)) {
                $productsData = [
                    // Kaos Polos Premium
                    [
                        'nama_produk' => 'Kaos Polos Premium Cotton Black',
                        'deskripsi' => 'Kaos polos premium dengan bahan cotton combed 30s. Nyaman dipakai, tidak mudah kusut, dan tahan lama.',
                        'harga' => 89000.00,
                        'gambar' => 'uploads/product/11.webp',
                        'id_kategori' => $categories[0]['id_kategori'],
                        'stok' => 100,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ],
                    [
                        'nama_produk' => 'Kaos Polos Premium Cotton White',
                        'deskripsi' => 'Kaos polos premium dengan bahan cotton combed 30s. Warna putih bersih dan tidak mudah kusam.',
                        'harga' => 89000.00,
                        'gambar' => 'uploads/product/10.webp',
                        'id_kategori' => $categories[0]['id_kategori'],
                        'stok' => 100,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ],
                    [
                        'nama_produk' => 'Kaos Polos Premium Cotton Navy',
                        'deskripsi' => 'Kaos polos premium dengan bahan cotton combed 30s. Warna navy elegant dan klasik.',
                        'harga' => 89000.00,
                        'gambar' => 'uploads/product/9.webp',
                        'id_kategori' => $categories[0]['id_kategori'],
                        'stok' => 75,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ],

                    // Kaos Graphic Design
                    [
                        'nama_produk' => 'Kaos Graphic Urban Style',
                        'deskripsi' => 'Kaos dengan desain grafis urban modern. Cocok untuk anak muda yang stylish.',
                        'harga' => 129000.00,
                        'gambar' => 'uploads/product/8.webp',
                        'id_kategori' => $categories[1]['id_kategori'],
                        'stok' => 50,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ],
                    [
                        'nama_produk' => 'Kaos Graphic Nature',
                        'deskripsi' => 'Kaos dengan desain grafis tema alam. Desain eksklusif dan detail tinggi.',
                        'harga' => 135000.00,
                        'gambar' => 'uploads/product/7.webp',
                        'id_kategori' => $categories[1]['id_kategori'],
                        'stok' => 45,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ],

                    // Kaos Limited Edition
                    [
                        'nama_produk' => 'Kaos Limited Art Series Vol.1',
                        'deskripsi' => 'Kaos limited edition dengan artwork dari seniman lokal. Hanya tersedia 50 pcs.',
                        'harga' => 249000.00,
                        'gambar' => 'uploads/product/6.webp',
                        'id_kategori' => $categories[2]['id_kategori'],
                        'stok' => 50,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ],
                    [
                        'nama_produk' => 'Kaos Limited Batik Modern',
                        'deskripsi' => 'Kaos limited edition dengan motif batik modern. Limited stock 30 pcs.',
                        'harga' => 279000.00,
                        'gambar' => 'uploads/product/5.webp',
                        'id_kategori' => $categories[2]['id_kategori'],
                        'stok' => 30,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ],

                    // Kaos Custom Design
                    [
                        'nama_produk' => 'Custom Name Jersey Style',
                        'deskripsi' => 'Kaos custom dengan desain ala jersey. Bisa request nama dan nomor.',
                        'harga' => 159000.00,
                        'gambar' => 'uploads/product/4.webp',
                        'id_kategori' => $categories[3]['id_kategori'],
                        'stok' => 100,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ],
                    [
                        'nama_produk' => 'Custom Full Print Design',
                        'deskripsi' => 'Kaos custom dengan full print design sesuai keinginan. Area print luas.',
                        'harga' => 199000.00,
                        'gambar' => 'uploads/product/3.webp',
                        'id_kategori' => $categories[3]['id_kategori'],
                        'stok' => 100,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ],

                    // Kaos Couple
                    [
                        'nama_produk' => 'Couple Shirt - Sweet Heart',
                        'deskripsi' => 'Set kaos couple dengan desain romantic sweet heart. Tersedia ukuran pria dan wanita.',
                        'harga' => 225000.00,
                        'gambar' => 'uploads/product/2.webp',
                        'id_kategori' => $categories[4]['id_kategori'],
                        'stok' => 40,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ],
                    [
                        'nama_produk' => 'Couple Shirt - King & Queen',
                        'deskripsi' => 'Set kaos couple dengan tema King & Queen. Perfect untuk pasangan.',
                        'harga' => 225000.00,
                        'gambar' => 'uploads/product/1.webp',
                        'id_kategori' => $categories[4]['id_kategori'],
                        'stok' => 35,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ],
                ];

                $this->db->table('products')->insertBatch($productsData);
            }
        }

        // Selesaikan transaksi
        $this->db->transComplete();

        // Cek status transaksi
        if ($this->db->transStatus() === FALSE) {
            // Jika terjadi kesalahan, rollback transaksi
            $this->db->transRollback();
            echo "Seeder gagal dijalankan. Transaksi dibatalkan.";
        } else {
            // Jika sukses, commit transaksi
            $this->db->transCommit();
            echo "Seeder berhasil dijalankan. Data telah diinsert ke database.";
        }
    }
}

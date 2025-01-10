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
                    'username' => 'admin_super',
                    'password' => password_hash('admin123', PASSWORD_BCRYPT),
                    'nama_lengkap' => 'Super Administrator',
                    'profile_color' => '#4A90E2',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'username' => 'admin_content',
                    'password' => password_hash('content123', PASSWORD_BCRYPT),
                    'nama_lengkap' => 'Content Manager',
                    'profile_color' => '#50E3C2',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'username' => 'admin_product',
                    'password' => password_hash('product123', PASSWORD_BCRYPT),
                    'nama_lengkap' => 'Product Manager',
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
                        'gambar' => 'polos_black_premium.jpg',
                        'id_kategori' => $categories[0]['id_kategori'],
                        'stok' => 100,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ],
                    [
                        'nama_produk' => 'Kaos Polos Premium Cotton White',
                        'deskripsi' => 'Kaos polos premium dengan bahan cotton combed 30s. Warna putih bersih dan tidak mudah kusam.',
                        'harga' => 89000.00,
                        'gambar' => 'polos_white_premium.jpg',
                        'id_kategori' => $categories[0]['id_kategori'],
                        'stok' => 100,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ],
                    [
                        'nama_produk' => 'Kaos Polos Premium Cotton Navy',
                        'deskripsi' => 'Kaos polos premium dengan bahan cotton combed 30s. Warna navy elegant dan klasik.',
                        'harga' => 89000.00,
                        'gambar' => 'polos_navy_premium.jpg',
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
                        'gambar' => 'graphic_urban.jpg',
                        'id_kategori' => $categories[1]['id_kategori'],
                        'stok' => 50,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ],
                    [
                        'nama_produk' => 'Kaos Graphic Nature',
                        'deskripsi' => 'Kaos dengan desain grafis tema alam. Desain eksklusif dan detail tinggi.',
                        'harga' => 135000.00,
                        'gambar' => 'graphic_nature.jpg',
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
                        'gambar' => 'limited_art_1.jpg',
                        'id_kategori' => $categories[2]['id_kategori'],
                        'stok' => 50,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ],
                    [
                        'nama_produk' => 'Kaos Limited Batik Modern',
                        'deskripsi' => 'Kaos limited edition dengan motif batik modern. Limited stock 30 pcs.',
                        'harga' => 279000.00,
                        'gambar' => 'limited_batik.jpg',
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
                        'gambar' => 'custom_jersey.jpg',
                        'id_kategori' => $categories[3]['id_kategori'],
                        'stok' => 100,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ],
                    [
                        'nama_produk' => 'Custom Full Print Design',
                        'deskripsi' => 'Kaos custom dengan full print design sesuai keinginan. Area print luas.',
                        'harga' => 199000.00,
                        'gambar' => 'custom_fullprint.jpg',
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
                        'gambar' => 'couple_heart.jpg',
                        'id_kategori' => $categories[4]['id_kategori'],
                        'stok' => 40,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ],
                    [
                        'nama_produk' => 'Couple Shirt - King & Queen',
                        'deskripsi' => 'Set kaos couple dengan tema King & Queen. Perfect untuk pasangan.',
                        'harga' => 225000.00,
                        'gambar' => 'couple_king_queen.jpg',
                        'id_kategori' => $categories[4]['id_kategori'],
                        'stok' => 35,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ],
                ];

                $this->db->table('products')->insertBatch($productsData);
            }
        }

        /**
         * 4. Seeder untuk Tabel frontend_pages
         */
        if ($this->db->table('frontend_pages')->countAll() == 0) {
            $admins = $this->db->table('admins')->get()->getResultArray();

            if (!empty($admins)) {
                $frontendPagesData = [
                    [
                        'page_type' => 'beranda',
                        'title' => 'Selamat Datang di Genatan Kaos',
                        'content' => '<div class="welcome-section">
                            <h1>Selamat Datang di Genatan Kaos</h1>
                            <p>Temukan koleksi kaos berkualitas dengan desain eksklusif dan bahan premium.</p>
                            <h2>Mengapa Memilih Kami?</h2>
                            <ul>
                                <li>Bahan berkualitas premium</li>
                                <li>Desain eksklusif</li>
                                <li>Pengerjaan teliti</li>
                                <li>Pelayanan terbaik</li>
                            </ul>
                        </div>',
                        'last_modified_by' => $admins[0]['id_admin'],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ],
                    [
                        'page_type' => 'produk_kami',
                        'title' => 'Produk Kami',
                        'content' => '<div class="products-section">
                            <h1>Koleksi Produk Kami</h1>
                            <p>Kami menyediakan berbagai jenis kaos berkualitas:</p>
                            <h2>Kategori Produk:</h2>
                            <ul>
                                <li>Kaos Polos Premium - Bahan berkualitas tinggi</li>
                                <li>Kaos Graphic Design - Desain eksklusif dan modern</li>
                                <li>Kaos Limited Edition - Produk terbatas</li>
                                <li>Kaos Custom Design - Sesuai keinginan Anda</li>
                                <li>Kaos Couple - Special untuk pasangan</li>
                            </ul>
                        </div>',
                        'last_modified_by' => $admins[1]['id_admin'],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ],
                    [
                        'page_type' => 'tentang_kami',
                        'title' => 'Tentang Kami',
                        'content' => '<div class="about-section">
                            <h1>Tentang Genatan Kaos</h1>
                            <p>Genatan Kaos adalah brand lokal yang berdedikasi menghadirkan produk kaos berkualitas tinggi dengan desain eksklusif. Kami percaya bahwa setiap kaos adalah ekspresi diri, dan kami berkomitmen untuk menyediakan produk yang tidak hanya nyaman dipakai tetapi juga stylish.</p>
                            <h2>Visi Kami</h2>
                            <p>Menjadi brand kaos terpercaya di Indonesia dengan kualitas premium dan desain inovatif yang memenuhi kebutuhan pelanggan.</p>
                            <h2>Misi Kami</h2>
                            <ul>
                                <li>Menghadirkan produk berkualitas tinggi dengan bahan terbaik</li>
                                <li>Memberikan pelayanan pelanggan yang luar biasa</li>
                                <li>Berinovasi dalam desain untuk selalu mengikuti tren terbaru</li>
                                <li>Mendukung industri kreatif lokal dengan kolaborasi desainer lokal</li>
                            </ul>
                            <h2>Nilai-Nilai Kami</h2>
                            <ul>
                                <li>Integritas: Menjalankan bisnis dengan jujur dan transparan</li>
                                <li>Inovasi: Selalu mencari cara baru untuk meningkatkan produk dan layanan</li>
                                <li>Komitmen: Berkomitmen untuk memenuhi dan melampaui harapan pelanggan</li>
                                <li>Keberlanjutan: Menggunakan bahan yang ramah lingkungan dan proses produksi yang bertanggung jawab</li>
                            </ul>
                            <h2>Tim Kami</h2>
                            <p>Didukung oleh tim yang berpengalaman dan penuh semangat, Genatan Kaos terus berusaha memberikan yang terbaik bagi pelanggan kami.</p>
                        </div>',
                        'last_modified_by' => $admins[2]['id_admin'],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ],
                ];

                $this->db->table('frontend_pages')->insertBatch($frontendPagesData);
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

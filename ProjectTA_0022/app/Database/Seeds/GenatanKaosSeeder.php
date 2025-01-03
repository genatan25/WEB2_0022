<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GenatanKaosSeeder extends Seeder
{
    public function run()
    {
        // Seed data user
        $this->db->table('user')->insertBatch([
            [
                'username'     => 'johndoe',
                'password'     => password_hash('password123', PASSWORD_BCRYPT),
                'email'        => 'johndoe@example.com',
                'nama_lengkap' => 'John Doe',
                'alamat'       => 'Jl. Merdeka No. 45, Jakarta Pusat',
                'telepon'      => '081234567890',
                'profile_color'=> '#ff5733',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'username'     => 'janedoe',
                'password'     => password_hash('password456', PASSWORD_BCRYPT),
                'email'        => 'janedoe@example.com',
                'nama_lengkap' => 'Jane Doe',
                'alamat'       => 'Jl. Diponegoro No. 12, Bandung',
                'telepon'      => '082345678901',
                'profile_color'=> '#33ff57',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
        ]);

        // Seed data admin
        $this->db->table('admin')->insert([
            'username'     => 'superadmin',
            'password'     => password_hash('admin123', PASSWORD_BCRYPT),
            'nama_lengkap' => 'Super Admin',
            'profile_color'=> '#5733ff',
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s'),
        ]);

        // Seed data kategori
        $this->db->table('kategori')->insertBatch([
            [
                'nama_kategori' => 'Kaos Casual',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kategori' => 'Kaos Olahraga',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kategori' => 'Hoodie',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ]);

        // Seed data produk
        $this->db->table('produk')->insertBatch([
            [
                'nama_produk' => 'Kaos Casual Polos',
                'deskripsi'   => 'Kaos berbahan katun combed 30s, nyaman untuk aktivitas sehari-hari.',
                'harga'       => 80000.00,
                'gambar'      => 'kaos_casual_polos.jpg',
                'id_kategori' => 1,
                'stok'        => 150,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'nama_produk' => 'Kaos Olahraga Dri-Fit',
                'deskripsi'   => 'Kaos olahraga berbahan dri-fit yang menyerap keringat.',
                'harga'       => 120000.00,
                'gambar'      => 'kaos_olahraga_dri-fit.jpg',
                'id_kategori' => 2,
                'stok'        => 100,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ]);

        // Seed data transaksi
        $this->db->table('transaksi')->insert([
            'id_user'     => 1,
            'total_harga' => 200000.00,
            'status'      => 'pending',
            'created_at'  => date('Y-m-d H:i:s'),
        ]);

        // Seed data detail_transaksi
        $this->db->table('detail_transaksi')->insertBatch([
            [
                'id_transaksi' => 1,
                'id_produk'    => 1,
                'jumlah'       => 1,
                'subtotal'     => 80000.00,
            ],
            [
                'id_transaksi' => 1,
                'id_produk'    => 2,
                'jumlah'       => 1,
                'subtotal'     => 120000.00,
            ],
        ]);

        // Seed data cart
        $this->db->table('cart')->insert([
            'id_user'  => 2,
            'id_produk'=> 1,
            'jumlah'   => 2,
            'subtotal' => 160000.00,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // Seed data testimoni
        $this->db->table('testimoni')->insert([
            'id_user'      => 1,
            'isi_testimoni'=> 'Produk sangat berkualitas dan sesuai deskripsi!',
            'created_at'   => date('Y-m-d H:i:s'),
        ]);
    }
}

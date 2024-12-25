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
                'username'     => 'user1',
                'password'     => password_hash('password1', PASSWORD_BCRYPT),
                'email'        => 'user1@example.com',
                'nama_lengkap' => 'User One',
                'alamat'       => 'Address of User One',
                'telepon'      => '1234567890',
                'created_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'username'     => 'user2',
                'password'     => password_hash('password2', PASSWORD_BCRYPT),
                'email'        => 'user2@example.com',
                'nama_lengkap' => 'User Two',
                'alamat'       => 'Address of User Two',
                'telepon'      => '0987654321',
                'created_at'   => date('Y-m-d H:i:s'),
            ],
        ]);

        // Seed data admin
        $this->db->table('admin')->insert([
            'username'     => 'admin',
            'password'     => password_hash('adminpassword', PASSWORD_BCRYPT),
            'nama_lengkap' => 'Administrator',
        ]);

        // Seed data kategori
        $this->db->table('kategori')->insertBatch([
            ['nama_kategori' => 'Kaos'],
            ['nama_kategori' => 'Jaket'],
            ['nama_kategori' => 'Hoodie'],
        ]);

        // Seed data produk
        $this->db->table('produk')->insertBatch([
            [
                'nama_produk' => 'Kaos Polos',
                'deskripsi'   => 'Kaos polos nyaman dan berkualitas.',
                'harga'       => 75000.00,
                'gambar'      => 'kaos_polos.jpg',
                'id_kategori' => 1,
                'stok'        => 50,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'nama_produk' => 'Jaket Jeans',
                'deskripsi'   => 'Jaket jeans stylish untuk gaya kasual.',
                'harga'       => 250000.00,
                'gambar'      => 'jaket_jeans.jpg',
                'id_kategori' => 2,
                'stok'        => 30,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ]);

        // Seed data transaksi
        $this->db->table('transaksi')->insert([
            'id_user'     => 1,
            'total_harga' => 150000.00,
            'status'      => 'pending',
            'created_at'  => date('Y-m-d H:i:s'),
        ]);

        // Seed data detail_transaksi
        $this->db->table('detail_transaksi')->insert([
            'id_transaksi' => 1,
            'id_produk'    => 1,
            'jumlah'       => 2,
            'subtotal'     => 150000.00,
        ]);

        // Seed data cart
        $this->db->table('cart')->insert([
            'id_user'  => 2,
            'id_produk'=> 2,
            'jumlah'   => 1,
            'subtotal' => 250000.00,
        ]);

        // Seed data testimoni
        $this->db->table('testimoni')->insert([
            'id_user'      => 1,
            'isi_testimoni'=> 'Produk sangat bagus dan pengiriman cepat!',
            'created_at'   => date('Y-m-d H:i:s'),
        ]);
    }
}

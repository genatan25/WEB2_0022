<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGenatanKaosTables extends Migration
{
    public function up()
    {
        // Tabel user
        $this->forge->addField([
            'id_user'       => ['type' => 'INT', 'auto_increment' => true],
            'username'      => ['type' => 'VARCHAR', 'constraint' => '50'],
            'password'      => ['type' => 'VARCHAR', 'constraint' => '255'],
            'email'         => ['type' => 'VARCHAR', 'constraint' => '100'],
            'nama_lengkap'  => ['type' => 'VARCHAR', 'constraint' => '100'],
            'alamat'        => ['type' => 'TEXT'],
            'telepon'       => ['type' => 'VARCHAR', 'constraint' => '15'],
            'created_at'    => ['type' => 'TIMESTAMP', 'null' => true],
        ]);
        $this->forge->addKey('id_user', true);
        $this->forge->createTable('user');

        // Tabel admin
        $this->forge->addField([
            'id_admin'      => ['type' => 'INT', 'auto_increment' => true],
            'username'      => ['type' => 'VARCHAR', 'constraint' => '50'],
            'password'      => ['type' => 'VARCHAR', 'constraint' => '255'],
            'nama_lengkap'  => ['type' => 'VARCHAR', 'constraint' => '100'],
        ]);
        $this->forge->addKey('id_admin', true);
        $this->forge->createTable('admin');

        // Tabel kategori
        $this->forge->addField([
            'id_kategori'   => ['type' => 'INT', 'auto_increment' => true],
            'nama_kategori' => ['type' => 'VARCHAR', 'constraint' => '50'],
        ]);
        $this->forge->addKey('id_kategori', true);
        $this->forge->createTable('kategori');

        // Tabel produk
        $this->forge->addField([
            'id_produk'     => ['type' => 'INT', 'auto_increment' => true],
            'nama_produk'   => ['type' => 'VARCHAR', 'constraint' => '100'],
            'deskripsi'     => ['type' => 'TEXT'],
            'harga'         => ['type' => 'DECIMAL', 'constraint' => '12,2'],
            'gambar'        => ['type' => 'VARCHAR', 'constraint' => '255'],
            'id_kategori'   => ['type' => 'INT'],
            'stok'          => ['type' => 'INT'],
            'created_at'    => ['type' => 'TIMESTAMP', 'null' => true],
            'updated_at'    => ['type' => 'TIMESTAMP', 'null' => true],
        ]);
        $this->forge->addKey('id_produk', true);
        $this->forge->addForeignKey('id_kategori', 'kategori', 'id_kategori', 'CASCADE', 'CASCADE');
        $this->forge->createTable('produk');

        // Tabel transaksi
        $this->forge->addField([
            'id_transaksi'  => ['type' => 'INT', 'auto_increment' => true],
            'id_user'       => ['type' => 'INT'],
            'total_harga'   => ['type' => 'DECIMAL', 'constraint' => '12,2'],
            'status'        => ['type' => 'ENUM', 'constraint' => ['pending', 'paid', 'shipped', 'completed', 'canceled']],
            'created_at'    => ['type' => 'TIMESTAMP', 'null' => true],
        ]);
        $this->forge->addKey('id_transaksi', true);
        $this->forge->addForeignKey('id_user', 'user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('transaksi');

        // Tabel detail_transaksi
        $this->forge->addField([
            'id_detail'     => ['type' => 'INT', 'auto_increment' => true],
            'id_transaksi'  => ['type' => 'INT'],
            'id_produk'     => ['type' => 'INT'],
            'jumlah'        => ['type' => 'INT'],
            'subtotal'      => ['type' => 'DECIMAL', 'constraint' => '12,2'],
        ]);
        $this->forge->addKey('id_detail', true);
        $this->forge->addForeignKey('id_transaksi', 'transaksi', 'id_transaksi', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_produk', 'produk', 'id_produk', 'CASCADE', 'CASCADE');
        $this->forge->createTable('detail_transaksi');

        // Tabel cart
        $this->forge->addField([
            'id_cart'       => ['type' => 'INT', 'auto_increment' => true],
            'id_user'       => ['type' => 'INT'],
            'id_produk'     => ['type' => 'INT'],
            'jumlah'        => ['type' => 'INT'],
            'subtotal'      => ['type' => 'DECIMAL', 'constraint' => '12,2'],
        ]);
        $this->forge->addKey('id_cart', true);
        $this->forge->addForeignKey('id_user', 'user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_produk', 'produk', 'id_produk', 'CASCADE', 'CASCADE');
        $this->forge->createTable('cart');

        // Tabel testimoni
        $this->forge->addField([
            'id_testimoni'  => ['type' => 'INT', 'auto_increment' => true],
            'id_user'       => ['type' => 'INT'],
            'isi_testimoni' => ['type' => 'TEXT'],
            'created_at'    => ['type' => 'TIMESTAMP', 'null' => true],
        ]);
        $this->forge->addKey('id_testimoni', true);
        $this->forge->addForeignKey('id_user', 'user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('testimoni');
    }

    public function down()
    {
        $this->forge->dropTable('testimoni');
        $this->forge->dropTable('cart');
        $this->forge->dropTable('detail_transaksi');
        $this->forge->dropTable('transaksi');
        $this->forge->dropTable('produk');
        $this->forge->dropTable('kategori');
        $this->forge->dropTable('admin');
        $this->forge->dropTable('user');
    }
}

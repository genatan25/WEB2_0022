<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGenatanKaosTables extends Migration
{
    public function up()
    {
        // Users Table
        $this->forge->addField([
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        $this->forge->addKey('id_user', true);
        $this->forge->createTable('users', true);

        // Admins Table
        $this->forge->addField([
            'id_admin' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'nama_lengkap' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'profile_color' => [
                'type' => 'VARCHAR',
                'constraint' => 7,
                'default' => '#FFFFFF'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        $this->forge->addKey('id_admin', true);
        $this->forge->createTable('admins', true);

        // Categories Table
        $this->forge->addField([
            'id_kategori' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nama_kategori' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'unique' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        $this->forge->addKey('id_kategori', true);
        $this->forge->createTable('categories', true);

        // Products Table
        $this->forge->addField([
            'id_produk' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nama_produk' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'harga' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'default' => 0.00
            ],
            'gambar' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'id_kategori' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'stok' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        $this->forge->addKey('id_produk', true);
        $this->forge->addForeignKey('id_kategori', 'categories', 'id_kategori', 'CASCADE', 'CASCADE');
        $this->forge->createTable('products', true);

        // Product Details Table
        $this->forge->addField([
            'id_detail' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'id_produk' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'key' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'value' => [
                'type' => 'TEXT'
            ]
        ]);
        $this->forge->addKey('id_detail', true);
        $this->forge->addForeignKey('id_produk', 'products', 'id_produk', 'CASCADE', 'CASCADE');
        $this->forge->createTable('product_details', true);

        // Transaction Table
        $this->forge->addField([
            'id_transaction' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true
            ],
            'tgl_transaksi' => [
                'type' => 'TIMESTAMP'
            ],
            'jml_produk' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'grand_total' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2'
            ]
        ]);
        $this->forge->addKey('id_transaction', true);
        $this->forge->addForeignKey('id_user', 'users', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('transaction', true);

        // Detail Transaction Table
        $this->forge->addField([
            'id_detail_transaction' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'id_transaction' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'id_produk' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true
            ],
            'jumlah' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'total_harga' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2'
            ]
        ]);
        $this->forge->addKey('id_detail_transaction', true);
        $this->forge->addForeignKey('id_transaction', 'transaction', 'id_transaction', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_produk', 'products', 'id_produk', 'CASCADE', 'CASCADE');
        $this->forge->createTable('detail_transaction', true);
    }

    public function down()
    {
        $this->forge->dropTable('detail_transaction', true);
        $this->forge->dropTable('transaction', true);
        $this->forge->dropTable('product_details', true);
        $this->forge->dropTable('products', true);
        $this->forge->dropTable('categories', true);
        $this->forge->dropTable('admins', true);
        $this->forge->dropTable('users', true);
    }
}
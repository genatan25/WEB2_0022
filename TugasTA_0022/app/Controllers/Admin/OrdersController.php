<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class OrdersController extends BaseController
{
    public function index()
    {
        $transaksiModel = new \App\Models\TransaksiModel();
        $detailTransaksiModel = new \App\Models\DetailTransaksiModel();

        // Ambil data transaksi
        $transactions = $transaksiModel
            ->select('transaction.id_transaction, transaction.tgl_transaksi, transaction.id_user, users.username, transaction.jml_produk, transaction.grand_total')
            ->join('users', 'users.id_user = transaction.id_user')
            ->orderBy('transaction.id_transaction', 'DESC')
            ->findAll();

        // Tambahkan detail produk ke setiap transaksi
        foreach ($transactions as &$transaction) {
            $details = $detailTransaksiModel
                ->select('detail_transaction.*, products.nama_produk, products.gambar, products.harga')
                ->join('products', 'products.id_produk = detail_transaction.id_produk')
                ->where('detail_transaction.id_transaction', $transaction['id_transaction'])
                ->findAll();

            $transaction['products'] = $details; // Tambahkan ke array transaksi
        }

        return view('admin/pesanan_masuk', [
            'transactions' => $transactions,
        ]);
    }


    public function getTransactionDetails($transactionId)
    {
        $detailTransaksiModel = new \App\Models\DetailTransaksiModel();
        $transaksiModel = new \App\Models\TransaksiModel();

        // Ambil data transaksi
        $transaction = $transaksiModel
            ->select('transaction.*, users.username')
            ->join('users', 'users.id_user = transaction.id_user')
            ->where('transaction.id_transaction', $transactionId)
            ->first();

        if (!$transaction) {
            return $this->response->setJSON(['success' => false, 'message' => 'Transaksi tidak ditemukan.']);
        }

        // Ambil detail produk
        $products = $detailTransaksiModel
            ->select('detail_transaction.*, products.nama_produk, products.gambar, products.harga')
            ->join('products', 'products.id_produk = detail_transaction.id_produk')
            ->where('detail_transaction.id_transaction', $transactionId)
            ->findAll();

        return $this->response->setJSON([
            'success' => true,
            'username' => $transaction['username'],
            'tgl_transaksi' => $transaction['tgl_transaksi'],
            'products' => $products,
        ]);
    }

    public function purchase()
    {
        $session = session();
        $id_user = $session->get('id_user'); // Ambil ID user dari session

        if (!$id_user) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Anda harus login terlebih dahulu.'
            ]);
        }

        // Ambil data keranjang dari request
        $cart = $this->request->getJSON(true); // Pastikan data diterima dalam format JSON

        if (empty($cart) || !is_array($cart)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Keranjang belanja kosong.'
            ]);
        }

        $transaksiModel = new \App\Models\TransaksiModel();
        $detailTransaksiModel = new \App\Models\DetailTransaksiModel();

        $db = \Config\Database::connect();
        $db->transStart(); // Mulai transaksi database

        try {
            // Simpan data awal ke tabel `transaction` dengan `jml_produk` dan `grand_total` NULL
            $transactionData = [
                'id_user' => $id_user,
                'jml_produk' => null,
                'grand_total' => null,
            ];

            $transaksiModel->insert($transactionData);
            $id_transaction = $transaksiModel->getInsertID(); // Ambil ID transaksi yang baru saja dimasukkan

            // Simpan data ke tabel `detail_transaction`
            foreach ($cart as $item) {
                $detailTransactionData = [
                    'id_transaction' => $id_transaction,
                    'id_produk' => $item['id'],
                    'jumlah' => $item['quantity'],
                    'total_harga' => $item['price'] * $item['quantity'],
                ];

                $detailTransaksiModel->insert($detailTransactionData);
            }

            // Hitung `jml_produk` dan `grand_total` dari tabel `detail_transaction`
            $query = $db->query("
            SELECT 
                COUNT(*) AS jml_produk, 
                SUM(total_harga) AS grand_total 
            FROM detail_transaction 
            WHERE id_transaction = ?", [$id_transaction]);

            $result = $query->getRow();

            // Update tabel `transaction` dengan nilai `jml_produk` dan `grand_total` yang dihitung
            $transaksiModel->update($id_transaction, [
                'jml_produk' => $result->jml_produk,
                'grand_total' => $result->grand_total,
            ]);

            $db->transComplete(); // Selesaikan transaksi database

            if ($db->transStatus() === false) {
                // Jika terjadi kesalahan, rollback
                $db->transRollback();
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menyimpan data transaksi.'
                ]);
            }

            // Hapus keranjang dari session atau frontend jika berhasil
            $session->remove('cart'); // Jika keranjang disimpan di session

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Transaksi berhasil dilakukan!'
            ]);
        } catch (\Exception $e) {
            $db->transRollback(); // Rollback jika terjadi kesalahan
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }
}

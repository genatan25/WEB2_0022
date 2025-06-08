<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TransaksiModel;
use App\Models\DetailTransaksiModel;
use CodeIgniter\I18n\Time;

class OrdersController extends BaseController
{
    public function index()
    {
        $transaksiModel = new TransaksiModel();
        $detailTransaksiModel = new DetailTransaksiModel();

        // Retrieve transactions with related user details
        $transactions = $transaksiModel
            ->select('transaction.id_transaction, transaction.tgl_transaksi, transaction.id_user, users.username, transaction.jml_produk, transaction.grand_total')
            ->join('users', 'users.id_user = transaction.id_user')
            ->orderBy('transaction.id_transaction', 'DESC')
            ->findAll();

        // Add product details for each transaction
        foreach ($transactions as &$transaction) {
            $details = $detailTransaksiModel
                ->select('detail_transaction.*, products.nama_produk, products.gambar, products.harga')
                ->join('products', 'products.id_produk = detail_transaction.id_produk')
                ->where('detail_transaction.id_transaction', $transaction['id_transaction'])
                ->findAll();

            $transaction['products'] = $details; // Add product details to the transaction array
        }

        return view('admin/pesanan_masuk', [
            'transactions' => $transactions,
        ]);
    }

    public function getTransactionDetails($transactionId)
    {
        $detailTransaksiModel = new DetailTransaksiModel();
        $transaksiModel = new TransaksiModel();

        // Retrieve transaction data
        $transaction = $transaksiModel
            ->select('transaction.*, users.username')
            ->join('users', 'users.id_user = transaction.id_user')
            ->where('transaction.id_transaction', $transactionId)
            ->first();

        if (!$transaction) {
            return $this->response->setJSON(['success' => false, 'message' => 'Transaction not found.']);
        }

        // Retrieve product details for the transaction
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
        $id_user = $session->get('id_user'); // Retrieve user ID from the session

        if (!$id_user) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'You need to log in first.'
            ]);
        }

        // Retrieve cart data from the request
        $cart = $this->request->getJSON(true); // Ensure data is received in JSON format

        if (empty($cart) || !is_array($cart)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'The shopping cart is empty.'
            ]);
        }

        $transaksiModel = new TransaksiModel();
        $detailTransaksiModel = new DetailTransaksiModel();

        $db = \Config\Database::connect();
        $db->transStart(); // Start database transaction

        try {
            // Insert initial transaction data with null values for products count and grand total
            $transactionData = [
                'id_user' => $id_user,
                'jml_produk' => null,
                'grand_total' => null,
            ];

            $transaksiModel->insert($transactionData);
            $id_transaction = $transaksiModel->getInsertID(); // Get the newly inserted transaction ID

            // Insert data into the `detail_transaction` table for each cart item
            foreach ($cart as $item) {
                $detailTransactionData = [
                    'id_transaction' => $id_transaction,
                    'id_produk' => $item['id'],
                    'jumlah' => $item['quantity'],
                    'total_harga' => $item['price'] * $item['quantity'],
                ];

                $detailTransaksiModel->insert($detailTransactionData);
            }

            // Calculate the total number of products and grand total for the transaction
            $query = $db->query("
            SELECT 
                COUNT(*) AS jml_produk, 
                SUM(total_harga) AS grand_total 
            FROM detail_transaction 
            WHERE id_transaction = ?", [$id_transaction]);

            $result = $query->getRow();

            // Update the transaction table with the calculated `jml_produk` and `grand_total`
            $transaksiModel->update($id_transaction, [
                'jml_produk' => $result->jml_produk,
                'grand_total' => $result->grand_total,
            ]);

            $db->transComplete(); // Complete the database transaction

            if ($db->transStatus() === false) {
                // If there is an error, rollback the transaction
                $db->transRollback();
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'An error occurred while saving the transaction data.'
                ]);
            }

            // Remove the cart from the session or frontend if successful
            $session->remove('cart'); // If the cart is stored in session

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Transaction successful!'
            ]);
        } catch (\Exception $e) {
            $db->transRollback(); // Rollback in case of an error
            return $this->response->setJSON([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ]);
        }
    }
}

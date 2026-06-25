<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CustomerModel;

class Customers extends BaseController
{
    protected $customerModel;

    public function __construct()
    {
        $this->customerModel = new CustomerModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $customers = $db->table('customers')
            ->select('customers.*, users.username, users.role, (SELECT COUNT(*) FROM orders WHERE orders.id_customer = customers.id_customer) as total_orders')
            ->join('users', 'users.id_user = customers.id_user')
            ->get()->getResultArray();

        $data = [
            'title' => 'Kelola Pelanggan - Admin',
            'customers' => $customers,
        ];
        return view('admin/customers/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Pelanggan Baru - Admin',
        ];
        return view('admin/customers/tambah', $data);
    }

    public function simpan()
    {
        $userModel = new \App\Models\UserModel();
        $rules = [
            'nama'     => 'required|min_length[3]',
            'username' => 'required|min_length[5]|is_unique[users.username]',
            'password' => 'required|min_length[6]',
            'phone'    => 'required',
            'alamat'   => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        $userId = $userModel->insert([
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'customer',
        ]);

        $this->customerModel->insert([
            'id_user' => $userId,
            'nama'    => $this->request->getPost('nama'),
            'phone'   => $this->request->getPost('phone'),
            'alamat'  => $this->request->getPost('alamat'),
        ]);

        return redirect()->to('/admin/pelanggan')->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $db = \Config\Database::connect();
        $customer = $db->table('customers')
            ->select('customers.*, users.username')
            ->join('users', 'users.id_user = customers.id_user')
            ->where('customers.id_customer', $id)
            ->get()->getRowArray();

        if (!$customer) {
            return redirect()->to('/admin/pelanggan')->with('error', 'Pelanggan tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Pelanggan - Admin',
            'customer' => $customer,
        ];
        return view('admin/customers/edit', $data);
    }

    public function update($id)
    {
        $customer = $this->customerModel->find($id);
        if (!$customer) {
            return redirect()->to('/admin/pelanggan')->with('error', 'Pelanggan tidak ditemukan.');
        }

        $userModel = new \App\Models\UserModel();
        $userId = $customer['id_user'];

        $rules = [
            'nama'   => 'required|min_length[3]',
            'phone'  => 'required',
            'alamat' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        
        $this->customerModel->update($id, [
            'nama'   => $this->request->getPost('nama'),
            'phone'  => $this->request->getPost('phone'),
            'alamat' => $this->request->getPost('alamat'),
        ]);

        
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $userModel->update($userId, [
                'password' => password_hash($password, PASSWORD_DEFAULT),
            ]);
        }

        return redirect()->to('/admin/pelanggan')->with('success', 'Data pelanggan berhasil diperbarui!');
    }

    public function hapus($id)
    {
        $customer = $this->customerModel->find($id);
        if ($customer) {
            $userId = $customer['id_user'];
            
            
            $this->customerModel->delete($id);
            $userModel = new \App\Models\UserModel();
            $userModel->delete($userId);
            
            return redirect()->to('/admin/pelanggan')->with('success', 'Pelanggan berhasil dihapus.');
        }
        return redirect()->to('/admin/pelanggan')->with('error', 'Pelanggan tidak ditemukan.');
    }

    public function detail($id)
    {
        $db = \Config\Database::connect();
        $customer = $db->table('customers')
            ->select('customers.*, users.username')
            ->join('users', 'users.id_user = customers.id_user')
            ->where('customers.id_customer', $id)
            ->get()->getRowArray();

        if (!$customer) {
            return redirect()->to('/admin/pelanggan')->with('error', 'Data pelanggan tidak ditemukan.');
        }

        $orderModel = new \App\Models\OrderModel();
        $orders = $orderModel->getOrdersByCustomer($id);

        $data = [
            'title' => 'Detail Pelanggan - Admin',
            'customer' => $customer,
            'orders' => $orders,
        ];
        return view('admin/customers/detail', $data);
    }

    public function search()
    {
        $query = $this->request->getGet('query');
        
        $db = \Config\Database::connect();
        $builder = $db->table('customers')
            ->select('customers.*, users.username, users.role, (SELECT COUNT(*) FROM orders WHERE orders.id_customer = customers.id_customer) as total_orders')
            ->join('users', 'users.id_user = customers.id_user');
            
        if (!empty($query)) {
            $builder->groupStart()
                    ->like('customers.nama', $query)
                    ->orLike('users.username', $query)
                    ->groupEnd();
        }
        
        $customers = $builder->get()->getResultArray();
        
        return view('admin/customers/_table_rows', ['customers' => $customers]);
    }
}

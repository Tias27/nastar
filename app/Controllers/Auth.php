<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CustomerModel;

class Auth extends BaseController
{
    protected $userModel;
    protected $customerModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->customerModel = new CustomerModel();
    }

    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to(session()->get('role') === 'admin' ? '/admin' : '/customer/dashboard');
        }
        return view('auth/login', ['title' => 'Login - Bulan Cake & Cookies']);
    }

    public function prosesLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->userModel->findByUsername($username);

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Username atau password salah.')->withInput();
        }

        $sessionData = [
            'id_user'   => $user['id_user'],
            'username'  => $user['username'],
            'role'      => $user['role'],
            'logged_in' => true,
        ];

        if ($user['role'] === 'customer') {
            $customer = $this->customerModel->findByUserId($user['id_user']);
            if ($customer) {
                $sessionData['id_customer'] = $customer['id_customer'];
                $sessionData['nama'] = $customer['nama'];
            }
        }

        session()->set($sessionData);

        if ($user['role'] === 'admin') {
            return redirect()->to('/admin/dashboard')->with('success', 'Selamat datang, Admin!');
        }
        return redirect()->to('/customer/dashboard')->with('success', 'Selamat datang, ' . (isset($customer) && isset($customer['nama']) ? $customer['nama'] : $username) . '!');
    }

    public function register()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/customer/dashboard');
        }
        return view('auth/register', ['title' => 'Daftar Akun - Bulan Cake & Cookies']);
    }

    public function prosesRegister()
    {
        $rules = [
            'nama'         => 'required|min_length[3]',
            'username'     => 'required|min_length[5]|is_unique[users.username]',
            'password'     => 'required|min_length[6]',
            'confpassword' => 'matches[password]',
            'phone'        => 'required',
            'alamat'       => 'required',
        ];

        $messages = [
            'nama' => [
                'required'   => 'Nama lengkap wajib diisi.',
                'min_length' => 'Nama lengkap minimal 3 karakter.'
            ],
            'username' => [
                'required'   => 'Username wajib diisi.',
                'min_length' => 'Username minimal 5 karakter.',
                'is_unique'  => 'Username sudah ada.'
            ],
            'password' => [
                'required'   => 'Password wajib diisi.',
                'min_length' => 'Password minimal 6 karakter.'
            ],
            'confpassword' => [
                'matches' => 'Konfirmasi password tidak sesuai dengan password yang dimasukkan.'
            ],
            'phone' => [
                'required' => 'Nomor WhatsApp wajib diisi.'
            ],
            'alamat' => [
                'required' => 'Alamat lengkap wajib diisi.'
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        $userId = $this->userModel->insert([
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'customer',
        ]);

        $nama = $this->request->getPost('nama');

        $customerId = $this->customerModel->insert([
            'id_user' => $userId,
            'nama'    => $nama,
            'phone'   => $this->request->getPost('phone'),
            'alamat'  => $this->request->getPost('alamat'),
        ]);

        
        session()->set([
            'id_user'     => $userId,
            'username'    => $this->request->getPost('username'),
            'role'        => 'customer',
            'logged_in'   => true,
            'id_customer' => $customerId,
            'nama'        => $nama,
        ]);

        return redirect()->to('/customer/dashboard')->with('success', 'Selamat datang, ' . $nama . '! Akun berhasil dibuat.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Anda berhasil logout.');
    }
}

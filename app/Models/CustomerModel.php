<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id_customer';
    protected $allowedFields = ['id_user', 'nama', 'alamat', 'phone'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function findByUserId($id_user)
    {
        return $this->where('id_user', $id_user)->first();
    }
}

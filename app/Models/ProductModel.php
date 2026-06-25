<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id_product';
    protected $allowedFields = [
        'nama_product', 'deskripsi', 'harga', 'stok', 'gambar'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function insert_data($data)
    {
        return $this->insert($data);
    }

    public function update_data($id, $data)
    {
        return $this->update($id, $data);
    }

    public function delete_data($id)
    {
        return $this->delete($id);
    }

    public function getProducts($limit = null, $keyword = null)
    {
        $builder = $this->builder();
        
        if ($keyword) {
            $keyword = trim($keyword);
            if (!empty($keyword)) {
                $builder->like('nama_product', $keyword);
            }
        }

        if ($limit) {
            $builder->limit($limit);
        }

        return $builder->orderBy('created_at', 'DESC')->get()->getResultArray();
    }
}

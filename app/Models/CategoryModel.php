<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id_category';
    protected $allowedFields = ['nama_category', 'slug', 'deskripsi'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null;

    public function findBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }
}

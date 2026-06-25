<?php

namespace App\Models;

use CodeIgniter\Model;

class TestimonialModel extends Model
{
    protected $table = 'testimonials';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_customer', 'id_product', 'nama', 'pesan', 'rating', 'is_approved'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null;

    public function getApproved($limit = null)
    {
        $q = $this->where('is_approved', 1)->orderBy('created_at', 'DESC');
        if ($limit) $q->limit($limit);
        return $q->findAll();
    }
}

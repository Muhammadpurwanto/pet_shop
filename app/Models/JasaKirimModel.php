<?php

namespace App\Models;

use CodeIgniter\Model;

class JasaKirimModel extends Model
{
    protected $table = 'jasa_kirim';
    // protected $useTimestamps = true;
    protected $allowedFields = ['id', 'name', 'price'];
}
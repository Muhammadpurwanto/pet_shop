<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table = 'karyawan';
    // protected $useTimestamps = true;
    protected $allowedFields = ['id', 'name', 'email'];
}
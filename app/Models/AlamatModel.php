<?php

namespace App\Models;

use CodeIgniter\Model;

class AlamatModel extends Model
{
    protected $table = 'alamat';
    // protected $useTimestamps = true;
    protected $allowedFields = ['provinsi', 'kabupaten', 'kecamatan', 'desa', 'detail', 'kode_pos', 'id_users'];
}
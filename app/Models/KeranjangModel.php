<?php

namespace App\Models;

use CodeIgniter\Model;

class KeranjangModel extends Model
{
    protected $table = 'keranjang';
    // protected $useTimestamps = true;
    protected $allowedFields = ['id_user','id_product','jumlah','total'];

}
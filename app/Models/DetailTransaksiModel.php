<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailTransaksiModel extends Model
{
    protected $table = 'detail_transaksi';
    protected $allowedFields = ['id_product','id_transaksi','quantity'];
}
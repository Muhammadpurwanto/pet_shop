<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $useTimestamps = true;
    protected $allowedFields = ['id','id_user','id_petPay','id_jasa_kirim','id_karyawan','id_service','id_alamat','tanggal','jam'];

}
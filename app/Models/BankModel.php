<?php

namespace App\Models;

use CodeIgniter\Model;

class BankModel extends Model
{
    protected $table = 'bank';
    // protected $useTimestamps = true;
    protected $allowedFields = ['id', 'name', 'saldo', 'id_users'];
}
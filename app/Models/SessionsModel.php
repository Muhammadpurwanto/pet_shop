<?php

namespace App\Models;

use CodeIgniter\Model;

class SessionsModel extends Model
{
    protected $table = 'sessions';
    protected $allowedFields = ['id', 'id_user','id_admin'];
}
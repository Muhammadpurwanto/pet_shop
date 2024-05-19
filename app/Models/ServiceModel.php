<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table = 'service';
    protected $allowedFields = ['id', 'name', 'description', 'price', 'image'];
}
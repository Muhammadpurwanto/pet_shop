<?php

namespace App\Controllers;
use App\Models\ServiceModel;

class Service extends BaseController
{
    protected Sessions $session;

    public function __construct()
    {
        $this->session = new Sessions();
    }
    public function index(): string
    {
        $serviceModel = new ServiceModel();
        $services = $serviceModel->findAll();
        $data = [
            'title' => 'Service',
            'user' => $this->session->currentUser(),
            'services' => $services
        ];
        return view('service/index.php', $data);
    }
    public function insert()
    {
    
    }
}

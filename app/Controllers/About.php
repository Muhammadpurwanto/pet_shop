<?php

namespace App\Controllers;

class About extends BaseController
{
    protected Sessions $session;
    public function __construct()
    {
        $this->session = new Sessions();
    }
    public function index(): string
    {
        $data = [
            'title' => 'Home|index',
            'user' => $this->session->currentUser()
        ];
        return view('about/index.php', $data);
    }
}

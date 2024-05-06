<?php

namespace App\Controllers;

class Bank extends BaseController
{
    private Sessions $session;
    public function __construct()
    {
        $this->session = new Sessions();
    }
    public function index(): string
    {
        $user = $this->session->currentUser();
            $data = [
                'title' => 'Home|dasboard',
                'user' => $user
            ];
            return view('bank/index.php', $data);
        
    }
    public function add()
    {
        $user = $this->session->currentUser();
            $data = [
                'title' => 'Home|dasboard',
                'user' => $user
            ];
            return view('bank/add.php', $data);
    }
}

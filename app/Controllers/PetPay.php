<?php

namespace App\Controllers;

use App\Models\PetPayModel;

class PetPay extends BaseController
{
    protected PetPayModel $petPayModel;
    private Sessions $session;
    public function __construct()
    {
        $this->petPayModel = new PetPayModel();
        $this->session = new Sessions();
    }
    public function add()
    {
        $user = $this->session->currentUser();
        $akun = $this->petPayModel->where(['id_user' => $user['id']])->first();
        // dd($akun['no_rek']);
            $data = [
                'title' => 'TopUp',
                'user' => $user,
                'akun' => $akun
            ];
            return view('PetPay/add.php', $data);
    }
    public function postAdd()
    {
        $user = $this->session->currentUser();
        // dd($user);
        $dataForm = [
            'saldo' => 0,
            'id_user' => $user['id'],
            'no_rek' => $this->request->getPost('rek'),
        ];
        $this->petPayModel->save($dataForm);
        session()->setFlashdata('pesan','Data Berhasil Ditambahkan.');
        return redirect()->to(base_url('/petPay/add'));
    }
    public function topUp()
    {
        $user = $this->session->currentUser();
        $akun = $this->petPayModel->where(['id_user' => $user['id']])->first();
        // dd($akun['no_rek']);
            $data = [
                'title' => 'TopUp',
                'user' => $user,
                'akun' => $akun
            ];
            return view('PetPay/topUp.php', $data);
    }
    public function postTopUp()
    {
        $user = $this->session->currentUser();
        $akun = $this->petPayModel->where(['id_user' => $user['id']])->first();

        $nominal = $this->request->getPost('saldo');
        $akun['saldo'] = $akun['saldo'] + $nominal;
        $this->petPayModel->save($akun);
        session()->setFlashdata('pesan','Data Berhasil Ditambahkan.');
        return redirect()->to(base_url('/petPay/add'));
    }
}

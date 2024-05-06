<?php

namespace App\Controllers;

use App\Models\AlamatModel;

class Alamat extends BaseController
{
    protected AlamatModel $alamatModel;
    private Sessions $session;
    public function __construct()
    {
        $this->alamatModel = new AlamatModel();
        $this->session = new Sessions();
    }
    public function index(): string
    {
        $user = $this->session->currentUser();
        $alamats = $this->alamatModel->where(['id_users' => $user['id']])->findAll();
        
        $data = [
            'title' => 'Alamat User',
            'user' => $user,
            'alamats' => $alamats
        ];
        return view('alamat/index.php', $data);
    }
    public function add()
    {
        $user = $this->session->currentUser();
        
        $data = [
            'title' => 'Alamat User',
            'user' => $user
        ];
        return view('alamat/add.php', $data);
    }
    public function postAdd()
    {
        $user = $this->session->currentUser();
        $dataForm = [
            'provinsi' => $this->request->getPost('provinsi'),
            'kabupaten' => $this->request->getPost('kabupaten'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'desa' => $this->request->getPost('desa'),
            'detail' => $this->request->getPost('detail'),
            'kode_pos' => $this->request->getPost('kode_pos'),
            'id_users' => $user['id'],
        ];
        // dd($dataForm);
        $rules = [
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'detail' => 'required',
            'kode_pos' => 'required',
        ];
        if(!$this->validate($rules)){
            $validation = \Config\Services::validation();
            $data = [
                'title' => 'Tambah Alamat',
                'validation' => $validation,
                'input_data' => $this->request->getPost()
            ];
            return view('/alamat/add.php', $data);
        }
        $this->alamatModel->save($dataForm);

        session()->setFlashdata('pesan','Alamat Berhasil Ditambahkan.');
        return redirect()->to(base_url('/alamat'));
    }
    public function update($id)
    {
        $alamat = $this->alamatModel->find($id);
        $data = [
            'title' => 'Update Alamat',
            'alamat' => $alamat
        ];
        return view('alamat/update.php', $data);
    }
    public function postUpdate($id)
    {
        $alamat = $this->alamatModel->find($id);
        $user = $this->session->currentUser();
        $dataForm = [
            'id' => $alamat['id'],
            'provinsi' => $this->request->getVar('provinsi'),
            'kabupaten' => $this->request->getVar('kabupaten'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'desa' => $this->request->getVar('desa'),
            'detail' => $this->request->getVar('detail'),
            'kode_pos' => $this->request->getVar('kode_pos'),
            'id_users' => $user['id'],
        ];

        $rules = [
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'detail' => 'required',
            'kode_pos' => 'required',
        ];
        if(!$this->validate($rules)){
            $validation = \Config\Services::validation();
            $data = [
                'title' => 'Form Update',
                'validation' => $validation,
                'alamat' => $alamat
            ];
            return view('/alamat/update.php', $data);
        }

        // $db->table('users')->update($dataForm);
        $this->alamatModel->save($dataForm);

        session()->setFlashdata('pesan','Data Berhasil Diupdate.');
        return redirect()->to(base_url('/alamat'));
    }
    public function delete($id)
    {
        $this->alamatModel->delete($id);
        session()->setFlashdata('pesan','Data Berhasil Dihapus.');
        return redirect()->to('/alamat');
    }
    
}

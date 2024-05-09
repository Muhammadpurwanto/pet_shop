<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\ProductsModel;
use App\Models\CategoriesModel;

class Admin extends BaseController
{
    protected AdminModel $adminModel;
    protected Sessions $session;
    protected ProductsModel $productsModel;
    protected CategoriesModel $categoriesModel;
    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->session = new Sessions();
        $this->productsModel = new ProductsModel();
        $this->categoriesModel = new CategoriesModel();
    }
    public function index(): string
    {
        $admin = $this->session->currentAdmin();
        if($admin == null){
            $data = [
                'title' => 'Home|index'
            ];
            return view('/admin/index.php', $data);
        }else{
            $data = [
                'title' => 'Dasboard',
                'admin' => $admin
            ];
            return view('/admin/dasboard', $data);
        }
    }
    public function registrasi()
    {
        $admin = $this->session->currentAdmin();
        $data = [
            'title' => 'Form Registrasi Admin',
            'admin' => $admin
        ];
        return view('admin/registrasi.php', $data);
    }
    public function postRegistrasi()
    {
        $admin = $this->session->currentAdmin();
        $dataForm = [
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'name' => $this->request->getVar('name'),
            'image' => $this->request->getFile('image')->getRandomName(),
        ];
        $rules = [
            'email' => 'required|is_unique[users.email]',
            'password' => 'required|min_length[8]|max_length[12]',
            'name' => 'required',
            'image' => 'max_size[image,3075]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]'
        ];
        if(!$this->validate($rules)){
            $validation = \Config\Services::validation();
            $data = [
                'title' => 'Form Registrasi Admin',
                'admin' => $admin,
                'validation' => $validation,
                'input_data' => $this->request->getPost()
            ];
            return view('/admin/registrasi.php', $data);
        }
        $fileImage = $this->request->getFile('image');
        if($fileImage->getError() == 4){
            $dataForm['image'] = 'defaultUser.jpg';
        }else{
            $fileImage->move('img',$dataForm['image']);
        }
        $this->adminModel->save($dataForm);

        session()->setFlashdata('pesan','Data Berhasil Ditambahkan.');
        return redirect()->to('/admin');
    }
    
    public function login(): string
    {
        $data = [
            'title' => 'Home|dasboard'
        ];
        return view('admin/login.php', $data);
    }
    public function postLogin()
    {
        $model = [
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ];

        $admin = $this->adminModel->where(['email' => $model['email']])->first();
        // dd($admin);

        if($admin != null && password_verify($model['password'], $admin['password'])){
            $data = [
                'title' => 'Admin|login',
            ];

            $this->session->create(intval($admin['id']));
            return redirect()->to(base_url("/admin"));
        }else{
            $data = [
                'title' => 'Admin|login'
            ];
            session()->setFlashdata('error','User or password is wrong.');
            return view('/admin/login',$data);
            
        }
    }
    public function akun()
    {
        $data = [
            'title' => 'Admin|akun',
            'admin' => $this->session->currentAdmin(),
            'akun' => true
        ];
        return view('admin/akun.php', $data);
    }
    public function postAkun()
    {
        $admin = $this->session->currentAdmin();
        $dataForm = [
            'id' => $admin['id'],
            'email' => $this->request->getVar('email'),
            'password' => $admin['password'],
            'name' => $this->request->getVar('name'),
            'image' => $this->request->getFile('image')->getRandomName(),
        ];

        if($admin['email'] == $dataForm['email']){
            $rule_email = 'required';
        }else{
            $rule_email = 'required|is_unique[users.email]';
        }

        $rules = [
            'name' => 'required',
            'email' => $rule_email,
            'image' => 'max_size[image,3075]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]'
        ];
        if(!$this->validate($rules)){
            $validation = \Config\Services::validation();
            $data = [
                'title' => 'Form Update',
                'validation' => $validation,
                'akun' => true,
                'admin' => $admin
            ];
            return view('/admin/akun.php', $data);
        }

        $fileImage = $this->request->getFile('image');
        if($fileImage->getError() == 4){
            $dataForm['image'] = $this->request->getVar('old_image');
        }else{
            $fileImage->move('img',$dataForm['image']);
            if(file_exists('img/'. $this->request->getVar('old_image'))){
                unlink('img/'.$this->request->getVar('old_image'));
            }
        }

        // $db->table('users')->update($dataForm);
        $this->adminModel->save($dataForm);

        session()->setFlashdata('pesan','Data Berhasil Diupdate.');
        return redirect()->to(base_url('/admin'));
    }
    public function password()
    {
        $admin = $this->session->currentAdmin();
        $data = [
            'title' => 'Ganti Password',
            'admin' => $admin,
            'akun' => true
        ];
        return view('/admin/password.php', $data);
    }
    public function postPassword()
    {
        $admin = $this->session->currentAdmin();
        $dataForm = [
            'old_password' => $this->request->getPost('old_password'),
            'new_password' => $this->request->getPost('new_password'),
            'konfirmasi_password' => $this->request->getPost('konfirmasi_password'),
        ];
        $rules = [
            'old_password' => 'required',
            'new_password' => 'required|min_length[8]|max_length[12]',
            'konfirmasi_password' => 'required',
        ];
        
        if(!$this->validate($rules)){
            $validation = \Config\Services::validation();
            $data = [
                'title' => 'Form Update',
                'validation' => $validation,
                'akun' => true,
                'admin' => $admin
            ];
            return view('/admin/password.php', $data);
        }
        if(password_verify($dataForm['old_password'], $admin['password']) && $dataForm['new_password'] == $dataForm['konfirmasi_password']){
            $admin['password'] = password_hash($this->request->getVar('new_password'), PASSWORD_BCRYPT);
            $this->adminModel->save($admin);
            session()->setFlashdata('pesan','Berhasil Merubah Password');
            return redirect()->to(base_url("/admin/akun"));
        }else{
            session()->setFlashdata('pesan', 'Password Is Wrong');
            return redirect()->to(base_url("/admin/password"));
        }
    }
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url("/admin"));
    }
    public function products()
    {
        $products = $this->productsModel->findAll();
        $admin = $this->session->currentAdmin();
        $data = [
            'title' => 'Daftar Produk',
            'admin' => $admin,
            'products' => $products
        ];
        return view('admin/products.php', $data);
    }
    public function addProduct()
    {        
        $categories = $this->categoriesModel->findAll();
        $admin = $this->session->currentAdmin();
        // dd($categories);
        $data = [
            'title' => 'Form Tambah Produk',
            'user' => $admin,
            'categories' => $categories,
            'admin' => $admin
        ];
        return view('admin/addProduct.php', $data);
    }
    public function postAddProduct()
    {
        $db = \Config\Database::connect();
        $categories = $this->categoriesModel->findAll();
        $admin = $this->session->currentAdmin();
        $dataForm = [
            'id' => strtoupper($this->request->getVar('id')),
            'name' => $this->request->getVar('name'),
            'description' => $this->request->getVar('description'),
            'quantity' => $this->request->getVar('quantity'),
            'price' => $this->request->getVar('price'),
            'id_categories' => $this->request->getVar('category'),
            'image' => $this->request->getFile('image')->getRandomName(),
        ];
        $rules = [
            'id' => 'required|is_unique[products.id]|max_length[8]|min_length[4]',
            'name' => 'required',
            'quantity' => 'integer',
            'price' => 'integer',
            'category' => 'required',
            'image' => 'max_size[image,3075]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]'
        ];
        if(!$this->validate($rules)){
            $validation = \Config\Services::validation();
            $data = [
                'title' => 'Form Tambah Produk',
                'admin' => $admin,
                'categories' => $categories,
                'validation' => $validation,
                'input_data' => $this->request->getPost()
            ];
            return view('/admin/addProduct', $data);
        }
        // Ambil Gambar
        $fileImage = $this->request->getFile('image');
        if($fileImage->getError() == 4){
            $dataForm['image'] = 'defaultProduct.jpeg';
        }else{
            $fileImage->move('img',$dataForm['image']);
        }
        // $this->productsModel->save($data);
        $db->table('products')->insert($dataForm);

        session()->setFlashdata('pesan','Data Berhasil Ditambahkan.');
        return redirect()->to('/admin/products');
    }
    public function deleteProduct($id)
    {
        $product = $this->productsModel->find($id);
        if($product['image'] != 'defaultProduct.jpeg' && file_exists('img/'.$product['image'])){
            unlink('img/'.$product['image']);
        }
        $this->productsModel->delete($id);
        session()->setFlashdata('pesan','Data Berhasil Dihapus.');
        return redirect()->to('/admin/products');
    }

    public function updateProduct($id)
    {
        $product = $this->productsModel->find($id);
        $categories = $this->categoriesModel->findAll();
        $admin = $this->session->currentAdmin();
        $data = [
            'title' => 'Form Tambah Produk',
            'admin' => $admin,
            'categories' => $categories,
            'product' => $product
        ];
        return view('/admin/updateProduct',$data);
    }
    public function postUpdateProduct($id)
    {
        $product = $this->productsModel->find($id);
        $categories = $this->categoriesModel->findAll();
        $admin = $this->session->currentAdmin();
        $validation = \Config\Services::validation();
        $dataForm = [
            'id' => $product['id'],
            'name' => $this->request->getVar('name'),
            'description' => $this->request->getVar('description'),
            'quantity' => $this->request->getVar('quantity'),
            'price' => $this->request->getVar('price'),
            'id_categories' => $this->request->getVar('category'),
            'image' => $this->request->getFile('image')->getRandomName(),
        ];

        $rules = [
            'name' => 'required',
            'quantity' => 'integer',
            'price' => 'integer',
            'category' => 'required',
            'image' => 'max_size[image,3075]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]'
        ];

        if(!$this->validate($rules)){
            $validation = \Config\Services::validation();
            $data = [
                'title' => 'Form Tambah Produk',
                'admin' => $admin,
                'categories' => $categories,
                'validation' => $validation,
                'product' => $product,

            ];
            return view('/admin/updateProduct',$data);
        }
        // dd($product['image']);
        $fileImage = $this->request->getFile('image');
        if($fileImage->getError() == 4){
            $dataForm['image'] = $this->request->getVar('old_image');
        }else{
            $fileImage->move('img',$dataForm['image']);
            if(file_exists('img/'. $this->request->getVar('old_image'))){
                unlink('img/'.$this->request->getVar('old_image'));
            }
        }
        $this->productsModel->save($dataForm);

        session()->setFlashdata('pesan','Data Berhasil Diupdate.');
        return redirect()->to(base_url('/admin/products'));

        
        
    }

}
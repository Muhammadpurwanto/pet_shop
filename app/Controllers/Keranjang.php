<?php

namespace App\Controllers;

use App\Models\AlamatModel;
use App\Models\JasaKirimModel;
use App\Models\PetPayModel;
use App\Models\ProductsModel;
use App\Models\KeranjangModel;

class Keranjang extends BaseController
{
    private Sessions $session;
    private ProductsModel $productModel;
    private KeranjangModel $keranjangModel;
    private AlamatModel $alamatModel;
    private JasaKirimModel $jasaKirimModel;
    private PetPayModel $petPayModel;
    public function __construct()
    {
        $this->session = new Sessions();
        $this->productModel = new ProductsModel();
        $this->keranjangModel = new KeranjangModel();
        $this->alamatModel = new AlamatModel();
        $this->jasaKirimModel = new JasaKirimModel();
        $this->petPayModel= new PetPayModel();
    }
    public function index(): string
    {
        $user = $this->session->currentUser();
        $alamats = $this->alamatModel->where(['id_users' => $user['id']])->findAll();
        $kurir = $this->jasaKirimModel->where(['category' => 'product'])->findAll();
        $petPay = $this->petPayModel->where(['id_user' => $user['id']])->first();
        $db = \Config\Database::connect();

        $builder = $db->table('keranjang');
        $builder->select('products.name as name, products.image as image, products.price as price, keranjang.jumlah as jumlah, keranjang.id as id');
        $builder->join('products', 'keranjang.id_product = products.id');
        $builder->where('keranjang.id_user', $user['id']);
        $query = $builder->get();

        $results = $query->getResult();
        // dd($petPay);
            $data = [
                'title' => 'Home|dasboard',
                'user' => $user,
                'products' => $results,
                'petPay' => $petPay,
                'alamats' =>$alamats,
                'kurirs' => $kurir,
            ];
            return view('keranjang/index.php', $data);
        
    }
    public function postAdd($id_product)
    {
        $user = $this->session->currentUser();
        // dd($user);
        $product = $this->productModel->find($id_product);
        // dd($product);
        if($product['quantity'] < 1){
            session()->setFlashdata('error','Product Habis!!.');
            return redirect()->to(base_url('/products'));
        }
        $dataForm = [
            'jumlah' => 1,
            'id_user' => $user['id'],
            'id_product' => $product['id'],
            'total' => $product['price'],
        ];
        $this->keranjangModel->save($dataForm);
        return redirect()->to(base_url('/products'));
    }
    public function countKeranjang()
    {
        $user = $this->session->currentUser();
        $db = \Config\Database::connect();
        $builder = $db->table('keranjang');

        $count = $builder->where('id_user',$user['id'])->countAllResults();

        return $count;
    }
}

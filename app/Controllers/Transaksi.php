<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\PetPayModel;
use App\Models\ServiceModel;
use App\Controllers\Sessions;
use App\Models\KaryawanModel;
use App\Models\ProductsModel;
use App\Models\JasaKirimModel;
use App\Models\KeranjangModel;
use App\Controllers\BaseController;

class Transaksi extends BaseController
{
    private Sessions $session;
    private UsersModel $usersModel;
    private ProductsModel $productsModel;
    private PetPayModel $petPayModel;
    private JasaKirimModel $jasaKirimModel;
    private KaryawanModel $karyawanModel;
    private ServiceModel $serviceModel;
    private KeranjangModel $keranjangModel;
    public function __construct()
    {
        $this->session = new Sessions();
    }
    public function product(): string
    {
        $user = $this->session->currentUser();
        $db = \Config\Database::connect();

        $builder = $db->table('keranjang');
        $builder->select('products.name as name, products.image as image, products.price as price, keranjang.jumlah as jumlah, keranjang.id as id, petPay.saldo as saldo');
        $builder->join('products', 'keranjang.id_product = products.id');
        $builder->join('users', 'keranjang.id_user = users.id');
        $builder->join('petPay', 'users.id = petPay.id_user');
        $query = $builder->get();
    
        $results = $query->getResult();

    // $dataForm = [
    //     'id_user' => $user['id'],
    //     'id_product' => ,
    //     'id_petPay' => ,
    //     'id_jasa_kirim' => ,
    //     'id_keranjang' => ,
    // ];

            $data = [
                'title' => 'Home|dasboard',
                'user' => $user,
                'products' => $results,
            ];
            return view('transaksi/product.php', $data);
        
    }
    public function checkout()
    {
        $user = $this->session->currentUser();
        $db = \Config\Database::connect();


        $builder = $db->table('transaksi');
        $builder->select('*');
        $builder->join('products','transaksi.id_product = products.id');
        $builder->join('jasa_kirim','transaksi.id_jasa_kirim = jasa_kirim.id');
        $builder->join('keranjang','transaksi.id_keranjang = keranjang.id');

        $query = $builder->get();

        $results = $query->getResult();
        dd($results);
    }
}

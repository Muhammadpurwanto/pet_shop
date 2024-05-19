<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\AlamatModel;
use App\Models\PetPayModel;
use App\Models\ServiceModel;
use App\Controllers\Sessions;
use App\Models\KaryawanModel;
use App\Models\ProductsModel;
use App\Controllers\Keranjang;
use App\Models\JasaKirimModel;
use App\Models\KeranjangModel;
use App\Models\TransaksiModel;
use App\Controllers\BaseController;
use App\Models\DetailTransaksiModel;
use Exception;
use PHPUnit\Framework\Constraint\IsNull;

class Transaksi extends BaseController
{
    private Sessions $session;
    private UsersModel $usersModel;
    private TransaksiModel $transaksiModel;
    private DetailTransaksiModel $detailTransaksiModel;
    private ProductsModel $productsModel;
    private PetPayModel $petPayModel;
    private JasaKirimModel $jasaKirimModel;
    private KaryawanModel $karyawanModel;
    private ServiceModel $serviceModel;
    private KeranjangModel $keranjangModel;
    private Keranjang $keranjang;
    private AlamatModel $alamatModel;
    public function __construct()
    {
        $this->session = new Sessions();
        $this->transaksiModel = new TransaksiModel();
        $this->detailTransaksiModel = new DetailTransaksiModel();
        $this->alamatModel = new AlamatModel();
        $this->productsModel = new ProductsModel();
        $this->serviceModel = new ServiceModel();
        $this->petPayModel = new PetPayModel();
        $this->keranjangModel = new KeranjangModel();
        $this->keranjang = new Keranjang();
        $this->jasaKirimModel = new JasaKirimModel();
        $this->karyawanModel = new KaryawanModel();
    }
    public function transaksi()
    {
        if($this->request->getPost('keranjang')==null){
            session()->setFlashdata('error','Pilih Product Terlebih Dahulu.');
            return redirect()->to('/keranjang');
        } 
        $user = $this->session->currentUser();
        $petPay = $this->petPayModel->where(['id_user' => $user['id']])->first();
        $keranjangs = $this->keranjangModel->where(['id_user' => $user['id']])->findAll();
        $jumlah = $this->request->getVar('jumlah');
        // update jumlah
        for($i=0; $i<$this->keranjang->countKeranjang();$i++){
            $keranjangs[$i]['jumlah'] = $jumlah[$i];
            $this->keranjangModel->save($keranjangs[$i]);
            // $keranjangs[$i]['total'] = $keranjangs[$i]['total'] + $jumlah[$i];
            // $this->keranjangModel->save($keranjangs[$i]);
        }
        // dd($keranjangs);
        $totalHarga = 0;
        $id_keranjang = $this->request->getPost('keranjang');
        for($i=0; $i<count($id_keranjang); $i++){
            $results[] = $this->keranjangModel->find($id_keranjang[$i]);
            $products[] = $this->productsModel->find($results[$i]['id_product']);
            $total[] = $products[$i]['price'] * $results[$i]['jumlah'];
            $totalHarga = $totalHarga + $total[$i];
        }

        $kurir = $this->jasaKirimModel->find($this->request->getVar('kurir'));
        if($petPay['saldo'] < $totalHarga){
            session()->setFlashdata('error', 'Saldo Anda Tidak Cukup');
            return redirect()->to(base_url("/keranjang"));
        }
        $sisaSaldo = $petPay['saldo'] - ($totalHarga + $kurir['price']);
        $alamat = $this->alamatModel->find($this->request->getVar('alamat'));
        
            $data = [
                'title' => 'Transaksi',
                'user' => $user,
                'product' => $products,
                'keranjang' => $results,
                'total' => $total,
                'totalHarga' => $totalHarga,
                'sisaSaldo' => $sisaSaldo,
                'alamat' =>$alamat,
                'kurir' => $kurir,
                'petPay' => $petPay,
            ];
            // dd($sisaSaldo);
            return view('transaksi/transaksi.php', $data);
        
    }
    public function bayar()
    {
        $db = \Config\Database::connect();
        $db->transStart();
        try{
            $user = $this->session->currentUser();
            $petPay = $this->petPayModel->where(['id_user' => $user['id']])->first();
            $kurir = $this->jasaKirimModel->find($this->request->getPost('kurir'));
            $alamat = $this->alamatModel->find($this->request->getPost('alamat'));

            // input tabel transaksi
            $dataTransaksi = [
                'id'  => uniqid(),
                'id_user' => $user['id'],
                'id_petPay' => $petPay['id'],
                'id_jasa_kirim' => $kurir['id'],
                'id_alamat' => $alamat['id'],
            ];
            // dd($dataTransaksi);
            $db->table('transaksi')->insert($dataTransaksi);
            
            $id_keranjang = $this->request->getPost('keranjang');
            // dd($id_keranjang);
            $product_id = $this->request->getPost('product_id');
            for($i=0; $i<count($id_keranjang); $i++){
                $keranjangs[] = $this->keranjangModel->find($id_keranjang[$i]);
                $products[] = $this->productsModel->find($product_id[$i]);
            }

            // input tabel detail transaksi
            $transaksi = $this->transaksiModel->where(['id' => $dataTransaksi['id']])->first();
            // dd($keranjangs);
            for($i=0; $i<count($keranjangs); $i++){
                $dataDetailTransaksi = [
                    'id_transaksi' => $transaksi['id'],
                    'id_product' => $products[$i]['id'],
                    'quantity' => $keranjangs[$i]['jumlah'],
                ];
                $db->table('detail_transaksi')->insert($dataDetailTransaksi);
                // menghapus tabel keranjang
                $this->keranjangModel->delete($keranjangs[$i]['id']);
            }

            // update saldo
            $petPay['saldo'] = $this->request->getPost('sisaSaldo');
            $this->petPayModel->save($petPay);

            // mengurangi quantity di product        
            for($i=0; $i<count($product_id); $i++){            
                $products[$i]['quantity'] = $products[$i]['quantity'] - $keranjangs[$i]['jumlah'];
                $this->productsModel->save($products[$i]);
            }
            $db->transCommit();

            session()->setFlashdata('pesan','Transaksi Berhasil.');
            return redirect()->to('/transaksi/history');
        }catch(Exception $e){
            $db->transRollback();
            session()->setFlashdata('error','Transaksi Gagal.');
            return redirect()->to(base_url('/keranjang'));
        }
        
    }
    public function product($id)
    {
        $user = $this->session->currentUser();
        $product = $this->productsModel->find($id);
        $petPay = $this->petPayModel->where(['id_user' => $user['id']])->first();

        // dd($product);
        $kurir = $this->jasaKirimModel->find('JNE');
        if($product['quantity'] < 1){
            session()->setFlashdata('error','Product Habis!!.');
            return redirect()->to(base_url('/products'));
        }
        if($petPay['saldo'] < $product['price']){
            session()->setFlashdata('error', 'Saldo Anda Tidak Cukup');
            return redirect()->to(base_url("/product"));
        }
        $sisaSaldo = $petPay['saldo'] - ($product['price'] + $kurir['price']);
        $alamat = $this->alamatModel->where(['id_users' => $user['id']])->first();
        // dd($alamat);
            $data = [
                'title' => 'Transaksi',
                'user' => $user,
                'product' => $product,
                'sisaSaldo' => $sisaSaldo,
                'alamat' =>$alamat,
                'kurir' => $kurir,
                'petPay' => $petPay,
            ];
            // dd($sisaSaldo);
            return view('transaksi/product.php', $data);
    }
    public function bayarProduct()
    {
        $db = \Config\Database::connect();
        $db->transStart();
        try{
            $user = $this->session->currentUser();
            $petPay = $this->petPayModel->where(['id_user' => $user['id']])->first();
            $kurir = $this->jasaKirimModel->find($this->request->getPost('kurir'));
            $alamat = $this->alamatModel->find($this->request->getPost('alamat'));
            $product = $this->productsModel->find($this->request->getPost('product_id'));

            // dd($product);
            // input tabel transaksi
            $dataTransaksi = [
                'id'  => uniqid(),
                'id_user' => $user['id'],
                'id_petPay' => $petPay['id'],
                'id_jasa_kirim' => $kurir['id'],
                'id_alamat' => $alamat['id'],
            ];
            // dd($dataTransaksi);
            $db->table('transaksi')->insert($dataTransaksi);

            // input detail transaksi
            $transaksi = $this->transaksiModel->where(['id' => $dataTransaksi['id']])->first();
            // dd($keranjangs);
                $dataDetailTransaksi = [
                    'id_transaksi' => $transaksi['id'],
                    'id_product' => $product['id'],
                    'quantity' => 1,
                ];
                // dd($dataDetailTransaksi);
                $db->table('detail_transaksi')->insert($dataDetailTransaksi);      
            

            // update saldo
            $petPay['saldo'] = $this->request->getPost('sisaSaldo');
            $this->petPayModel->save($petPay);

            // mengurangi quantity di product                 
                $product['quantity'] = $product['quantity'] - 1;
                $this->productsModel->save($product);
            
            $db->transCommit();

            session()->setFlashdata('pesan','Transaksi Berhasil.');
            return redirect()->to(base_url('/transaksi/history'));
        }catch(Exception $e){
            $db->transRollback();
            dd($e);
            session()->setFlashdata('error','Transaksi Gagal');
            return redirect()->to(base_url('/keranjang'));
        }
        
    }
    public function booking($id)
    {
        $user = $this->session->currentUser();
        $alamats = $this->alamatModel->where(['id_users' => $user['id']])->findAll();
        $kurir = $this->jasaKirimModel->where(['category' => 'service'])->findAll();
        $petPay = $this->petPayModel->where(['id_user' => $user['id']])->first();
        $service= $this->serviceModel->find($id);
        $karyawan= $this->karyawanModel->findAll();

        for($i=0; $i<=7; $i++):
                $tanggal[] = date("l, d-M-Y", time()+60*60*24*$i);
        endfor;
        $jam = ['08.00-10.00','10.00-12.00','12.00-14.00','14.00-16.00'];

        // dd($tanggal);
            $data = [
                'title' => 'Home|dasboard',
                'user' => $user,
                'service' => $service,
                'petPay' => $petPay,
                'alamats' =>$alamats,
                'kurirs' => $kurir,
                'tanggals' => $tanggal,
                'jams' => $jam,
                'karyawans' => $karyawan,
            ];
            return view('transaksi/booking.php', $data);
    }
    public function service()
    {
        $user = $this->session->currentUser();
        $transaksi = $this->transaksiModel->findAll();
        $petPay = $this->petPayModel->where(['id_user' => $user['id']])->first();
        $id_service = $this->request->getPost('id_service');
        $service = $this->serviceModel->find($id_service);
        $id_kurir = $this->request->getPost('kurir');
        $kurir = $this->jasaKirimModel->where(['id' => $id_kurir])->first();
        $id_alamat = $this->request->getPost('alamat');
        $alamat = $this->alamatModel->where(['id' => $id_alamat])->first();
        $tanggal = $this->request->getPost('tanggal');
        $jam = $this->request->getPost('jam');
        $id_karyawan = $this->request->getPost('karyawan');
        $karyawan = $this->karyawanModel->where(['id' => $id_karyawan])->first();
        // dd($transaksi);
        if($petPay['saldo'] < $service['price']){
            session()->setFlashdata('error', 'Saldo Anda Tidak Cukup');
            return redirect()->to(base_url("/product"));
        }
        foreach($transaksi as $row){
            if($jam == $row['jam'] && $tanggal == $row['tanggal'] && $karyawan['id'] == $row['id_karyawan']){
                session()->setFlashdata('error','Tanggal/Jam/Karyawan Sudah Di Booking');
                return redirect()->to(base_url('/transaksi/booking/'.$service['id']));
            }
        }
        $sisaSaldo = $petPay['saldo'] - ($service['price'] + $kurir['price']);
        // dd($alamat);
            $data = [
                'title' => 'Transaksi',
                'user' => $user,
                'service' => $service,
                'sisaSaldo' => $sisaSaldo,
                'totalHarga' => $service['price'],
                'alamat' =>$alamat,
                'kurir' => $kurir,
                'petPay' => $petPay,
                'tanggal' => $tanggal,
                'jam' => $jam,
                'karyawan' => $karyawan,
            ];
            // dd($sisaSaldo);
            return view('transaksi/service.php', $data);
    }
    public function bayarService()
    {
        $db = \Config\Database::connect();
        $db->transStart();
        try{
            $user = $this->session->currentUser();
            $petPay = $this->petPayModel->where(['id_user' => $user['id']])->first();
            $kurir = $this->jasaKirimModel->find($this->request->getPost('kurir'));
            $karyawan = $this->karyawanModel->find($this->request->getPost('karyawan'));
            $service = $this->serviceModel->find($this->request->getPost('service'));
            $alamat = $this->alamatModel->find($this->request->getPost('alamat'));
            $tanggal = $this->request->getPost('tanggal');
            $jam = $this->request->getPost('jam');

            // dd($product);
            // input tabel transaksi
            $dataTransaksi = [
                'id'  => uniqid(),
                'id_user' => $user['id'],
                'id_petPay' => $petPay['id'],
                'id_jasa_kirim' => $kurir['id'],
                'id_karyawan' => $karyawan['id'],
                'id_service' => $service['id'],
                'id_alamat' => $alamat['id'],
                'tanggal' => $tanggal,
                'jam' => $jam,
            ];
            // dd($dataTransaksi);
            // $this->transaksiModel->save($dataTransaksi);
            $db->table('transaksi')->insert($dataTransaksi);

            // update saldo
            $petPay['saldo'] = $this->request->getPost('sisaSaldo');
            $this->petPayModel->save($petPay);

            $db->transCommit();

            session()->setFlashdata('pesan','Transaksi Berhasil.');
            return redirect()->to(base_url('/transaksi/history'));
        }catch(Exception $e){
            $db->transRollback();
            dd($e);
            session()->setFlashdata('error','Transaksi Gagal');
            return redirect()->to(base_url('/keranjang'));
        }
        
    }
    public function history()
    {
        $db = \Config\Database::connect();
        $user = $this->session->currentUser();
        $akun = $this->petPayModel->where(['id_user' => $user['id']])->first();
        $transaksi1 = $this->transaksiModel->where(['id_user' => $user['id']])->where(['id_service' => null])->orderBy('created_at','DESC')->limit(10)->findAll();
        $transaksi2 = $this->transaksiModel->where(['id_user' => $user['id']])->where('id_service IS NOT NULL')->orderBy('created_at','DESC')->limit(10)->findAll();

        foreach($transaksi1 as $row1){
            $detail_transaksi[] = $this->detailTransaksiModel->where(['id_transaksi' => $row1['id']])->findAll();
            $kurir1[] = $this->jasaKirimModel->find($row1['id_jasa_kirim']);
        }
        foreach($transaksi2 as $row2){
            $service[] = $this->serviceModel->find($row2['id_service']);
            $kurir2[] = $this->jasaKirimModel->find($row2['id_jasa_kirim']);
        }
        // dd($kurir);
        // dd($transaksi1);
            $data = [
                'title' => 'History',
                'user' => $user,
                'transaksi1' => $transaksi1,
                'transaksi2' => $transaksi2,
                'service' => $service,
                'detail_transaksi' => $detail_transaksi,
                'kurir1' => $kurir1,
                'kurir2' => $kurir2,
                'akun' => $akun
            ];
            // dd($data);
            return view('Users/history.php', $data);
    }
}

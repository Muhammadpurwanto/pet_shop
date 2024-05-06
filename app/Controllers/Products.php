<?php

namespace App\Controllers;
use App\Models\ProductsModel;

class Products extends BaseController
{
    protected ProductsModel $productsModel;
    protected Sessions $session;
    public function __construct()
    {
        $this->productsModel = new ProductsModel();   
        $this->session = new Sessions();     
    }
    public function index($id_categories = false)
    {        
        if($id_categories == false){

            $products = $this->productsModel->findAll();
        }else{
            $products = $this->productsModel->where(['id_categories' => $id_categories])->findAll();
        }
        $data = [
            'title' => 'Product|index',
            'products' => $products,
            'user' => $this->session->currentUser()
        ];
        // dd($data);
        return view('products/index.php', $data);
    }

    public function detail($id)
    {
        // $product = $this->productsModel->where(['id' => $id])->first();
        $product = $this->productsModel->find($id);
        $data = [
            'title' => 'Product|detail',
            'product' => $product,
            'user' => $this->session->currentUser()
        ];
        return view('products/detail.php', $data);
    }

    public function update()
    {
    
    }
    public function delete()
    {
    
    }
}

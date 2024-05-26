<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\UsersModel;
use App\Models\SessionsModel;

class Sessions extends BaseController
{
    public static $COOKIE_NAME = "X-SESSION";
    protected SessionsModel $sessionsModel;
    protected UsersModel $usersModel;
    protected AdminModel $adminModel;
    public function __construct()
    {
        $this->sessionsModel = new SessionsModel();
        $this->usersModel = new UsersModel();
        $this->adminModel = new AdminModel();
    }
    public function createUser($userId)
    {
        $db = \Config\Database::connect();
        $model = [
            'id' => uniqid(),
            'id_user' => $userId
        ];
        
        try {
            $db->table('sessions')->insert($model);
            setcookie(self::$COOKIE_NAME, $model['id'], 0,'/');
            // echo "Data berhasil disimpan.";
        } catch (\Exception $e) {
            echo "Gagal menyimpan data: " . $e->getMessage();
        }
        
    }
    public function createAdmin($adminId)
    {
        $db = \Config\Database::connect();
        $model = [
            'id' => uniqid(),
            'id_admin' => $adminId
        ];
        
        try {
            $db->table('sessions')->insert($model);
            setcookie(self::$COOKIE_NAME, $model['id'], 0,'/');
            // echo "Data berhasil disimpan.";
        } catch (\Exception $e) {
            echo "Gagal menyimpan data: " . $e->getMessage();
        }
        
    }
    public function destroy()
    {
        $id = $_COOKIE[self::$COOKIE_NAME] ?? '';
        $this->sessionsModel->delete($id);
        setcookie(self::$COOKIE_NAME, '', 1, '/');
    }
    public function currentUser()
    {
        $id = $_COOKIE[self::$COOKIE_NAME] ?? '';
        $session = $this->sessionsModel->find($id);
        // dd($session);
        if($session == null){
            return null;
        }
        if($session['id_user'] == null){
            return null;
        }else{
            return $this->usersModel->find($session['id_user']);
        }
    
    }
    public function currentAdmin()
    {
        $id = $_COOKIE[self::$COOKIE_NAME] ?? '';
        $session = $this->sessionsModel->find($id);
        if($session == null){
            return null;
        }
        if($session['id_admin'] == null){
            return null;
        }else{
            return $this->adminModel->find($session['id_admin']);
        }
    
    }
}

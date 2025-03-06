<?php
namespace App\Controllers;

use App\Models\Model;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class User extends BaseController{
    use ResponseTrait;
    private $model;

    public function __construct(){
        $this->model = new UserModel;
    }

    public function index(){
        $data = $this->model->findAll();
        return $this->respond($data, 200);
    }

    public function show($id_user = null){
        $data = $this->model->where('id_user', $id_user)->findAll();

        if($data){
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound("Data tidak ditemukan!");
        }
    }
}
?>
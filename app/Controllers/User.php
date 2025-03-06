<?php
namespace App\Controllers;

use App\Models\UserModelV;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class User extends BaseController{
    use ResponseTrait;
    private $model;
    private $viewModel;

    public function __construct(){
        $this->model = new UserModel;
        $this->viewModel = new UserModelV;
    }

    public function index(){
        $data = $this->viewModel->findAll();
        return $this->respond($data, 200);
    }

    public function show($id_user = null){
        $data = $this->viewModel->where('id_user', $id_user)->findAll();

        if($data){
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound("Data tidak ditemukan!");
        }
    }
}
?>
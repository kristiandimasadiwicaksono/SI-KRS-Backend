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

    public function create(){
        $data = $this->request->getPost();

        if(!$this->model->insert($data)){
            return $this->fail($this->model->errors());
        }

        $response = [
            'status' => 200,
            'error' => null,
            'message' => [
                'success' => 'Berhasil Menambahkan Data'
            ]
        ];
        return $this->respond($response);
    }

    public function update ($id_user = null){
        $data = $this->request->getRawInput();

        $isExist = $this->model->where('id_user', $id_user)->first();
        if(!$isExist){
            return $this->failNotFound("Data tidak ditemukan!");
        }

        if(!$this->model->where('id_user', $id_user)->set($data)->update()){
            return $this->fail($this->model->errors());
        }
        $response = [
            'status' => 200,
            'error' => null,
            'message' => [
                'success' => 'Berhasil Mengubah Data!'
            ]
        ];
        return $this->respond($response);
    }

    public function delete($id_user = null){
        $data = $this->model->where('id_user', $id_user)->findAll();

        if($data){
            $this->model->delete($id_user);
            $response = [
                'status' => 200,
                'error' => null,
                'message' => [
                    'success' => 'Berhasil Menghapus Data!'
                ]
            ];
            return $this->respond($response);
        } else {
            return $this->failNotFound("Data tidak ditemukan!");
        }
    }
}
?>
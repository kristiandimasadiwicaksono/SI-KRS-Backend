<?php
namespace App\Controllers;

use App\Models\KrsModel;
use CodeIgniter\API\ResponseTrait;

class Krs extends BaseController{
    use ResponseTrait;
    private $model;

    public function __construct() {
        $this->model = new KrsModel;
    }

    public function index(){
        $data = $this->model->getDataKrs();
        return $this->respond($data, 200);
    }

    public function show($id_krs = null){
        $data = $this->model->where('id_krs', $id_krs)->getDataKrs();

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
            'message' =>[
                'success' => 'Berhasil Menambahkan Data'
            ]
        ];
        return $this->respond($response);
    }

    public function update($id_krs = null){
        $data = $this->request->getRawInput();

        $isExist = $this->model->where('id_krs', $id_krs)->first();
        if(!$isExist){
            return $this->failNotFound("Data tidak ditemukan!");
        }

        if(!$this->model->where('id_krs', $id_krs)->set($data)->update()){
            return $this->fail($this->model->errors());
        }
        $response = [
            'status' => 200,
            'error' => null,
            'message' => [
                'success' => 'Berhasil Mengubah Data'
            ]
        ];
        return $this->respond($response);
    }

    public function delete ($id_krs = null){
        $data = $this->model->where('id_krs', $id_krs)->findAll();

        if($data){
            $this->model->delete($id_krs);
            $response = [
                'status' => 200,
                'error' => null,
                'message' => [
                   'success' => 'Berhasil Menghapus Data'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound("Data tidak ditemukan!");
        }
    }
}
?>
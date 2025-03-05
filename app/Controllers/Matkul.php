<?php
namespace App\Controllers;

use App\Models\MatkulModel;
use CodeIgniter\API\ResponseTrait;

class Matkul extends BaseController{
    use ResponseTrait;
    private $model;

    public function __construct(){
        $this->model = new MatkulModel;
    }

    public function index(){
        $data = $this->model->getDataMatkul();
        return $this->respond($data, 200);
    }

    public function show($id_matkul = null){
        $data = $this->model->where('id_matkul', $id_matkul)->getDataMatkul();

        if($data){
            return $this->respond($data, 200);
        } else  {
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

    public function update ($id_matkul = null){
        $data = $this->request->getRawInput();

        $isExist = $this->model->where('id_matkul', $id_matkul)->first();
        if(!$isExist){
            return $this->failNotFound("Data tidak ditemukan!");
        }

        if(!$this->model->where('id_matkul', $id_matkul)->set($data)->update()){
            return $this->fail($this->model->errors());
        }
        $response = [
            'status' => 200,
            'error' => null,
            'message' => [
                'message' => 'Berhasil Mengubah Data!'
            ]
        ];
        return $this->respond($response);
    }

    public function delete ($id_matkul = null){
        $data = $this->model->where('id_matkul', $id_matkul)->getDataMatkul();

        if($data){
            $this->model->delete($id_matkul);
            $response = [
                'status' => 200,
                'error' => null,
                'data' => $data,
                'message' => [
                   'message' => 'Berhasil Menghapus Data!'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound("Data tidak ditemukan!");
        }
    }
}
?>
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
        $data = $this->model->findAll();
        return $this->respond($data, 200);
    }

    public function show($id_matkul = null){
        $data = $this->model->where('id_matkul', $id_matkul)->findAll();

        if($data){
            return $this->respond($data, 200);
        } else  {
            return $this->failNotFound("Data tidak ditemukan!");
        }
    }

    public function create(){
        $data = $this->request->getPost();

        $existing = $this->model->where('nama_matkul', $data['nama_matkul'])->where('nip', $data['nip'])->first();
        if($existing){
            return $this->failNotFound("Mata Kuliah dengan NIP tersebut sudah terdaftar!");
        }

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

        if(isset($data['nama_matkul']) && isset($data['nip'])){
            $existing = $this->model->where('nama_matkul', $data['nama_matkul'])->where('nip', $data['nip'])->where('id_matkul !=', $id_matkul)->first();

            if($existing){
                return $this->failValidationErrors("Mata Kuliah dengan NIP tersebut sudah terdaftar!");
            }
        }

        $dosenModel = new \App\Models\DosenModelV();
        $dosen = $dosenModel->where('nip', $data['nip'])->first();

        if(!$dosen){
            return $this->failValidationErrors("NIP tidak ditemukan!");
        }

        $isExist = $this->model->find($id_matkul);
        if (!$isExist) {
            return $this->failNotFound("Data tidak ditemukan!");
        }

        if(!$this->model->update($id_matkul, $data)){
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

    public function delete ($id_matkul = null){
        $data = $this->model->where('id_matkul', $id_matkul)->findAll();

        if($data){
            $this->model->delete($id_matkul);
            $response = [
                'status' => 200,
                'error' => null,
                'message' => [
                   'success' => 'Berhasil Menghapus Data!'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound("Data tidak ditemukan!");
        }
    }
}
?>
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

    public function show($kode_matkul = null){
        $data = $this->model->where('kode_matkul', $kode_matkul)->getDataMatkul();

        if($data){
            return $this->respond($data, 200);
        } else  {
            return $this->failNotFound("Data tidak ditemukan!");
        }
    }

    public function create(){
        $data = $this->request->getPost();

        $existing = $this->model->where('kode_matkul', $data['kode_matkul'])->first();
        if($existing){
            return $this->failNotFound("Kode Mata Kuliah sudah terdaftar!");
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

    public function update ($kode_matkul = null){
        $data = $this->request->getRawInput();

        $isExist = $this->model->where('kode_matkul', $kode_matkul)->first();
        if(!$isExist){
            return $this->failNotFound("Data tidak ditemukan!");
        }

        if (isset($data['kode_matkul']) && $data['kode_matkul'] !== $kode_matkul) {
            $existing = $this->model->where('kode_matkul', $data['kode_matkul'])->first();
            if ($existing) {
                return $this->fail("Kode Mata Kuliah sudah digunakan!", 400);
            }
        }

        if(!$this->model->where('kode_matkul', $kode_matkul)->set($data)->update()){
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

    public function delete ($kode_matkul = null){
        $data = $this->model->where('kode_matkul', $kode_matkul)->findAll();

        if($data){
            $this->model->delete($kode_matkul);
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
<?php
namespace App\Controllers;

use App\Models\KrsModelV;
use App\Models\KrsModel;
use CodeIgniter\API\ResponseTrait;

class Krs extends BaseController{
    use ResponseTrait;
    private $model;
    private $viewModel;

    public function __construct() {
        $this->model = new KrsModel;
        $this->viewModel = new KrsModelV;
    }

    public function index(){
        $data = $this->viewModel->findAll();
        return $this->respond($data, 200);
    }

    public function show($id_krs = null){
        $data = $this->viewModel->where('id_krs', $id_krs)->findAll();

        if($data){
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound("Data tidak ditemukan!");
        }
    }

    public function create(){
        $data = $this->request->getPost();

        if (empty($data['npm']) || empty($data['kode_matkul'])) {
            return $this->fail("NPM dan ID Mata Kuliah wajib diisi!", 400);
        }

        $existing = $this->model->where('npm', $data['npm'])
                                ->where('kode_matkul', $data['kode_matkul'])
                                ->first();

        if($existing){
            return $this->fail("Mahasiswa dengan NPM ini sudah terdaftar di matakuliah yang sama!", 400);
        }

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

        if (empty($data)) {
            return $this->fail("Data tidak boleh kosong!", 400);
        }

        $existing = $this->model->where('npm', $data['npm'])
                                ->where('kode_matkul', $data['kode_matkul'])
                                ->where('id_krs !=', $id_krs)
                                ->first();

        if($existing){
            return $this->fail("Mahasiswa dengan NPM ini sudah terdaftar di matakuliah yang sama!", 400);
        }

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
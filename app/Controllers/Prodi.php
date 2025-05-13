<?php
namespace App\Controllers;

use App\Models\ProdiModel;
use CodeIgniter\API\ResponseTrait;

class Prodi extends BaseController{
    use ResponseTrait;
    private $model;

    public function __construct(){
        $this->model = new ProdiModel;
    }

    public function index(){
        $data = $this->model->findAll();
        return $this->respond($data, 200);
    }

    public function show($kode_prodi = null){
        $data = $this->model->where('kode_prodi', $kode_prodi)->findAll();

        if($data){
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound("Data tidak ditemukan!");
        }
    }

    public function create(){
        $data = $this->request->getPost();

        $existing = $this->model->where('kode_prodi', $data['kode_prodi'])->first();
        if($existing){
            return $this->failNotFound("Prodi ini sudah terdaftar!");
        }

        $inserted = $this->model->insert($data);
        if ($inserted === false) {
            return $this->fail($this->model->errors(), 400);
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

    public function update ($kode_prodi = null){
        $data = $this->request->getRawInput();

        $isExist = $this->model->where('kode_prodi', $kode_prodi)->first();
        if(!$isExist){
            return $this->failNotFound("Data tidak ditemukan!");
        }

        if (isset($data['kode_prodi']) && $data['kode_prodi'] !== $kode_prodi) {
            $existing = $this->model->where('kode_prodi', $data['kode_prodi'])->first();
            if ($existing) {
                return $this->fail("Kode Prodi sudah terdaftar!", 400);
            }
        }

        if(!$this->model->where('kode_prodi', $kode_prodi)->set($data)->update()){
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

    public function delete($kode_prodi = null){
        $data = $this->model->where('kode_prodi', $kode_prodi)->findAll();

        if($data){
            $this->model->delete($kode_prodi);

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
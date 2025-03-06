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

    public function show($id_prodi = null){
        $data = $this->model->where('id_prodi', $id_prodi)->findAll();

        if($data){
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound("Data tidak ditemukan!");
        }
    }

    public function create(){
        $data = $this->request->getPost();

        $existing = $this->model->where('nama_prodi', $data['nama_prodi'])->first();
        if($existing){
            return $this->failNotFound("Prodi ini sudah terdaftar!");
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

    public function update ($id_prodi = null){
        $data = $this->request->getRawInput();

        $isExist = $this->model->where('id_prodi', $id_prodi)->first();
        if(!$isExist){
            return $this->failNotFound("Data tidak ditemukan!");
        }

        $nama_prodi = $isExist['nama_prodi'];

        if (isset($data['nama_prodi']) && $data['nama_prodi'] !== $nama_prodi) {
            $existing = $this->model->where('nama_prodi', $data['nama_prodi'])
                                    ->where('id_prodi !=', $id_prodi)
                                    ->first();
            if ($existing) {
                return $this->fail("Nama Program Studi sudah digunakan!", 400);
            }
        }

        if(!$this->model->where('id_prodi', $id_prodi)->set($data)->update()){
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

    public function delete($id_prodi = null){
        $data = $this->model->where('id_prodi', $id_prodi)->findAll();

        if($data){
            $this->model->delete($id_prodi);
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
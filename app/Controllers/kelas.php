<?php
namespace App\Controllers;

use App\Models\KelasModel;
use CodeIgniter\API\ResponseTrait;

class Kelas extends BaseController{
    use ResponseTrait;
    private $model;

    public function __construct(){
        $this->model = new KelasModel;
    }

    public function index(){
        $data = $this->model->findAll();
        return $this->respond($data, 200);
    }

    public function show($id_kelas = null){
        $data = $this->model->where('id_kelas', $id_kelas)->findAll();

        if($data){
            return $this->respond($data,200);
        } else {
            return $this->failNotFound("Data tidak ditemukan!");
        }
    }

    public function create(){
        $data = $this->request->getPost();

        $validationRules = [
            'nama_kelas' => 'required|is_unique[kelas.nama_kelas]',
        ];
    
        $validationMessages = [
            'nama_kelas' => [
                'required' => 'Nama Kelas harus diisi!',
                'is_unique' => 'Nama Kelas sudah terdaftar!'
            ]
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            return $this->fail($this->validator->getErrors());
        }

        $this->model->insert($data);

        $response = [
            'status' => 200,
            'error' => null,
            'message' => [
                'success' => 'Berhasil Menambahkan Data'
            ]
        ];
        return $this->respond($response);
    }

    public function update ($id_kelas = null){
        $data = $this->request->getRawInput();

        $isExist = $this->model->where('id_kelas', $id_kelas)->first();
        if(!$isExist){
            return $this->failNotFound("Data tidak ditemukan!");
        }

        $validationRules = [
            'nama_kelas' => 'required'
        ];
    
        $validationMessages = [
            'nama_kelas' => [
                'required' => 'Nama Kelas harus diisi!'
            ]
        ];
    
        if (!$this->validate($validationRules, $validationMessages)) {
            return $this->fail($this->validator->getErrors());
        }

        $this->model->update($id_kelas, $data);

        $response = [
            'status' => 200,
            'error' => null,
           'message' => [
                'success' => 'Berhasil Mengubah Data'
            ]
        ];
        return $this->respond($response);
    }

    public function delete ($id_kelas = null){
        
        $data = $this->model->where('id_kelas', $id_kelas)->findAll();

        if($data){
            $this->model->delete($id_kelas);
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
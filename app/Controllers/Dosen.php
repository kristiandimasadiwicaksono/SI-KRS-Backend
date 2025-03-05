<?php
namespace App\Controllers;

use App\Models\DosenModel;
use CodeIgniter\API\ResponseTrait;

class Dosen extends BaseController{
    use ResponseTrait;
    private $model;

    public function __construct() {
        $this->model = new DosenModel;
    }

    public function index(){
        $data = $this->model->findAll();
        return $this->respond($data,200);
    }

    public function show($nip = null){
        $data = $this->model->where('nip',$nip)->findAll();

        if($data){
            return $this->respond($data,200);
        } else {
            return $this->failNotFound("Data tidak Ditemukan!");
        }
    }

    public function create(){
        $data = $this->request->getPost();
        $validationRules = [
            'nip' => 'required|is_unique[dosen.nip]',
            'nama_dosen' => 'required'
        ];
    
        $validationMessages = [
            'nip' => [
                'required' => 'NIP tidak boleh kosong!',
                'is_unique' => 'NIP sudah terdaftar!'
            ],
            'nama_dosen' => [
                'required' => 'Nama Dosen harus diisi!'
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

    public function update ($nip = null){
        $data = $this->request->getRawInput();

        $validationRules = [
            'nip' => 'required',
            'nama_dosen' => 'required'
        ];
    
        $validationMessages = [
            'nip' => [
                'required' => 'NIP tidak boleh kosong!'
            ],
            'nama_dosen' => [
                'required' => 'Nama Dosen harus diisi!'
            ]
        ];
    
        if (!$this->validate($validationRules, $validationMessages)) {
            return $this->fail($this->validator->getErrors());
        }
    
        $this->model->update($nip, $data);

        $response = [
            'status' => 200,
            'error' => null,
            'message' => [
                'success' => 'Berhasil Mengubah Data!'
            ]
            ];
        return $this->respond($response);
    }

    public function delete($nip = null){
        $data = $this->model->where('nip', $nip)->findAll();

        if($data){
            $this->model->delete($nip);
            $response = [
                'status' => 200,
                'error' => null,
                'message' => [
                    'success' => 'Berhasil Menghapus Data!'
                ]
            ];
            return $this -> respondDeleted($response);
        }else{
            return $this->failNotFound("Data tidak ditemukan!");
        }
    }
}
?>
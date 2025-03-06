<?php
namespace App\Controllers;

use App\Models\MhsModelV;
use App\Models\MhsModel;
use CodeIgniter\API\ResponseTrait;

class Mahasiswa extends BaseController
{
    use ResponseTrait;
    private $model;
    private $viewModel;

    public function __construct(){
        $this->model = new MhsModel;
        $this->viewModel = new MhsModelV;
    }

    public function index(){
        $data = $this->viewModel->getDataMhs();
        return $this->respond($data,200);
    }

    public function show($npm = null){
        $data = $this->viewModel->where('npm', $npm)->getDataMhs();

        if($data){
            return $this->respond($data,200);
        } else {
            return $this->failNotFound("Data tidak ditemukan!");
        }
    }

    public function create(){
        $data = $this->request->getPost();

        $existing = $this->model->where('npm', $data['npm'])->first();
        if($existing){
            return $this->failNotFound("NPM sudah digunakan!");
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

    public function update ($npm = null){
        $data = $this->request->getRawInput();

        $isExist = $this->model->where('npm', $npm)->first();
        if(!$isExist){
            return $this->failNotFound("Data tidak ditemukan!");
        }

        if (isset($data['npm']) && $data['npm'] !== $npm) {
            $existing = $this->model->where('npm', $data['npm'])->first();
            if ($existing) {
                return $this->fail("NPM sudah digunakan oleh mahasiswa lain!", 400);
            }
        }
        
        if(!$this->model->where('npm', $npm)->set($data)->update()){
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

    public function delete ($npm = null){
        $data = $this->model->where('npm', $npm)->findAll();

        if($data){
            $this->model->delete($npm);
            $response = [
                'status' => 200,
                'error' => null,
                'message' => [
                    'success' => 'Berhasil Menghapus Data'
                ]
            ];
            return $this -> respondDeleted($response);
        }else{
            return $this->failNotFound("Data tidak ditemukan!");
        }
    }
}
?>
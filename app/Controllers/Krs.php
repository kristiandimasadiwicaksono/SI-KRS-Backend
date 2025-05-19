<?php
namespace App\Controllers;

// Import model dan trait
use App\Models\KrsModelV;
use App\Models\KrsModel;
use CodeIgniter\API\ResponseTrait;

class Krs extends BaseController {
    use ResponseTrait;

    private $model;       // Model utama untuk operasi database
    private $viewModel;   // Model untuk view (read-only)

    // Konstruktor untuk inisialisasi model
    public function __construct() {
        $this->model = new KrsModel;
        $this->viewModel = new KrsModelV;
    }

    // =======================
    // GET: /krs
    // Menampilkan semua data dari view KRS
    // =======================
    public function index() {
        $data = $this->viewModel->findAll();
        return $this->respond($data, 200);
    }

    // =======================
    // GET: /krs/{id}
    // Menampilkan data KRS berdasarkan ID
    // =======================
    public function show($id_krs = null) {
        $data = $this->viewModel->where('id_krs', $id_krs)->first();

        if($data){
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound("Data tidak ditemukan!");
        }
    }

    // =======================
    // POST: /krs
    // Menambahkan data baru ke tabel KRS
    // =======================
    public function create() {
        $data = $this->request->getPost();

        // Validasi data
        if (empty($data['npm']) || empty($data['kode_matkul'])) {
            return $this->fail("NPM dan ID Mata Kuliah wajib diisi!", 400);
        }

        // Cek duplikasi data
        $existing = $this->model->where('npm', $data['npm'])
                                ->where('kode_matkul', $data['kode_matkul'])
                                ->first();

        if($existing){
            return $this->fail("Mahasiswa dengan NPM ini sudah terdaftar di matakuliah yang sama!", 400);
        }

        // Gagal input
        if(!$this->model->insert($data)){
            return $this->fail($this->model->errors());
        }

        // Respon berhasil
        $response = [
            'status' => 200,
            'error' => null,
            'message' =>[
                'success' => 'Berhasil Menambahkan Data'
            ]
        ];
        return $this->respond($response);
    }

    // =======================
    // PUT/PATCH: /krs/{id}
    // Mengubah data berdasarkan ID
    // =======================
    public function update($id_krs = null) {
        $data = $this->request->getRawInput();

        // Validasi kosong
        if (empty($data)) {
            return $this->fail("Data tidak boleh kosong!", 400);
        }

        // Cek duplikasi kecuali dirinya sendiri
        $existing = $this->model->where('npm', $data['npm'])
                                ->where('kode_matkul', $data['kode_matkul'])
                                ->where('id_krs !=', $id_krs)
                                ->first();

        if($existing){
            return $this->fail("Mahasiswa dengan NPM ini sudah terdaftar di matakuliah yang sama!", 400);
        }

        // Cek apakah data ada
        $isExist = $this->model->where('id_krs', $id_krs)->first();
        if(!$isExist){
            return $this->failNotFound("Data tidak ditemukan!");
        }

        // Update data
        if(!$this->model->where('id_krs', $id_krs)->set($data)->update()){
            return $this->fail($this->model->errors());
        }

        // Respon berhasil
        $response = [
            'status' => 200,
            'error' => null,
            'message' => [
                'success' => 'Berhasil Mengubah Data'
            ]
        ];
        return $this->respond($response);
    }

    // =======================
    // DELETE: /krs/{id}
    // Menghapus data berdasarkan ID
    // =======================
    public function delete($id_krs = null) {
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

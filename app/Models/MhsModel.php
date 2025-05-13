<?php
namespace App\Models;
use CodeIgniter\Model;

class MhsModel extends Model{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'npm';
    protected $allowedFields = [
        'npm',
        'nama_mahasiswa',
        'id_kelas',
        'kode_prodi'
    ];

    protected $validationRules = [
            'npm' => 'required',
            'nama_mahasiswa' => 'required',
            'id_kelas' => 'required',
            'kode_prodi' => 'required'
    ];

    protected $validationMessages = [
        'npm' => [
            'required' => 'NPM harus diisi',
        ],
        'nama_mahasiswa' => [
           'required' => 'Nama Mahasiswa harus diisi'
        ],
        'id_kelas' => [
            'required' => 'ID Kelas harus diisi'
        ],
        'kode_prodi' => [
            'required' => 'ID Program Studi harus diisi'
        ]
    ];

    public function getDataMhs($npm = null){
        return $this->select('mahasiswa.*, kelas.nama_kelas, prodi.nama_prodi')
            ->join('kelas', 'kelas.id_kelas = mahasiswa.id_kelas','left')
            ->join('prodi', 'prodi.id_prodi = mahasiswa.id_prodi','left')
            ->findAll();
    }
}

?>
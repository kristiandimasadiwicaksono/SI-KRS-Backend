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
        'id_prodi'
    ];
    protected $beforeInsert = ['cekReferensi'];

    protected $validationRules = [
            'npm' => 'required',
            'nama_mahasiswa' => 'required',
            'id_kelas' => 'required',
            'id_prodi' => 'required'
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
        'id_prodi' => [
            'required' => 'ID Program Studi harus diisi'
        ]
    ];


    protected function cekReferensi ($data){
        $db = \config\Database::connect();

        $kelas = $db->table('kelas')->where('id_kelas', $data['data']['id_kelas']??null)->countAllResults();
        if($kelas == 0){
            throw new \Exception('Kelas dengan ID '.$data['data']['id_kelas'].' tidak ditemukan');
        }
        
        $prodi = $db->table('prodi')->where('id_prodi', $data['data']['id_prodi']??null)->countAllResults();
        if($prodi == 0){
            throw new \Exception('Program Studi dengan ID '.$data['data']['id_prodi'].' tidak ditemukan');
        }
        return $data;
    }

    public function getDataMhs($npm = null){
        return $this->select('mahasiswa.*, kelas.nama_kelas, prodi.nama_prodi')
            ->join('kelas', 'kelas.id_kelas = mahasiswa.id_kelas','left')
            ->join('prodi', 'prodi.id_prodi = mahasiswa.id_prodi','left')
            ->findAll();
    }
}

?>
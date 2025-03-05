<?php
namespace App\Models;
use CodeIgniter\Model;

class MatkulModel extends Model{
    protected $table = 'matkul';
    protected $primaryKey = 'id_matkul';
    protected $allowedFields = [
        'nama_matkul',
        'nip',
        'sks',
        'semester'
    ];
    protected $beforeInsert = ['cekReferensi'];
    protected $afterInsert = ['cekReferensi'];

    protected $validationRules = [
        'nama_matkul' => 'required|is_unique[matkul.nama_matkul]',
        'sks' => 'required',
        'semester' => 'required'
    ];

    protected $validationMessages = [
        'nama_matkul' => [
            'required' => 'Nama Mata Kuliah harus diisi!',
            'is_unique' => 'Mata Kuliah sudah terdaftar!'
        ],
        'sks' => [
            'required' => 'SKS harus diisi!'
        ],
        'semester' => [
            'required' => 'Semester harus diisi!'
        ],
    ];

    protected function cekReferensi($data){
        $db = \config\Database::connect();

        $dosen = $db->table('dosen')->where('nip', $data['data']['nip']??null)->countAllResults();
        if($dosen == 0){
            throw new \Exception('NIP tidak terdaftar!');
        }
        return $data;
    }

    public function getDataMatkul($id_matkul = null){
        return $this->select('matkul.*, dosen.nama_dosen')
                    ->join('dosen', 'dosen.nip = matkul.nip')
                    ->findAll();
    }
}
?>
<?php
namespace App\Models;
use CodeIgniter\Model;

class KrsModel extends Model{
    protected $table = 'krs';
    protected $primaryKey = 'id_krs';
    protected $allowedFields = [
        'npm',
        'kode_matkul',
    ];
    protected $useTimestamps = false;
    protected $beforeInsert = ['cekReferensi'];
    protected $afterInsert = ['cekReferensi'];
    protected $beforeUpdate = ['cekReferensi'];
    protected $afterUpdate = ['cekReferensi'];

    protected function cekReferensi($data){
        $db = \config\Database::connect();

        $mahasiswa = $db->table('mahasiswa')->where('npm', $data['data']['npm']??null)->countAllResults();
        if($mahasiswa == 0){
            throw new \Exception('Mahasiswa dengan NPM '. $data['data']['npm'].' tidak ditemukan');
        }

        $matkul = $db->table('matkul')->where('kode_matkul', $data['data']['kode_matkul']??null)->countAllResults();
        if($matkul == 0){
            throw new \Exception('Mata Kuliah dengan ID '. $data['data']['kode_matkul'].' tidak ditemukan');
        }
        return $data;
    }
    
    public function getDataKrs($id_krs = null){
        return $this->select('krs.*, mahasiswa.nama_mahasiswa, matkul.nama_matkul')
                    ->join('mahasiswa', 'mahasiswa.npm = krs.npm','left')
                    ->join('matkul', 'matkul.kode_matkul = krs.kode_matkul','left')
                    ->findAll();
    }
}
?>
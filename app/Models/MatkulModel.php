<?php
namespace App\Models;
use CodeIgniter\Model;

class MatkulModel extends Model{
    protected $table = 'matkul';
    protected $primaryKey = 'kode_matkul';
    protected $allowedFields = [
        'kode_matkul',
        'nama_matkul',
        'sks',
        'semester'
    ];

    protected $validationRules = [
        'kode_matkul' => 'required',
        'nama_matkul' => 'required',
        'sks' => 'required',
        'semester' => 'required'
    ];

    protected $validationMessages = [
        'nama_matkul' => [
            'required' => 'Nama Mata Kuliah harus diisi!',
        ],
        'nip' => [
            'required' => 'NIP harus diisi!',
        ],
        'sks' => [
            'required' => 'SKS harus diisi!'
        ],
        'semester' => [
            'required' => 'Semester harus diisi!'
        ],
    ];
}
?>
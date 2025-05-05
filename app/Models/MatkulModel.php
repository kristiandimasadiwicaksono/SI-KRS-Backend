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

    protected $validationRules = [
        'nama_matkul' => 'required',
        'nip' => 'required',
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
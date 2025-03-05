<?php
namespace App\Models;
use CodeIgniter\Model;

class DosenModel extends Model{
    protected $table = "dosen";
    protected $primaryKey = "nip";
    protected $allowedFields = [
        'nip',
        'nama_dosen'
    ];


    protected $validationRules = [
        'nama_dosen' => 'required'
    ];

    protected $validationMessages = [
        'nip' => [
            'required' => 'NIP tidak boleh kosong!',
            'is_unique' => 'NIP sudah terdaftar!'
        ],
        'nama_dosen' => [
            'required' => 'Nama Dosen harus diisi!'
        ]
    ];
}
?>
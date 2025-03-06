<?php
namespace App\Models;
use CodeIgniter\Model;

class ProdiModel extends Model{
    protected $table = 'prodi';
    protected $primaryKey = 'kode_prodi';
    protected $allowedFields = [
        'kode_prodi',
        'nama_prodi'
    ];

    protected $validationRules = [
        'kode_prodi' => 'required',
        'nama_prodi' => 'required'
    ];

    protected $validationMessages = [
        'kode_prodi' =>[
            'required' => 'Kode Prodi harus diisi'
        ],
        'nama_prodi' =>[
            'required' => 'Nama Prodi harus diisi',
        ]
    ];
}
?>
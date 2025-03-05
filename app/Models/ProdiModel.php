<?php
namespace App\Models;
use CodeIgniter\Model;

class ProdiModel extends Model{
    protected $table = 'prodi';
    protected $primaryKey = 'id_prodi';
    protected $allowedFields = [
        'nama_prodi'
    ];

    protected $validationRules = [
        'nama_prodi' => 'required|is_unique[prodi.nama_prodi]'
    ];

    protected $validationMessages = [
        'nama_prodi' =>[
            'required' => 'Nama Prodi harus diisi',
            'is_unique' => 'Nama Prodi sudah terdaftar'
        ]
    ];
}
?>
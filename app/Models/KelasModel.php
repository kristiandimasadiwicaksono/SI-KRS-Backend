<?php
namespace App\Models;
use CodeIgniter\Model;

class KelasModel extends Model{
    protected $table = "kelas";
    protected $primaryKey = "id_kelas";
    protected $allowedFields = [
        'nama_kelas'
    ];

    protected $validationRules = [
        'nama_kelas' => [
            'label' => 'Kelas',
            'rules' => 'required|regex_match[/^[1-4][A-D]$/]'
        ]
    ];

    protected $validationMessages = [
        'nama_kelas' => [
            'required' => 'Kelas harus diisi!',
            'regex_match' => 'Format kelas harus antara 1A - 4D'
        ]
    ];
}

?>
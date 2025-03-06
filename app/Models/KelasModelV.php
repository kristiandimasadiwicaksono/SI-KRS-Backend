<?php
namespace App\Models;
use CodeIgniter\Model;


class KelasModelV extends Model{
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    protected $returnType = 'array';
    protected $useAutoIncrement = 'false';
}
?>
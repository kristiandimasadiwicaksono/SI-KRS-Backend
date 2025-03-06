<?php
namespace App\Models;
use CodeIgniter\Model;

class MatkulModelV extends Model{
    protected $table = 'matkul';
    protected $primaryKey = 'id_matkul';
    protected $returnType = 'array';
    protected $useAutoIncrement = 'false';
}
?>
<?php
namespace App\Models;
use CodeIgniter\Model;

class KrsModelV extends Model{
    protected $table = 'krs';
    protected $primaryKey = 'id_krs';
    protected $returnType = 'array';
    protected $useAutoIncrement = 'false';
}
?>
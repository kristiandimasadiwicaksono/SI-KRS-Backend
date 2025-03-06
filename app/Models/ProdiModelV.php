<?php
namespace App\Models;
use CodeIgniter\Model;

class ProdiModelV extends Model{
    protected $table = 'prodi';
    protected $primaryKey = 'id_prodi';
    protected $returnType = 'array';
    protected $useAutoIncrement = 'false';
}
?>
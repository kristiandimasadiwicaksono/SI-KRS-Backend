<?php
namespace App\Models;
use CodeIgniter\Model;

class DosenModelV extends Model{
    protected $table = 'dosen';
    protected $primaryKey = 'nip';
    protected $returnType = 'array';
    protected $useAutoIncrement = 'false';
}
?>
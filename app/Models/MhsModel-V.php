<?php
namespace App\Models;
use CodeIgniter\Model;

class MhsModelV extends Model{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'npm';
    protected $returnType = 'array';
    protected $useAutoIncrement = 'false';
}
?>
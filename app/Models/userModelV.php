<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModelV extends Model{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $returnType = 'array';
    protected $useAutoIncrement = 'false';
}
?>
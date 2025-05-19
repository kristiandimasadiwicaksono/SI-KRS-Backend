<?php
namespace App\Models;
use CodeIgniter\Model;

class KrsModelV extends Model{
    protected $table = 'v_krs'; //merupakan sebuah view yang ada di database krs
    protected $primaryKey = 'id_krs'; 
    protected $returnType = 'array'; //Hasil query akan berupa array
    protected $useAutoIncrement = 'false'; //View tidak menggunakan auto increment
}
?>
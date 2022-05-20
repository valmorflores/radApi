<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

    protected $table      = 'TBLUSER';
    protected $primaryKey = 'ID';
    protected $returnType = 'array';
 
    public function getLogin($userEmail){
        $query   = $this->db->query('SELECT * FROM TBLUSER WHERE EMAIL = ' . "' . $userEmail . '");
        $results = $query->getResult();
        return $results;
      // return $this->UserModel->find($userName);
    }

}
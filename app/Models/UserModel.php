<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

    protected $table      = 'TBLUSER';
    protected $primaryKey = 'ID';
    protected $returnType = 'array';
 
    public function getLogin($userEmail,$password){
        $query   = $this->db->query("SELECT * FROM TBLUSER WHERE EMAIL = '" . $userEmail . "'");
        $results = $query->getResult();
        $finallist = [];
        foreach ($results as $row)
        {            
            $finallist[] = $row;
        }          
        $data = [];        
        $data = $finallist;
        return $data;
      // return $this->UserModel->find($userName);
    }

}
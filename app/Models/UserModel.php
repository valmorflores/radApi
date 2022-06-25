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

    public function postAddUserLogin($name, $email, $passwordHash) {
        $table = 'TBLUSER';
        $sql = 'INSERT INTO ' . $table . ' ( ';
        $separator = '';
        $fields = '';
        $data['NAME'] = $name;
        $data['EMAIL'] = $email;
        $data['PASSWORD'] = $passwordHash;
        foreach( $data as $key => $row ) {
            if ( strpos( ' '.$fields, $key ) <= 0 ) {
                $this->allowedFields[] = $key;
                $fields = trim($fields) . $separator . ' ' . $key . ' ';
                $separator = ',';
            }
        }
        $separator = '';
        $values = '';
        foreach( $data as $key => $row ) {
            $values = trim( $values ) . $separator . ' ' . $this->db->escape( $row );
            $separator = ',';
        }
        $sql = $sql . $fields . ') VALUES ( ' . $values . ' )';
        $query   = $this->db->query($sql);    
        return true;
    }


    public function getLoginKey($userEmail,$key){
        $query   = $this->db->query(
            "SELECT TBLUSER.*, TBLUSERKEY.KEYVALUE " . 
            " FROM TBLUSER" . 
            " LEFT OUTER JOIN TBLUSER.ID = TBLUSERKEY.USERID " .
            " WHERE EMAIL = '" . $userEmail . "'");
        $results = $query->getResult();
        $finallist = [];
        foreach ($results as $row)
        {            
            $finallist[] = $row;
        }          
        $data = [];        
        $data = $finallist;
        return $data;       
    }

    public function emailExists($userEmail){
        $query   = $this->db->query(
            "SELECT TBLUSER.* " . 
            " FROM TBLUSER" .
            " WHERE EMAIL = '" . $userEmail . "'");
        $results = $query->getResult();
        $finallist = [];
        foreach ($results as $row)
        {            
            $finallist[] = $row;
        }          
        $data = [];        
        $data = $finallist;
        return count($data)>0;       
    }
}
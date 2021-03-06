<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

    
    protected $table      = 'TBLUSER';
    protected $primaryKey = 'ID';
    protected $returnType = 'array';
    
    function __construct()
    {
        $this->db = \Config\Database::connect('radapi');
    }


    public function getLogin($userEmail,$password){
        $this->db = \Config\Database::connect('radapi');
        $query   = $this->db->query(
            "SELECT * FROM TBLUSER " . 
            " WHERE EMAIL = " . $this->db->escape($userEmail) . 
            " AND DELETED_AT IS NULL ");
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
        $sql = "SELECT TBLUSER.* " . 
        " FROM TBLUSER" .
        " WHERE EMAIL = " . $this->db->escape($userEmail) .
        " AND DELETED_AT IS NULL ";
        $query = $this->db->query($sql);
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

    public function getUser($userEmail){
        $query   = $this->db->query("SELECT * FROM TBLUSER WHERE EMAIL = " . 
             $this->db->escape($userEmail) . " AND DELETED_AT IS NULL ");
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

    public function deleteUser($id, $email){
        $query   = $this->db->query(
            "UPDATE  " . 
            " TBLUSER" .
            " SET DELETED_AT = CURRENT_TIMESTAMP() ". 
            " WHERE ID = " . $id . " AND EMAIL = " . $this->db->escape( $email ) );
        return true;
    }

    public function activeUser($email){
        $query   = $this->db->query(
            "UPDATE  " . 
            " TBLUSER" .
            " SET ACTIVATED_AT = CURRENT_TIMESTAMP() ". 
            " WHERE DELETED_AT IS NULL AND EMAIL = " . $this->db->escape( $email ) );
        return $this->getUser($email);
    }

    public function patchPassword($email,$passwordHash){
        $query   = $this->db->query(
            "UPDATE  " . 
            " TBLUSER" .
            " SET PASSWORD = " . $this->db->escape( $passwordHash ) . 
           // " , UPDATED_AT = CURRENT_TIMESTAMP() ". 
            " WHERE DELETED_AT IS NULL AND EMAIL = " . $this->db->escape( $email ) );
        return $this->getUser($email);
    }

    public function userExists($userId, $userEmail){
        $sql = "SELECT TBLUSER.* " . 
        " FROM TBLUSER" .
        " WHERE EMAIL = " . $this->db->escape($userEmail) .
        " AND DELETED_AT IS NULL " . 
        " AND ID = " . $userId;
        $query = $this->db->query($sql);
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

    public function getUserByToken($token){
        $sql = "SELECT TBLUSERTOKEN.*, TBLUSER.* " . 
            " FROM TBLUSERTOKEN" .
            " LEFT OUTER JOIN TBLUSER ON TBLUSER.ID = TBLUSERTOKEN.USER_ID " .
            " WHERE TBLUSERTOKEN.TOKEN = " . $this->db->escape($token); 
        $query = $this->db->query($sql);
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

}
<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\TokenObjModel;

class TokenModel extends Model 
{
    protected $table      = 'TBLUSERTOKEN';
    protected $primaryKey = 'ID';
    protected $returnType = 'array';
    protected $allowedFields = ['ID', 
            'TOKEN', 
            'USER_ID', 
            'REVOKED',
            'CLIENT_ID', 
            'REFRESH_TOKEN', 
            'EXPIRES_AT_DATE'];

    public function __construct(){       
        
        parent::__construct();
        $this->db = \Config\Database::connect('radapi');

    }

    public function saveToken(TokenObjModel $token ): void {
        $sql = "INSERT INTO TBLUSERTOKEN (" . 
            'ID,
                TOKEN,
                REVOKED,
                USER_ID,
                CLIENT_ID,
                REFRESH_TOKEN,
                EXPIRES_AT_DATE
            ) VALUES ('.
                $this->db->escape(0).", ".
                $this->db->escape($token->getToken()).", ".
                $this->db->escape(0).", ".
                $this->db->escape($token->getUserId()).", " .
                $this->db->escape(0).", " .
                $this->db->escape($token->getRefresh_token()).", " . 
                $this->db->escape($token->getExpired_at_date())." ) ";
         $this->db->query($sql);
    }

    public function isValidOrNotFound(TokenObjModel $tokenObj){
        $dataToken = $this->getDataFromToken($tokenObj->getToken());
        if (isset($dataToken))
        {         
            foreach ($dataToken as $row){
                // TODO: Real validation from data here
                // Valid? true
                return true;
                if ( $row->EXPIRES_AT_DATE >= date('d-m-Y') ) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        else
        {
            return true;
        }
    }

    public function isValid(TokenObjModel $tokenObj){
        $dataToken = $this->getDataFromToken($tokenObj->getToken());
        if (isset($dataToken))
        {         
            foreach ($dataToken as $row){
                // TODO: Real validation from data here
                // Valid? true
                return true;
                if ( $row->EXPIRES_AT_DATE >= date('d-m-Y') ) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        else
        {
            return false;
        }
    }

    public function exists(TokenObjModel $tokenObj){
        $dataToken = $this->getDataFromToken($tokenObj->getToken());
        if (isset($dataToken))
        {         
            foreach ($dataToken as $row){
                return true;
            }
        }
        return false;
    }

    public function verifyRefreshToken(string $refreshToken): bool
    {
        $statement = $this->pdo
            ->prepare('SELECT
                    ID
                FROM TBLUSERTOKEN
                WHERE REVOKED < 1
                 AND REFRESH_TOKEN = :refresh_token;
            ');
        $statement->bindParam('refresh_token', $refreshToken);
        $statement->execute();
        $tokens = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return count($tokens) === 0 ? false : true;
    }

    public function revokeRefreshToken(string $refreshToken): bool
    {
        $statement = $this->pdo
            ->prepare('UPDATE 
                TBLUSERTOKEN
                SET REVOKED = 1
                WHERE REFRESH_TOKEN = :refresh_token;
            ');
        $statement->bindParam('refresh_token', $refreshToken);
        $statement->execute();
        return true;        
    }

    public function getDataFromToken(string $token): array {
        $data = $this->db->query(
             'SELECT TUT.*, TUSER.*, TBLSTAFF.* ' . 
               ' FROM TBLUSERTOKEN TUT ' . 
               ' LEFT OUTER JOIN TBLUSER TUSER ON TUT.USER_ID = TUSER.ID ' .
               ' LEFT OUTER JOIN TBLSTAFF ON TBLSTAFF.STAFFID = TUSER.STAFFID ' . 
               ' WHERE TUT.TOKEN = ?', $token );
        //$tokenData = $statement->fetchAll(\PDO::FETCH_ASSOC);                   
        return $data->getResult();
    }

    public function getUserIdFromToken(string $token): int {
        $statement = $this->pdo->
             prepare('SELECT TUT.USER_ID, TBLSTAFF.STAFFID ' . 
               ' FROM TBLUSERTOKEN TUT ' . 
               ' LEFT OUTER JOIN TBLUSER TUSER ON TUT.USER_ID = TUSER.ID ' .
               ' LEFT OUTER JOIN TBLSTAFF ON TBLSTAFF.STAFFID = TUSER.STAFFID ' . 
               ' WHERE TUT.TOKEN = :t' );
        $statement->bindParam('t', $token);
        $statement->execute();
        $tokenData = $statement->fetchAll(\PDO::FETCH_ASSOC);                   
        foreach( $tokenData as $item){            
            if ($item['STAFFID']!=null){
                return $item['STAFFID'];
            }
        }
        return 0;
    }

}


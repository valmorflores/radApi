<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientsModel extends Model
{

    protected $table      = 'TBLCLIENTS';
    protected $primaryKey = 'ID';
    protected $returnType = 'array';

    public function __consttruct() {       
    }

    public function getAll(){
        $query   = $this->db->query('SELECT * FROM TBLCLIENTS');
        $results = $query->getResult();
        return $results;
      // return $this->ClientsModel->find($userName);
    }


    public function getByUsername($userName){
        $query   = $this->db->query('SELECT * FROM DBASGU.USUARIOS WHERE NM_USUARIO LIKE ' . "'VALMOR%'");
        $results = $query->getResult();
        return $results;
      // return $this->ClientsModel->find($userName);
    }

    public function findByUsername($userName){
        return $this->find($userName);
    }

    public function search($data){
        $palavras = explode( ' ', $data['ds_nome'] . ' ' . ' ' . ' ' );
        $palavra1 = $palavras[0];
        $palavra2 = $palavras[1];
        $palavra3 = $palavras[2];
        $query = $this->db->query('SELECT * FROM DBASGU.USUARIOS ' . 
         ' WHERE NM_USUARIO LIKE ' .  $this->db->escape($data['ds_nome'] . '%') .
         ' OR CD_USUARIO = ' .  $this->db->escape(trim(substr($data['ds_nome'],0,30))) .
         ' OR NM_USUARIO LIKE ' .  $this->db->escape( '%' . $data['ds_nome'] . '%') .
         ' OR NM_USUARIO LIKE ' .  $this->db->escape( '%' . $data['ds_nome'] ) .
         ' OR NM_USUARIO = ' .  $this->db->escape( $data['ds_nome'] ) .
         ' OR ( NM_USUARIO LIKE '.  $this->db->escape( $palavra1 . '%' ) . 
              ' AND NM_USUARIO LIKE ' . $this->db->escape( '%' . $palavra2 . '%' ) . 
              ' AND NM_USUARIO LIKE ' . $this->db->escape( '%' . $palavra3 . '%' ) . ' )'
        );
        $results = $query->getResult();
        return $results;
    }

}
<?php

namespace App\Models;

use CodeIgniter\Model;

class TableDataModel extends Model
{
 
    public function getFromTable($table, $offset = 0, $limit = 0){
        $builder = $this->db->table($table);
        if ( ($offset + $limit ) == 0 ) {
            $query = $builder->get();//$this->db->query('SELECT * FROM ' . $table);        
        } else {
            $query = $builder->get($limit,$offset);
        }        
        $results = $query->getResult();
        return $results;
    }

    public function getFromTableBy($table, $field, $information){
        $builder = $this->db->table($table);
        $builder->where(array($field => $information));
        $query = $builder->get();        
        $results = $query->getResult();
        return $results;
    }

    public function getFromQuery($query){
        $query   = $this->db->query($query);
        $results = $query->getResult();
        return $results;
    }

    public function postToTable($table,$data){
        $sql = 'INSERT INTO ' . $table . ' ( ';
        $separator = '';
        $fields = '';
        foreach( $data as $key => $row ) {
            if ( strpos( $fields, $key . ' ') <= 0 ) {
                $fields = $fields . $separator . $key . ' ';
                $separator = ',';
            }
        }
        $separator = '';
        $values = '';
        foreach( $data as $key => $row ) {
            $values = $values . $separator . $this->db->escape( $row );
            $separator = ',';
        }
        $sql = $sql . $fields . ') VALUES (' . $values . ')';
        $query   = $this->db->query($sql);
        //var_dump($sql);die;
        return true; 
     }

}
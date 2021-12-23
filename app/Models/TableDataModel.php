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

}
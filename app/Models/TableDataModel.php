<?php

namespace App\Models;

use CodeIgniter\Model;

class TableDataModel extends Model
{
 
    protected $allowedFields;

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

    /**
     * postToTable : insert information into database
     * @param table name of table
     * @param data  information array ['fieldname'=>'data','fieldname2'=>'data2']
     */
    public function postToTable($table,$data){
        $sql = 'INSERT INTO ' . $table . ' ( ';
        $separator = '';
        $fields = '';
        foreach( $data as $key => $row ) {
            if ( strpos( $fields, $key . ' ') <= 0 ) {
                $this->allowedFields[] = $row;
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

}
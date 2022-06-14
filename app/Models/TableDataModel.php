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
    public function deleterecords($table, $field, $id){
        $builder = $this->db->table($table);
        $builder->where($field, $id);
        $builder->delete();
        return true;
    /**
     * postToTable : insert information into database
     * @param table name of table
     * @param data  information array ['fieldname'=>'data','fieldname2'=>'data2']
     */
    public function postToTable($table, $data, $autoinc = ''){
        // if autoinc, use this and get last record +1
        if ($autoinc!=''){
            $data[$autoinc] = $this->get_next_id($table, $autoinc);
        }
        $sql = 'INSERT INTO ' . $table . ' ( ';
        $separator = '';
        $fields = '';
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
	public function PutInTable($table, $data, $keyid){
       
               $sql = 'UPDATE ' . $table . ' SET ';
        $separator = '';

        foreach( $data as $key => $row ) {
                $sql = $sql .$separator .' '. $key . ' = "'. $row.'" ';
                $separator = ',';
        }

        $sql = $sql . 'WHERE '.$keyidname.' = '.$keyid;

        $query   = $this->db->query($sql);
        return true;
    }

    /* 
    * get_next_id
    *
    */
    private function get_next_id($table, $field){
        $sql = 'SELECT MAX( ' . $field . ' )+1 AS ' . $field . ' FROM ' . $table;
        $query = $this->db->query($sql);
        $results = $query->getResult();
        foreach($results as $row){
            return $row->$field;
        }
        return 1;
    }

}
<?php

namespace App\Models;

use CodeIgniter\Model;

class ProcessModel extends Model
{
 
    protected $allowedFields;

	public function postProcessExecute($name, $information){        
        $builder = $this->db->table('TBLPREPROC');
        $builder->where(array('name' => $name));
        $query = $builder->get();
        $results = $query->getResult();
        $sql = $results[0]->SCRIPT_SQL;
        $sql = str_replace("\r\n", " ", $sql);
        $parameters = $results[0]->PARAMETERS;
        $data = [];
        // Transform information parameters using
        // codeigniter syntax :field:
        if (strpos($information, '=')>0){            
            $information_array=explode('&', $information);
            foreach($information_array as $row){
                $key = substr($row, 0, strpos($row, '='));
                $value = substr($row, strpos($row, '=')+1);
                $data[$key] = $value;
                $sql = str_replace( ":" . $key .":", $value, $sql);
            }
        }
        $data = (object) $data;
        $query = $this->db->query($sql,$data);
        return $query;
    }

}
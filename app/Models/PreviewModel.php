<?php

namespace App\Models;

use CodeIgniter\Model;

class PreviewModel extends Model
{
 
    protected $allowedFields;

	public function getPreviewExecute($information,$parameters=null){
        $builder = $this->db->table('TBLPREVIEW');
        $builder->where(array('name' => $information));
        $query = $builder->get();
        $results = $query->getResult();
        $sql = $results[0]->SCRIPT_SQL;
        if ($parameters==null) {
            $query = $this->db->query($sql);
            $results = $query->getResult();
            return $results;
        }
        else
        {
            $data = [];
            $parameters = $parameters . '&';
            if (strpos($parameters, '=')>0){            
                $information_array=explode('&', $parameters);
                foreach($information_array as $row){
                    $key = substr($row, 0, strpos($row, '='));
                    $value = substr($row, strpos($row, '=')+1);
                    $data[$key] = $value;
                    $sql = str_replace( ":" . $key .":", $value, $sql);
                }
            }            
            //var_dump($sql);die;
            $data = (object) $data;
            $query = $this->db->query($sql);
            return $query->getResult();
        }
    }
}

?>
<?php

namespace App\Models;

use CodeIgniter\Model;

class ProcessModel extends Model
{
 
    protected $allowedFields;

	public function getPreviewExecute($information){
        $builder = $this->db->table('TBLPREVIEW');
        $builder->where(array('name' => $information));
        $query = $builder->get();
        $results = $query->getResult();
        $sql = $results[0]->SCRIPT_SQL;
        $query = $this->db->query($sql);
        $results = $query->getResult();
        return $results;

    }
}

?>
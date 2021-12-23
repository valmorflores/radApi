<?php 

namespace App\Controllers;
use App\Models\ClientsModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class TablesKeys extends ResourceController
{
    use ResponseTrait;
    
    private $session;
   
    // Create a shared instance of the model
    public function __construct()
    {
        $this->ClientsModel = new ClientsModel();
        $this->session = session();
    }

    // keys
    public function list($table = null) {        
        $db2 = \Config\Database::connect('default');
        $columns = $db2->getFieldData($table);
        $table_name = !empty($table) ? $table : 'STORES';
        $indexes = $db2->getIndexData($table_name);            
        $list=[];
        foreach ($indexes as $row)
        {
            $info = array(
                    'name',trim($row->RELATION_NAME),
                    'index_name' => trim($row->INDEX_NAME),
                    'index_id' => trim($row->INDEX_ID),
                    'foreign_key' => trim($row->FOREIGN_KEY)
            );
            $list[]=$info;
        }
        $data = [];
        
        $data = $list;
        $resp = $data;
        $response = [
            'parameter_table_name' => $table_name,
            'status'   => 200,
            'error'    => null,
            'data'     => $resp,
            'messages' => [
                'success' => 'Keys from table'
                ]
            ];
        return $this->respond($response);
    }

}
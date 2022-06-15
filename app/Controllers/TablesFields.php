<?php 

namespace App\Controllers;
use App\Models\ClientsModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class TablesFields extends ResourceController
{
    use ResponseTrait;
    
    private $session;

    // Lista todos clients
    public function index()
    {
        $model = new ClientsModel();
        $data = $model->findAll();
        return $this->respond($data);
    }
    
    // Create a shared instance of the model
    public function __construct()
    {
        $this->ClientsModel = new ClientsModel();
        $this->session = session();
    }

    // Colunas da tabela
    public function fields($table = null) {        
        $info = new BaseController();
        $loadResult = $info->loadAuthorization($this->request);
        if (isset($loadResult['error_status'])){
            // Error from load (unknow authorization data)
            return $this->respond($loadResult);
        }
        else
        {

            $db2 = \Config\Database::connect('default');
            $table_name = !empty($table) ? $table : 'TBLCLIENTS';
            $columns = $db2->getFieldData($table_name);
            $tables = [];
            $finalcolumns = [];
            foreach ($columns as $col)
            {                
                $info = array('name' => trim($col->name),
                        'type' => trim($col->type),
                        'size' => $col->max_length,
                        'default' => $col->default);
                $finalcolumns[]=$info;
            }          
            $data = [];
            
            $data = $finalcolumns;
            $resp = $data;
            $response = [
                'parameter_table_name' => $table_name,
                'status'   => 200,
                'error'    => null,
                'data'     => $resp,
                'messages' => [
                    'success' => 'Structure from table'
                    ]
                ];
            return $this->respond($response);
        }
    }

    // firldNames from table
    public function fieldNames($table = null) {
        $info = new BaseController();
        $loadResult = $info->loadAuthorization($this->request);
        if (isset($loadResult['error_status'])){
            // Error from load (unknow authorization data)
            return $this->respond($loadResult);
        }
        else
        {
            
            $db2 = \Config\Database::connect('default');
            $table_name = !empty($table) ? $table : 'TBLCLIENTS';
            $columns = $db2->getFieldData($table_name);
            $tables = [];
            $finalcolumns = [];
            foreach ($columns as $col)
            {
                $info = trim($col->name);
                $finalcolumns[]=$info;
            }          
            $data = [];
            $data = $finalcolumns;
            $resp = $data;
            $response = [
                'parameter_table_name' => $table_name,
                'status'   => 200,
                'error'    => null,
                'data'     => $resp,
                'messages' => [
                    'success' => 'Field names list'
                    ]
                ];
            return $this->respond($response);
        }
    }

}
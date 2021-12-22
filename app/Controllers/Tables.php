<?php 

namespace App\Controllers;
use App\Models\ClientsModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Tables extends ResourceController
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
    public function columns($table = null) {        
        $db2 = \Config\Database::connect('default');
        $table_name = !empty($table) ? $table : 'TBLCLIENTS';
        $columns = $db2->_fieldData($table_name);
        $tables = [];
        $finalcolumns = [];
        foreach ($columns as $col)
        {
            $info = array('name' => trim($col->name),
                    'type' => trim($col->type),
                    'size' => trim($col->max_length),
                    'default' => trim($col->default));
            $finalcolumns[]=$info;
        }          
        $data = [];
        
        $data = $finalcolumns;
        $resp = $data;
        $response = [
            'table_name' => $table_name,
            'status'   => 200,
            'error'    => null,
            'data'     => $resp,
            'messages' => [
                'success' => 'Dados'
                ]
            ];
        return $this->respond($response);
    }


 }
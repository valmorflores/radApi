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
 
    public function tableList() {
        $db2 = \Config\Database::connect('default');
        $tables = $db2->listTables();
        return $tables;
    }

    // List of tables
    public function list() {
        $tables = $this->tableList();
        $finalcolumns = [];
        foreach ($tables as $row)
        {
            $finalcolumns[]=trim($row);
        }          
        $data = [];
        $data = $finalcolumns;
        $resp = $data;
        $response = [
            'status'   => 200,
            'error'    => null,
            'data'     => $resp,
            'messages' => [
                'success' => 'List of tables'
                ]
            ];
        return $this->respond($response);
    }

    // Search in tables list
    public function search($table = null) {        
        $tables = $this->tableList();
        //var_dump($tables);die;
        $finallist = [];
        foreach ($tables as $row)
        {            
            if (strpos( $row, $table )!==false) {
                $finallist[] = trim($row);
            }
        }          
        $data = [];        
        $data = $finallist;
        $resp = $data;        
        $response = [
            'parameter_partial_table_name' => $table,
            'status'   => 200,
            'error'    => null,
            'data'     => $resp,
            'messages' => [
                'success' => 'Search in tables with information'
                ]
            ];
        return $this->respond($response);
    }
}
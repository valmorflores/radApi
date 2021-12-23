<?php 

namespace App\Controllers;
use App\Models\ClientsModel;
use App\Models\TableDataModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class TablesData extends ResourceController
{
    use ResponseTrait;
    
    private $session;
   
    // Create a shared instance of the model
    public function __construct()
    {        
        $this->ClientsModel = new ClientsModel();
        $this->TableDataModel = new TableDataModel();
        $this->session = session();   
    }

    // getData
    public function getdata($table = null, $offset, $records) {        
        $dataSet = $this->TableDataModel->getFromTable($table, $offset, $records);
        $list=[];
        
        foreach ($dataSet as $row)
        {
            $info = $row;
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

    // getDataBy like: $path/v1/tables/data-by/TBLOPTIONS/ID/84
    public function getdataby($table = null, $field, $information) {
        $dataSet = $this->TableDataModel->getFromTableBy($table, $field, $information);
        $list=[];
        
        foreach ($dataSet as $row)
        {
            $info = $row;
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
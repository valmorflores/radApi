<?php 

namespace App\Controllers;
use App\Models\ClientsModel;
use App\Models\TableDataModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

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

    // getData $path/v1/tables/data/TBLOPTIONS
    public function getdata($table = null, $offset, $records) {

        $info = new BaseController();
        $loadResult = $info->loadAuthorization($this->request);
        if (isset($loadResult['error_status'])){
            // Error from load (unknow authorization data)
            return $this->respond($loadResult);
        }
        else
        {
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
                'parameter_table_name' => $table,
                'parameter_offset' => $offset,
                'parameter_records' => $records,
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

    // getDataBy like: $path/v1/tables/data-by/TBLOPTIONS/ID/84
    public function getdataby($table = null, $field, $information) {
        $info = new BaseController();
        $loadResult = $info->loadAuthorization($this->request);
        if (isset($loadResult['error_status'])){
            // Error from load (unknow authorization data)
            return $loadResult;
        }
        else
        {

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
                'parameter_table_name' => $table,
                'parameter_field' => $field,
                'parameter_data' => $information,
                'status'   => 200,
                'error'    => null,
                'data'     => $resp,
                'messages' => [
                    'success' => 'Data from table record by key field'
                    ]
                ];
            return $this->respond($response);
        }
    }

}
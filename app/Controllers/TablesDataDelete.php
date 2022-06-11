<?php

namespace App\Controllers;
use App\Models\ClientsModel;
use App\Models\TableDataModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class TablesDataDelete extends ResourceController
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
    public function deletedata($table = null , $field, $id)
    {
    $info = new BaseController();
    $loadResult = $info->loadAuthorization($this->request);
        if (isset($loadResult['error_status'])){
            // Error from load (unknow authorization data)
            return $loadResult;
        }
        else
        {
        
            $dataSet = $this->TableDataModel->deleterecords($table, $field, $id);
            $list=[];
         //   foreach ($dataSet as $row)
          //  {
            //    $info = $row;
              //  $list[]=$info;
           // }
            $data = [];
            $data = $list;
            $resp = $data;
            $response = [
                'parameter_table_name' => $table,
                'parameter_field' => $field,
                'parameter_data' => $id,
                'status'   => 200,
                'error'    => null,
                'data'     => $resp,
                'messages' => [
                    'success' => 'Data deleted'
                    ]
                ];
            return $this->respond($response);
        }
    }
}

?>
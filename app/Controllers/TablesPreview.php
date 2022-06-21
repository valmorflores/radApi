<?php

namespace App\Controllers;
use App\Models\ClientsModel;
use App\Models\TableDataModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class TablesPreview extends ResourceController
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


     public function getpreview($table = null, $information) {
        $info = new BaseController();
        $loadResult = $info->loadAuthorization($this->request);
        if (isset($loadResult['error_status'])){
            // Error from load (unknow authorization data)
            return $loadResult;
        }
        else
        {

            $dataSet = $this->TableDataModel->getPreviewExecute($table, $information);
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
              //  'parameter_field' => $field,
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

?>
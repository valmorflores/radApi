<?php

namespace App\Controllers;
use App\Models\PreviewModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class Preview extends ResourceController
{
    use ResponseTrait;

    private $session;

    // Create a shared instance of the model
    public function __construct()
    {
        $this->PreviewModel = new PreviewModel();
        $this->session = session();
    }



     

     public function getpreview($information) {

        $info = new BaseController();
        $loadResult = $info->loadAuthorization($this->request);
        if (isset($loadResult['error_status'])){
            // Error from load (unknow authorization data)
            return $loadResult;
        }
        else
        {

            $dataSet = $this->PreviewModel->getPreviewExecute($information);
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
              //  'parameter_table_name' => $table,
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
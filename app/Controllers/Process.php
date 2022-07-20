<?php

namespace App\Controllers;
use App\Models\ProcessModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class Process extends ResourceController
{
    use ResponseTrait;

    private $session;

    // Create a shared instance of the model
    public function __construct()
    {
        $this->ProcessModel = new ProcessModel();
        $this->session = session();
    }

    public function postprocess($table = null, $information = '') {
        $info = new BaseController();
        $loadResult = $info->loadAuthorization($this->request);
        try {
            if (isset($loadResult['error_status'])){
                return $this->respond($loadResult,403);
            }
            else
            {
                $dataSet = $this->ProcessModel->postProcessExecute($table, $information);
                $list=[];            
                $data = [];
                $data = $list;
                $resp = $dataSet;
                $response = [
                    'parameter_process_name' => $table,
                //  'parameter_field' => $field,
                    'parameter_data' => $information,
                    'status'   => 200,
                    'error'    => null,
                    'data'     => $resp,
                    'messages' => [
                        'success' => 'Process data information'
                        ]
                    ];
                return $this->respond($response);
            }
        } catch (\Exception $ex) {
            $resp = [];
            $response = [
                'parameter_data' => $information,
                'status'   => 500,
                'error'    => 1,
                'data'     => [],
                'messages' => [
                    'success' => 'Unknow internal error: ' . $ex->getMessage()
                    ]
                ];
            return $this->respond($response,500);
        }
    }
}

?>
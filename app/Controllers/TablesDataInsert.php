<?php 

namespace App\Controllers;
use App\Models\ClientsModel;
use App\Models\TableDataModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class TablesDataInsert extends ResourceController
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

    // postData [POST] $path/v1/tables/data/TBLSTAFF
    public function postdata($table = null) {

        $info = new BaseController();
        $loadResult = $info->loadAuthorization($this->request);
        if (isset($loadResult['error_status'])){
            // Error from load (unknow authorization data)
            return $this->respond($loadResult);
        }
        else
        {
            $dataFields = [ 'ROLEID' => 3,
                       'NAME' => 'Support group' ];

            $dataSet = $this->TableDataModel->postToTable($table, $dataFields);
            $list=[];
            
            /*foreach ($dataSet as $row)
            {
                $info = $row;
                $list[]=$info;
            }*/
            $data = [];
            $data = $list;
            $resp = $data;
            $response = [
                'parameter_table_name' => $table,
                'status'   => 200,
                'error'    => null,
                'data'     => $dataFields,
                'messages' => [
                    'success' => 'Saved data!'
                    ]
                ];
            return $this->respond($response);
        }
    }

}
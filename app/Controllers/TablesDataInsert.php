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
            $dataTableColumns = $this->getFields($table);
            $dataFields = [];
            foreach ($dataTableColumns as $row) {
                $dataFields[] = $row['name'];
            }
            
            
            // List for fields (NAME=>'Name',ID=1,...)
            $dataFieldsAndInfo = [];
            foreach ($dataFields as $row) {
                $key = $row;
                $dataFieldsAndInfo[ $key ] = $this->request->getVar($row) ?? '' ;
            }
            
            //Autoinc field (use get_next_id)
            $autoinc = $this->request->getVar('autoinc') ?? '';

            $dataSet = $this->TableDataModel->postToTable($table, $dataFieldsAndInfo, $autoinc);
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
                'incremental' => $autoinc,
                'data'     => $dataFieldsAndInfo,
                'messages' => [
                    'success' => 'Saved data!'
                    ]
                ];
            return $this->respond($response);
        }
    }

    private function getFields($table_name){
        $db2 = \Config\Database::connect('default');
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
        return $finalcolumns;
    }

}
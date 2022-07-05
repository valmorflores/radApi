<?php

namespace App\Controllers;
use App\Models\ClientsModel;
use App\Models\TableDataModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class TablesDataUpdate extends ResourceController
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
    public function updatedata($table = null){
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
				$dataFieldsAndInfo = array_filter($dataFieldsAndInfo);
            }
            
            $keyidname = $this->request->getVar('key') ?? '';
            $keyid = $this->request->getVar('ID') ?? '';

            $dataSet = $this->TableDataModel->PutInTable($table, $dataFieldsAndInfo, $keyid, $keyidname);
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
          //      'incremental' => $id,
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

?>
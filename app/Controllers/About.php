<?php

namespace App\Controllers;
use App\Models\ClientsModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class About extends ResourceController
{
    use ResponseTrait;
    
    private $session;

    public function __construct()
    {
        $this->session = session();
        helper('profile');
    }

    public function version(){        
        return $this->changelog()[1]['version'];
    }

    public function changelog(){
        $changelog = [];
        $changelog[] = ['title'=>'Maio/2022'];
        $changelog[] = ['version'=>'v1.0.02', 'module'=>'Post', 'description'=>'Suporte para post em tabela, via comando URL similar a este: [POST] /radApi/public/v1/tables/data/TBLROLES?autoinc=ROLEID&NAME=item2'];
        $changelog[] = ['version'=>'v1.0.01', 'module'=>'Get', 'description'=>'Selecionar dados de uma tabela: [GET] /radApi/public/v1/tables/data/TBLROLES'];
        $changelog[] = ['version'=>'v1.0.00', 'module'=>'Lançamento', 'description'=>'Inicio do log sobre a ferramenta radApi'];
        return $changelog;
    }

    public function apptitle(){
        return 'Sistema de administração de dados via Api RESTful';
    }
    
    public function appname(){
        return 'radApi';
    }

    public function people(){
        $people = [];
        $people[] = [
            'id' => 0,
            'area' => 'Analista de Projetos', 
            'function' => 'Projeto e desenvolvimento', 
            'name' => 'Valmor Pereira Flores'
        ]; 
        return $people;
    }

    public function index()
    {
        $data['app'] = $this->appname();
        $data['version'] = $this->version();
        $data['title'] = $this->apptitle();
        $data['people'] = $this->people();
        $data['changelog'] = $this->changelog();
        $data['resource'] = '/about';
        $response= $data;
        return $this->respond($response);
    }

}

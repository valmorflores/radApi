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
        return $this->changelog()[1][0];
    }

    public function changelog(){
        $changelog = [];
        $changelog[] = ['', 'Maio/2022', ''];
        $changelog[] = ['v1.0.00', 'Lançamento', 'Inicio do log sobre a ferramenta radApi'];
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
        $people[] = [0,'Analista de Projetos', 'Projeto e desenvolvimento', 'Valmor Pereira Flores'];        
        return $people;
    }

    public function index()
    {
        $data['appname'] = $this->appname();
        $data['apptitle'] = $this->apptitle();
        $data['people'] = $this->people();
        $data['version'] = $this->version();
        $data['changelog'] = $this->changelog();
        $data['resource'] = '/about';
        $response= $data;
        return $this->respond($response);
    }

}

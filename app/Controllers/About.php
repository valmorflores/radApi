<?php

namespace App\Controllers;
use App\Models\ClientsModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Controllers\Tables;

class About extends ResourceController
{
    use ResponseTrait;
    
    private $session;

    private $defaultDb;

    private $radApiDb;

    private $tables;

    public function __construct()
    {
        $this->defaultDb = db_connect(); // default database group
        $this->radApiDb = db_connect("radapi"); // other database group
        $this->session = session();
        $this->tables = new Tables();
        helper('profile');
    }

    public function version(){        
        return $this->changelog()[1]['version'];
    }

    public function changelog(){
        $url = base_url();
        $changelog = [];
        $changelog[] = ['title'=>'Julho/2022'];
        $changelog[] = ['version'=>'v1.0.08', 'module'=>'Global', 'description'=>'One database (radapi application and other to do target managing)'];
        $changelog[] = ['version'=>'v1.0.07', 'module'=>'User', 'description'=>'Get user data from token [GET] '.$url.'/user/by-token/{token}'];
        $changelog[] = ['title'=>'Junho/2022'];
        $changelog[] = ['version'=>'v1.0.06', 'module'=>'Password', 'description'=>'Change password endpoint [PATCH] '.$url.'/user/password?email=valmorflores@gmail.com&password=123'];
        $changelog[] = ['version'=>'v1.0.05', 'module'=>'Activation', 'description'=>'Get activation link from e-mail [GET] '.$url.'/activation/link?APP_KEY=0123&email=valmorflores@gmail.com'];
        $changelog[] = ['version'=>'v1.0.04', 'module'=>'Users', 'description'=>'Add user endpoint'];
        $changelog[] = ['version'=>'v1.0.03', 'module'=>'Password', 'description'=>'Suporte para senhas em Php sem Argon2i'];
        $changelog[] = ['title'=>'Maio/2022'];
        $changelog[] = ['version'=>'v1.0.02', 'module'=>'Post', 'description'=>'Suporte para post em tabela, via comando URL similar a este: [POST] /radApi/public/v1/tables/data/TBLROLES?autoinc=ROLEID&NAME=item2'];
        $changelog[] = ['version'=>'v1.0.01', 'module'=>'Get', 'description'=>'Selecionar dados de uma tabela: [GET] /radApi/public/v1/tables/data/TBLROLES'];
        $changelog[] = ['version'=>'v1.0.00', 'module'=>'Lan??amento', 'description'=>'Inicio do log sobre a ferramenta radApi'];
        return $changelog;
    }

    public function apptitle(){
        return 'Sistema de administra????o de dados via Api RESTful';
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
            'name' => 'Valmor Pereira Flores',
            
        ]; 
        $people[] = [
            'id' => 1,
            'area' => 'Desenvolvedor', 
            'function' => 'Projeto e desenvolvimento', 
            'name' => 'Marlei Rafael'
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
        $data['table_list'] = $this->tables->internaltablelist(getenv('APP_KEY'));
        $password = '0';
        if(defined('PASSWORD_ARGON2ID')) {
            $data['pwd_argon'] = password_hash( $password, PASSWORD_ARGON2I );
        } 
        $data['pwd_default'] = password_hash( $password, PASSWORD_DEFAULT, 
              array('time_cost' => 10, 'memory_cost' => '2048k', 'threads' => 6) );        
        $response= $data;
        return $this->respond($response);
    }

}

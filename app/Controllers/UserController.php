<?php 

namespace App\Controllers;

use App\Models\ClientsModel;
use App\Models\UserModel;

class UserController extends BaseController {

    public function login() {
        $this->UserModel = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $dataInfo = $this->request->getBody();
        $this->UserModel->getLogin($email,$password);
        //var_dump($this->request);
        //var_dump($email);
        //var_dump($password);
        
        var_dump($dataInfo);
        die;
    }

}

<?php 

namespace App\Controllers;

use App\Models\ClientsModel;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class UserController extends ResourceController {    

    use ResponseTrait;

    /*
    *
    * Example: http://localhost:89/dev/radApi/public/v1/
    *              user/login?email=usuarioexemplo@gmail.com&password=123
    */
    public function login() {
        $this->UserModel = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $resp = $this->UserModel->getLogin($email,$password);        
        $response = [
            'status'   => 200,
            'error'    => null,
            'data'     => $resp,
            'messages' => [
                'success' => 'Login',
                'email' => $email,
                'password' => password_hash( $password, PASSWORD_ARGON2I )
                ]
            ];
        return $this->respond($response);
    }

}

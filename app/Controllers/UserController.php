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
        // Stage 1 - User validation
        $resp = $this->UserModel->getLogin($email,$password);
        if (count($resp)<1){
            $responseCode = 404;
            $response = [
                'status'   => $responseCode,
                'token'    => '',
                'verify'   => false,
                'error'    => 'Unknow user records',
                'data'     => [],
                'messages' => []
                ];
            return $this->respond($response,$responseCode);
        }
        // Stage 2 - Password validation
        $passwordFromRequest = password_hash( $password, PASSWORD_ARGON2I );
        $passwordFromBase = $resp[0]->PASSWORD ?? '';
        $verifyOk = password_verify( $password, $passwordFromBase);
        $responseCode = 200;
        if ($verifyOk) {
            // Build or get token
            $token = substr( strtoupper( password_hash( $password, PASSWORD_ARGON2I ) ), 29 );
            $responseCode = 200;
            $response = [
                'status'   => $responseCode,
                'token' => $token,
                'verify'   => $verifyOk,
                'from_base' => $passwordFromBase,
                'from_request' => $passwordFromRequest,
                'error'    => null,
                'data'     => $resp,
                'messages' => [
                    'success' => 'Login',
                    'email' => $email,
                    'password' => $passwordFromRequest
                    ]
                ];
        } else {
            $responseCode = 403;
            $response = [
                'status'   => $responseCode,
                'token'    => '',
                'verify'   => $verifyOk,
                'error'    => 'Invalid password information',
                'data'     => [],
                'messages' => []
                ];
        }
        return $this->respond($response,$responseCode);
    }

}

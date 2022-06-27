<?php 

namespace App\Controllers;

use App\Models\ClientsModel;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use Exception;
use \Firebase\JWT\JWT;
use App\Models\TokenObjModel;
use App\Models\TokenModel;

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
        if(defined('PASSWORD_ARGON2ID')) {
            $passwordFromRequest = password_hash( $password, PASSWORD_ARGON2I );
        } else {
            $passwordFromRequest = password_hash( $password, PASSWORD_DEFAULT, 
                 array('time_cost' => 10, 'memory_cost' => '2048k', 'threads' => 6) );
        }
        $passwordFromBase = $resp[0]->PASSWORD ?? '';
        $verifyOk = password_verify( $password, $passwordFromBase);
        $responseCode = 200;
        if ($verifyOk) {
            $token = $this->getToken($resp);
            // Set tokenObj
            $tokenObj = new TokenObjModel();
            $tokenObj->setId(0);
            $tokenObj->setToken($token);
            $tokenObj->setUserId($resp[0]->STAFFID ?? 0);
            $tokenObj->setRefresh_token($token);
            $tokenObj->setExpired_at('06-15-2022');
            $this->TokenModel = new TokenModel();
            $this->TokenModel->saveToken( $tokenObj );
            // Build or get token
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

    function postAddUser() {
        // only authrized
        $info = new BaseController();
        $loadResult = $info->loadAuthorization($this->request);
        if (isset($loadResult['error_status'])){
            // Error from load (unknow authorization data)
            return $this->respond($loadResult);
        }
        else
        {    
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');
            $this->UserModel = new UserModel();
            if ($this->UserModel->emailExists($email)){
                $responseCode = 409;
                $response = [
                    'status'   => $responseCode,
                    'token'    => '',
                    'verify'   => false,
                    'error'    => 'Conflict, already exists user e-mail',
                    'data'     => [],
                    'messages' => []
                    ];
                return $this->respond($response,$responseCode);
            } 
            // Stage 1 - Create hash password
            $passwordHash = '';
            if(defined('PASSWORD_ARGON2ID')) {
                $passwordHash = password_hash( $password, PASSWORD_ARGON2I );
            } else {
                $passwordHash = password_hash( $password, PASSWORD_DEFAULT, 
                    array('time_cost' => 10, 'memory_cost' => '2048k', 'threads' => 6) );
            }
            $name = $this->request->getVar('name');
            $this->UserModel->postAddUserLogin($name,$email,$passwordHash);
            $resp = $this->UserModel->getUser($email);
            // Build or get token
            $responseCode = 200;
            $response = [
                'status'   => $responseCode,
                'hash'     => $passwordHash,
                'error'    => null,
                'data'     => $resp,
                'messages' => [
                    'success' => 'Login',
                    'email' => $email,
                     
                    ]
                ];
            return $this->respond($response,$responseCode);
        }        
    }

    public function deleteUser() {
        // only authrized
        $info = new BaseController();
        $loadResult = $info->loadAuthorization($this->request);
        if (isset($loadResult['error_status'])){
            // Error from load (unknow authorization data)
            return $this->respond($loadResult);
        }
        else
        {    
            $this->UserModel = new UserModel();
            $email = $this->request->getVar('email');
            $id = $this->request->getVar('id');
            if (!$this->UserModel->emailExists($email)){
                $responseCode = 404;
                $response = [
                    'status'   => $responseCode,
                    'token'    => '',
                    'verify'   => false,
                    'error'    => 'Unknow user e-mail',
                    'data'     => [],
                    'messages' => []
                    ];
                return $this->respond($response,$responseCode);
            } else {
                if (!$this->UserModel->userExists($id, $email)) { 
                    $responseCode = 404;
                    $response = [
                        'status'   => $responseCode,
                        'token'    => '',
                        'verify'   => false,
                        'error'    => 'Unknow this user e-mail with this id',
                        'data'     => [],
                        'messages' => []
                        ];
                    return $this->respond($response,$responseCode);
                } else {
                    $this->UserModel->deleteUser($id, $email);
                    $responseCode = 200;
                    $response = [
                        'status'   => $responseCode,
                        'error'    => null,
                        'data'     => ['id' => $id,
                                    'email' => $email],
                        'messages' => [
                            'success' => 'Successful delete record',                        
                            ]
                        ];
                    return $this->respond($response,$responseCode);
                }
                
            }
        }
    }

    public function getUser() {
        // only authrized
        $info = new BaseController();
        $loadResult = $info->loadAuthorization($this->request);
        if (isset($loadResult['error_status'])){
            // Error from load (unknow authorization data)
            return $this->respond($loadResult);
        }
        else
        {    
            $this->UserModel = new UserModel();
            $email = $this->request->getVar('email');
            if (!$this->UserModel->emailExists($email)){
                $responseCode = 404;
                $response = [
                    'status'   => $responseCode,
                    'email'    => $email,
                    'verify'   => false,
                    'error'    => 'Unknow user e-mail',
                    'data'     => [],
                    'messages' => []
                    ];
                return $this->respond($response,$responseCode);
            } else {
                $data = $this->UserModel->getUser($email);
                $responseCode = 200;
                $response = [
                    'status'   => $responseCode,
                    'error'    => null,
                    'data'     => $data,
                    'messages' => [
                        'success' => 'Successful get user record',
                        ]
                    ];
                return $this->respond($response,$responseCode);
            }
        }
    }
   
    public function getUserActivateLink() {
        $email = $this->request->getVar('email');
        if (!(getenv('APP_KEY'))){
           $responseCode = 403;
           $response = [
               'status'   => $responseCode,
               'email'    => $email,
               'verify'   => false,
               'error'    => 'Forbidden service, unknow APP_KEY into server setup',
               'data'     => [],
               'messages' => []
               ];
           return $this->respond($response,$responseCode);
        } else {
            $key = $this->request->getVar('APP_KEY');
            if (!isset($key)){
                $responseCode = 403;
                $response = [
                    'status'   => $responseCode,
                    'email'    => $email,
                    'verify'   => false,
                    'error'    => 'Forbidden service, need APP_KEY parameter',
                    'data'     => [],
                    'messages' => []
                    ];
                return $this->respond($response,$responseCode);
            }
            if (!($key==getenv('APP_KEY'))){
                $responseCode = 403;
                $response = [
                    'status'   => $responseCode,
                    'email'    => $email,
                    'verify'   => false,
                    'error'    => 'Forbidden service, invalid APP_KEY',
                    'data'     => [],
                    'messages' => []
                    ];
                return $this->respond($response,$responseCode);
            }
            $responseCode = 200;
            $data = [
                'email' => $email,
                'link'  => base_url() . '/user/activate/now/',
                'key'=> $key];
            $response = [
                'status'   => $responseCode,
                'error'    => null,
                'data'     => $data,
                'messages' => [
                    'success' => 'Successful get user activation link',
                    ]
                ];
            return $this->respond($response,$responseCode);
        }
    }

    private function getKey()
    {
        return "br*1234567890";
    }

    private function getToken($resp) {
        $key = $this->getKey();
        $iat = time(); // current timestamp value
        $nbf = $iat + 10;
        $exp = $iat + 3600;
        $payload = array(
            "uid" => $resp[0]->STAFFID,
            "iss" => "The_claim",
            "aud" => "The_Aud",
            "iat" => $iat, // issued at
            "nbf" => $nbf, //not before in seconds
            "exp" => $exp, // expire time in seconds
            "data" => $resp[0]->EMAIL,
        );
        // JWT generator
        $token = JWT::encode($payload, $key, 'HS256');
        return $token;    
    }


    /*
    *
    * Example: http://localhost:89/dev/radApi/public/v1/
    *              user/keylogin?email=usuarioexemplo@gmail.com&key=abcDef
    */
    public function keylogin() {
        $this->UserModel = new UserModel();
        $email = $this->request->getVar('email');
        $key = $this->request->getVar('key');
        // Stage 1 - User validation
        $resp = $this->UserModel->getLoginKey($email,$key);
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
        $passwordFromRequest = $key;
        $passwordFromBase = $resp[0]->KEYVALUE ?? '';
        $verifyOk = ($key == $passwordFromBase);
        $responseCode = 200;
        if ($verifyOk) {
            $token = $this->getToken($resp);
            // Set tokenObj
            $tokenObj = new TokenObjModel();
            $tokenObj->setId(0);
            $tokenObj->setToken($token);
            $tokenObj->setUserId($resp[0]->STAFFID ?? 0);
            $tokenObj->setRefresh_token($token);
            $tokenObj->setExpired_at('06-15-2022');
            $this->TokenModel = new TokenModel();
            $this->TokenModel->saveToken( $tokenObj );
            // Build or get token
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

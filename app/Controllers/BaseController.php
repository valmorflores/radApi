<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use Psr\Log\LoggerInterface;
use App\Models\TokenModel;
use App\Models\TokenObjModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    private $utils;
    private $staffid;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }

    public function __construct(){
        $this->staffid = null;
    }

    function loadAuthorization($request){
        $auth = new UserController();
        $data = $request->getHeaders();
        if (!isset($data['Authorization'])){
            $responseCode = 403;
            $response = [
                'status' => $responseCode,
                'token' => '',
                'error' => 'Forbidden: Authorization headers not found',
                'error_status' => 1,
                'data' => [],
                'messages' => []
                ];
            return $response;
        }
        $token = trim($data['Authorization']??'1');
        // remove bearer
        if (strpos(' ' . $token,'Bearer') > 0){
            $token = trim(substr($token,strpos(' ' . $token,'Bearer')+6));
        }
        // If authorization like app_key, authorized is true
        // Todo: change by authorized list into database
        if ( trim($token) == trim(getenv('APP_KEY') ?? '0') ){
            return true;
        }
        
        $this->TokenModel = new TokenModel();
        $resp = $this->TokenModel->getDataFromToken($token);
        $tokenObj = new TokenObjModel();
        $tokenObj->setToken($token);
        if (!($this->TokenModel->exists($tokenObj))){
            $responseCode = 404;
            $response = [
                'status' => $responseCode,
                'token' => $token,
                'error' => 'Token not found',
                'error_status' => 1,
                'data' => [],
                'messages' => []
                ];
            return $response;
        }
        if (!($this->TokenModel->isValid($tokenObj))){
            $responseCode = 403;
            $response = [
                'status' => $responseCode,
                'token' => $token,
                'error' => 'Token found, but expirated',
                'error_status' => 1,
                'data' => [],
                'messages' => []
                ];                
            return $response;
        }
        return true;
    }

    public function getStaffId(){
        return $this->staffid;
    }



}

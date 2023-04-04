<?php

namespace App\Libraries;

// created by saepulfariz 09/3/2023
// restApi library codeigniter 4

use CodeIgniter\CodeIgniter;
use CodeIgniter\RESTful\ResourceController;

class RestApi extends ResourceController
{

    private $db;
    public $request;

    // buat limit true buat on
    public $rest_enable_limits = true;
    public $methods = [];

    /*

    CREATE TABLE `limits` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `uri` VARCHAR(255) NOT NULL,
        `count` INT(10) NOT NULL,
        `hour_started` INT(11) NOT NULL,
        `api_key` VARCHAR(40) NOT NULL,
        `created_at` DATETIME NOT NULL,
        `updated_at` DATETIME NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    */

    // set nama parameter key nya
    public $rest_key_name = 'api_key';
    // buat key true buat on
    public $rest_enable_keys = true;

    /*

    CREATE TABLE `keys` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `user_id` INT(11) NOT NULL,
        `key` VARCHAR(40) NOT NULL,
        `level` INT(2) NOT NULL,
        `ignore_limits` TINYINT(1) NOT NULL DEFAULT '0',
        `is_private_key` TINYINT(1)  NOT NULL DEFAULT '0',
        `ip_addresses` TEXT NULL DEFAULT NULL,
        `created_at` DATETIME NOT NULL,
        `updated_at` DATETIME NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


    */


    public function __construct()
    {
        $this->db = db_connect();

        $this->request = \Config\Services::request();
    }

    public function getRestKey()
    {
        if ($this->rest_enable_keys == false) {
            return false;
        } else {
            return $this->rest_key_name;
        }
    }

    public function filterAuth()
    {
        // dd($this->request->getMethod());
        // dd($this->request->getUri()->getPath());
        // dd($this->request->detectPath());

        $routes = \CodeIgniter\Config\BaseService::routes();
        // d($this->request->getServer());
        // d(service('router')->controllerName());
        // d(class_basename(service('router')->controllerName()));


        // dd($routes->getRegisteredControllers());


        // d(array_key_first($routes->getRoutes()));
        // d($routes->getRoutesOptions()); // nampilkan get doank

        // d($routes->getHTTPVerb()); // get put delete
        //  GET 
        // d($routes->getRoutes());

        // dd($path = explode('/', $this->request->getPath()));

        // d($this->request->getServer()['PHP_AUTH_USER']);
        // d($this->request->getServer()['PHP_AUTH_PW']);

        // dd($this->request->getUri()->getUserInfo());
        $rq = \Config\Services::request();
        $input = $rq->getRawInput();
        $get = $rq->getVar();
        $input = array_merge($input, $get);

        $fieldApi = $this->getRestKey();

        if ($fieldApi != false) {


            if (isset($input[$fieldApi])) {

                $resKeys = $this->db->table('keys')->where('key', $input[$fieldApi])->get()->getRowArray();

                if ($resKeys) {
                    // $this->filterLimit($input[$fieldApi]);
                    $data = [
                        'status' => 200,
                        'error' => 200,
                        'message' => 'API VALID'
                    ];
                } else {
                    $data = [
                        'status' => 404,
                        'error' => 404,
                        'message' => [
                            'error' => 'API NOT VALID'
                        ]
                    ];
                }
            } else {
                $data = [
                    'status' => 404,
                    'error' => 404,
                    'message' => [
                        'error' => 'Please send -' . $fieldApi . '- in parameter REST API'
                    ]
                ];
            }

            if ($data['error'] == 404) {
                echo json_encode($data);
                die;
            }
        }
    }

    private function _insertLimit($apiKey)
    {
        $uri = 'uri:' . $this->request->getPath() . ':' . $this->request->getMethod();
        $controller = service('router')->controllerName();
        $data = [
            'controller' => $controller,
            'uri' => $uri,
            'count' => 1,
            'hour_started' => time(),
            'api_key' => $apiKey,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->table('limits')->insert($data);
    }

    public function method(string $method, int $limit)
    {
        $this->methods[$method]['limit'] = $limit;
        // dd($this->methods);
        $this->checkApi();
    }

    private function checkApi()
    {
        $rq = \Config\Services::request();
        $input = $rq->getRawInput();
        $get = $rq->getVar();
        $input = array_merge($input, $get);

        $fieldApi = $this->getRestKey();

        if ($fieldApi != false) {


            if (isset($input[$fieldApi])) {

                $resKeys = $this->db->table('keys')->where('key', $input[$fieldApi])->get()->getRowArray();

                if ($resKeys) {
                    $this->filterLimit($input[$fieldApi]);

                    $data = [
                        'status' => 200,
                        'error' => 200,
                        'message' => 'API VALID'
                    ];
                } else {
                    $data = [
                        'status' => 404,
                        'error' => 404,
                        'message' => [
                            'error' => 'API NOT VALID'
                        ]
                    ];
                }
            } else {
                $data = [
                    'status' => 404,
                    'error' => 404,
                    'message' => [
                        'error' => 'Please send -' . $fieldApi . '- in parameter REST API'
                    ]
                ];
            }

            if ($data['error'] == 404) {
                echo json_encode($data);
                die;
            }
        }
    }


    private function filterLimit($apiKey)
    {

        if ($this->rest_enable_limits == true) {
            if (count($this->methods) >  0) {
                $controller = service('router')->controllerName();
                $arrayMethod = $this->methods;
                foreach ($arrayMethod as $key => $d) {
                    if (strtolower($this->request->getMethod()) == $key) {
                        $cekCount = $this->db->table('limits')->selectSum('count', 'count')->where('api_key', $apiKey)->like('uri', $key)->where('controller', $controller)->get()->getRowArray()['count'];

                        if ($arrayMethod[$key]['limit'] > $cekCount) {
                            $this->_insertLimit($apiKey);
                        } else {
                            $data = [
                                'status' => 403,
                                'error' => 403,
                                'message' => [
                                    'error' => 'LIMIT API'
                                ]
                            ];

                            echo json_encode($data);
                            die;
                        }
                    } else {
                        $this->_insertLimit($apiKey);
                    }
                }

                return true;
            }
        }


        return false;
    }
}

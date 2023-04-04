<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class ApiKeyAuthFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $input = \Config\Services::request();
        $input = $input->getRawInput();
        $get = $request->getVar();
        $input = array_merge($input, $get);

        $db = db_connect();

        $fieldApi = 'api_key';

        if (isset($input[$fieldApi])) {
            $resKeys = $db->table('keys')->where('key', $input[$fieldApi])->get()->getRowArray();


            if ($resKeys) {
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

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}

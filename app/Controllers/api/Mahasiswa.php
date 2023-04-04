<?php

namespace App\Controllers\Api;

use App\Models\MahasiswaModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Libraries\RestApi;

class Mahasiswa extends RestApi
{
    use ResponseTrait;


    private $modelmahasiswa;
    public function __construct()
    {
        // helper('form');
        parent::__construct();
        // $this->methods['get']['limit'] = 10;
        $this->method('get', 10);
        $this->modelmahasiswa = new MahasiswaModel();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data['mahasiswa'] = $this->modelmahasiswa->orderBy('id', 'DESC')->findAll();
        return $this->respond($data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $data['mahasiswa'] = $this->modelmahasiswa->orderBy('id', 'DESC')->find($id);

        if ($data['mahasiswa']) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('No Mahasiswa found');
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        return $this->failNotFound('Route not found');
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $resPost = $this->request->getVar();
        // count($resPost) == 4

        $data = [
            'npm'  => $this->request->getVar('npm'),
            'nama' => $this->request->getVar('nama'),
            'email'  => $this->request->getVar('email'),
            'jurusan'  => $this->request->getVar('jurusan'),
        ];

        // $rules = $this->modelmahasiswa->validationRules;
        $rules = $this->modelmahasiswa->validationRulesInsert();
        $messageRules = $this->modelmahasiswa->validationMessages;

        // $rules = [
        //     'npm'     => 'required|alpha_numeric_space|min_length[9]',
        //     'email'        => 'required|valid_email|is_unique[mahasiswa.email]',
        //     'nama'        => 'required',
        //     'jurusan'        => 'required',
        // ];

        $input = $this->request->getVar();

        if (!$this->validateData($input, $rules, $messageRules)) {

            $response = [
                'status'   => 201,
                // 'error'    =>  validation_list_errors(),
                // gagal karena belum import helper form
                // 'error'    =>  validation_errors(),
                'error' => $this->validator->getErrors(),
                'messages' => [
                    'success' => 'Mahasiswa Failed Parameter successfully'
                ]
            ];
            return $this->respond($response);
        } else {

            $this->modelmahasiswa->save($data);

            $response = [
                'status'   => 201,
                'error'    => null,
                'messages' => [
                    'success' => 'Mahasiswa created successfully'
                ]
            ];
            return $this->respondCreated($response);
        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        return $this->failNotFound('Route not found');
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        // $id = $this->request->getVar('id');

        $dataRes = $this->modelmahasiswa->where('id', $id)->first();
        if ($dataRes) {

            // $rules = $this->modelmahasiswa->validationRules;

            // $input = $this->request->getVar();

            $input = $this->request->getRawInput();

            // return json_encode($input);

            // $validEmail = 'required|valid_email';

            // // jika ada input email maka kita cek email lama atau baru
            // if (isset($input['email'])) {
            //     if ($input['email'] != $dataRes['email']) {
            //         // maka akan cek is_unique email di database
            //         $validEmail = 'required|valid_email|is_unique[mahasiswa.email]';
            //     }
            // } else {
            //     // jika gak ada kasih required ama valid ajah
            //     $validEmail = $validEmail;
            // }

            // $rules = [
            //     'npm'     => 'required|alpha_numeric_space|min_length[9]',
            //     'email'        => $validEmail,
            //     'nama'        => 'required',
            //     'jurusan'        => 'required',
            // ];

            $rules = $this->modelmahasiswa->validationRulesUpdate($dataRes, $input);

            $dataRes = $this->modelmahasiswa->where('id', $id)->first();

            if (!$this->validateData($input, $rules)) {
                $response = [
                    'status'   => 201,
                    // 'error'    =>  validation_list_errors(),
                    // gagal karena belum import helper form
                    // 'error'    =>  validation_errors(),
                    'error' => $this->validator->getErrors(),
                    'messages' => [
                        'success' => 'Mahasiswa Failed Parameter successfully'
                    ]
                ];
                return $this->respond($response);
            } else {
                $data = [
                    'npm'  => $input['npm'],
                    'nama' => $input['nama'],
                    'email'  => $input['email'],
                    'jurusan'  => $input['jurusan'],
                ];

                $resk = $this->modelmahasiswa->update($id, $data);

                $response = [
                    'status'   => 200,
                    'error'    => null,
                    'data' => $resk,
                    'messages' => [
                        'success' => 'Mahasiswa updated successfully'
                    ]
                ];
                return $this->respond($response);
            }
        } else {
            return $this->failNotFound('No Mahasiswa found');
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $data = $this->modelmahasiswa->where('id', $id)->first();
        if ($data) {
            $this->modelmahasiswa->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Mahasiswa successfully deleted'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('No Mahasiswa found');
        }
    }
}

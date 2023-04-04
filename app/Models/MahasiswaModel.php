<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    // protected $DBGroup          = 'default';
    protected $table            = 'mahasiswa';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'npm',
        'nama',
        'email',
        'jurusan',
        'created_at',
        'updated_at',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];

    // protected $emailValid = $this->table . '.email';
    protected $validationRules = [
        'npm'     => 'required|alpha_numeric_space|min_length[9]',
        // |is_unique[mahasiswa.email]
        'email'        => 'required|valid_email',
        'nama'        => 'required',
        'jurusan'        => 'required',
        // 'password'     => 'required|min_length[8]',
        // 'pass_confirm' => 'required_with[password]|matches[password]',
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Sorry. That email has already been taken. Please choose another.',
            'required' => 'Coba isi donk email nya,.',
        ],
    ];


    protected $skipValidation       = false;
    protected $cleanValidationRules = true;


    // protected $skipValidation       = true;
    // kalau ini di aktif kan maka akan di skip validation dan akan terjadi input / edit data kosong

    // protected $cleanValidationRules = false;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function validationRulesUpdate(array $dataOld, array $dataRequest): array
    {
        $array = $this->validationRules;

        // $input = $this->request->getRawInput();
        $input = $dataRequest;

        // return json_encode($input);

        $validEmail = 'required|valid_email';

        // jika ada input email maka kita cek email lama atau baru
        if (isset($input['email'])) {
            if ($input['email'] != $dataOld['email']) {
                // maka akan cek is_unique email di database
                $validEmail = 'required|valid_email|is_unique[mahasiswa.email]';
            }
        } else {
            // jika gak ada kasih required ama valid ajah
            $validEmail = $validEmail;
        }

        $array['email'] = $validEmail;

        return $array;
    }

    public function validationRulesInsert(): array
    {
        $array = $this->validationRules;
        $validEmail = 'required|valid_email|is_unique[mahasiswa.email]';

        $array['email'] = $validEmail;

        return $array;
    }
}

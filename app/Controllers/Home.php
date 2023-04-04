<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [];
        // $db = db_connect();
        // $data['res'] = $db->query("SELECT * FROM information_schema.tables")->getResultArray();
        return view('welcome_message', $data);
    }
}

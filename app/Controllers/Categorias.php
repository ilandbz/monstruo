<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\DataSession;
use App\Traits\CategoriaTrait;

class Categorias extends BaseController
{
    use CategoriaTrait;

    public function index()
    {
        $data = DataSession::getData();
        $data['script'] = "categorias/script";
        return view('categorias/index',$data);
    }
}

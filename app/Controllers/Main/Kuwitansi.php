<?php

namespace App\Controllers\Main;
use App\Controllers\BaseController;

class Kuwitansi extends BaseController
{
    public function index()
    {
        parent::MasterView('kuwitansi/kuwitansi', []);
    }
}
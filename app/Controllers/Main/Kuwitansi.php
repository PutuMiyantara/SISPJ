<?php

namespace App\Controllers\Main;
use App\Controllers\BaseController;
use App\Models\ModelKuwitansi;
use CodeIgniter\Model;

class Kuwitansi extends BaseController
{
    public function index()
    {
        parent::MasterView('kuwitansi/kuwitansi', ['dataUrl' => parent::manageUrl()]);
    }

}
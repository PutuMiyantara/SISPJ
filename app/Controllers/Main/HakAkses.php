<?php

namespace App\Controllers\Main;
use App\Controllers\BaseController;

class HakAkses extends BaseController
{
    public function index()
    {
        parent::MasterView('hak_akses/hak_akses', ['dataUrl' => parent::manageUrl()]);
    }

    public function detail_hak_akses()
    {
        parent::MasterView('hak_akses/detail_hak_akses', ['dataUrl' => parent::manageUrl()]);
    }
}
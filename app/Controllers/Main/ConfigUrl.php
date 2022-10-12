<?php

namespace App\Controllers\Main;
use App\Controllers\BaseController;
use App\Models\ModelKuwitansi;
use CodeIgniter\Model;

class ConfigUrl extends BaseController
{
    public function index()
    {
        parent::MasterView('hak_akses/main_menu', []);
    }

    public function subMenu()
    {
        parent::MasterView('hak_akses/sub_menu', []);
    }
    
    public function subSubMenu()
    {
        parent::MasterView('hak_akses/sub_sub_menu', []);
    }
}
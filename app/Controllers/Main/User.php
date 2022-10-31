<?php

namespace App\Controllers\Main;

use App\Controllers\BaseController;
use App\Models\ModelUser;

class User extends BaseController
{
    public function index()
    {
        parent::masterView('user/user', ['dataUrl' => parent::manageUrl()]);
    }

    public function detail()
    {
        $this->masterView('/user/detail', ['dataUrl' => parent::manageUrl()]);
    }

    public function tambah()
    {
        $this->masterView('/user/tambah', ['dataUrl' => parent::manageUrl()]);
    }

    public function admin()
    {
        $this->masterView('templates/user/admin', ['dataUrl' => parent::manageUrl()]);
    }
    public function pegawai()
    {
        $this->masterView('templates/user/pegawai', ['dataUrl' => parent::manageUrl()]);
    }
}
<?php

namespace App\Controllers\Main;
use App\Controllers\BaseController;

class RekeningBelanja extends BaseController
{
    public function index()
    {
        parent::MasterView('rekening_belanja/rekening_belanja', []);
    }

    public function sub1()
    {
        // $model = new \App\Models\ModelKodeBelanjaSub1();
        // $data['list'] = $model->getSearchRekDasar();
        // parent::MasterView('rekening_belanja/kode_belanja_sub1/tambah', $data);
        // parent::MasterView('rekening_belanja/kode_belanja_sub1/kode_belanja_sub1', $data);
        parent::MasterView('rekening_belanja/kode_belanja_sub1/kode_belanja_sub1', []);
    }

    public function sub2()
    {
        parent::MasterView('rekening_belanja/kode_belanja_sub2/kode_belanja_sub2', []);
    }

    public function sub3()
    {
        parent::MasterView('rekening_belanja/kode_belanja_sub3/kode_belanja_sub3', []);
    }

    public function sub4()
    {
        parent::MasterView('rekening_belanja/kode_belanja_sub4/kode_belanja_sub4', []);
    }

    public function sub5()
    {
        parent::MasterView('rekening_belanja/kode_belanja_sub5/kode_belanja_sub5', []);
    }
}
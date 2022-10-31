<?php

namespace App\Controllers\Main;
use App\Controllers\BaseController;

class RekeningBelanja extends BaseController
{
    public function index()
    {
        parent::MasterView('rekening_belanja/rekening_belanja', ['dataUrl' => parent::manageUrl()]);
    }

    public function sub1()
    {
        parent::MasterView('rekening_belanja/kode_belanja_sub1/kode_belanja_sub1', ['dataUrl' => parent::manageUrl()]);
    }

    public function sub2()
    {
        parent::MasterView('rekening_belanja/kode_belanja_sub2/kode_belanja_sub2', ['dataUrl' => parent::manageUrl()]);
    }

    public function sub3()
    {
        parent::MasterView('rekening_belanja/kode_belanja_sub3/kode_belanja_sub3', ['dataUrl' => parent::manageUrl()]);
    }

    public function sub4()
    {
        parent::MasterView('rekening_belanja/kode_belanja_sub4/kode_belanja_sub4', ['dataUrl' => parent::manageUrl()]);
    }

    public function sub5()
    {
        parent::MasterView('rekening_belanja/kode_belanja_sub5/kode_belanja_sub5', ['dataUrl' => parent::manageUrl()]);
    }
}
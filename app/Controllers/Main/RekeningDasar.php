<?php

namespace App\Controllers\Main;
use App\Controllers\BaseController;

class RekeningDasar extends BaseController
{
    public function index()
    {
        parent::MasterView('rekening_dasar/rekening_dasar', []);
    }

    public function kodeDinas()
    {
        parent::MasterView('rekening_dasar/kode_dinas/kode_dinas', []);
    }

    public function kodeUrusan()
    {
        parent::MasterView('rekening_dasar/kode_urusan/kode_urusan', []);
    }

    public function kodeBidang()
    {
        parent::MasterView('rekening_dasar/kode_bidang/kode_bidang', []);
    }

    public function kodeKegiatan()
    {
        parent::MasterView('rekening_dasar/kode_kegiatan/kode_kegiatan', []);
    }

    public function kodeProgram()
    {
        parent::MasterView('rekening_dasar/kode_program/kode_program', []);
    }

    public function kodeUnit()
    {
        parent::MasterView('rekening_dasar/kode_unit/kode_unit', []);
    }
}
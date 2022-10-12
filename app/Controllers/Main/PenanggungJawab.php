<?php

namespace App\Controllers\Main;
use App\Controllers\BaseController;

class PenanggungJawab extends BaseController
{
    public function kpa_ppk()
    {
        parent::MasterView('/penanggung_jawab/kpa_ppk', []);
    }
    public function pptk()
    {
        parent::MasterView('/penanggung_jawab/pptk', []);
    }
    public function bendahara()
    {
        parent::MasterView('/penanggung_jawab/bendahara', []);
    }
    public function pengurus_barang()
    {
        parent::MasterView('/penanggung_jawab/pengurus_barang', []);
    }

}
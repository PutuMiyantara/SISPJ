<?php

namespace App\Controllers\Main;
use App\Controllers\BaseController;

class PenanggungJawab extends BaseController
{
    public function kpa_ppk()
    {
        parent::MasterView('/penanggung_jawab/kpa_ppk', ['dataUrl' => parent::manageUrl()]);
    }
    public function pptk()
    {
        parent::MasterView('/penanggung_jawab/pptk', ['dataUrl' => parent::manageUrl()]);
    }
    public function bendahara()
    {
        parent::MasterView('/penanggung_jawab/bendahara', ['dataUrl' => parent::manageUrl()]);
    }
    public function pengurus_barang()
    {
        parent::MasterView('/penanggung_jawab/pengurus_barang', ['dataUrl' => parent::manageUrl()]);
    }

}
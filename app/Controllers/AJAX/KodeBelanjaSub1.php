<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelKodeBelanjaSub1;

class KodeBelanjaSub1 extends BaseController{
    public function index(){
        $model = new ModelKodeBelanjaSub1();
        $data = array(
            'id' => '1',
            'kode_belanja_sub1' => '001',
            'uraian' => 'Belanja Dasar'
        );
        echo json_encode($data); 
    }
}
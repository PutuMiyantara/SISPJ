<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelKodeDinas;

class KodeDinas extends BaseController{
    public function __construct()
    {
        $this->mKodeDinas = new ModelKodeDinas();
    }

    public function index($search)
    {
        $data = $this->mKodeDinas->getKodeDinas(null);
        $result = [];
        if ($search == 'search') {
            # code...
            foreach ($data as $key) {
                # code...
                array_push($result,
                [
                    'id_kode_dinas' => $key->id,
                    'kode_dinas' => (
                        $key->kode_rek_dinas . " - " .
                        $key->nama_rek_dinas)
                ]);
            }
        } else{
            $result = $data;
        }
        echo json_encode($result);
    }

    public function insertData(){
        $dataJSON = $this->request->getJSON(true);
        $errortext[] ='';
        $message = '';

        if($this->validator->run($dataJSON, 'koderekeningdinas')){
            if ($this->mKodeDinas->insertData($dataJSON)) {
                $message = 'Berhasil Menyimpan Data';
            }
            else{
                $errortext[] = 'Gagal Memasukan Data';
            }
        } else{
            $errortext[] = implode(', ', $this->validator->getErrors());
        }
        $validationtext = implode('', $errortext);
        $output = array('errortext' => $validationtext, 'message' => $message);
        echo json_encode($output);
    }

    public function getDetail($id){
        $where = array('id' => $id);
        echo json_encode($this->mKodeDinas->getKodeDinas($where));
    }
    
    public function updateData($id){
        $where = array('id' => $id);
        $dataJSON = $this->request->getJSON(true);
        $errortext[] ='';

        $message = '';
        if ($this->validator->run($dataJSON, 'koderekeningdinas')) {
            # code...
            if ($this->mKodeDinas->updateData($where, $dataJSON)) {
                # code...
                $message = "Berhasil Menyimpan Data";
            } else{
                $errortext[] ='Gagal Menyimpan Data';
            }
        } else{
            $errortext[] = implode(', ', $this->validator->getErrors());
        }

        $validationtext = implode('', $errortext);
        $output = array('errortext' => $validationtext, 'message' => $message);
        echo json_encode($output);
    }

    public function deleteData(){
        $where = $this->request->getJSON(true);
        $this->mKodeDinas->deleteData($where);
        return true;
    }


}
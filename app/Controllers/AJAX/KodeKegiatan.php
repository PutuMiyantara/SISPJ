<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelKodeKegiatan;

class KodeKegiatan extends BaseController{
    public function __construct()
    {
        $this->mKodeKegiatan = new ModelKodeKegiatan();
    }

    public function index($search)
    {
        $data = $this->mKodeKegiatan->getKodeKegiatan(null);
        $result = [];
        if ($search == 'search') {
            # code...
            foreach ($data as $key) {
                # code...
                array_push($result,
                [
                    'id_kode_kegiatan' => $key->id,
                    'kode_kegiatan' => (
                        $key->kode_rek_kegiatan . " - " .
                        $key->nama_rek_kegiatan)
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

        if($this->validator->run($dataJSON, 'koderekeningkegiatan')){
            if ($this->mKodeKegiatan->insertData($dataJSON)) {
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
        echo json_encode($this->mKodeKegiatan->getKodeKegiatan($where));
    }
    
    public function updateData($id){
        $where = array('id' => $id);
        $dataJSON = $this->request->getJSON(true);
        $errortext[] ='';

        $message = '';
        if ($this->validator->run($dataJSON, 'koderekeningkegiatan')) {
            # code...
            if ($this->mKodeKegiatan->updateData($where, $dataJSON)) {
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
        $this->mKodeKegiatan->deleteData($where);
        return true;
    }


}
<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelKodeProgram;

class KodeProgram extends BaseController{
    public function __construct()
    {
        $this->mKodeUrusan = new ModelKodeProgram();
    }

    public function index($search)
    {
        $data = $this->mKodeUrusan->getKodeProgram(null);
        $result = [];
        if ($search == 'search') {
            # code...
            foreach ($data as $key) {
                # code...
                array_push($result,
                [
                    'id_kode_program' => $key->id,
                    'kode_program' => (
                        $key->kode_rek_program . " - " .
                        $key->nama_rek_program)
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

        if($this->validator->run($dataJSON, 'koderekeningprogram')){
            if ($this->mKodeUrusan->insertData($dataJSON)) {
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
        echo json_encode($this->mKodeUrusan->getKodeProgram($where));
    }
    
    public function updateData($id){
        $where = array('id' => $id);
        $dataJSON = $this->request->getJSON(true);
        $errortext[] ='';

        $message = '';
        if ($this->validator->run($dataJSON, 'koderekeningprogram')) {
            # code...
            if ($this->mKodeUrusan->updateData($where, $dataJSON)) {
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
        $this->mKodeUrusan->deleteData($where);
        return true;
    }


}
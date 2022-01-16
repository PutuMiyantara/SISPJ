<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelRekeningDasar;

class RekeningDasar extends BaseController{
    public function __construct()
    {
        $this->mRekeningDasar = new ModelRekeningDasar();
    }

    public function index()
    {
        echo json_encode($this->mRekeningDasar->getRekeningDasar(null));
    }

    public function insertData(){
        $dataJSON = $this->request->getJSON(true);
        $errortext[] ='';
        $message = '';

        if($this->validator->run($dataJSON, 'koderekeningdasar')){
            if ($this->mRekeningDasar->insertData($dataJSON)) {
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
        $where = array('tb_rekening_dasar.id' => $id);
        echo json_encode($this->mRekeningDasar->getRekeningDasar($where));
    }
    
    public function updateData($id){
        $where = array('id' => $id);
        $dataJSON = $this->request->getJSON(true);
        $errortext[] ='';

        $message = '';
        if ($this->validator->run($dataJSON, 'koderekeningdasar')) {
            # code...
            if ($this->mRekeningDasar->updateData($where, $dataJSON)) {
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
        $this->mRekeningDasar->deleteData($where);
        return true;
    }


}
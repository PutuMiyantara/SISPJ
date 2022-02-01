<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelKodeBelanjaSub1;

class KodeBelanjaSub1 extends BaseController{
    public function __construct()
    {
        $this->mKodeBelanjaSub1 = new ModelKodeBelanjaSub1();
    }

    public function index()
    {
        echo json_encode($this->mKodeBelanjaSub1->getKodeBelanjaSub1(null));
    }

    public function searchRekDasar(){
        // $test = $this->input->get('test');
        echo json_encode($this->mKodeBelanjaSub1->getSearchRekDasar());
        // echo json_encode($this->mKodeBelanjaSub1->getSearchRekDasar($test));
    }

    public function insertData(){
        $dataJSON = $this->request->getJSON(true);
        $errortext[] ='';
        $message = '';

        if($this->validator->run($dataJSON, 'kodebelanjasub1')){
            if ($this->mKodeBelanjaSub1->insertData($dataJSON)) {
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
        $where = array('tb_kode_belanja_sub1.id' => $id);
        echo json_encode($this->mKodeBelanjaSub1->getKodeBelanjaSub1($where));
    }
    
    public function updateData($id){
        $where = array('id' => $id);
        $dataJSON = $this->request->getJSON(true);
        $errortext[] ='';

        $message = '';
        if ($this->validator->run($dataJSON, 'kodebelanjasub1')) {
            # code...
            if ($this->mKodeBelanjaSub1->updateData($where, $dataJSON)) {
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
        $this->mKodeBelanjaSub1->deleteData($where);
        return true;
    }


}
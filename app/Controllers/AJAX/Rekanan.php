<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelRekanan;

class Rekanan extends BaseController{
    public function __construct()
    {
        $this->mRekanan = new ModelRekanan();
    }

    public function index()
    {
        echo json_encode($this->mRekanan->getKpaPpk(null));
    }

    public function insertData(){
        $dataJSON = $this->request->getJSON(true);
        $errortext[] ='';
        $message = '';

        if($this->validator->run($dataJSON, 'rekanan')){
            if ($this->mRekanan->insertData($dataJSON)) {
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
        echo json_encode($this->mRekanan->getKpaPpk($where));
    }
    
    public function updateData($id, $data){
        $where = array('id' => $id);
        $errortext[] ='';
        $message = '';
        
        if ($this->validator->run($data, 'rekanan')) {
            # code...
            if ($this->mRekanan->updateData($where, $data)) {
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
        $this->mRekanan->deleteData($where);
        return true;
    }


}